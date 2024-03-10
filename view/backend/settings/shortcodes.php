<?php
use com\cminds\registration\App;
?>
<p><strong>Notice: shortcodes are case-sensitive</strong></p>
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