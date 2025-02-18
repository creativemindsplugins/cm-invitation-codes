<?php
namespace com\cminds\registration\controller;

use com\cminds\registration\model\Settings;
use com\cminds\registration\lib\Email;
use com\cminds\registration\model\Labels;
use com\cminds\registration\model\User;
use com\cminds\registration\App;

class EmailVerificationController extends Controller {
	
	const PARAM_VERIFICATION_CODE = 'cmreg_verification_code';
	const PARAM_VERIFICATION_MSG = 'cmreg_verification_msg';
	const CRON_ACTION = 'cmreg_delete_inactive_users';
	const NONCE_RESEND_EMAIL = 'cmreg_resend_email';
	const FILTER_VERIFICATION_ENABLED = 'cmreg_registration_email_verification_enabled';
	
	static $actions = array(
		'init' => array('priority' => 1),
		'wp_enqueue_scripts',
		'register_new_user' => array('args' => 1, 'priority' => 100),
		'edit_user_profile' => array('args' => 1, 'method' => 'show_user_profile'),
		'show_user_profile' => array('args' => 1),
		self::CRON_ACTION,
	);

	static $filters = array(
		'authenticate' => array('args' => 3, 'priority' => 100),
		'cmreg_user_can_login' => array('args' => 2),
		'cmreg_registration_ajax_response' => array('args' => 2, 'priority' => 500),
	);

	static $ajax = array(
		'cmreg_manually_activation',
		'cmreg_resend_activation_email',
	);
	
	static function init() {

		// CRON job to delete inactive users
		if (wp_get_schedule(self::CRON_ACTION) === false) {
			wp_clear_scheduled_hook(self::CRON_ACTION);
			wp_schedule_event(time(), 'daily', self::CRON_ACTION);
		}

        $verify_code = $_GET[self::PARAM_VERIFICATION_CODE] ?? '';

        if (App::isLicenseOk() && !empty($verify_code)) {
            add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueAccountVerificationScript']);
            if ($userId = User::verifyEmail($verify_code)) {
                if (Settings::getOption(Settings::OPTION_REGISTER_EMAIL_VERIFICATION_AUTOLOGIN)) {
                    User::loginById($userId);

                    if (Settings::getOption(Settings::OPTION_REGISTER_WELCOME_EMAIL_ENABLE)) {
                        Email::sendWelcomeEmail($userId);
                    }

                    // Perform redirection because some parts of WordPress still think user is not logged-in
                    $url = remove_query_arg(static::PARAM_VERIFICATION_CODE, $_SERVER['REQUEST_URI']);
                    $url = add_query_arg(static::PARAM_VERIFICATION_MSG, 'register_account_verification_success', $url);
                    wp_redirect($url);

                    exit;
                }

                if (Settings::getOption(Settings::OPTION_REGISTER_WELCOME_EMAIL_ENABLE)) {
                    Email::sendWelcomeEmail($userId);
                }

                $msg = 'You account has been verified.';
            } else {
                $msg = 'Failed to verify your account.';
            }

            add_action('wp_enqueue_scripts', function () use ($msg) {
                wp_localize_script('cmreg_show_toast_message', 'cmreg_show_toast_message', compact('msg'));
            });

        }
    }
	
	static function wp_enqueue_scripts() {
		if ($label = filter_input(INPUT_GET, static::PARAM_VERIFICATION_MSG)) {
			$msg = Labels::getLocalized($label);
			if ($msg != $label) {
				static::enqueueAccountVerificationScript();
				wp_localize_script('cmreg_show_toast_message', 'cmreg_show_toast_message', compact('msg'));
			}
		}
	}
	
	static function enqueueAccountVerificationScript() {
		wp_enqueue_script('cmreg_show_toast_message');
	}
	
	static function getVerificationUrl($userId, $code) {
		return add_query_arg(self::PARAM_VERIFICATION_CODE, $code, RegistrationController::getWelcomeUrl($userId));
	}

	static function sendEmailVerification($userId, $verificationCode) {
		$user = get_userdata($userId);
		if (empty($user)) return false;
		
		$email = $user->user_email;
		
		/*
		if(Settings::getOption(Settings::OPTION_REGISTER_EMAIL_VERIFICATION_ON_SECONDARY_EMAIL_ENABLE) == '1') {
			if(Settings::getOption(Settings::OPTION_REGISTER_SECONDARY_EMAIL_FIELD_META_KEY) != '') {
				$email = get_user_meta($userId, Settings::getOption(Settings::OPTION_REGISTER_SECONDARY_EMAIL_FIELD_META_KEY), true);
			}
		}
		*/

		return Email::send(
			$email,
			Settings::getOption(Settings::OPTION_REGISTER_ACTIVATION_EMAIL_SUBJECT),
			wpautop(Settings::getOption(Settings::OPTION_REGISTER_ACTIVATION_EMAIL_BODY)),
			self::getEmailVerificationVars($userId, $verificationCode)
		);
	}
	
