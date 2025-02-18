<?php
/*
Plugin Name: CM Registration and Invitation Codes
Plugin URI: https://www.cminds.com/wordpress-plugins-library/registration-and-invitation-codes-plugin-for-wordpress/
Description: Add AJAX-based login and registration forms with captcha, email verification, invitation codes and more.
Author: CreativeMindsSolutions
Version: 2.5.1
*/

if (version_compare('5.3', PHP_VERSION, '>')) {
	die(sprintf('We are sorry, but you need to have at least PHP 5.3 to run this plugin (currently installed version: %s)'
		. ' - please upgrade or contact your system administrator.', PHP_VERSION));
}

require_once dirname(__FILE__) . '/App.php';
com\cminds\registration\App::bootstrap(__FILE__);

require_once dirname(__FILE__) . '/wizard/wizard.php';