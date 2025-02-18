<?php
namespace com\cminds\registration\controller;

use com\cminds\registration\model\Settings;
use com\cminds\registration\model\User;
use com\cminds\registration\model\Labels;
use com\cminds\registration\lib\Email;

class UserController extends Controller {
	
	static $actions = array(
		'delete_user' => array('args' => 1),
	);
	
	static $ajax = array(
		'cmreg_change_password',
	);
	
	static function cmreg_change_password() {
	
		$response = array('success' => 0, 'msg' => 'An error occurred. Please try again.');
	
		$nonce = filter_input(INPUT_POST, 'nonce');
		if ($nonce AND wp_verify_nonce($nonce, static::ACTION_EDIT)) {
			
			$pass = trim(filter_input(INPUT_POST, 'password'));
			$pass2 = trim(filter_input(INPUT_POST, 'password_repeat'));
				
			try {
				
				if (strlen($pass) == 0) {
					throw new \Exception(Labels::getLocalized('change_password_error_empty_pass'));
				}
				if ($pass !== $pass2) {
					throw new \Exception(Labels::getLocalized('change_password_error_pass_does_not_match'));
				}
	
				User::setPassword(get_current_user_id(), $pass);
	
				$response['success'] = 1;
				$response['msg'] = Labels::getLocalized('change_password_success');
	
			} catch (\Exception $e) {
				$response['msg'] = $e->getMessage();
			}
				
		}
	
		header('content-type: application/json');
		echo json_encode($response);
		exit;
	}

	static function delete_user($userId) {
		if (Settings::getOption(Settings::OPTION_ACCOUNT_DELETED_USER_EMAIL_ENABLE) AND $user = get_userdata($userId)) {
			$subject = Settings::getOption(Settings::OPTION_ACCOUNT_DELETED_USER_EMAIL_SUBJECT);
			$body = wpautop(Settings::getOption(Settings::OPTION_ACCOUNT_DELETED_USER_EMAIL_BODY));
			$vars = array_merge(Email::getBlogVars(), Email::getUserVars($userId));
			Email::send($user->user_email, $subject, $body, $vars);
		}
	}
	
}