<?php
namespace com\cminds\registration\model;

use com\cminds\registration\lib\Email;
use com\cminds\registration\App;

class Settings extends SettingsAbstract {

	public static $categories = array(
		'general' => 'General',
		'login' => 'Login',
		'register' => 'Registration',
		'invitations' => 'Invitations',
		'email' => 'Email',
		'dashboard' => 'Dashboard',
		'customcss' => 'Custom CSS',
		'labels' => 'Labels',
	);

	public static $subcategories = array(
		'general' => array(
			'general' => 'General',
			'api' => 'API Keys',
			'editprofileform' => 'Edit Profile Form',		
			'logout' => 'Logout',
			'appearance' => 'Appearance',
			'dashboard' => 'Dashboard',
			'toastmessage' => 'Toast Message',
			'adminbar' => 'Admin Bar',
			'selfregister' => 'Self Register',
		),
		'login' => array(			
			'access' => 'Access Restriction Content',
			'login' => 'Login',
			'social-login' => 'Social Login',
			'limit' => 'Limit login attempts',
			'resetpasswordlimit' => 'Reset password restrictions',
			'ip' => 'IP restrictions',
			'redirect_role' => 'Redirection per role',
		),
		'register' => array(		
			'multi_step' => 'Multi Step Registration',
			'register' => 'Registration',
			'subscribe' => 'Subscribe Integrations',
			'pass' => 'Password',
			'verification' => 'Email verification',
			'ip' => 'IP restrictions',
			's2member' => 'S2Member Pro integration',
			'gravity_forms' => 'Gravity Forms integration',
			'age_verification' => 'Age verification',
			
		),
		'invitations' => array(			
			'invitations' => 'Invitations settings',
			'email' => 'Email template',
			'dashboard' => 'Dashboard',
			'edit_profile' => 'Edit profile',
			'automatic_creation' => 'Automatic creation',
		),
		'email' => array(	
			//'general' => 'General email settings',
			'password_email' => 'Password email after register',
			'welcome' => 'Welcome email',
			'welcomeadmin' => 'New user notification to admin',
			'activation' => 'Activation email',
			'admin' => 'Administrator notifications',
			'invite_friend' => 'Invite friend',
			'account_deleted' => 'Account deleted',
			'reset_password_email' => 'Reset password email',
			'self_register_email' => 'Self register email',
			'edit_profile_confirm_email' => 'Edit profile confirm email',
			'password_email_by_admin' => 'Password email by admin',
		),
		'dashboard'    => array(
            'navigation' => 'Navigation',
            'appearance' => 'Appearance',
			'tabs' => 'Dashboard Tabs',
        ),
		'customcss' => array(
			'customcss' => 'Custom CSS',
		),
		'labels' => array(
			'other' => 'Other',
		),
	);

