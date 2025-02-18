<?php
namespace com\cminds\registration\shortcode;

use com\cminds\registration\model\Settings;
use com\cminds\registration\model\Labels;
use com\cminds\registration\controller\FrontendController;

class RegistrationButtonShortcode extends Shortcode {
	
	const SHORTCODE_NAME = 'cmreg-registration-btn';
	
	static function shortcode($atts=array(), $buttonText = null) {
		if (empty($buttonText)) {
			$buttonText = 'Registration';
		}
		if (!is_user_logged_in()) {
			$atts = shortcode_atts(array(
				'href' => '#cmreg-only-registration-click',
			), $atts);
			return FrontendController::getLoginButton($buttonText, $atts);
		}
	}
	
}