	static function getEmailVerificationVars($userId, $verificationCode) {
		$vars = Email::getBlogVars() + Email::getUserVars($userId);
		$vars['[linkurl]'] = static::getVerificationUrl($userId, $verificationCode);
		return $vars;
	}
	
	/**
	 * After successful registration
	 *
	 * @param unknown $userId
	 */
	static function register_new_user($userId) {
		if (!App::isLicenseOk()) return;

		if (static::isVerificationEnabledForUser($userId)) {
			$verificationCode = User::generateEmailVerificationCode($userId);
            static::sendEmailVerification($userId, $verificationCode);
		}
	}
	
	static function authenticate($user, $username, $password) {
		if (!App::isLicenseOk()) return $user;
		
		$addError = function($errorCode, $msg) use (&$user) {
			if (is_wp_error($user)) {
				$user->add($errorCode, $msg);
			} else {
				$user = new \WP_Error($errorCode, $msg);
			}
		};
		
		if ($userData = get_user_by('login', $username) AND !User::canLogin($userData->ID)) {
			$addError('email_not_verified', Labels::getLocalized('login_error_email_not_verified'));
		}
		
		return $user;
		
	}
	
	static function cmreg_user_can_login($result, $userId) {
		if ($result) {
			$result = User::canLogin($userId);
		}
		return $result;
	}
	
	static function cmreg_delete_inactive_users() {
		User::deleteInactiveUsers();
	}
	
	static function cmreg_registration_ajax_response($response, $userId) {
		if ($userId AND !empty($response['success'])) {
			$status = User::getEmailVerificationStatus($userId);
			if (User::EMAIL_VERIFICATION_STATUS_PENDING == $status) {
				/*
				if(Settings::getOption(Settings::OPTION_REGISTER_EMAIL_VERIFICATION_ON_SECONDARY_EMAIL_ENABLE) == '1') {
					$response['msg'] = Labels::getLocalized('register_secondary_email_verification_msg');
				} else {
				*/
					$response['msg'] = Labels::getLocalized('register_verification_msg');
				//}
			}
		}
		return $response;
	}
	
	static function show_user_profile(\WP_User $user) {
		$userId = $user->ID;
		if (static::isVerificationEnabledForUser($userId)) {
			wp_enqueue_script('cmreg-backend');
			$canLogin = User::canLogin($userId);
			$nonce = wp_create_nonce(static::NONCE_RESEND_EMAIL);
			echo static::loadBackendView('user-activation-status', compact('canLogin', 'userId', 'nonce'));
		}
	}
	
	static function cmreg_manually_activation() {
		$nonce = filter_input(INPUT_POST, 'nonce');
		$userId = filter_input(INPUT_POST, 'userId');
		if ($nonce AND wp_verify_nonce($nonce, static::NONCE_RESEND_EMAIL) AND $userId) {
			if (User::canLogin($userId)) {
				echo 'This user has been already activated.';
			} else {
				update_user_meta($userId, 'cmreg_email_verification_status', 'verified');
			}
		} else {
			echo 'Invalid input data.';
		}
		exit;
	}

	static function cmreg_resend_activation_email() {
		$nonce = filter_input(INPUT_POST, 'nonce');
		$userId = filter_input(INPUT_POST, 'userId');
		if ($nonce AND wp_verify_nonce($nonce, static::NONCE_RESEND_EMAIL) AND $userId) {
			if (!static::isVerificationEnabledForUser($userId)) {
				echo 'Email verification is not required for this user.';
			}
			else if (User::canLogin($userId)) {
				echo 'This user has been already activated.';
			}
			else if ($verificationCode = User::getEmailVerificationCode($userId)) {
				static::sendEmailVerification($userId, $verificationCode);
				echo 'Email has been sent.';
			} else {
				echo 'Unknown verification code.';
			}
		} else {
			echo 'Invalid input data.';
		}
		exit;
	}
	
	static function isVerificationEnabledForUser($userId) {
		return apply_filters(
            static::FILTER_VERIFICATION_ENABLED,
            User::isVerificationEnabled($userId),
            $userId
        );
	}

}