	const OPTION_CUSTOM_CSS = 'cmreg_custom_css';
	const OPTION_LOGIN_FIELD = 'cmreg_login_field';
	const OPTION_WP_LOGIN_PAGE_REDIRECTION_URL = 'cmreg_wp_login_page_redirection_url';
	const OPTION_LOGIN_REDIRECT_URL = 'cmreg_login_redirect_url';
	const OPTION_LOGIN_REMEMBER_ENABLE = 'cmreg_login_remember_enable';
	const OPTION_LOGIN_LOST_PASSWORD_ENABLE = 'cmreg_login_lost_password_enable';
	const OPTION_RECAPTCHA_API_SITE_KEY = 'cmreg_recaptcha_api_site_key';
	const OPTION_RECAPTCHA_API_SECRET_KEY = 'cmreg_recaptcha_api_secret_key';
	const OPTION_LOGOUT_REDIRECT_URL = 'cmreg_logout_redirect_url';
	const OPTION_REGISTER_DISPLAY_NAME_ENABLE = 'cmreg_register_display_name_enable';
	const OPTION_REGISTER_DEFAULT_ROLE = 'cmreg_register_default_role';
	const OPTION_REGISTER_MINIMUM_AGE = 'cmreg_register_minimum_age';
	const OPTION_REGISTER_BIRTH_DATE_FIELD_META_KEY = 'cmreg_register_birth_date_field_meta_key';
	const OPTION_REGISTER_REPEAT_PASS_ENABLE = 'cmreg_register_repeat_pass_enable';
	const OPTION_S2MEMBERS_ENABLE = 'cmreg_s2members_enable';
	const OPTION_REGISTER_INVIT_CODE = 'cmreg_register_invit_code_require';
	const OPTION_REGISTER_RECAPTCHA_ENABLE = 'cmreg_register_recaptcha_enable';
	const OPTION_REGISTER_LOGIN_ENABLE = 'cmreg_register_login_enable';
	const OPTION_REGISTER_PRVENT_SYSTEM_EMAIL = 'cmreg_register_prevent_system_email';
	//const OPTION_GRAVITY_FORMS_REGISTRATION_HOOK_ENABLE = 'cmreg_gravity_forms_reg_hook_enable';
	const OPTION_WP_REGISTER_PAGE_REDIRECTION_URL = 'cmreg_wp_register_page_redirection_url';
	const OPTION_LOGIN_RECAPTCHA_ENABLE = 'cmreg_login_recaptcha_enable';
	const OPTION_LOGIN_LIMIT_ATTEMPTS_ACTION = 'cmreg_login_limit_attempts_action';
	const OPTION_LOGIN_LIMIT_ATTEMPTS_NUMBER = 'cmreg_login_limit_attempts_number';
	const OPTION_LOGIN_LIMIT_ATTEMPTS_INTERVAL_MINUTES = 'cmreg_login_limit_attempts_interval_minutes';
	const OPTION_LOGIN_LIMIT_ATTEMPTS_SEND_USER_EMAIL = 'cmreg_login_limit_attempts_send_user_email';
	const OPTION_PREVENT_CALLING_LOGIN_FOOTER_FRONTEND = 'cmreg_prevent_calling_login_footer_frontend';
	const OPTION_REGISTER_S2MEMBER_DEFAULT_LEVEL = 'cmreg_register_s2member_default_level';
	const OPTION_REGISTER_WELCOME_EMAIL_ENABLE = 'cmreg_register_welcome_email_enable';
	const OPTION_REGISTER_WELCOME_EMAIL_SUBJECT = 'cmreg_register_welcome_email_subject';
	const OPTION_REGISTER_WELCOME_EMAIL_BODY = 'cmreg_register_welcome_email_body';
	const OPTION_REGISTER_ACTIVATION_EMAIL_SUBJECT = 'cmreg_register_activation_email_subject';
	const OPTION_REGISTER_ACTIVATION_EMAIL_BODY = 'cmreg_register_activation_email_body';
	const OPTION_ACCOUNT_DELETED_USER_EMAIL_ENABLE = 'cmreg_account_deleted_user_email_enable';
	const OPTION_ACCOUNT_DELETED_USER_EMAIL_SUBJECT = 'cmreg_account_deleted_user_email_subject';
	const OPTION_ACCOUNT_DELETED_USER_EMAIL_BODY = 'cmreg_account_deleted_user_email_body';
	const OPTION_REGISTER_EMAIL_VERIFICATION_ENABLE = 'cmreg_register_email_verification_enable';
	const OPTION_REGISTER_EMAIL_VERIFICATION_AUTOLOGIN = 'cmreg_register_email_verification_autologin';
	const OPTION_REGISTER_ADMIN_NOTIFY_EMAIL = 'cmreg_register_admin_notify_email';
	const OPTION_REGISTER_ADMIN_NOTIFY_REGISTERED = 'cmreg_register_admin_notify_registered';
	const OPTION_REGISTER_ADMIN_NOTIFY_ACTIVATED = 'cmreg_register_admin_notify_activated';
	const OPTION_REGISTER_WELCOME_PAGE = 'cmreg_register_welcome_page';
	const OPTION_REGISTER_STRONG_PASS_ENABLE = 'cmreg_register_strong_pass_enable';
	const OPTION_REGISTER_DAYS_FOR_VERIFICATION = 'cmreg_register_days_for_verification';
	const OPTION_OVERLAY_OPACITY = 'cmreg_overlay_opacity';
	const OPTION_OVERLAY_PRELOAD = 'cmreg_overlay_preload';
	const OPTION_LOGOUT_INACTIVITY_TIME = 'cmreg_logout_inactivity_time_min';
	const OPTION_RELOAD_AFTER_LOGOUT = 'cmreg_reload_after_logout';
	const OPTION_REGISTER_NOTICE_ADMIN_ENABLE = 'cmreg_register_notice_admin_enable';
	const OPTION_REGISTER_EXTRA_FIELDS = 'cmreg_register_extra_fields';
	const OPTION_TERMS_OF_SERVICE_CHECKBOX_TEXT = 'cmreg_toc_checkbox_text';
	const OPTION_EMAIL_USE_HTML = 'cmreg_email_use_html';
	const OPTION_SOCIAL_LOGIN_FACEBOOK_APP_ID = 'cmreg_social_login_facebook_app_id';
	const OPTION_SOCIAL_LOGIN_FACEBOOK_APP_SECRET = 'cmreg_social_login_facebook_app_secret';
	const OPTION_SOCIAL_LOGIN_GOOGLE_APP_ID = 'cmreg_social_login_google_app_id';
	const OPTION_SOCIAL_LOGIN_GOOGLE_APP_SECRET = 'cmreg_social_login_google_app_secret';
	const OPTION_SOCIAL_LOGIN_ENABLE = 'cmreg_social_login_enable';
	const OPTION_LOGIN_SHOW_SOCIAL_LOGIN_BUTTONS = 'cmreg_login_show_social_login_buttons';
	const OPTION_REGISTER_SHOW_SOCIAL_LOGIN_BUTTONS = 'cmreg_register_show_social_login_buttons';
	const OPTION_SOCIAL_LOGIN_ENABLE_ALLOW_REGISTRATION = 'cmreg_social_login_allow_registration';
	const OPTION_REGISTER_IP_ALLOW = 'cmreg_register_ip_allow';
	const OPTION_REGISTER_IP_DENY = 'cmreg_register_ip_deny';
	const OPTION_LOGIN_IP_ALLOW = 'cmreg_login_ip_allow';
	const OPTION_LOGIN_IP_DENY= 'cmreg_login_ip_deny';
	const OPTION_INVITE_FRIEND_EMAIL_SUBJECT = 'cmreg_invite_friend_email_subject';
	const OPTION_INVITE_FRIEND_EMAIL_BODY = 'cmreg_invite_friend_email_body';
	const OPTION_INVITE_FRIEND_REGISTRATION_PAGE_URL = 'cmreg_invite_friend_registration_page_url';
	const OPTION_INVITE_FRIEND_LIMIT_PER_USER = 'cmreg_invite_friend_limit_per_user';
	const OPTION_DASHBOARD_USERS_COLUMN_INVIT_CODE_ENABLE = 'cmreg_dashboard_users_column_invit_code_enable';
	const OPTION_USER_PROFILE_INVIT_CODE_SHOW = 'cmreg_user_profile_invit_code_show';
	const OPTION_LOGIN_REDIRECTION_PER_ROLE = 'cmreg_login_redirection_per_role';

