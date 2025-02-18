<?php
use com\cminds\registration\model\Settings;
use com\cminds\registration\model\InvitationCode;

/* @var $code InvitationCode */
$emailVerificationStatus = $code->getEmailVerificationStatus();
$emailVerificationOptions = [
    InvitationCode::EMAIL_VERIFICATION_NO => 'No',
    InvitationCode::EMAIL_VERIFICATION_YES => 'Yes',
    InvitationCode::EMAIL_VERIFICATION_GLOBAL => 'Follow global settings',
];
if (empty($emailVerificationOptions[$emailVerificationStatus])) {
    $emailVerificationStatus = InvitationCode::EMAIL_VERIFICATION_GLOBAL;
}
?>
<div class="cmreg-invitation_codes_backend__metabox">
    <div class="cmreg-field-wrapper cmreg-code">
        <div class="cmreg-field-label">Code:</div>
        <div class="cmreg-field-value">
            <input type="text"
                   name="<?php echo esc_attr(InvitationCode::META_CODE_STRING); ?>"
                   value="<?php echo esc_attr($code->getOrGenerateCodeString()); ?>"
                   class="cmreg-code-input" />
            <input type="button" value="Generate new" class="cmreg-code-generate button" />
        </div>
    </div>

    <div class="cmreg-field-wrapper cmreg-expiration">
        <div class="cmreg-field-label">Expiration date:</div>
        <div class="cmreg-field-value">
            <input type="datetime-local"
                   name="<?php echo esc_attr(InvitationCode::META_EXPIRATION); ?>"
                   value="<?php echo esc_attr($code->getExpirationDateFormatted()); ?>" />
        </div>
    </div>

    <div class="cmreg-field-wrapper cmreg-users-limit onlyinpro">
        <div class="cmreg-field-label">Users limit:</div>
        <div class="cmreg-field-value">
            <input type="number" value="0" disabled />
			<div class="cm_field_help_pro">(Only in Pro)</div>
        </div>
    </div>
	
    <div class="cmreg-field-wrapper cmreg-email-verification onlyinpro">
        <div class="cmreg-field-label">Require email verification:</div>
        <div class="cmreg-field-value">
            <select disabled>
                <?php foreach ($emailVerificationOptions as $value => $label): ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($value, $emailVerificationStatus); ?>>
                        <?php echo $label; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div>
                <em>Global option is:</em>
                <strong>
                    <?php echo(Settings::getOption('Settings::OPTION_REGISTER_EMAIL_VERIFICATION_ENABLE') ? 'Yes' : 'No'); ?>
                </strong>
            </div>
			<div class="cm_field_help_pro">(Only in Pro)</div>
        </div>
    </div>

    <div class="cmreg-field-wrapper cmreg-email-verification onlyinpro">
        <div class="cmreg-field-label">
            Require to use the following email address during the registration:
        </div>
        <div class="cmreg-field-value">
            <input type="email" disabled value="" />
            <br><em>Using this option makes the invitation code disposable. Leave empty to disable.</em>
			<div class="cm_field_help_pro">(Only in Pro)</div>
        </div>
    </div>

    <div class="cmreg-field-wrapper cmreg-user-role onlyinpro">
        <?php $all_roles = Settings::getRolesOptions(); ?>
        <div class="cmreg-field-label">User role:</div>
        <div class="cmreg-field-value">
            <select disabled>
                <option value="">Follow global option</option>
                <?php foreach (Settings::getRolesOptions() as $roleName => $roleLabel): ?>
                    <?php printf('<option value="%s"%s>%s</option>',
                        esc_attr($roleName),
                        selected($roleName, $code->getUserRole(), false),
                        esc_html($roleLabel)
                    ); ?>
                <?php endforeach; ?>
            </select>
            <div>
                <em>Global option is:</em>
                <strong><?php echo ucwords(get_option('default_role', 'subscriber')); ?></strong>
            </div>
			<div class="cm_field_help_pro">(Only in Pro)</div>
        </div>
    </div>

    <div class="cmreg-field-wrapper cmreg-login-redirection-url onlyinpro">
        <div class="cmreg-field-label">
            Custom Redirection URL after login for users that used this code:
        </div>
        <div class="cmreg-field-value">
            <input type="text" disabled />
            <br><em>Leave empty to use the global options: redirection by role or the default login redirection
                URL.</em>
			<div class="cm_field_help_pro">(Only in Pro)</div>
        </div>
    </div>

    <?php do_action('cmreg_invitation_code_edit', $code->getId(), $code); ?>
</div>