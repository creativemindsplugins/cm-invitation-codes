<?php
namespace com\cminds\registration\controller;

use WP_Query;
use com\cminds\registration\App;
use com\cminds\registration\lib\Email;
use com\cminds\registration\model\Labels;
use com\cminds\registration\model\Settings;
use com\cminds\registration\model\InvitationCode;
use com\cminds\registration\shortcode\CreateInvitationCodeShortcode;

class InvitationCodesController extends Controller {

    const PARAM_INVITATION_CODE = 'cmreg_code';
    const PARAM_ACTION = 'cmreg_action';
    const COOKIE_INVITATION_CODE = 'cmreg_invitation_code';
    const ACTION_USER_CREATE_CODE = 'cmreg_user_create_invitation_code';
    const ACTION_USER_SEND_CODE = 'cmreg_user_send_invitation_code';
    const FIELD_INVITATION_CODE = 'cmreg_invit_code';
    const FILTER_GET_INPUT_INVITATION_CODE = 'cmreg_get_input_invitation_code';

    static $filters = [
        'cmreg_options_config' => ['priority' => 50],
        'cmreg_create_invitation_code' => ['args' => 2],
    ];

    static $actions = [
        'plugins_loaded',
        'register_post' => ['args' => 3],
        'register_new_user' => ['args' => 1, 'priority' => 20],
        'cmreg_profile_edit_form' => ['args' => 1, 'priority' => 100],
    ];

    static $ajax = [
        'cmreg_user_create_invitation_code',
        'cmreg_user_send_invitation_code',
    ];

    static function plugins_loaded() {
        // Set cookie with the invitation code to further use
        $code = filter_input(INPUT_GET, static::PARAM_INVITATION_CODE);
		if(!empty($code)) {
			if (strlen($code) > 0) {
				setcookie(static::COOKIE_INVITATION_CODE, $code, time() + 3600 * 24 * 365);
			}
		}
    }

    static function register_form($place = null) {

    }

    static function getInvitationCodeField($invitationCodeLabel = '', $invitationCodePlaceholder = '', $invitationCodeTooltip = '') {
        $invitationCodeRequired = (Settings::getOption(Settings::OPTION_REGISTER_INVIT_CODE) == Settings::INVITATION_CODE_REQUIRED);

		$invitationCode = '';
		if(!empty($_GET['invite'])) {
			$invitationCode = $_GET['invite'];
		} else if(!empty($_GET[self::PARAM_INVITATION_CODE])) {
			$invitationCode = $_GET[self::PARAM_INVITATION_CODE];
		}

        $showInvitationCode = (Settings::getOption(Settings::OPTION_REGISTER_INVIT_CODE) != Settings::INVITATION_CODE_DISABLED);
        if ($showInvitationCode) {
            return self::loadFrontendView('registration', compact('invitationCodeRequired', 'invitationCode', 'invitationCodeLabel', 'invitationCodePlaceholder', 'invitationCodeTooltip'));
        }
        return "";
    }

    /**
     * Validate the registration
     *
     * @param string $sanitized_user_login
     * @param string $user_email
     * @param \WP_Error $errors
     */
    static function register_post($sanitized_user_login, $user_email, \WP_Error $errors) {
        //if (App::isLicenseOk()) {

            //$codeRequired = (Settings::getOption(Settings::OPTION_REGISTER_INVIT_CODE) == Settings::INVITATION_CODE_REQUIRED);

            // Validate invitation code before registration
            $invitationCode = static::getInputInvitationCode();

            /**
             * @var $code InvitationCode
             */
            $code = InvitationCode::getByCode($invitationCode);

            if (!empty($invitationCode) and (empty($code) or $code->getStatus() != 'publish')) {

                // Code doesn't exists

                //if ($codeRequired) { // but it's required
                    $errors->add('invalid_invitation_code', Labels::getLocalized('register_invit_code_invalid_error'));
                //}

            } else {

                // Code exists
				
				if($code) {

					$requireEmail = $code->getRequiredEmail();
					//var_dump($requireEmail);var_dump($user_email);exit;
					if (!empty($requireEmail) and strtolower($requireEmail) != strtolower($user_email)) {
						$errors->add('expected_different_email', Labels::getLocalized('register_invit_code_expected_different_email_error'));
					}

					$usersLimit = $code->getUsersLimit();
					if (!empty($usersLimit) and $usersLimit <= $code->getUsersCount()) {
						$errors->add('invit_code_users_limit_error', Labels::getLocalized('register_invit_code_users_limit_error'));
					}

					$expiration = $code->getExpirationDate();
					if (!empty($expiration) and $expiration < time()) {
						$errors->add('invit_code_expired_error', Labels::getLocalized('register_invit_code_expired_error'));
					}

				}

            }

        //}
    }