	const LOGIN_FIELD_EMAIL = 'email';
	const LOGIN_FIELD_LOGIN = 'login';
	const LOGIN_FIELD_BOTH = 'both';

	const INVITATION_CODE_DISABLED = 'disabled';
	const INVITATION_CODE_OPTIONAL = 'optional';
	const INVITATION_CODE_REQUIRED = 'required';

	const LIMIT_ATTEMPTS_ACTION_DISABLED = 'disabled';
	const LIMIT_ATTEMPTS_ACTION_SHOW_CAPTCHA = 'show_captcha';
	const LIMIT_ATTEMPTS_ACTION_WAIT = 'wait';

	const STRONG_PASSWORD_REGEXP = '~^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$~';
	
	public static function getOptionsConfig() {
		
		$remote_address = $_SERVER['REMOTE_ADDR'] ?? '';
		
		return apply_filters('cmreg_options_config', array(
			
			// General
			
			'cmreg_AddWizardMenu' => array(
				'type' => self::TYPE_BOOL,
				'default' => 1,
				'category' => 'general',
				'subcategory' => 'general',
				'title' => 'Display "Setup Wizard" in plugin menu',
				'desc' => 'Uncheck this to remove Setup Wizard from plugin menu.',
			),
			'_onlyinpro_1' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'general',
				'title' => 'Authentication pop-up window',
				'desc' => 'What forms will the pop-up contain. You can activate or deactivate the pop-up from each page/post',
			),
			'_onlyinpro_2' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'general',
				'title' => 'Allow users to close the pop-up',
				'desc' => 'If enabled, the user will able to close the pop-up.',
			),
			'_onlyinpro_3' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'general',
				'title' => 'Hide password field characters',
				'desc' => 'If enabled then the password field characters typed on the frontend will remain hidden until the user clicks the eye icon (<span class="dashicons dashicons-hidden"></span>). Otherwise, typed characters will be visible all the times.',
			),
			'_onlyinpro_4' => array(
				'type' => self::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'general',
				'title' => 'Which roles can delete themselves?',
				'desc' => 'Administrator role excluded because this role already have permission to delete users.',
			),
			
