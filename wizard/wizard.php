<?php
use com\cminds\registration\App;

class CMREGF_SetupWizard {

    /* 1. Rename this class
     * 2. Update the "Welcome.." step in /view/wizard.php file
     * 3. Update wizard steps in the setSteps()
     * 4. In the CSS and JS files you can add any custom code for the specific plugin if needed
     * 5. Update the add_submenu_page() to add wizard page correctly, and saveOptions() to update options correctly
     * 6. You can add custom functions to this class if needed
     * 7. Include this file with include_once or require_once
     */

    public static $steps;
    public static $wizard_url;
    public static $wizard_path;
    public static $options_slug = 'cmreg_'; //change for your plugin needs
    public static $wizard_screen = 'cm-registration_page_cmreg_setup_wizard'; //change for your plugin needs
    public static $setting_page_slug = 'cm-registration-settings'; //change for your plugin needs
    public static $plugin_basename;

    public static function init() {
        self::$wizard_url = plugin_dir_url(__FILE__);
        self::$wizard_path = plugin_dir_path(__FILE__);
        self::$plugin_basename = plugin_basename(App::SLUG); //change for your plugin needs
        self::setSteps();
        add_action('admin_menu', array(__CLASS__, 'add_submenu_page'),30);
        add_action('wp_ajax_cmregf_save_wizard_options',[__CLASS__,'saveOptions']);
        add_action('wp_ajax_cmregf_create_pages',[__CLASS__,'createPages']);
        add_action( 'admin_enqueue_scripts', [ __CLASS__, 'enqueueAdminScripts' ] );
    }
	
	public static function createPages() {
		$out = '';
		if ( current_user_can( 'edit_pages' ) ) {
			
			$page_title = $_POST['page_title'];
			$page_content = $_POST['page_content'];
			$field_name = $_POST['field_name'];
			
			$new_page = array(
				'post_title'   => $page_title,
				'post_content' => $page_content,
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_author'  => get_current_user_id(),
			);
			
			$page_id = wp_insert_post($new_page);
			
			if($page_id) {
				update_option($field_name, $page_id);
				$out = get_the_permalink($page_id);
			}
		
		}
		echo $out;
		wp_die();
	}
	