    static function getInputInvitationCode() {
        return apply_filters(static::FILTER_GET_INPUT_INVITATION_CODE, filter_input(INPUT_POST, static::FIELD_INVITATION_CODE));
    }

    /**
     * After successful registration
     *
     * @param unknown $userId
     */
    static function register_new_user($userId) {

        //if (!App::isLicenseOk()) return;

        $invitationCode = static::getInputInvitationCode();
        $code = InvitationCode::getByCode($invitationCode);
        if ($code) {
            $code->registerInvitation($userId);
        }

    }

    static function cmreg_options_config($config) {
        return array_merge($config, [
            Settings::OPTION_REGISTER_INVIT_CODE => [
                'type' => Settings::TYPE_RADIO,
                'options' => [
                    Settings::INVITATION_CODE_DISABLED => 'disabled',
                    Settings::INVITATION_CODE_OPTIONAL => 'optional',
                    Settings::INVITATION_CODE_REQUIRED => 'required',
                ],
                'default' => Settings::INVITATION_CODE_OPTIONAL,
                'category' => 'register',
                'subcategory' => 'register',
                'title' => 'Ask for invitation code',
            ],
			'_onlyinpro_64' => [
                'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
                'category' => 'register',
                'subcategory' => 'register',
                'title' => 'Hide invitation code field',
                'desc' => 'Hide invitation code field if the user went to the site by invitation link.',
            ],
			'_onlyinpro_65' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Default role',
				'desc' => 'User\'s role granted after the registration.',
			),
			'_onlyinpro_66' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Terms of service acceptance text',
				'desc' => 'Enter text which will be displayed next to the checkbox that users have to check to accept terms of service. If left empty checkboxes will not be displayed.',
			),
			'_onlyinpro_67' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Allow auto login after registration',
				'desc' => 'If enabled, then user will be logged-in to Wordpress automatically after registration.',
			),
			'_onlyinpro_68' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Redirect after register to URL address',
				'desc' => 'Enter an option URL address that users will be redirected after regster. If empty user will stay on the same page.<br />'
							. 'You can use the <kbd>%usernicename%</kbd>, <kbd>%userlogin%</kbd> and <kbd>%usersitename%</kbd> parameter in the URL.<br><br>For example: '
							. '<kbd>/welcome/%usernicename%</kbd>.',
			),
        ]);
    }

    static function cmreg_create_invitation_code($result, $args) {

        $result = [];

        $post = [
            'ID' => null,
            'post_title' => $args['name'],
            'post_type' => InvitationCode::POST_TYPE,
            'post_status' => 'publish',
        ];
        $obj = new InvitationCode((object)$post);
        if ($obj->save()) {
            $obj->setCodeString($args['code'] ?? $obj->getOrGenerateCodeString());
            if (isset($args['role'])) {
                $obj->setUserRole($args['role']);
            }
            if (isset($args['loginRedirectionUrl'])) {
                $obj->setLoginRedirectionUrl($args['loginRedirectionUrl']);
            }
            if (isset($args['usersLimit']) and is_numeric($args['usersLimit']) and $args['usersLimit'] > 0) {
                $obj->setUsersLimit($args['usersLimit']);
            }
            if (isset($args['expirationDate'])) {
                $obj->setExpirationDate($args['expirationDate']);
            }
            if (isset($args['requiredEmail'])) {
                $obj->setRequiredEmail($args['requiredEmail']);
            }
            if (isset($args['emailVerification'])) {
                $obj->setEmailVerificationStatus($args['emailVerification']);
            }
            if (isset($args['paymentStatus'])) {
                update_post_meta($obj->getId(), 'cmreg_eddpay_require_payment', $args['paymentStatus']);
            }
            if (isset($args['productId'])) {
                update_post_meta($obj->getId(), 'cmreg_pay_woo_product_id', $args['productId']);
            }
            if (isset($args['customUrl'])) {
                update_post_meta($obj->getId(), 'cmreg_eddpay_payment_custom_url', $args['customUrl']);
            }
            $result['ID'] = $obj->getId();
            $result['codeString'] = $obj->getCodeString();
            $result['instance'] = $obj;
        } else {
            $result = false;
        }

        return $result;

    }

    private static function generateCode(array $atts, $params = []): InvitationCode {
        $user_id = $params['user_id'] ?? get_current_user_id();
        $code_owner = get_user_by('id', $user_id);

        $inv_code = [
            'ID' => null,
            'post_title' => 'Created by ' . $code_owner->user_login . ' user',
            'post_type' => InvitationCode::POST_TYPE,
            'post_status' => 'publish',
            'post_author' => $user_id
        ];

        $invitationCode = new InvitationCode((object)$inv_code);
        $inv_id = $invitationCode->save();

        if (!$inv_id) {
            return InvitationCode::getInstance();
        }

        if (!empty($params['code_string'])) {
            $invitationCode->setCodeString($params['code_string']);
        }

        if (!empty($atts['role'])) {
            $invitationCode->setUserRole($atts['role']);
        }
        if (!empty($atts['userslimit']) and is_numeric($atts['userslimit']) and $atts['userslimit'] > 0) {
            $invitationCode->setUsersLimit($atts['userslimit']);
        }
        if (!empty($atts['expiration'])) {
            $invitationCode->setExpirationDate($atts['expiration']);
        }

        $verifyemail = $atts['verifyemail'] ?? 'global';
        if (empty($verifyemail)) {
            $verifyemail = 'global';
        }
        $invitationCode->setEmailVerificationStatus($verifyemail);

        if (!empty($atts['emailinput']) && !empty($params['email'])) {
            $invitationCode->setRequiredEmail($params['email']);
        }

        return $invitationCode;
    }


    static function cmreg_user_create_invitation_code() {
        $response = ['success' => false, 'msg' => "An error occurred."];
        $nonce = filter_input(INPUT_POST, 'nonce');
        $hash = filter_input(INPUT_POST, 'hash');

        if (!wp_verify_nonce($nonce, static::ACTION_USER_CREATE_CODE) || !$hash) {
            header('content-type: application/json');
            echo json_encode($response);
            exit;
        }

        $atts = CreateInvitationCodeShortcode::getAttributesByHash($hash);

        if (!empty($atts['expiration'])) {
            if ($time = strtotime($atts['expiration'])) {
                $atts['expiration'] = Date('Y-m-d H:i:s', $time);
            }
        }

        if (empty($atts) || !is_array($atts)) {
            $response['msg'] = 'Cannot perform the action. Please try again.';
            header('content-type: application/json');
            echo json_encode($response);
            exit;
        }

        $response_html = '';

        $showlink = filter_input(INPUT_POST, 'showlink');
        $emails = self::validateEmails((array)($_POST['email'] ?? []));

        if (empty($emails)) {
            $emails = [''];
        }

        if (empty($atts['role'])) {
            // use from global settings
            $atts['role'] = Settings::getOption(Settings::OPTION_REGISTER_DEFAULT_ROLE);
        }

        $response['codeString'] = [];
        $invitationCodes = [];
        foreach ($emails as $email) {

            $invitationCode = self::generateCode($atts, ['email' => $email]);

            if (!is_a($invitationCode, 'com\cminds\registration\model\InvitationCode')) {
                continue;
            }

            $invitationCodes[] = $invitationCode;

            $link = Settings::getOption(Settings::OPTION_INVITE_FRIEND_REGISTRATION_PAGE_URL);
            if (empty($link)) {
                $link = site_url();
            }

            $codeString = $response['codeString'][] = $invitationCode->getOrGenerateCodeString();
            $link = add_query_arg([static::PARAM_INVITATION_CODE => $codeString], $link);

            if (!empty($email)) {
                static::sendInvitationToEmail($invitationCode, $email, get_current_user_id());
            }

            $response_html .= static::loadFrontendView(
                'create-invitation-code-result',
                compact('codeString', 'link', 'showlink', 'email')
            );
        }

        if (empty($invitationCodes)) {
            $response['msg'] = 'Cannot create the invitation code. Please try again.';
            header('content-type: application/json');
            echo json_encode($response);
            exit;
        }

        $response = [
            'success' => true,
            'html' => $response_html,
        ];

        header('content-type: application/json');
        echo json_encode($response);
        exit;
    }

    static function cmreg_user_send_invitation_code() {
        $response = ['success' => false, 'msg' => "An error occurred."];
        $nonce = filter_input(INPUT_POST, 'nonce');

        if (!wp_verify_nonce($nonce, static::ACTION_USER_SEND_CODE)) {
            header('content-type: application/json');
            echo json_encode($response);
            exit;
        }

        $emails = self::validateEmails((array)($_POST['email'] ?? []));

        if (empty($emails)) {
            header('content-type: application/json');
            $response['msg'] = 'Incorrect emails.';
            echo json_encode($response);
            exit;
        }

        $invitationCode = self::getUserReferralCode(get_current_user_id());
        if (!$invitationCode || !is_a($invitationCode, 'com\cminds\registration\model\InvitationCode')) {
            header('content-type: application/json');
            $response['msg'] = 'Incorrect invitation code.';
            echo json_encode($response);
            exit;
        }

        $codeString = $invitationCode->getOrGenerateCodeString();
        $link = self::getUserReferralLink(get_current_user_id());
        foreach ($emails as $email) {
            if (!empty($email)) {
                $email_link = $link . "&cmreg_referral_email={$email}";
                static::sendReferralInvitationToEmail($invitationCode, $email, get_current_user_id(), $email_link);
            }
        }

        $showlink = filter_input(INPUT_POST, 'showlink');

        $response_html = static::loadFrontendView(
            'send-invitation-code-result',
            compact('link', 'showlink', 'codeString')
        );

        $response = [
            'success' => true,
            'html' => apply_filters('cmreg_user_send_invitation_code__response_html', $response_html),
        ];

        header('content-type: application/json');
        echo json_encode($response);
        exit;
    }

    protected static function sendInvitationToEmail(InvitationCode $invitationCode, $invitedEmail, $inviterUserId) {
        $subject = Settings::getOption(Settings::OPTION_INVITE_FRIEND_EMAIL_SUBJECT);
        $body = wpautop(Settings::getOption(Settings::OPTION_INVITE_FRIEND_EMAIL_BODY));

        $link = Settings::getOption(Settings::OPTION_INVITE_FRIEND_REGISTRATION_PAGE_URL);
        if (empty($link)) {
            $link = site_url();
        }

        $codeString = $invitationCode->getCodeString();
        $link = add_query_arg([static::PARAM_INVITATION_CODE => $codeString], $link);

        $vars = array_merge([
            '[linkurl]' => $link,
            '[invitationcode]' => $codeString
        ], Email::getBlogVars(), Email::getUserVars($inviterUserId));

        return Email::send($invitedEmail, $subject, $body, $vars);
    }

    protected static function sendReferralInvitationToEmail(InvitationCode $invitationCode, $invitedEmail, $inviterUserId, $link) {
        $subject = Settings::getOption(Settings::OPTION_INVITE_FRIEND_EMAIL_SUBJECT);
        $body = wpautop(Settings::getOption(Settings::OPTION_INVITE_FRIEND_EMAIL_BODY));

        $codeString = $invitationCode->getCodeString();

        $vars = array_merge([
            '[linkurl]' => $link,
            '[invitationcode]' => $codeString
        ], Email::getBlogVars(), Email::getUserVars($inviterUserId));

        return Email::send($invitedEmail, $subject, $body, $vars);
    }

    static function cmreg_profile_edit_form($userId) {
        if (Settings::getOption(Settings::OPTION_USER_PROFILE_INVIT_CODE_SHOW)) {
            $code = InvitationCode::getByUser($userId);
            echo static::loadFrontendView('profile-edit-invitation-code', compact('code', 'userId'));
        }
    }

    private static function validateEmails(array $emails): array {
        $validated = [];

        if (empty($emails)) {
            return [];
        }

        foreach ($emails as $email) {
            $email = sanitize_email($email);
            if (!empty($email)) {
                $validated[] = $email;
            }
        }

        return $validated;
    }

    public static function getUserReferralLink($user_id) {
        $link = Settings::getOption(Settings::OPTION_INVITE_FRIEND_REGISTRATION_PAGE_URL);
        if (empty($link)) {
            $link = site_url();
        }
        $invitationCode = self::getUserReferralCode($user_id, true);
        $codeString = $invitationCode->getCodeString();

        return add_query_arg([static::PARAM_INVITATION_CODE => $codeString], $link);
    }

    public static function createUserReferralCode($user_id) {
        $atts['verifyemail'] = 0;

        $user = get_userdata($user_id);
        if (!is_a($user, 'WP_User')) {
            return 0;
        }

        $params = [
            'code_string' => $user->get('user_nicename'),
        ];
        $invitationCode = self::generateCode($atts, $params);

        update_user_meta($user_id, 'cmeg_referral_code', $invitationCode->getId());
        return $invitationCode->getId();
    }

    public static function getUserReferralCode($user_id, $create_if_not_exist = false) {

        $args = [
            'fields' => 'ids',
            'post_type' => 'cmreg_invitcode',
            'author' => $user_id,
            'orderby' => ['ID' => 'ASC'],
        ];

        $query = new WP_Query($args);
        $posts = $query->get_posts();
        if (!empty($posts)) {
            $code_id = array_shift($posts);
            update_user_meta($user_id, 'cmeg_referral_code', $code_id);
            unset($posts, $code_id);
        }

        $code_id = get_user_meta($user_id, 'cmeg_referral_code', true);

        if (!$create_if_not_exist && empty($code_id)) {
            return InvitationCode::getInstance();
        }

        $invitationCode = InvitationCode::getInstance($code_id);
        if ($invitationCode->getId()) {
            return $invitationCode;
        }

        delete_user_meta($user_id, 'cmeg_referral_code');
        if (!$create_if_not_exist) {
            return InvitationCode::getInstance();
        }

        $code_id = self::createUserReferralCode($user_id);

        return InvitationCode::getInstance($code_id);
    }

}