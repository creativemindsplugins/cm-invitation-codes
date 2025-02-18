<?php
use com\cminds\registration\App;
?>
<style>.cm_field_help_pro { opacity:0.5; }</style>
<p style="margin:0px;"><strong>Notice: shortcodes are case-sensitive</strong></p>
<article class="cmreg-shortcode-desc">
	<header>
		<h4>Login and registration links</h4>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<p>To show the login or registration form overlay after clicking a link, just set the URL address of the link to the following value:</p>
		<ul>
			<li><kbd>#cmreg-login-click</kbd> - to show the login and registration form side by side</li>
			<li><kbd>#cmreg-only-login-click</kbd> - to show the login form only</li>
			<li><kbd>#cmreg-only-registration-click</kbd> - to show the registration form only</li>
		</ul>
		<h5>Example</h5>
		<p><kbd>&lt;a href="#cmreg-login-click">Clik here to login&lt;/a></kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc">
	<header>
		<h4>[cmreg-login]</h4>
		<span>Displays the login button</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<h5>Shortcode content</h5>
		<p>Optionally you can pass the text that will appear on the button.</p>
		<h5>Examples</h5>
		<p><kbd>[cmreg-login]</kbd></p>
		<p><kbd>[cmreg-login]Click here to login[/cmreg-login]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc">
	<header>
		<h4>[cmreg-login-form]</h4>
		<span>Displays the login form</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<h5>Parameters</h5>
		<ul>
			<li><strong>registration-url</strong> - URL to the registration page (optional). If passed then it will show a link to the registration page.</li>
			<li><strong>registration-link</strong> - text for the registration page link (optional). If passed then it will show a link to the registration page.</li>
		</ul>
		<h5>Shortcode content</h5>
		<p>Optionally you can pass text or HTML that will be displayed for the logged-in users instead of the login form by putting it between the shortcode tags.</p>
		<h5>Examples</h5>
		<p><kbd>[cmreg-login-form]</kbd></p>
		<p><kbd>[cmreg-login-form]You are already logged-in[/cmreg-login-form]</kbd></p>
		<p><kbd>[cmreg-login-form registration-url="/register" registration-link="Click here to register"]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc">
	<header>
		<h4>[cmreg-registration-form]</h4>
		<span>Displays the registration form</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<h5>Parameters</h5>
		<ul>
			<li><strong>login-url</strong> - URL to the login page (optional). If passed then it will show a link to the login page.</li>
			<li><strong>login-link</strong> - text for the login page link (optional). If passed then it will show a link to the login page.</li>
		</ul>
		<h5>Shortcode content</h5>
		<p>Optionally you can pass text or HTML that will be displayed for the logged-in users instead of the registration form by putting it between the shortcode tags.</p>
		<h5>Examples</h5>
		<p><kbd>[cmreg-registration-form]</kbd></p>
		<p><kbd>[cmreg-registration-form]You are already logged-in[/cmreg-registration-form]</kbd></p>
		<p><kbd>[cmreg-registration-form login-url="/login" login-link="Click here to login"]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc">
	<header>
		<h4>[cmreg-registration-btn]</h4>
		<span>Displays the registration button</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<p>Shortcode displays the registration button and the registration form is being opened in the overlay after clicking the button.</p>
		<h5>Examples</h5>
		<p><kbd>[cmreg-registration-btn]</kbd></p>
		<p>You can also set the button's text:</p>
		<p><kbd>[cmreg-registration-btn]Click here[/cmreg-registration-btn]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-lost-password] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Displays the password reset form for not logged-in users</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<h5>Parameters</h5>
		<ul>
			<li><strong>showforusers</strong> - whether to show the reset password form also for logged-in users (0
				or 1). Default is 0.
			</li>
		</ul>
		<h5>Examples</h5>
		<p><kbd>[cmreg-lost-password]</kbd></p>
		<p><kbd>[cmreg-lost-password showforusers=1]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-reset-password] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Displays the reset password form</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<p>Displays the form that user can use to change his password.</p>
		<h5>Parameters</h5>
		<ul>
			<li><strong>showheader</strong> - whether to show the header (0 or 1). Default is 0.</li>
		</ul>
		<h5>Examples</h5>
		<p><kbd>[cmreg-reset-password]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-edit-profile] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Displays the edit profile form</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<p>Displays the form that user can use to edit his profile data eg. display name, email address and the
			extra fields defined in the CM Registration plugin settings.</p>
		<h5>Parameters</h5>
		<ul>
			<li><strong>showheader</strong> - whether to show the header (0 or 1). Default is 1.</li>
		</ul>
		<h5>Examples</h5>
		<p><kbd>[cmreg-edit-profile]</kbd></p>
		<p><kbd>[cmreg-edit-profile showheader=0]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-change-password] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Displays the change password form</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<p>Displays the form that user can use to change his password.</p>
		<h5>Parameters</h5>
		<ul>
			<li><strong>showheader</strong> - whether to show the header (0 or 1). Default is 0.</li>
		</ul>
		<h5>Examples</h5>
		<p><kbd>[cmreg-change-password]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-social-login] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Displays the social login buttons</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<h5>Examples</h5>
		<p><kbd>[cmreg-social-login]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-create-invitation-code] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Allow users to invite friends</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<p>Displays a form for the regular users to create the invitation codes with the specified parameters
			or send an invitation directly to the email address given by a user.</p>
		<h5>Parameters</h5>
		<ul>
			<li><strong>expiration</strong> - set the expiration date (<kbd>YYYY-MM-DD HH:MM:SS</kbd>) or time
				period that the invitation will be valid for
				in English words e.g. <kbd>30 days</kbd>. You can use the following English words: minutes, hours,
				days, weeks, months or years.
			</li>
			<li><strong>userslimit</strong> - number of users that can use a single created invitation code.</li>
			<li><strong>verifyemail</strong> - whether to verify the email address of a user that will register with
				the created invitation code (0 or 1).
				Default value (global) depends on the plugin settings.
			</li>
			<li><strong>role</strong> - set a role that the new user will be registered with (optional).</li>
			<li><strong>showparams</strong> - whether to show the invitation parameters (such as expiration date,
				email verification etc.) to the user that want to invite his friends.
			</li>
			<li><strong>emailinput</strong> - whether to show the email address input field for the invited user (0
				or 1). If enabled, the invitation will be
				automatically send to the invited user by email.
			</li>
			<li><strong>showlink</strong> - 0 or 1. Shows a link that can be followed to claim the code.</li>
		</ul>
		<h5>Examples</h5>
		<p><kbd>[cmreg-create-invitation-code expiration="2 weeks" verifyemail=1]</kbd></p>
		<p><kbd>[cmreg-create-invitation-code role=contributor userslimit=1]</kbd></p>
		<p><kbd>[cmreg-create-invitation-code emailinput=1 showparams=1]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-send-invitation-code] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Allow users to invite friends</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<p>Displays a form for regular users to send invitations directly to the email addresses provided by a user.</p>
		<h5>Parameters</h5>
		<ul>
			<li><strong>showparams</strong> - whether to show the invitation parameters (such as expiration date,
				email verification etc.) to the user that want to invite his friends.
			</li>
			<li><strong>showlink</strong> - 0 or 1. Shows a link that can be followed to claim the code.</li>
		</ul>
		<h5>Examples</h5>
		<p><kbd>[cmreg-send-invitation-code]</kbd></p>
		<p><kbd>[cmreg-send-invitation-code showparams=1]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-list-users-invitations] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Displays the invitations created by current user</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<h5>Examples</h5>
		<p><kbd>[cmreg-list-users-invitations]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
    <header>
        <h4>[cmreg-logout-btn] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
        <span>Displays the logout button</span>
    </header>
    <div class="cmreg-shortcode-desc-inner">
        <h5>Shortcode content</h5>
        <p>Optionally you can pass the text that will appear on the button.</p>
        <h5>Examples</h5>
        <p><kbd>[cmreg-logout-btn]</kbd></p>
        <p><kbd>[cmreg-logout-btn]Click here to logout[/cmreg-logout-btn]</kbd></p>
    </div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
    <header>
        <h4>[cmreg-delete-account] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
        <span>Displays the delete account button</span>
    </header>
    <div class="cmreg-shortcode-desc-inner">
        <h5>Shortcode content</h5>
        <p>Optionally you can pass the text that will appear on the button.</p>
        <h5>Examples</h5>
        <p><kbd>[cmreg-delete-account]</kbd></p>
        <p><kbd>[cmreg-delete-account]Delete Account[/cmreg-delete-account]</kbd></p>
    </div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
    <header>
        <h4>[cmreg-copy-invitation-code] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
        <span>Displays the copy/share invitation code box</span>
    </header>
    <div class="cmreg-shortcode-desc-inner">
        <h5>Examples</h5>
        <p><kbd>[cmreg-copy-invitation-code]</kbd></p>
    </div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-dashboard] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Show the dashboard</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<h5>Parameters</h5>
		<ul>
			<li><strong>view</strong> - tabs or accordion. You can override global view setting with this parameter.</li>
		</ul>
		<h5>Examples</h5>
		<p><kbd>[cmreg-dashboard]</kbd></p>
		<p><kbd>[cmreg-dashboard view="accordion"]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-user-profile-field] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Show the user profile field value if user logged in.</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<h5>Parameters</h5>
		<ul>
			<li><strong>usermeta</strong> - you need to pass user meta key.</li>
		</ul>
		<h5>Examples</h5>
		<p><kbd>[cmreg-user-profile-field]</kbd></p>
		<p><kbd>[cmreg-user-profile-field usermeta="UserMetaKey"]</kbd></p>
	</div>
</article>
<article class="cmreg-shortcode-desc onlyinpro">
	<header>
		<h4>[cmreg-additional-code] <span class="cm_field_help_pro">(Only in Pro)</span></h4>
		<span>Displays the additional invitation code form</span>
	</header>
	<div class="cmreg-shortcode-desc-inner">
		<p>Displays the form that user can use for additional user role from invitation code.</p>
		<h5>Examples</h5>
		<p><kbd>[cmreg-additional-code]</kbd></p>
		<p><kbd>[cmreg-additional-code]This will work for logged in users only[/cmreg-additional-code]</kbd></p>
	</div>
</article>
<style>
.show_hide_pro_options { display:none; }
</style>