			'_onlyinpro_5' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'api',
				'title' => 'Google reCAPTCHA API site key',
				'desc' => '<a href="javascript:void(0);" class="button" disabled>Register new reCAPTCHA v2 key</a>'
			),
			'_onlyinpro_6' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'api',
				'title' => 'Google reCAPTCHA API secret key',
				'desc' => 'Enter <strong>reCAPTCHA v2</strong> keys only.<br>More details you can read in this documentation:<br><a href="javascript:void(0);" disabled>https://creativeminds.helpscoutdocs.com/article/640-cm-registration-cmreg-general-settings</a>',
			),
			'_onlyinpro_7' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'editprofileform',
				'title' => 'Hide display name field',
				'desc' => 'If enabled, display name field hide from edit profile form.',
			),
			'_onlyinpro_8' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'editprofileform',
				'title' => 'Hide website url field',
				'desc' => 'If enabled, website url field hide from edit profile form.',
			),
			'_onlyinpro_9' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'editprofileform',
				'title' => 'Hide about me field',
				'desc' => 'If enabled, about me field hide from edit profile form.',
			),
			'_onlyinpro_10' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'editprofileform',
				'title' => 'Enable email confirm',
				'desc' => 'If enabled, then user able to change email after confirm the new email address.',
			),
			'_onlyinpro_11' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'editprofileform',
				'title' => 'Enable profile picture',
				'desc' => 'If enabled, then user able to change profile picture from edit profile page.',
			),
			'_onlyinpro_12' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'editprofileform',
				'title' => 'Show invitation code field',
				'desc' => 'If enabled then the Invitation Code field will be displayed on the edit profile form.',
			),
			'_onlyinpro_13' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'editprofileform',
				'title' => 'Allow to edit the invitation code',
				'desc' => 'If enabled, the user will be able to change his invitation code. Changing the invitation code will apply to the user the parameters that are set in the invitation code, like the user role.'
			),
			'_onlyinpro_14' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'editprofileform',
				'title' => 'Allow to delete profile',
				'desc' => 'If enabled then the Delete Account link will be displayed on the edit profile form.'
			),
			self::OPTION_LOGOUT_REDIRECT_URL => array(
				'type' => self::TYPE_STRING,
				'category' => 'general',
				'subcategory' => 'logout',
				'title' => 'Redirect after logout to URL address',
				'desc' => 'You can enter a custom URL address that users will be redirected after logout.',
			),
			'_onlyinpro_15' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'logout',
				'title' => 'Logout after inactivity time [min]',
				'desc' => 'User will be logged-out after this time of inactivity. Set 0 to disable.'
			),
			'_onlyinpro_16' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'logout',
				'title' => 'Reload browser after logout',
				'desc' => 'If enabled, the script will be checking in background if user is still logged-in and reload the browser if not.'
			),
			'_onlyinpro_17' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'appearance',
				'title' => 'Overlay background opacity',
				'desc' => 'Enter the opacity of the login dialog box overlay background.',
			),
			'_onlyinpro_18' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'appearance',
				'title' => 'Preload login form overlay',
				'desc' => 'If enabled the login form will be preloaded on the page load. Disable this option if experiencing performance issues. '
						. 'However disabling this will cause that the login form will show up after a delay.',
			),
			'_onlyinpro_19' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'appearance',
				'title' => 'Display form fields label',
				'desc' => 'If enabled then form fields label will display.',
			),
			'_onlyinpro_20' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'toastmessage',
				'title' => 'Toast Message Time Duration [seconds]',
				'desc' => 'Toast messages are nonintrusive alerts that pop up over the content. The default value is 10 seconds.',
			),
			'_onlyinpro_21' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'adminbar',
				'title' => 'Hide admin bar',
				'desc' => 'If enabled, admin top bar hide for all on frontend.',
			),
			'_onlyinpro_22' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'options' => Settings::getRolesOptions(),
				'category' => 'general',
				'subcategory' => 'adminbar',
				'title' => 'Allow admin bar for specific roles',
				'desc' => 'If above option is enabled and you want to allow admin bar for specific roles please select here.',
			),
			'_onlyinpro_23' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'selfregister',
				'title' => 'Enable self register',
				'desc' => 'If enabled, then self register link will display below forgot your password link.',
			),
			'_onlyinpro_24' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'selfregister',
				'title' => 'Short period message interval',
				'desc' => 'You can manage message text on labels tab and default value is 5.',
			),
			'_onlyinpro_25' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'selfregister',
				'title' => 'Long period message interval',
				'desc' => 'You can manage message text on labels tab and default value is 100.',
			),
			'_onlyinpro_26' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'selfregister',
				'title' => 'Enable email to admin',
				'desc' => 'If enabled, then email sent to site administartor if there\'s over long period interval with failed submissions from one IP.',
			),
			'_onlyinpro_27' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'general',
				'subcategory' => 'selfregister',
				'title' => 'API URL',
				'desc' => '',
			),
			
			// Login
			'_onlyinpro_28' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'options' => array('0'=>'Site accessible to Everyone', '1'=>'Site accessible to Logged In Users'),
				'category' => 'login',
				'subcategory' => 'access',
				'title' => 'Global Site Access',
				'desc' => 'Control the global access to your site.',
			),
			'_onlyinpro_29' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'access',
				'title' => 'Custom Redirect URL',
				'desc' => 'Logged out users will be redirected to this URL if they are not permitted to access the site. You can use URLs such as http://localhost/knowledgetrail/login. If this field is left empty, users will be redirected to your home page by default.',
			),
			'_onlyinpro_30' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'access',
				'title' => 'Exclude the following URLs',
				'desc' => 'Separate URL by new lines.<br>Examples:<br><code>'.site_url().'/login</code><br><code>'.site_url().'/register</code>',
			),			
			self::OPTION_LOGIN_REDIRECT_URL => array(
				'type' => self::TYPE_STRING,
				'category' => 'login',
				'subcategory' => 'login',
				'title' => 'Redirect after login to URL address',
				'desc' => 'Enter an option URL address that users will be redirected after login. If empty user will stay on the same page.<br />'
							. 'You can use the <kbd>%userlogin%</kbd> and <kbd>%usernicename%</kbd> parameter in the URL, for example: '
							. '<kbd>/welcome/%usernicename%</kbd>.',
			),
			self::OPTION_LOGIN_REMEMBER_ENABLE => array(
				'type' => self::TYPE_BOOL,
				'default' => 0,
				'category' => 'login',
				'subcategory' => 'login',
				'title' => 'Enable the "Remember me" option',
			),
			'_onlyinpro_31' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'login',
				'title' => 'Log user last login date',
				'desc' => 'You can use <kbd>[cmreg_login_date id="user-id"]</kbd> to show users their last login date on the frontend.',
			),	
			self::OPTION_LOGIN_LOST_PASSWORD_ENABLE => array(
				'type' => self::TYPE_BOOL,
				'default' => 1,
				'category' => 'login',
				'subcategory' => 'login',
				'title' => 'Enable lost password form',
			),
			self::OPTION_LOGIN_FIELD => array(
				'type' => self::TYPE_RADIO,
				'default' => static::LOGIN_FIELD_BOTH,
				'options' => array(
					self::LOGIN_FIELD_EMAIL => 'email',
					self::LOGIN_FIELD_LOGIN => 'login',
					self::LOGIN_FIELD_BOTH => 'both email or login',
				),
				'category' => 'login',
				'subcategory' => 'login',
				'title' => 'Login using field',
			),
			self::OPTION_WP_LOGIN_PAGE_REDIRECTION_URL => array(
				'type' => self::TYPE_STRING,
				'default' => '',
				'category' => 'login',
				'subcategory' => 'login',
				'title' => 'Disable wp-login.php and login page redirect to this URL',
				'desc' => 'You can disable the regular Wordpress login page (wp-login.php) and redirect users to the specified URL address '
						. 'where they can find the CM Registration login form/shortcode. This will affect also the lost password page. '
						. 'Leave blank to enable the wp-login.php page.<br><br><strong>Warning:</strong> Use this option with caution to avoid losing access to your site. Ensure the redirect URL is correct and accessible, as an incorrect setup may block login functionality.',
			),
			'_onlyinpro_32' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'login',
				'title' => 'Disable wp-login.php and lost password page redirect to this URL',
				'desc' => 'You can disable the regular WordPress lost password page (wp-login.php) and redirect users to this specified URL address where they can find the CM Registration reset password shortcode <code>[cmreg-reset-password]</code>. Leave blank to enable the wp-login.php page.',
			),				
			self::OPTION_PREVENT_CALLING_LOGIN_FOOTER_FRONTEND => array(
				'type' => self::TYPE_BOOL,
				'default' => 1,
				'category' => 'login',
				'subcategory' => 'login',
				'title' => 'Prevent from calling login_footer action in the front-end',
				'desc' => 'For some issues with the login form on the front-end you can try to enable this option to prevent '
					. 'from calling the login_footer action. E. g. it solves the problem if your login form doesn\'t '
					. 'work when you\'re using the NextGEN Gallery plugin.'
			),
			'_onlyinpro_33' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'login',
				'title' => 'Enable reCAPTCHA on the login form',
			),
			'_onlyinpro_34' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'login',
				'title' => 'Terms of service acceptance text',
				'desc' => 'Enter text which will be displayed next to the checkbox that users have to check to accept terms of service. If left empty checkboxes will not be displayed.',
			),	
			'_onlyinpro_35' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Enable social login',
				'desc' => 'General option to enable the social login features. User will be able to login using his social service account and will be logged-in '
						. 'to a WP account with the same email address.',
			),
			'_onlyinpro_36' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Add social login buttons to the login form',
				'desc' => 'If enabled the social login buttons will be added to the login form by default. '
						. 'If disabled you can still use the social login by using the [cmreg-social-login] shortcode.',
			),
			'_onlyinpro_37' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Position of social login buttons on login form',
				'desc' => 'Set a position of social buttons for login form.',
			),
			'_onlyinpro_38' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Enable registration using social login',
				'desc' => 'If enabled a Wordpress account will be automatically created for a new user that used the social login button '
						. '(when plugin won\'t find any associated account). If disabled then user won\'t be logged if there\'s no WP account '
						. 'with the same email address.',
			),
			'_onlyinpro_39' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Add social login buttons to the registration form',
				'desc' => 'If enabled the social login buttons will be added to the registration form by default. '
					. 'If disabled you can still use the social login by using the [cmreg-social-login] shortcode.',
			),
			'_onlyinpro_40' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Position of social login buttons on registration form',
				'desc' => 'Set a position of social buttons for registration form.',
			),
			'_onlyinpro_41' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Ask for invitation code if registering with social login',
				'desc' => 'If enabled then after user will try to register with the social login feature he will be asked to enter '
				. 'an invitation code before his account will be created.',
			),
			'_onlyinpro_42' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Facebook App ID',
				'desc' => 'Create a <a href="http://developers.facebook.com" target="_blank">Facebook Login App</a> and enter the following URL '
						. 'into the "Valid OAuth redirect URIs":<br><kbd>' . get_site_url() .'/cminds-registration-social-login/facebook/int_callback</kbd><br><br>'
						. 'Then go to App Review and make your App public.',
			),
			'_onlyinpro_43' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Facebook App Secret',
				'desc' => '',
			),
			'_onlyinpro_44' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Google App ID',
				'desc' => 'Create a <a href="https://console.developers.google.com/" target="_blank">Google project</a> and enter the following URL '
				. 'into the "Authorized redirect URIs":<br><kbd>' . get_site_url() .'/cminds-registration-social-login/google/oauth2callback</kbd><br><br>'
				. 'More details you can read in this documentation: <a href="http://creativeminds.helpscoutdocs.com/article/990-cm-answers-cma-social-login-google">'
				.'http://creativeminds.helpscoutdocs.com/article/990-cm-answers-cma-social-login-google</a>',
			),
			'_onlyinpro_45' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'social-login',
				'title' => 'Google App Secret',
				'desc' => '',
			),
			'_onlyinpro_46' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'limit',
				'title' => 'Action after user exceeded the login attempts limit',
				'desc' => 'If you want to use "Show captcha" option the you should need to enter Google reCAPTCHA API keys under General tab.<br><a href="javascript:void(0);">Delete all attempts log</a>',
			),
			'_onlyinpro_47' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'limit',
				'title' => 'Number of attempts',
				'desc' => 'After this many attempts, the action above will be triggered.',
			),
			'_onlyinpro_48' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'limit',
				'title' => 'Wait time [minutes]',
				'desc' => 'How much time the user will have to wait before attempting to login again. Only works with the "Let user wait" setting.',
			),
			'_onlyinpro_49' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'resetpasswordlimit',
				'title' => 'Action after user reset password',
				'desc' => '',
			),
			'_onlyinpro_50' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'resetpasswordlimit',
				'title' => 'Wait time [minutes]',
				'desc' => 'How much time the user will have to wait before reset password again. Only works with the "Let user wait" setting.',
			),
			'_onlyinpro_51' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'ip',
				'title' => 'Allow login only from IP',
				'desc' => 'Separate IP addresses by new lines.<br>Examples:<br><kbd>80.43.15.145</kbd><br><kbd>80.43.15.x</kbd><br><kbd>80.43.x.x</kbd>'
					. '<br><br>Your IP address is: <kbd>'. $remote_address .'</kbd>',
			),
			'_onlyinpro_52' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'ip',
				'title' => 'Deny login from IP',
				'desc' => 'Separate IP addresses by new lines.<br>Examples:<br><kbd>80.43.15.145</kbd><br><kbd>80.43.15.x</kbd><br><kbd>80.43.x.x</kbd>'
					. '<br><br>Your IP address is: <kbd>'. $remote_address .'</kbd>',
			),
			'_onlyinpro_53' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'login',
				'subcategory' => 'redirect_role',
				'title' => 'Redirection per role',
				'desc' => 'Set a custom after-login redirection URL address per user role.',
			),
			
			// Registration
			'_onlyinpro_54' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'multi_step',
				'title' => 'Multi step',
				'desc' => 'If enabled, the you can design registration form with multi step.',
			),
			'_onlyinpro_55' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'multi_step',
				'title' => 'Name of multi step',
				'desc' => 'Separate multi step name by new lines.<br>Examples:<br><code>Profile</code><br><code>Personal Details</code>',
			),
			'_onlyinpro_56' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'multi_step',
				'title' => 'Progress bar',
				'desc' => 'If enabled, the progress bar will show in top with multi step.',
			),
			'_onlyinpro_57' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'multi_step',
				'title' => 'Breadcrumbs',
				'desc' => 'If enabled, the breadcrumbs will show in top with multi step.',
			),
			'_onlyinpro_58' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'multi_step',
				'title' => 'Navigation',
				'desc' => 'If enabled, the navigation will show in bottom with multi step.',
			),
			self::OPTION_REGISTER_LOGIN_ENABLE => array(
				'type' => self::TYPE_BOOL,
				'default' => 1,
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Allow user to enter his login',
				'desc' => 'If disabled, the login will be created from the entered email address. The login is need during the singing-in.',
			),
			self::OPTION_REGISTER_DISPLAY_NAME_ENABLE => array(
				'type' => self::TYPE_BOOL,
				'default' => 0,
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Allow user to enter his publicly displayed name',
				'desc' => 'If disabled, the public name will be his email address. If enabled user can enter name that will be displayed next to '
							. 'his comments or posts.',
			),
			'_onlyinpro_59' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Allow user to add organization',
				'desc' => '	If enabled, then organization field will be show during the registration.',
			),
			'_onlyinpro_60' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Require to email',
				'desc' => 'If enabled, then email field will be required during the registration.',
			),
			'_onlyinpro_61' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Require to repeat email',
				'desc' => '	If enabled, then repeat email field will be required during the registration.',
			),
			self::OPTION_REGISTER_PRVENT_SYSTEM_EMAIL => array(
				'type' => self::TYPE_BOOL,
				'default' => 1,
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Prevent sending the standard WP welcome email',
				'desc' => 'If enabled the regular Wordpress\' welcome mail won\'t be send to the user. For some specific cases you may need to disable this option.',
			),
			self::OPTION_WP_REGISTER_PAGE_REDIRECTION_URL => array(
				'type' => self::TYPE_STRING,
				'default' => '',
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Disable WP registration page and redirect to this URL',
				'desc' => 'You can disable the regular Wordpress registration page (wp-login.php?action=register) and redirect users to the specified URL address '
						. 'where they can find the CM Registration form/shortcode. Leave blank to enable the wp-login.php page.',
			),
			'_onlyinpro_62' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Toast Message Time Duration [seconds]',
				'desc' => 'Toast messages are nonintrusive alerts that pop up over the content. The default value is 20 seconds.',
			),
			'_onlyinpro_63' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'register',
				'title' => 'Enable reCAPTCHA on the registration form',
			),
			'_onlyinpro_69' => array(
                'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
                'category' => 'register',
                'subcategory' => 'subscribe',
                'title' => 'Allow user to select subscribe checkbox',
            ),
			'_onlyinpro_70' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'subscribe',
				'title' => 'Mailchimp API Key',
				'desc' => 'You can enter Mailchimp API Key.',
			),
			'_onlyinpro_71' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'subscribe',
				'title' => 'Mailchimp List/Audience ID',
				'desc' => 'You can enter Mailchimp List/Audience ID.',
			),
			'_onlyinpro_72' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'subscribe',
				'title' => 'Required to select subscribe checkbox',
				'desc' => 'If enabled, then checkbox will be set "required" and user should be select subscribe checkbox before submit.',
			),
			'_onlyinpro_73' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'subscribe',
				'title' => 'Subscribe checkbox text',
				'desc' => 'Enter text which will be displayed next to the subscribe checkbox.',
			),
			'_onlyinpro_74' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'pass',
				'title' => 'Require to password',
				'desc' => '',
			),
			self::OPTION_REGISTER_REPEAT_PASS_ENABLE => array(
				'type' => self::TYPE_BOOL,
				'default' => 0,
				'category' => 'register',
				'subcategory' => 'pass',
				'title' => 'Require to repeat password',
			),
			self::OPTION_REGISTER_STRONG_PASS_ENABLE => array(
				'type' => self::TYPE_BOOL,
				'default' => 1,
				'category' => 'register',
				'subcategory' => 'pass',
				'title' => 'Require strong passwords',
				'desc' => 'Password must be at least 8 characters long and must contain at least one lowercase letter, one uppercase letter and one digit.<br />'
							.'Regular expression: <kbd>'. Settings::STRONG_PASSWORD_REGEXP .'</kbd>',
			),
			'_onlyinpro_75' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'pass',
				'title' => 'Generate a password',
				'desc' => 'Prefill generated password to the field.',
			),
			'_onlyinpro_75z1' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'verification',
				'title' => 'Require email verification',
				'desc' => 'If enabled, user have to confirm his email address by clicking the activation link which will be send to his email. '
					. 'Until this his account won\'t be active and user will be unable to login.',
			),
			'_onlyinpro_76' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'verification',
				'title' => 'Email verification on secondary email',
				'desc' => 'If enabled, user need to confirm email address by clicking the activation link which will be send to secondary email. '
					. 'Until this his account won\'t be active and user will be unable to login.',
			),
			'_onlyinpro_77' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'verification',
				'title' => 'Meta key of the secondary email field',
				'desc' => 'Choose the meta key of the secondary email profile field for receive activation email.',
			),
			'_onlyinpro_78' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'verification',
				'title' => 'Days for verification',
				'desc' => 'Give new user x days to verify his account. After that time the registered account will be deleted.',
			),
			'_onlyinpro_79' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'options' => Settings::getPagesOptions(),
				'category' => 'register',
				'subcategory' => 'verification',
				'title' => 'Page loaded after successful email verification',
			),
			'_onlyinpro_80' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'verification',
				'title' => 'Login user after successful email verification',
				'desc' => 'If enabled, user will be logged-in to Wordpress automatically after he verified his email address with the verification link.',
			),
			'_onlyinpro_81' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'ip',
				'title' => 'Allow registration only from IP',
				'desc' => 'Separate IP addresses by new lines.<br>Examples:<br><kbd>80.43.15.145</kbd><br><kbd>80.43.15.x</kbd><br><kbd>80.43.x.x</kbd>'
					. '<br><br>Your IP address is: <kbd>'. $remote_address .'</kbd>',
			),
			'_onlyinpro_82' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'ip',
				'title' => 'Deny registration from IP',
				'desc' => 'Separate IP addresses by new lines.<br>Examples:<br><kbd>80.43.15.145</kbd><br><kbd>80.43.15.x</kbd><br><kbd>80.43.x.x</kbd>'
					. '<br><br>Your IP address is: <kbd>'. $remote_address .'</kbd>',
			),	
			'_onlyinpro_83' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 's2member',
				'title' => 'Enable S2Members integration',
				'desc' => 'If enabled, the invitations code can be related with the S2Members Pro membership level and new users '
				. 'will be assigned to the chosen level.',
			),
			'_onlyinpro_84' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 's2member',
				'title' => 'S2Member Pro default level',
				'desc' => 'Assign user which is not using the invitation code to the chosen S2Members Pro membership level.',
			),
			'_onlyinpro_85' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'age_verification',
				'title' => 'Meta key of the birth date field',
				'desc' => 'Choose the meta key of the birth date profile field for the age verification.',
			),
			'_onlyinpro_86' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'register',
				'subcategory' => 'age_verification',
				'title' => 'Minimum allowed age',
				'desc' => 'Choose how old a user have to be to pass the registration. You can setup a profile field '
						. '<kbd>date</kbd> with a user meta key specified in settings above and the plugin will automatically validate it. Set 0 to disable.',
			),
			
			// Invitations
			'_onlyinpro_87' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'invitations',
				'subcategory' => 'invitations',
				'title' => 'Registration page URL',
				'desc' => 'Specify what page should be shown when the user clicks on the invitation link. Usually this should be a page with the registration shortcode.',
			),
			'_onlyinpro_88' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'invitations',
				'subcategory' => 'invitations',
				'title' => 'Limit allowed invitations per user',
				'desc' => 'Set the invitations limit per user. This won\'t apply to the users with the manage_options capability.',
			),
			'_onlyinpro_89' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'invitations',
				'subcategory' => 'invitations',
				'title' => 'Auto pop-up window',
				'desc' => 'If enabled, then pop-up will open automatic if query string have "invite" or "cmreg_code".',
			),
			'_onlyinpro_90' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'invitations',
				'subcategory' => 'email',
				'title' => 'Friends invitation email subject',
				'desc' => 'You can use the following shortcodes:<br />[blogname], [siteurl], [userdisplayname], [userlogin], [useremail], [userrole], [userfirstname], [userlastname]',
			),
			'_onlyinpro_91' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'invitations',
				'subcategory' => 'email',
				'title' => 'Friends invitation email template',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
					' [blogname] [siteurl] [userdisplayname] [userlogin] [useremail] [linkurl] [invitationcode] [userrole] [userfirstname] [userlastname]'),
			),
			Settings::OPTION_DASHBOARD_USERS_COLUMN_INVIT_CODE_ENABLE => array(
				'type' => Settings::TYPE_BOOL,
				'category' => 'invitations',
				'subcategory' => 'dashboard',
				'default' => 1,
				'title' => 'Show invitation code column for users',
				'desc' => 'If enabled then the "Invitation Code" column will be added to the Users page in the wp-admin dashboard.',
			),
			'_onlyinpro_92' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'invitations',
				'subcategory' => 'automatic_creation',
				'title' => 'Enable automatic create invitation code',
				'desc' => 'If enabled then the Invitation Code will be auto create after register and associate with user.',
			),
			'_onlyinpro_93' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'invitations',
				'subcategory' => 'automatic_creation',
				'title' => 'Use meta key for invitation code',
				'desc' => 'If enabled the following setting meta key will be used for invitation code otherwise invitation code will be generated random.',
			),
			'_onlyinpro_94' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'invitations',
				'subcategory' => 'automatic_creation',
				'title' => 'Define meta key for invitation code',
				'desc' => 'Choose the meta key which one use for invitation code from profile fields section.',
			),
			
			// Rmail
			'_onlyinpro_e1' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'password_email',
				'title' => 'Enable password email to user after register',
				'desc' => 'If enabled then user will get password email after register.'
			),
			'_onlyinpro_e2' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'password_email',
				'title' => 'Password email subject',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [blogname]'),
			),
			'_onlyinpro_e3' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'password_email',
				'title' => 'Reset password email template',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [userfirstname] [userlastname] [userlogin] [siteurl] [resetpasswordurl]'),
			),
			'_onlyinpro_e4' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'welcome',
				'title' => 'Enable sending welcome email to user',
				'desc' => 'If enabled then user will get welcome email after register.'
			),
			'_onlyinpro_e5' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'welcome',
				'title' => 'Welcome email subject',
				'desc' => 'You can use the following shortcodes:<br />[blogname], [siteurl], [userdisplayname], [userlogin], [useremail], [linkurl], [userrole], [userfirstname], [userlastname]',
			),
			'_onlyinpro_e6' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'welcome',
				'title' => 'Welcome email body template',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
					' [blogname] [siteurl] [userdisplayname] [userlogin] [useremail] [linkurl] [userrole] [userfirstname] [userlastname]'),
			),
			self::OPTION_REGISTER_NOTICE_ADMIN_ENABLE => array(
				'type' => self::TYPE_BOOL,
				'default' => 0,
				'category' => 'email',
				'subcategory' => 'welcomeadmin',
				'title' => 'Notify admin about new registration',
				'desc' => 'If enabled then the default notification email will be send to: '. get_bloginfo('admin_email'),
			),
			'_onlyinpro_e7' => array(
                'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
                'category' => 'email',
                'subcategory' => 'welcomeadmin',
                'title' => 'Cc',
                'desc' => 'Carbon copy email for the notification',
            ),
			'_onlyinpro_e8' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'welcomeadmin',
				'title' => 'Admin email subject',
				'desc' => 'You can use the following shortcode:<br />[blogname]',
			),
			'_onlyinpro_e9' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'welcomeadmin',
				'title' => 'Admin email body template',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
					' [blogname] [siteurl] [userdisplayname] [userlogin] [useremail] [userrole] [userfirstname] [userlastname]'),
			),
			'_onlyinpro_e9xy1' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'activation',
				'title' => 'Activation email subject',
				'desc' => 'You can use the following shortcodes:<br>[blogname], [siteurl], [userdisplayname], [userlogin], [useremail], [linkurl], [userrole], [userfirstname], [userlastname]',
			),
			'_onlyinpro_e9xy2' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'activation',
				'title' => 'Activation email body template',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />', ' [blogname] [siteurl] [userdisplayname] [userlogin] [useremail] [linkurl] [userrole] [userfirstname] [userlastname]'),
			),
			'_onlyinpro_e10' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'account_deleted',
				'title' => 'Enable sending email to user after deleted his account',
				'desc' => 'If admin delete an account, the email with notification will be send to this user.'
			),
			'_onlyinpro_e11' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'account_deleted',
				'title' => 'Deleted account notification email subject',
				'desc' => 'You can use the following shortcodes:<br />[blogname], [siteurl], [userdisplayname], [userlogin], [useremail], [userrole], [userfirstname], [userlastname]',
			),
			'_onlyinpro_e12' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'account_deleted',
				'title' => 'Deleted account notification email template',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [blogname] [siteurl] [userdisplayname] [userlogin] [useremail] [userrole] [userfirstname] [userlastname]'),
			),
			'_onlyinpro_e13' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'reset_password_email',
				'title' => 'Enable headers for email',
				'desc' => 'If enabled then email will work with headers.'
			),
			'_onlyinpro_e14' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'reset_password_email',
				'title' => 'Reset password email subject',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [blogname]'),
			),
			'_onlyinpro_e15' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'reset_password_email',
				'title' => 'Reset password email template',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [userfirstname] [userlastname] [userlogin] [useremail] [siteurl] [resetpasswordurl]'),
			),
			'_onlyinpro_e16' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'self_register_email',
				'title' => 'Self register blocked IP admin email subject',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [blogname]'),
			),
			'_onlyinpro_e17' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'self_register_email',
				'title' => 'Self register blocked IP admin email template',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [long_period_interval] [ip] [blogname] [siteurl]'),
			),
			'_onlyinpro_e18' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'edit_profile_confirm_email',
				'title' => 'Edit profile confirm email subject',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [blogname]'),
			),
			'_onlyinpro_e19' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'edit_profile_confirm_email',
				'title' => 'Edit profile confirm email template',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [userfirstname] [userlastname] [userlogin] [siteurl] [confirmemailurl]'),
			),
			'_onlyinpro_e20' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'password_email_by_admin',
				'title' => 'Password email subject',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [blogname]'),
			),
			'_onlyinpro_e21' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'email',
				'subcategory' => 'password_email_by_admin',
				'title' => 'Reset password email template',
				'desc' => 'You can use the following shortcodes:' . str_replace(' ', '<br />',
						' [userfirstname] [userlastname] [userlogin] [siteurl] [resetpasswordurl]'),
			),
				
			// Dashboard
			'_onlyinpro_d1' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'dashboard',
				'subcategory' => 'navigation',
				'title' => 'Dashboard page',
				'desc' => 'Select page which will display the user\'s dashboard (using the cmreg-dashboard shortcode) or choose '
							. '"-- create new page --" to create such page.',
			),
			'_onlyinpro_d2' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'dashboard',
				'subcategory' => 'appearance',
				'title' => 'View',
			),
			'_onlyinpro_d3' => array(
				'type' => Settings::TYPE_CUSTOM,
				'content' => 'Available in Pro version and above.<br><a href="'.get_site_url().'/wp-admin/admin.php?page=cmreg_pro">UPGRADE NOW&nbsp;➤</a>',
				'category' => 'dashboard',
				'subcategory' => 'tabs',
				'title' => 'Dashboard tabs',
				'desc' => 'Drag and drop to change the order.',
			),
			
			// Custom CSS
			self::OPTION_CUSTOM_CSS => array(
				'type' => self::TYPE_TEXTAREA,
				'category' => 'customcss',
				'subcategory' => 'customcss',
				'title' => 'Custom CSS',
				'desc' => 'You can enter a custom CSS which will be embeded on every page that contains a CM Registration interface.',
			),

		));

	}
	
	static function listShortcodes($vars) {
		$out = '';
		foreach ($vars as $name => $val) {
			$out .= $name . '<br />';
		}
		return $out;
	}
	
}