    public static function setSteps() {
		
		$shortcodes_content = "";
		
		$shortcodes_content .= "<div class='shortcode_row shortcode_row_1'>";
			$shortcodes_content .= "<div class='shortcode_row_content'><strong>[cmreg-login-form]</strong> - Displays the login form on the page.</div>";
			$shortcodes_content .= "<div class='shortcode_row_control'>";
				$shortcodes_content .= "<div class='first'>";
					if(get_option('cmreg_login_form_page_id') == '') {
						$shortcodes_content .= "<a href='javascript:void(0);' class='generate' data-content='[cmreg-login-form]' data-title='Login Form' data-fname='cmreg_login_form_page_id'>Generate page</a>";
						$shortcodes_content .= "<a href='javascript:void(0);' class='generated' style='display:none;'>Generated</a>";	
					} else {
						$shortcodes_content .= "<a href='javascript:void(0);' class='generated'>Generated</a>";	
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='second'>";
					if(get_option('cmreg_login_form_page_id') == '') {
						$shortcodes_content .= "<input type='text' name='cmreg_login_form_page_id' id='cmreg_login_form_page_id' value='' />";
					} else {
						$postt1 = get_post(get_option('cmreg_login_form_page_id'));
						$shortcodes_content .= "<input type='text' name='cmreg_login_form_page_id' id='cmreg_login_form_page_id' value='".$postt1->guid."' />";
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='third'>";
					if(get_option('cmreg_login_form_page_id') == '') {
						$shortcodes_content .= "<a href='' target='_blank' style='display:none;'>View Page</a>";
					} else {
						$shortcodes_content .= "<a href='".$postt1->guid."' target='_blank'>View Page</a>";
					}
				$shortcodes_content .= "</div>";
			$shortcodes_content .= "</div>";
			$shortcodes_content .= "<div class='shortcode_row_copy'>";
				$shortcodes_content .= "<div class='first'>&nbsp;</div>";
				$shortcodes_content .= "<div class='second'>";
					if(get_option('cmreg_login_form_page_id') == '') {
						$shortcodes_content .= "<a href='javascript:void(0);' style='display:none;'>Copy URL</a>";
					} else {
						$shortcodes_content .= "<a href='javascript:void(0);'>Copy URL</a>";
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='third'>&nbsp;</div>";
			$shortcodes_content .= "</div>";
		$shortcodes_content .= "</div>";
		
		$shortcodes_content .= "<div class='shortcode_row shortcode_row_2'>";
			$shortcodes_content .= "<div class='shortcode_row_content'><strong>[cmreg-registration-form]</strong> - Displays the registration form on the page.</div>";
			$shortcodes_content .= "<div class='shortcode_row_control'>";
				$shortcodes_content .= "<div class='first'>";
					if(get_option('cmreg_registration_form_page_id') == '') {
						$shortcodes_content .= "<a href='javascript:void(0);' class='generate' data-content='[cmreg-registration-form]' data-title='Registration Form' data-fname='cmreg_registration_form_page_id'>Generate page</a>";
						$shortcodes_content .= "<a href='javascript:void(0);' class='generated' style='display:none;'>Generated</a>";	
					} else {
						$shortcodes_content .= "<a href='javascript:void(0);' class='generated'>Generated</a>";	
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='second'>";
					if(get_option('cmreg_registration_form_page_id') == '') {
						$shortcodes_content .= "<input type='text' name='cmreg_registration_form_page_id' id='cmreg_registration_form_page_id' value='' />";
					} else {
						$postt2 = get_post(get_option('cmreg_registration_form_page_id'));
						$shortcodes_content .= "<input type='text' name='cmreg_registration_form_page_id' id='cmreg_registration_form_page_id' value='".$postt2->guid."' />";
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='third'>";
					if(get_option('cmreg_registration_form_page_id') == '') {
						$shortcodes_content .= "<a href='' target='_blank' style='display:none;'>View Page</a>";
					} else {
						$shortcodes_content .= "<a href='".$postt2->guid."' target='_blank'>View Page</a>";
					}
				$shortcodes_content .= "</div>";
			$shortcodes_content .= "</div>";
			$shortcodes_content .= "<div class='shortcode_row_copy'>";
				$shortcodes_content .= "<div class='first'>&nbsp;</div>";
				$shortcodes_content .= "<div class='second'>";
					if(get_option('cmreg_registration_form_page_id') == '') {
						$shortcodes_content .= "<a href='javascript:void(0);' style='display:none;'>Copy URL</a>";
					} else {
						$shortcodes_content .= "<a href='javascript:void(0);'>Copy URL</a>";
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='third'>&nbsp;</div>";
			$shortcodes_content .= "</div>";
		$shortcodes_content .= "</div>";
		
		$shortcodes_content .= "<div class='shortcode_row shortcode_row_3'>";
			$shortcodes_content .= "<div class='shortcode_row_content'><strong>[cmreg-login]</strong> - Adds a login button that users can click to view the login form.</div>";
			$shortcodes_content .= "<div class='shortcode_row_control'>";
				$shortcodes_content .= "<div class='first'>";
					if(get_option('cmreg_login_page_id') == '') {
						$shortcodes_content .= "<a href='javascript:void(0);' class='generate' data-content='[cmreg-login]' data-title='Login Button' data-fname='cmreg_login_page_id'>Generate page</a>";
						$shortcodes_content .= "<a href='javascript:void(0);' class='generated' style='display:none;'>Generated</a>";	
					} else {
						$shortcodes_content .= "<a href='javascript:void(0);' class='generated'>Generated</a>";	
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='second'>";
					if(get_option('cmreg_login_page_id') == '') {
						$shortcodes_content .= "<input type='text' name='cmreg_login_page_id' id='cmreg_login_page_id' value='' />";
					} else {
						$postt3 = get_post(get_option('cmreg_login_page_id'));
						$shortcodes_content .= "<input type='text' name='cmreg_login_page_id' id='cmreg_login_page_id' value='".$postt3->guid."' />";
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='third'>";
					if(get_option('cmreg_login_page_id') == '') {
						$shortcodes_content .= "<a href='' target='_blank' style='display:none;'>View Page</a>";
					} else {
						$shortcodes_content .= "<a href='".$postt3->guid."' target='_blank'>View Page</a>";
					}
				$shortcodes_content .= "</div>";
			$shortcodes_content .= "</div>";
			$shortcodes_content .= "<div class='shortcode_row_copy'>";
				$shortcodes_content .= "<div class='first'>&nbsp;</div>";
				$shortcodes_content .= "<div class='second'>";
					if(get_option('cmreg_login_page_id') == '') {
						$shortcodes_content .= "<a href='javascript:void(0);' style='display:none;'>Copy URL</a>";
					} else {
						$shortcodes_content .= "<a href='javascript:void(0);'>Copy URL</a>";
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='third'>&nbsp;</div>";
			$shortcodes_content .= "</div>";
		$shortcodes_content .= "</div>";
		
		$shortcodes_content .= "<div class='shortcode_row shortcode_row_4'>";
			$shortcodes_content .= "<div class='shortcode_row_content'><strong>[cmreg-registration-btn]</strong> - Adds a registration button that users can click to view the registration form.</div>";
			$shortcodes_content .= "<div class='shortcode_row_control'>";
				$shortcodes_content .= "<div class='first'>";
					if(get_option('cmreg_registration_btn_page_id') == '') {
						$shortcodes_content .= "<a href='javascript:void(0);' class='generate' data-content='[cmreg-registration-btn]' data-title='Registration Button' data-fname='cmreg_registration_btn_page_id'>Generate page</a>";
						$shortcodes_content .= "<a href='javascript:void(0);' class='generated' style='display:none;'>Generated</a>";	
					} else {
						$shortcodes_content .= "<a href='javascript:void(0);' class='generated'>Generated</a>";	
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='second'>";
					if(get_option('cmreg_registration_btn_page_id') == '') {
						$shortcodes_content .= "<input type='text' name='cmreg_registration_btn_page_id' id='cmreg_registration_btn_page_id' value='' />";
					} else {
						$postt4 = get_post(get_option('cmreg_registration_btn_page_id'));
						$shortcodes_content .= "<input type='text' name='cmreg_registration_btn_page_id' id='cmreg_registration_btn_page_id' value='".$postt4->guid."' />";
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='third'>";
					if(get_option('cmreg_registration_btn_page_id') == '') {
						$shortcodes_content .= "<a href='' target='_blank' style='display:none;'>View Page</a>";
					} else {
						$shortcodes_content .= "<a href='".$postt4->guid."' target='_blank'>View Page</a>";
					}
				$shortcodes_content .= "</div>";
			$shortcodes_content .= "</div>";
			$shortcodes_content .= "<div class='shortcode_row_copy'>";
				$shortcodes_content .= "<div class='first'>&nbsp;</div>";
				$shortcodes_content .= "<div class='second'>";
					if(get_option('cmreg_registration_btn_page_id') == '') {
						$shortcodes_content .= "<a href='javascript:void(0);' style='display:none;'>Copy URL</a>";
					} else {
						$shortcodes_content .= "<a href='javascript:void(0);'>Copy URL</a>";
					}
				$shortcodes_content .= "</div>";
				$shortcodes_content .= "<div class='third'>&nbsp;</div>";
			$shortcodes_content .= "</div>";
		$shortcodes_content .= "</div>";
			
        self::$steps = [
            1 => ['title' => 'Registration Settings',
                'options' => [
                    0 => [
                        'name' => 'cmreg_register_login_enable',
						'type' => 'bool',                
						'title' => 'Allow user to enter his login',
                        'hint' => 'Let users create a unique username for logging into the site.',
						'value' => 1,
                    ],
					1 => [
                        'name' => 'cmreg_register_display_name_enable',
						'type' => 'bool',                
						'title' => 'Allow user to enter his publicly displayed name',
                        'hint' => 'Enable users to choose a name displayed publicly on their profile.',
						'value' => 0,
                    ],
                    2 => [
                        'name' => 'cmreg_register_invit_code_require',
                        'type' => 'radio',
						'title' => 'Ask for invitation code',
						'hint' => 'Choose if to require users to provide an invitation code to complete registration.',
                        'options' => [
                            0 => [
                                'title' => 'disabled',
                                'value' => 'disabled'
                            ],
                            1 => [
                                'title' => 'optional',
                                'value' => 'optional'
                            ],
							2 => [
                                'title' => 'required',
                                'value' => 'required'
                            ],
                        ],
						'value' => 'optional',
                    ],
					3 => [
                        'name' => 'cmreg_register_strong_pass_enable',
						'type' => 'bool',                
						'title' => 'Require strong passwords',
                        'hint' => 'Enforce strong passwords with a combination of letters, numbers, and special characters.',
						'value' => 1,
                    ],
					4 => [
                        'name' => 'cmreg_register_repeat_pass_enable',
						'type' => 'bool',                
						'title' => 'Require to repeat password',
                        'hint' => 'Ask users to confirm their password by entering it a second time.',
						'value' => 0,
                    ],
                ],
            ],
            2 => ['title' =>'Login Settings',
                'options' => [
                    0 => [
                        'name' => 'cmreg_login_remember_enable',
						'type' => 'bool',                
						'title' => 'Enable the "Remember me" option',
                        'hint' => 'Allow users to stay logged in on their device for future visits.',
						'value' => 0,
                    ],
                    1 => [
                        'name' => 'cmreg_login_lost_password_enable',
						'type' => 'bool',                
						'title' => 'Enable lost password form',
                        'hint' => 'Provide users with a form to reset their password if forgotten.',
						'value' => 1,
                    ],
                    2 => [
                        'name' => 'cmreg_login_field',
                        'type' => 'radio',
						'title' => 'Login using field',
						'hint' => 'Choose whether users log in using their email, username, or either.',
                        'options' => [
                            0 => [
                                'title' => 'email',
                                'value' => 'email'
                            ],
                            1 => [
                                'title' => 'login',
                                'value' => 'login'
                            ],
							2 => [
                                'title' => 'both',
                                'value' => 'both'
                            ],
                        ],
						'value' => 'both',
                    ],
                ],
            ],
            3 => ['title' =>'Redirection Settings',
                'options' => [
                    0 => [
                        'name' => 'cmreg_logout_redirect_url',
						'type' => 'string',                
						'title' => 'Redirect after logout to URL address',
                        'hint' => 'Specify the page users are redirected to after logging out.',
						'value' => '',
						'placeholder' => 'https://your-site.com/home/',
                    ],
                    1 => [
                        'name' => 'cmreg_login_redirect_url',
						'type' => 'string',                
						'title' => 'Redirect after login to URL address',
                        'hint' => 'Specify the page users are redirected to after logging in.',
						'value' => '',
						'placeholder' => 'https://your-site.com/welcome/',
                    ],
					2 => [
                        'name' => 'cmreg_wp_register_page_redirection_url',
						'type' => 'string',                
						'title' => 'Disable WP registration page and redirect to this URL',
                        'hint' => 'Prevent access to the default WordPress registration page and redirect users to a custom URL.',
						'value' => '',
						'placeholder' => 'https://your-site.com/registration/',
                    ],
                ],
                'content' => "*The relevant pages can be generated in the next step."
            ],
            4 => ['title' =>'Shortcodes',
                'content' => "<p>To make the most of the CM Registration plugin, it's helpful to use the provided shortcodes. These can be added to pages, posts, or widgets to display login and registration forms or buttons.</p>
				<p>Shortcodes for Forms and Buttons:</p>
				".$shortcodes_content."
				"
			],
            5 => ['title' =>'Creating Invitation Codes',
                'content' => "<p>The final step is to create Invitation Codes to restrict registrations on your site.</p>
							  <p>
								  1. Go to the <a href='".admin_url('edit.php?post_type=cmreg_invitcode')."' target='_blank'>\"Invitation Codes\"</a> page, where you can manage all your invitation codes.<br>
								  2. Click <a href='".admin_url('post-new.php?post_type=cmreg_invitcode')."' target='_blank'>\"Add New Invitation Code\"</a> to start creating one.
							  </p>
							  <div class='cm_wizard_image_holder'>
								<a href='". self::$wizard_url . "assets/img/wizard_step_5_1.png' target='_blank'>
									<img src='". self::$wizard_url . "assets/img/wizard_step_5_1.png' width='750px' style='border:1px solid #444;' />
								</a>
							  </div>
							  <p>To create a new invitation code:</p>
							  <p>
								1. Enter a code title (for internal use only).<br>
								2. Add a custom code or generate a random one.<br>
								3. Optionally, set an expiration date and time.<br>
								4. Click \"Publish\" to save the code.
							  </p>
							  <div class='cm_wizard_image_holder'>
								<a href='". self::$wizard_url . "assets/img/wizard_step_5_2.png' target='_blank'>
									<img src='". self::$wizard_url . "assets/img/wizard_step_5_2.png' width='750px' style='border:1px solid #444;' />
								</a>
							  </div>"
			],
        ];
        return;
    }

    public static function add_submenu_page() {
        if(get_option('cmreg_AddWizardMenu', 1)) {
            add_submenu_page( App::SLUG, 'Setup Wizard', 'Setup Wizard', 'manage_options', self::$options_slug . 'setup_wizard', [__CLASS__,'renderWizard'], 20 );
        }
    }

    public static function enqueueAdminScripts() {
        $screen = get_current_screen();		
        if ($screen && $screen->id === self::$wizard_screen) {
            wp_enqueue_style('wizard-css', self::$wizard_url . 'assets/wizard.css');
            wp_enqueue_script('wizard-js', self::$wizard_url . 'assets/wizard.js');
            wp_localize_script('wizard-js', 'wizard_data', ['ajaxurl' => admin_url('admin-ajax.php')]);
            wp_enqueue_script('wp-color-picker');
            wp_enqueue_style('wp-color-picker');
        }
    }
	
    public static function saveOptions() {
        if (isset($_POST['data'])) {
            // Parse the serialized data
            parse_str($_POST['data'], $formData);
            if(!wp_verify_nonce($formData['_wpnonce'],'wizard-form')){
                wp_send_json_error();
            }
            foreach($formData as $key => $value){
                if( !str_contains($key, self::$options_slug) ){
                    continue;
                }
                if(is_array($value)){
                    $sanitized_value = array_map('sanitize_text_field', $value);
					update_option($key, $sanitized_value);
                    continue;
                }
                $sanitized_value = sanitize_text_field($value);
				update_option($key, $sanitized_value);
            }
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    }

    public static function renderWizard() {
        require 'view/wizard.php';
    }

    public static function renderSteps() {
        $output = '';
        $steps = self::$steps;
        foreach($steps as $num => $step) {
            $output .= "<div class='cm-wizard-step step-{$num}' style='display:none;'>";
            $output .= "<h1>" . self::getStepTitle($num) . "</h1>";
            $output .= "<div class='step-container'>
                            <div class='cm-wizard-menu-container'>" . self::renderWizardMenu($num)." </div>";
            $output .= "<div class='cm-wizard-content-container'>";
            if(isset($step['options'])) {
                $output .= "<form>";
                $output .= wp_nonce_field('wizard-form');
                foreach($step['options'] as $option){
                    $output .=  self::renderOption($option);
                }
                $output .= "</form>";
            }
            if (isset($step['content'])) {
                $output .= $step['content'];
            }
            $output .= '</div></div>';
            $output .= self::renderStepsNavigation($num);
            $output .= '</div>';
        }
        return $output;
    }

    public static function renderStepsNavigation($num) {
        $settings_url = admin_url( 'admin.php?page='. self::$setting_page_slug );
        $output = "<div class='step-navigation-container'><button class='prev-step' data-step='{$num}'>Previous</button>";
        if($num == count(self::$steps)){
            $output .= "<button class='finish' onclick='window.location.href = \"$settings_url\" '>Finish</button>";
        } else {
			$output .= "<button class='next-step' data-step='{$num}'>Next</button>";
        }
        $output .= "<p><a href='$settings_url'>Skip the setup wizard</a></p></div>";
        return $output;
    }

    public static function renderOption($option) {
        switch($option['type']) {
            case 'bool':
                return self::renderBool($option);
            case 'int':
                return self::renderInt($option);
            case 'string':
                return self::renderString($option);
            case 'radio':
                return self::renderRadioSelect($option);
            case 'select':
                return self::renderSelect($option);
            case 'color':
                return self::renderColor($option);
            case 'multicheckbox':
                return self::renderMulticheckbox($option);
        }
    }

    public static function renderBool($option) {
		$val = get_option($option['name'], $option['value']);
        $checked = checked(1, get_option($option['name'], $option['value']), false);
        $output = "<div class='form-group'>";
		$output .= "<label for='{$option['name']}' class='label'>{$option['title']}<div class='cm_field_help' data-title='{$option['hint']}'></div></label>";
		$output .= "<input type='hidden' name='{$option['name']}' value='0'>";
        $output .= "<input type='checkbox' id='{$option['name']}' name='{$option['name']}' class='toggle-input' value='{$val}' {$checked}>";
		$output .= "<label for='{$option['name']}' class='toggle-switch'></label>";
		$output .= "</div>";
        return $output;
    }

    public static function renderInt($option) {
        $min = isset($option['min']) ? "min='{$option['min']}'" : '';
        $max = isset($option['max']) ? "max='{$option['max']}'" : '';
        $step = isset($option['step']) ? "step='{$option['step']}'" : '';
        $value = get_option( $option['name'], $option['value']);
        return "<div class='form-group'>
                <label for='{$option['name']}' class='label'>{$option['title']}<div class='cm_field_help' data-title='{$option['hint']}'></div></label>
                <input type='number' id='{$option['name']}' name='{$option['name']}' value='{$value}' {$min} {$max} {$step} />
            </div>";
    }

    public static function renderString($option) {
        $value = get_option( $option['name'], $option['value'] );
        return "<div class='form-group'>
                <label for='{$option['name']}' class='label'>{$option['title']}<div class='cm_field_help' data-title='{$option['hint']}'></div></label>
                <input type='text' id='{$option['name']}' name='{$option['name']}' value='{$value}' placeholder='{$option['placeholder']}' />
            </div>";
    }

    public static function renderRadioSelect($option) {
        $options = $option['options'];
        $output = "<div class='form-group'>";
		$output .= "<label class='label'>{$option['title']}<div class='cm_field_help' data-title='{$option['hint']}'></div></label>";
        $output .= "<div>";
        if(is_callable($option['options'], false, $callable_name)) {
            $options = call_user_func($option['options']);
        }
		foreach($options as $item) {
            $checked = checked($item['value'], get_option($option['name'], $option['value']), false);
            $output .= "<input type='radio' id='{$option['name']}_{$item['value']}' name='{$option['name']}' value='{$item['value']}' {$checked} />
                <label for='{$option['name']}_{$item['value']}'>{$item['title']}</label><br>";
        }
        $output .= "</div>";
		$output .= "</div>";
        return $output;
    }

    public static function renderColor($option) {
        ob_start();
		?>
        <script>jQuery(function ($) { $('input[name="<?php echo esc_attr($option['name']); ?>"]').wpColorPicker(); });</script>
		<?php
        $output = ob_get_clean();
        $value = get_option( $option['name'], $option['value']);
        $output .= "<div class='form-group'><label for='{$option['name']}' class='label'>{$option['title']}<div class='cm_field_help' data-title='{$option['hint']}'></div></label>";
        $output .= sprintf('<input type="text" name="%s" value="%s" />', esc_attr($option['name']), esc_attr($value));
        $output .= "</div>";
        return $output;
    }

    public static function renderSelect($option) {
        $options = $option['options'];
		$output = "<div class='form-group'>";
        $output .= "<label for='{$option['name']}' class='label'>{$option['title']}<div class='cm_field_help' data-title='{$option['hint']}'></div></label>";
		$output .= "<select id='{$option['name']}' name='{$option['name']}'>";
        if(is_callable($option['options'], false, $callable_name)) {
            $options = call_user_func($option['options']);
        }
        foreach($options as $item) {
			$selected = selected($item['value'],get_option( $option['name'] ),false);
			$output .= "<option value='{$item['value']}' {$selected}>{$item['title']}</option>";
		}
		$output .= "</select></div>";
		return $output;
	}
	
    public static function renderMulticheckbox($option) {
        $options = $option['options'];
        $output = "<div class='form-group'>";
        $output .= "<label class='label'>{$option['title']}<div class='cm_field_help' data-title='{$option['hint']}'></div></label>";
		$output .= "<div>";
        if(is_callable($option['options'], false, $callable_name)) {
            $options = call_user_func($option['options']);
        }
		foreach($options as $item) {
            $checked = in_array($item['value'], get_option( $option['name'] )) ? 'checked' : '';
            $output .= "<input type='checkbox' id='{$option['name']}_{$item['value']}' name='{$option['name']}[]' value='{$item['value']}' {$checked}/>
                <label for='{$option['name']}_{$item['value']}'>{$item['title']}</label><br>";
        }
        $output .= "</div>";
        $output .= "</div>";
        return $output;
    }

    public static function renderWizardMenu($current_step) {
        $steps = self::$steps;
        $output = "<ul class='cm-wizard-menu'>";
        foreach ($steps as $key => $step) {
            $num = $key;
            $selected = $num == $current_step ? 'class="selected"' : '';
            $output .= "<li {$selected} data-step='$num'>Step $num: {$step['title']}</li>";
        }
        $output .= "</ul>";
        return $output;
    }

    public static function getStepTitle($current_step) {
        $steps = self::$steps;
        $title = "Step {$current_step}: ";
        $title .= $steps[$current_step]['title'];
        return $title;
    }

    //Custom functions
	
}

CMREGF_SetupWizard::init();