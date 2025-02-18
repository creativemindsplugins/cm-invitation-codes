<?php
use com\cminds\registration\controller\RegistrationController;
use com\cminds\registration\model\Settings;
use com\cminds\registration\model\Labels;
?>
<div class="cmreg-registration cmreg-wrapper">
	<form method="post" data-ajax-url="<?php echo esc_attr(admin_url('admin-ajax.php')); ?>" class="cmreg-registration-form">
		<h2><?php echo Labels::getLocalized('register_form_header'); ?></h2>
		<div class="cmreg-form-text"><?php echo Labels::getLocalized('register_form_text'); ?></div>
		<div class="cmreg-email-field"><input type="email" class="text" required name="email" placeholder="<?php
			echo esc_attr(Labels::getLocalized('field_email')); ?>" /></div>
		<?php if (Settings::getOption(Settings::OPTION_REGISTER_LOGIN_ENABLE)): ?>
			<div class="cmreg-login-field"><input type="text" class="text" required name="login" placeholder="<?php
				echo esc_attr(Labels::getLocalized('register_field_login')); ?>" /></div>
		<?php endif; ?>
		<div class="cmreg-password-field"><input type="password" class="text" required name="<?php echo RegistrationController::FIELD_PASS;
			?>" placeholder="<?php echo esc_attr(Labels::getLocalized('field_password')); ?>" /></div>
		<?php if (Settings::getOption(Settings::OPTION_REGISTER_REPEAT_PASS_ENABLE)): ?>
			<div class="cmreg-repeat-password-field"><input type="password" class="text" required name="<?php echo RegistrationController::FIELD_REPEAT_PASS;
				?>" placeholder="<?php echo esc_attr(Labels::getLocalized('field_repeat_password')); ?>" /></div>
		<?php endif; ?>
		<?php if (Settings::getOption(Settings::OPTION_REGISTER_DISPLAY_NAME_ENABLE)): ?>
			<div class="cmreg-display-name-field"><input type="text" class="text" required name="display_name" placeholder="<?php
				echo esc_attr(Labels::getLocalized('field_display_name')); ?>" /></div>
		<?php endif; ?>
		
		<?php
		$invit_code = Settings::getOption(Settings::OPTION_REGISTER_INVIT_CODE);
		if($invit_code != 'disabled') {
			if($invit_code == 'required') {
				?>
				<div class="cmreg-invitation-code-field">
					<div class="cmreg_ainvlink_con">
						<input type="text" class="text" name="cmreg_invit_code" required placeholder="Invitation Code" value="" />
					</div>
				</div>
				<?php
			} else {
				?>
				<div class="cmreg-invitation-code-field">
					<a href="" class="cmreg_ainvlink">Got an invitation code?</a>
					<div class="cmreg_ainvlink_con" style="display:none;">
						<input type="text" class="text" name="cmreg_invit_code" placeholder="Invitation Code" value="" />
					</div>
				</div>	
				<?php
			}
		}
		?>

		<?php do_action('cmreg_register_form', 'cmreg_overlay', $atts); ?>
		<div class="cmreg-buttons-field">
			<input type="hidden" name="action" value="cmreg_registration" />
			<input type="hidden" name="role" value="<?php echo esc_attr($atts['role']); ?>" />
			<input type="hidden" name="role_nonce" value="<?php echo esc_attr($roleNonce); ?>" />
			<input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
			<button type="submit"><span class="dashicons dashicons-edit"></span><?php echo Labels::getLocalized('register_form_submit_btn'); ?></button>
		</div>
		<?php do_action('cmreg_register_form_bottom', $atts); ?>
		<?php if (isset($atts['login-url'])): ?>
			<div class="cmreg-login-link"><a href="<?php echo esc_attr($atts['login-url']); ?>"><?php
				echo (isset($atts['login-link']) ? $atts['login-link'] : Labels::getLocalized('registration_login_btn')); ?></a></div>
		<?php endif; ?>
	</form>
</div>