<?php
use com\cminds\registration\controller\SettingsController;
use com\cminds\registration\App;
ob_start();
include plugin_dir_path(__FILE__) . 'views/plugin_compare_table.php';
$plugin_compare_table = ob_get_contents();
ob_end_clean();
$activation_redirect_wizard = get_option('cmreg_AddWizardMenu', 1);
$cminds_plugin_config = array(
    'plugin-is-pro'                 => App::isPro(),
    'plugin-has-addons'             => TRUE,
    'plugin-is-addon'               => FALSE,
    'plugin-version'                => App::VERSION,
    'plugin-abbrev'                 => App::PREFIX,
    'plugin-affiliate'              => '',
    'plugin-redirect-after-install' => $activation_redirect_wizard ? admin_url( 'admin.php?page=cmreg_setup_wizard' ) : admin_url( 'admin.php?page=' . SettingsController::getMenuSlug() ),
    'plugin-settings-url'           => admin_url( 'admin.php?page=' . SettingsController::getMenuSlug() ),
    'plugin-show-guide'             => TRUE,
    'plugin-campign'				=> '?utm_source=cmregfree&utm_campaign=freeupgrade',
    'plugin-guide-text'             => '    <div style="display:block">
        <ol>
            <li>Go to <strong>"Plugin Settings"</strong> and configure the desired behavior of the login and logout</li>
            <li>Use the css class <strong>"cmreg-login-click"</strong> and add it to a link in your site navigation</li>
            <li>Alternatively use the shortcode  <strong>"[cmreg-login]Login[/cmreg-login]" </strong> in your site side bar widget.</li>
            <li><strong>Troubleshooting:</strong> Make sure your site does not have any JavaScript error which might prevent registraion popup from appearing</li>
        </ol>
    </div>',
    'plugin-guide-video-height'     => 240,
    'plugin-guide-videos'           => array(
        array( 'title' => 'Installation tutorial', 'video_id' => '158514902' ),
    ),
    'plugin-addons'                 => array(
        array(
            'title'       => 'CM Registration EDD Payment Addon',
            'description' => 'Require users make payment in order to activate the registered user account.',
            'link'        => 'https://www.cminds.com/downloads/cm-registration-edd-payment-addon?utm_source=cmreg&utm_campaign=freeupgrade&upgrade=1',
            'link_buy'    => 'https://www.cminds.com/checkout/?edd_action=add_to_cart&download_id=139000&wp_referrer=https://www.cminds.com/checkout/&edd_options[price_id]=1'
        ),
        array(
            'title'       => 'CM Registration Bulk Invitation Addon',
            'description' => 'Bulk send invitation codes to the emails from a CSV file.',
            'link'        => 'https://www.cminds.com/wordpress-plugins-library/registration-and-invitation-codes-plugin-for-wordpress/',
            'link_buy'    => 'https://www.cminds.com/checkout/?edd_action=add_to_cart&download_id=137386&wp_referrer=https://www.cminds.com/checkout/&edd_options[price_id]=0'
        ),
        array(
            'title'       => 'CM Registration Approve New Users Addon',
            'description' => 'Approve or reject new users registrations.',
            'link'        => 'https://www.cminds.com/wordpress-plugins-library/registration-and-invitation-codes-plugin-for-wordpress?utm_source=cmreg&utm_campaign=freeupgrade&upgrade=1',
            'link_buy'    => 'https://www.cminds.com/?edd_action=add_to_cart&download_id=159093&edd_options[price_id]=1'
        ),
    ),
    'plugin-show-shortcodes'        => TRUE,
    'plugin-shortcodes'             => '<p>You can use the following available shortcodes.</p>',
    'plugin-shortcodes-action'      => 'cmreg_display_available_shortcodes',
    'plugin-parent-abbrev'          => '',
    'plugin-file'                   => App::getPluginFile(),
    'plugin-dir-path'               => plugin_dir_path( App::getPluginFile() ),
    'plugin-dir-url'                => plugin_dir_url( App::getPluginFile() ),
    'plugin-basename'               => plugin_basename( App::getPluginFile() ),
    'plugin-icon'                   => '',
    'plugin-name'                   => App::getPluginName( true ),
    'plugin-license-name'           => App::getPluginName( true ),
    'plugin-slug'                   => App::PREFIX,
    'plugin-short-slug'             => App::PREFIX,
    'plugin-parent-short-slug'      => '',
    'plugin-menu-item'              => App::SLUG,
    'plugin-textdomain'             => '',
    'plugin-userguide-key'          => '2722-cm-registration-cmreg-getting-started-free-version-tutorial',
    'plugin-store-url'              => 'https://www.cminds.com/wordpress-plugins-library/registration-and-invitation-codes-plugin-for-wordpress/?utm_source=cmreg&utm_campaign=freeupgrade&upgrade=1',
    'plugin-support-url'            => 'https://www.cminds.com/contact/',
    'plugin-video-tutorials-url'    => 'https://www.videolessonsplugin.com/video-lesson/lesson/user-registration-invitation-codes-plugin/',
    'plugin-review-url'             => 'https://www.cminds.com/wordpress-plugins-library/registration-and-invitation-codes-plugin-for-wordpress/',
    'plugin-changelog-url'          => 'https://www.cminds.com/wordpress-plugins-library/registration-and-invitation-codes-plugin-for-wordpress/',
    'plugin-licensing-aliases'      => App::getLicenseAdditionalNames(),
    'plugin-upgrade-text'           => 'Reasons to upgrade to pro',
    'plugin-upgrade-text-list'      => array(
        array( 'title' => 'Introduction', 'video_time' => '0:00' ),
        array( 'title' => 'reCaptcha Support', 'video_time' => '0:27' ),
        array( 'title' => 'Email verification support', 'video_time' => '0:41' ),
        array( 'title' => 'Customize registration email notifications ', 'video_time' => '0:56' ),
        array( 'title' => 'Customize labels and messages', 'video_time' => '1:08' ),
        array( 'title' => 'Invitations codes support', 'video_time' => '1:15' ),
        array( 'title' => 'Registration form builder', 'video_time' => 'More' ),
        array( 'title' => 'Assign a role after registration', 'video_time' => 'More' ),
    ),
    'plugin-upgrade-video-height'   => 240,
    'plugin-upgrade-videos'         => array(
        array( 'title' => 'Registration Premium Features', 'video_id' => '157189342' ),
    ),
    'plugin-compare-table'          => $plugin_compare_table,
);