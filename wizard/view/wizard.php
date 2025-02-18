<div class="cm-wizard-step step-0">
    <h1>Welcome to the CM Registration Setup Wizard</h1>
    <p>Thank you for installing the CM Registration plugin!</p>
    <p>This plugin improves your website by enabling advanced user registration and management features, making<br>it easier to create a seamless registration experience for your visitors.</p>
    <img class="img" src="<?php echo CMREGF_SetupWizard::$wizard_url . 'assets/img/wizard_logo.png';?>" />
    <p>To help you get started, we’ve prepared a quick setup wizard to guide you through these steps:</p>
    <ul>
        <li>• Configuring registration settings</li>
        <li>• Setting up login options</li>
        <li>• Creating and managing invitation codes</li>
    </ul>
    <button class="next-step" data-step="0">Start</button>
    <p><a href="<?php echo admin_url( 'admin.php?page='. CMREGF_SetupWizard::$setting_page_slug ); ?>" >Skip the setup wizard</a></p>
</div>
<?php echo CMREGF_SetupWizard::renderSteps(); ?>