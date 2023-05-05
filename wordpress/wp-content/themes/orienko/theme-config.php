<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Orienko_Theme_Config')) {

    class Orienko_Theme_Config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'orienko'),
                'desc' => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'orienko'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {
			if (class_exists('ReduxFrameworkPlugin')) {
                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(esc_html__('Customize &#8220;%s&#8221;', 'orienko'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'orienko'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'orienko'); ?>" />
                <?php endif; ?>

                <h4><?php echo esc_html($this->theme->display('Name')); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(esc_html__('By %s', 'orienko'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(esc_html__('Version %s', 'orienko'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'orienko') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo esc_html($this->theme->display('Description')); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . esc_html__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'orienko') . '</p>', esc_html__('http://codex.wordpress.org/Child_Themes', 'orienko'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
           
			$form_options = array();
			if(class_exists('WYSIJA')){
				$wysija_model_forms = WYSIJA::get('forms', 'model');
				$wysija_forms = $wysija_model_forms->getRows();
				foreach($wysija_forms as $wysija_form){
					$form_options[$wysija_form['form_id']] = esc_html($wysija_form['name']);
				}
			}
		   
            // General
            $this->sections[] = array(
                'title'     => esc_html__('General', 'orienko'),
                'desc'      => esc_html__('General theme options', 'orienko'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(

                    array(
                        'id'        => 'logo_main',
                        'type'      => 'media',
                        'title'     => esc_html__('Logo', 'orienko'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload logo here.', 'orienko'),
                    ),
					array(
                        'id'        => 'opt-favicon',
                        'type'      => 'media',
                        'title'     => esc_html__('Favicon', 'orienko'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => esc_html__('Upload favicon here.', 'orienko'),
                    ),
					array(
                        'id'        => 'background_opt',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => esc_html__('Body background', 'orienko'),
                        'subtitle'  => esc_html__('Upload image or select color. Only work with box layout', 'orienko'),
						'default'   => array('background-color' => '#fff'),
                    ),
					array(
                        'id'        => 'back_to_top',
                        'type'      => 'switch',
                        'title'     => esc_html__('Back To Top', 'orienko'),
						'desc'      => esc_html__('Show back to top button on all pages', 'orienko'),
						'default'   => true,
                    ),
					array(
                        'id'        => 'use_mailchimp_form',
                        'type'      => 'switch',
                        'title'     => esc_html__('Use mailchimp Form', 'orienko'),
                        'subtitle'  => esc_html__('This apply for footer form too, if you install and connected to mailchimp, you can fill MC form ID in above field.', 'orienko'),
						'default'   => false,
                    ),
                ),
            );
			
			// Colors
            $this->sections[] = array(
                'title'     => esc_html__('Colors', 'orienko'),
                'desc'      => esc_html__('Color options', 'orienko'),
                'icon'      => 'el-icon-tint',
                'fields'    => array(
					array(
                        'id'        => 'primary_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Primary Color', 'orienko'),
                        'subtitle'  => esc_html__('Pick a color for primary color (default: #fa7c63).', 'orienko'),
						'transparent' => false,
                        'default'   => '#fa7c63',
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'second_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Second Color', 'orienko'),
                        'subtitle'  => esc_html__('Pick a color for second color (default: #467ecb).', 'orienko'),
						'transparent' => false,
                        'default'   => '#467ecb',
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'sale_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Sale Label BG Color', 'orienko'),
                        'subtitle'  => esc_html__('Pick a color for bg sale label (default: #ef3835).', 'orienko'),
						'transparent' => true,
                        'default'   => '#ef3835',
                        'validate'  => 'color',
                    ),
					
					array(
                        'id'        => 'saletext_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Sale Label Text Color', 'orienko'),
                        'subtitle'  => esc_html__('Pick a color for sale label text (default: #ffffff).', 'orienko'),
						'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
					
					array(
                        'id'        => 'rate_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Rating Star Color', 'orienko'),
                        'subtitle'  => esc_html__('Pick a color for star of rating (default: #ffae00).', 'orienko'),
						'transparent' => false,
                        'default'   => '#ffcf40',
                        'validate'  => 'color',
                    ),
					
					array(
                        'id'        => 'headersearch_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Header search color', 'orienko'),
                        'subtitle'  => esc_html__('Pick a color for search color (default: #e1e1e1).', 'orienko'),
						'transparent' => false,
                        'default'   => '#e1e1e1',
                        'validate'  => 'color',
                    ),
                ),
            );
			
			//Fonts
			$this->sections[] = array(
                'title'     => esc_html__('Fonts', 'orienko'),
                'desc'      => esc_html__('Fonts options', 'orienko'),
                'icon'      => 'el-icon-font',
                'fields'    => array(

                    array(
                        'id'            => 'bodyfont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Body font', 'orienko'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
						'text-align'   => false,
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Main body font.', 'orienko'),
                        'default'       => array(
                            'color'         => '#666666',
                            'font-weight'    => '400',
                            'font-family'   => 'Open Sans',
                            'google'        => true,
                            'font-size'     => '13px',
                            'line-height'   => '20px'
						),
                    ),
					array(
                        'id'            => 'headingfont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Heading font', 'orienko'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'line-height'   => false,
						'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Heading font.', 'orienko'),
                        'default'       => array(
							'color'         => '#333333',
                            'font-weight'    => '300',
                            'font-family'   => 'Oswald',
                            'google'        => true,
						),
                    ),
					array(
                        'id'            => 'menufont',
                        'type'          => 'typography',
                        'title'         => esc_html__('Menu font', 'orienko'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        'line-height'   => false,
						'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Menu font.', 'orienko'),
                        'default'       => array(
							'color'         => '#fff',
                            'font-weight'    => '300',
                            'font-family'   => 'Oswald',
							'font-size'     => '18px',
                            'google'        => true,
						),
                    ),
					array(
                        'id'        => 'sub_menu_bg',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Submenu background', 'orienko'),
                        'subtitle'  => esc_html__('Pick a color for sub menu bg (default: #ffffff).', 'orienko'),
						'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'sub_menu_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => esc_html__('Submenu color', 'orienko'),
                        'subtitle'  => esc_html__('Pick a color for sub menu color (default: #333333).', 'orienko'),
						'transparent' => false,
                        'default'   => '#333333',
                        'validate'  => 'color',
                    ),
                ),
            );
			
			//Header
			$this->sections[] = array(
                'title'     => esc_html__('Header', 'orienko'),
                'desc'      => esc_html__('Header options', 'orienko'),
                'icon'      => 'el-icon-tasks',
                'fields'    => array(

					array(
                        'id'        => 'header_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Header Layout', 'orienko'),

                        //Must provide key => value pairs for select options
                        'options'   => array(
                            'default' => 'Default',
                            'second' => 'Second',
							'third' => 'Third',
                        ),
                        'default'   => 'default'
                    ),
					array(
						'id'       => 'top_menu',
						'type'     => 'select',
						'data'     => 'menus',
						'title'    => esc_html__( 'Top Menu', 'orienko' ),
						'subtitle' => esc_html__( 'Select a menu', 'orienko' ),
					),
					array(
						'id'        => 'categories_menu_items',
						'type'      => 'slider',
						'title'     => esc_html__('Number of items', 'orienko'),
						'desc'      => esc_html__('Number of menu items level 1 to show, default value: 11', 'orienko'),
						'default'   => 5,
						'min'       => 1,
						'step'      => 1,
						'max'       => 30,
						'display_value' => 'text'
					),
					array(
                        'id'        => 'showmore_menu_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Showmore menu text', 'orienko'),
                        'default'   => 'More Categories'
                    ),
					array(
                        'id'        => 'sticky_header',
                        'type'      => 'switch',
                        'title'     => esc_html__('Sticky Header', 'orienko'),
						'default'   => true,
                    ),
					array(
                        'id'        => 'enable_topbar',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Topbar', 'orienko'),
						'default'   => true,
                    ),
                ),
            );
			
			//Footer
			$this->sections[] = array(
                'title'     => esc_html__('Footer', 'orienko'),
                'desc'      => esc_html__('Footer options', 'orienko'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					array(
                        'id'        => 'footer_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Footer Layout', 'orienko'),
                        'options'   => array(
                            'default' => 'Default',
							'second' => 'Second',
                        ),
                        'default'   => 'default'
                    ),

					array(
						'id'               => 'copyright',
						'type'             => 'editor',
						'title'    => esc_html__('Copyright information', 'orienko'),
						'subtitle'         => esc_html__('HTML tags allowed: a, br, em, strong', 'orienko'),
						'default'          => 'Copyright &copy; 2016 lionthemes88 All Rights Reserved.',
						'desc'  => esc_html__('Move to widgets manager from version 1.4', 'orienko'),
						'args'   => array(
							'teeny'            => true,
							'textarea_rows'    => 5,
							'media_buttons'	=> false,
						)
					),
					array(
						'id'               => 'payment_icons',
						'type'             => 'editor',
						'title'    => esc_html__('Payment icons', 'orienko'),
						'subtitle'         => esc_html__('HTML tags allowed: a, img', 'orienko'),
						'default'          => '',
						'desc'  => esc_html__('Move to widgets manager from version 1.4', 'orienko'),
						'args'   => array(
							'teeny'            => true,
							'textarea_rows'    => 5,
							'media_buttons'	=> true,
						)
					),
                ),
            );
			
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => esc_html__( 'Newsletter', 'orienko' ),
				'subsection' => true,
				'fields'     => array(
					
					array(
                        'id'        => 'newsletter_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Newsletter title', 'orienko'),
						'desc'  => esc_html__('Move to widgets manager from version 1.4', 'orienko'),
                        'default'   => 'newsletter'
                    ),
					array(
						'id'       => 'newsletter_form',
						'type'     => 'text',
						'title'    => esc_html__('Newsletter form ID', 'orienko'),
						'desc'  => esc_html__('Move to widgets manager from version 1.4', 'orienko'),
						'options'   => '',
					),
				)
			);
		
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => esc_html__( 'Social Icons', 'orienko' ),
				'subsection' => true,
				'fields'     => array(

					array(
                        'id'        => 'follow_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Follow title', 'orienko'),
                        'default'   => 'follow us:'
                    ),
					array(
						'id'       => 'social_icons',
						'type'     => 'sortable',
						'title'    => esc_html__('Social Icons', 'orienko'),
						'subtitle' => esc_html__('Enter social links', 'orienko'),
						'desc'     => esc_html__('Drag/drop to re-arrange', 'orienko'),
						'mode'     => 'text',
						'options'  => array(
							'facebook'     => '',
							'twitter'     => '',
							'instagram' => '',
							'tumblr'     => '',
							'pinterest'     => '',
							'google-plus'     => '',
							'linkedin'     => '',
							'behance'     => '',
							'dribbble'     => '',
							'youtube'     => '',
							'vimeo'     => '',
							'rss'     => '',
							'vk'     => '',
							'yahoo'     => '',
							'qq'     => '',
							'skype'     => '',
							'weibo'     => '',
							'snapchat'     => '',
							'whatsapp'     => '',
						),
						'default' => array(
						    'facebook'     => '#facebook',
							'twitter'     => '#twitter.com',
							'google-plus'     => '#google-plus',
							'youtube'     => '#youtube',
							'instagram'     => '#instagram',
						),
					),
				)
			);
			
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => esc_html__( 'About Us', 'orienko' ),
				'subsection' => true,
				'fields'     => array(				
					array(
                        'id'        => 'about_us_title',
                        'type'      => 'text',
                        'title'     => esc_html__('About Us Title', 'orienko'),
                        'default'   => 'STORE INFORMATION',
						'desc'  => esc_html__('Move to widgets manager from version 1.4', 'orienko'),
                    ),					
					array(
						'id'=>'about_us',
						'type' => 'textarea',
						'title' => esc_html__('About Us', 'orienko'), 
						'subtitle'         => esc_html__('HTML tags allowed: a, img, br, em, strong, p, ul, li', 'orienko'),
						'desc'  => esc_html__('Move to widgets manager from version 1.4', 'orienko'),
						'default' => '
							<ul>
								<li><i class="fa fa-home"></i><p>My Company : 42 avenue des Champs Elysées 75000 Paris France</p></li>
								<li><i class="fa fa-phone"></i><p>Phone: (0123) 456789</p></li>
								<li><i class="fa fa-envelope"></i><p>Email:lionthemes88@gmail.com</p></li>
							</ul>
						
						',
					),
					
				)
			);

            $this->sections[] = array(
                'icon'       => 'el-icon-website',
                'title'      => esc_html__( 'Menus', 'orienko' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'footer_menu1',
                        'type'     => 'select',
                        'data'     => 'menus',
                        'title'    => esc_html__( 'Menu #1', 'orienko' ),
                        'subtitle' => esc_html__( 'Select a menu', 'orienko' ),
						'desc'  => esc_html__('Move to widgets manager from version 1.4', 'orienko'),
                    ),
                    array(
                        'id'       => 'footer_menu2',
                        'type'     => 'select',
                        'data'     => 'menus',
                        'title'    => esc_html__( 'Menu #2', 'orienko' ),
                        'subtitle' => esc_html__( 'Select a menu', 'orienko' ),
						'desc'  => esc_html__('Move to widgets manager from version 1.4', 'orienko'),
                    ),
                     array(
                        'id'       => 'footer_menu3',
                        'type'     => 'select',
                        'data'     => 'menus',
                        'title'    => esc_html__( 'Menu #3', 'orienko' ),
                        'subtitle' => esc_html__( 'Select a menu', 'orienko' ),
						'desc'  => esc_html__('Move to widgets manager from version 1.4', 'orienko'),
                    ),
                )
            );
			
			//Sticky Social Icons
			$this->sections[] = array(
                'title'     => esc_html__('Sticky Social Icons', 'orienko'),
                'desc'      => esc_html__('This setting for social icons always on top of page.', 'orienko'),
                'icon'      => 'el-icon-website',
                'fields'    => array(
					array(
						'id'       => 'sticky_icons',
						'type'     => 'select',
						'options'     => array(
							'' => esc_html__( 'No display', 'orienko' ),
							'on_left' => esc_html__( 'On left', 'orienko' ),
							'on_right' => esc_html__( 'On right', 'orienko' ),
						),
						'default'   => 'on_right',
						'title'    => esc_html__( 'Sticky on the side', 'orienko' ),
					),
					array(
						'id'       => 'sticky_social_icons',
						'type'     => 'sortable',
						'title'    => esc_html__('Social Icons', 'orienko'),
						'subtitle' => esc_html__('Enter social links', 'orienko'),
						'desc'     => esc_html__('Drag/drop to re-arrange', 'orienko'),
						'mode'     => 'text',
						'options'  => array(
							'facebook'     => '',
							'twitter'     => '',
							'google-plus'     => '',
							'youtube'     => '',
							'pinterest'     => '',
							'mail-to' => '',
							'instagram' => '',
							'tumblr'     => '',
							'linkedin'     => '',
							'behance'     => '',
							'dribbble'     => '',							
							'vimeo'     => '',
							'rss'     => '',
							'vk'     => '',
							'yahoo'     => '',
							'qq'     => '',
							'skype'     => '',
							'weibo'     => '',
							'snapchat'     => '',
							'whatsapp'     => '',
							
						),
						'default' => array(
						    'facebook'     => '#facebook',
							'twitter'     => '#twitter.com',
							'google-plus'     => '#google-plus',
							'youtube'     => '#youtube',
							'pinterest'     => '#pinterest',
							'mail-to' => 'mailto:lionthemes88@gmail.com',
						),
					),
					array(
						'id'       => 'sticky_social_titles',
						'type'     => 'sortable',
						'title'    => esc_html__('Social Titles', 'orienko'),
						'subtitle' => esc_html__('This be merge with social icons select above.', 'orienko'),
						'desc'     => esc_html__('This display depend on social icons selected', 'orienko'),
						'mode'     => 'text',
						'options'  => array(
							'facebook'     => '',
							'twitter'     => '',
							'google-plus'     => '',
							'youtube'     => '',
							'pinterest'     => '',
							'mail-to' => '',
							'instagram' => '',
							'tumblr'     => '',
							'linkedin'     => '',
							'behance'     => '',
							'dribbble'     => '',							
							'vimeo'     => '',
							'rss'     => '',
							'vk'     => '',							
						),
						'default' => array(
						    'facebook'     => 'Follow via Facebook',
							'twitter'     => 'Follow via Twitter',
							'google-plus'     => 'Follow via Google +',
							'youtube'     => 'Follow via Youtube',
							'pinterest'     => 'Follow via Pinterest',
							'mail-to' => 'Mail To Us',
						),
					),
				)
			);
			
			//Popup
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => esc_html__( 'Newsletter Popup', 'orienko' ),
				'desc'      => esc_html__('Content show up on home page loaded', 'orienko'),
				'fields'     => array(
					array(
                        'id'        => 'enable_popup',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable', 'orienko'),
						'default'   => true,
                    ),
					array(
                        'id'        => 'background_popup',
                        'type'      => 'background',
                        'output'    => array(''),
                        'title'     => esc_html__('Popup background', 'orienko'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'orienko'),
						'default'   => array('background-color' => '#FFF'),
                    ),
					array(
						'id'=>'popup_onload_content',
						'type' => 'editor',
						'title' => esc_html__('Content', 'orienko'), 
						'subtitle'         => esc_html__('HTML tags allowed: a, img, br, em, strong, p, ul, li', 'orienko'),
						'default' => '<h3>Newsletter</h3>
									Subscribe to the Orienko mailing list to receive updates on new arrivals, special offers
									and other discount information.',
						'args'   => array(
							'teeny'            => true,
							'textarea_rows'    => 10,
							'media_buttons'	=> true,
						)
					),
					array(
                        'id'        => 'popup_onload_form',
                        'type'      => 'text',
                        'title'     => esc_html__('Newsletter Form ID', 'orienko'),
						'default'   => '',
                    ),
					array(
						'id'        => 'popup_onload_expires',
						'type'      => 'slider',
						'title'     => esc_html__('Time expires', 'orienko'),
						'desc'      => esc_html__('Time expires after tick not show again defaut: 1 days', 'orienko'),
						'default'   => 1,
						'min'       => 1,
						'step'      => 1,
						'max'       => 7,
						'display_value' => 'text'
					),
				)
			);

			// Layout
            $this->sections[] = array(
                'title'     => esc_html__('Layout', 'orienko'),
                'desc'      => esc_html__('Select page layout: Box or Full Width', 'orienko'),
                'icon'      => 'el-icon-align-justify',
                'fields'    => array(
					array(
						'id'       => 'page_layout',
						'type'     => 'select',
						'multi'    => false,
						'title'    => esc_html__('Page Layout', 'orienko'),
						'options'  => array(
							'full' => 'Full Width',
							'box' => 'Box'
						),
						'default'  => 'full'
					),
					array(
						'id'        => 'box_layout_width',
						'type'      => 'slider',
						'title'     => esc_html__('Box layout width', 'orienko'),
						'desc'      => esc_html__('Box layout width in pixels, default value: 1200', 'orienko'),
						"default"   => 1200,
						"min"       => 960,
						"step"      => 1,
						"max"       => 1920,
						'display_value' => 'text'
					),
                ),
            );
			
			//Brand logos
			$this->sections[] = array(
                'title'     => esc_html__('Brand Logos', 'orienko'),
                'desc'      => esc_html__('Upload brand logos and links', 'orienko'),
                'icon'      => 'el-icon-briefcase',
                'fields'    => array(
					array(
                        'id'        => 'brand_enable',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable', 'orienko'),
						'default'   => true,
                    ),
					array(
                        'id'        => 'brand_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Brand title', 'orienko'),
                        'default'   => 'Brands Logo'
                    ),
					array(
						'id'          => 'brand_logos',
						'type'        => 'slides',
						'title'       => esc_html__('Logos', 'orienko'),
						'desc'        => esc_html__('Upload logo image and enter logo link.', 'orienko'),
						'placeholder' => array(
							'title'           => esc_html__('Title', 'orienko'),
							'description'     => esc_html__('Description', 'orienko'),
							'url'             => esc_html__('Link', 'orienko'),
						),
					),
                ),
            );
			
			// Sidebar
			$this->sections[] = array(
                'title'     => esc_html__('Sidebar', 'orienko'),
                'desc'      => esc_html__('Sidebar options', 'orienko'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					
					array(
						'id'       => 'sidebarshop_pos',
						'type'     => 'radio',
						'title'    => esc_html__('Shop Sidebar Position', 'orienko'),
						'subtitle'      => esc_html__('Sidebar on shop page', 'orienko'),
						'options'  => array(
							'left' => 'Left',
							'right' => 'Right'),
						'default'  => 'left'
					),
					array(
						'id'       => 'sidebarse_pos',
						'type'     => 'radio',
						'title'    => esc_html__('Pages Sidebar Position', 'orienko'),
						'subtitle'      => esc_html__('Sidebar on pages', 'orienko'),
						'options'  => array(
							'left' => 'Left',
							'right' => 'Right'),
						'default'  => 'left'
					),
					array(
						'id'       => 'sidebarblog_pos',
						'type'     => 'radio',
						'title'    => esc_html__('Blog Sidebar Position', 'orienko'),
						'subtitle'      => esc_html__('Sidebar on Blog pages', 'orienko'),
						'options'  => array(
							'left' => 'Left',
							'right' => 'Right'),
						'default'  => 'left'
					)
                ),
            );
			
			// Portfolio
            $this->sections[] = array(
                'title'     => esc_html__('Portfolio', 'orienko'),
                'desc'      => esc_html__('Use this section to select options for portfolio', 'orienko'),
                'icon'      => 'el-icon-bookmark',
                'fields'    => array(
					array(
						'id'        => 'portfolio_columns',
						'type'      => 'slider',
						'title'     => esc_html__('Portfolio Columns', 'orienko'),
						"default"   => 4,
						"min"       => 2,
						"step"      => 1,
						"max"       => 4,
						'display_value' => 'text'
					),
					array(
						'id'        => 'portfolio_per_page',
						'type'      => 'slider',
						'title'     => esc_html__('Projects per page', 'orienko'),
						'desc'      => esc_html__('Amount of projects per page on portfolio page', 'orienko'),
						"default"   => 12,
						"min"       => 4,
						"step"      => 1,
						"max"       => 48,
						'display_value' => 'text'
					),
					array(
                        'id'        => 'related_project_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related projects title', 'orienko'),
                        'default'   => 'Related Projects'
                    ),
                ),
            );
			
			// Product
            $this->sections[] = array(
                'title'     => esc_html__('Products', 'orienko'),
                'desc'      => esc_html__('Use this section to select options for product', 'orienko'),
                'icon'      => 'el-icon-tags',
                'fields'    => array(
					array(
                        'id'        => 'shop_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop Layout', 'orienko'),
                        'options'   => array(
							'sidebar' => 'Sidebar',
                            'fullwidth' => 'Full Width',
                        ),
                        'default'   => 'sidebar'
                    ),
					array(
                        'id'        => 'default_view',
                        'type'      => 'select',
                        'title'     => esc_html__('Shop default view', 'orienko'),
                        'options'   => array(
							'grid-view' => 'Grid View',
                            'list-view' => 'List View',
                        ),
                        'default'   => 'grid-view'
                    ),
					array(
						'id'        => 'product_per_page',
						'type'      => 'slider',
						'title'     => esc_html__('Products per page', 'orienko'),
						'subtitle'      => esc_html__('Amount of products per page on category page', 'orienko'),
						"default"   => 12,
						"min"       => 4,
						"step"      => 1,
						"max"       => 48,
						'display_value' => 'text'
					),
					array(
						'id'        => 'product_per_row',
						'type'      => 'slider',
						'title'     => esc_html__('Product columns', 'orienko'),
						'subtitle'      => esc_html__('Amount of product columns on category page', 'orienko'),
						"default"   => 3,
						"min"       => 1,
						"step"      => 1,
						"max"       => 6,
						'display_value' => 'text'
					),
					array(
						'id'       => 'enable_loadmore',
						'type'     => 'radio',
						'title'    => esc_html__('Load more ajax', 'orienko'),
						'options'  => array(
							'' => esc_html__('Default pagination', 'orienko'),
							'scroll-more' => esc_html__('Scroll to load more', 'orienko'),
							'button-more' => esc_html__('Button load more', 'orienko')
							),
						'default'  => ''
					),
					array(
						'id'       => 'enable_ajaxsearch',
						'type'     => 'switch',
						'title'    => esc_html__('Autocomplete Ajax Search', 'orienko'),
						'desc'      => esc_html__('Apply for woocommerce search form plugin or header search form', 'orienko'),
						'default'  => false
					),
					array(
						'id'        => 'ajaxsearch_result_items',
						'type'      => 'slider',
						'title'     => esc_html__('Number of search results', 'orienko'),
						'default'   => 6,
						'min'       => 2,
						'step'      => 2,
						'max'       => 20,
						'display_value' => 'text'
					),
					array(
						'id'       => 'second_image',
						'type'     => 'switch',
						'title'    => esc_html__('Use secondary product image', 'orienko'),
						'desc'      => esc_html__('Show the secondary image when hover on product on list', 'orienko'),
						'default'  => true,
					),
					array(
						'id'       => 'quickview_btn',
						'type'     => 'switch',
						'title'    => esc_html__('Quickview Button', 'orienko'),
						'desc'      => esc_html__('Display quickview button for grid mode.', 'orienko'),
						'default'  => true,
					),
					array(
                        'id'        => 'new_pro_from',
                        'type'      => 'text',
                        'title'     => esc_html__('New product from', 'orienko'),
						'desc'      => esc_html__('This set a day to mark product as new from that day to now. Blank for not set.', 'orienko'),
                        'default'   => ''
                    ),
					array(
                        'id'        => 'new_pro_label',
                        'type'      => 'text',
                        'title'     => esc_html__('New label', 'orienko'),
                        'default'   => 'New'
                    ),
					array(
                        'id'        => 'featured_pro_label',
                        'type'      => 'text',
                        'title'     => esc_html__('Featured label', 'orienko'),
                        'default'   => 'Hot'
                    ),
					array(
                        'id'        => 'upsells_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Up-Sells title', 'orienko'),
                        'default'   => 'Up-Sells'
                    ),
					array(
                        'id'        => 'crosssells_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Cross-Sells title', 'orienko'),
                        'default'   => 'Cross-Sells'
                    ),
                ),
            );
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => esc_html__( 'Product page', 'orienko' ),
				'subsection' => true,
				'fields'     => array(
					array(
                        'id'        => 'gallery_thumbnail_size',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Gallery thumbnails size', 'orienko'),
                        'subtitle'  => esc_html__('Width x Height : Empty height value to disable crop image.', 'orienko'),
                        'units'     => false,
                        'default'  => array(
                            'width'   => '110', 
                            'height'  => '72'
                        ),
                    ),
					array(
                        'id'        => 'enable_related',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show related products', 'orienko'),
						'default'   => true,
                    ),
					array(
                        'id'        => 'related_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Related products title', 'orienko'),
                        'default'   => 'Related Products'
                    ),
					array(
						'id'        => 'related_amount',
						'type'      => 'slider',
						'title'     => esc_html__('Number of related products', 'orienko'),
						"default"   => 4,
						"min"       => 1,
						"step"      => 1,
						"max"       => 16,
						'display_value' => 'text'
					),
					array(
                        'id'        => 'enable_upsells',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show upsells products', 'orienko'),
						'default'   => true,
                    ),
					array(
                        'id'        => 'upsells_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Up-Sells title', 'orienko'),
                        'default'   => 'Up-Sells'
                    ),
					array(
						'id'       => 'pro_social_share',
						'type'     => 'checkbox',
						'title'    => esc_html__('Social share', 'orienko'), 
						'options'  => array(
							'facebook' => esc_html__('Facebook', 'orienko'),
							'twitter' => esc_html__('Twitter', 'orienko'),
							'pinterest' => esc_html__('Pinterest', 'orienko'),
							'gplus' => esc_html__('Gplus', 'orienko'),
							'linkedin' => esc_html__('LinkedIn', 'orienko')
						),
						'default' => array(
							'facebook' => '1', 
							'twitter' => '1', 
							'pinterest' => '1',
							'gplus' => '1',
							'linkedin' => '1',
						)
					)
				)
			);
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => esc_html__( 'Quick View', 'orienko' ),
				'subsection' => true,
				'fields'     => array(
					array(
                        'id'        => 'detail_link_text',
                        'type'      => 'text',
                        'title'     => esc_html__('View details text', 'orienko'),
                        'default'   => 'View details'
                    ),
					array(
                        'id'        => 'quickview_link_text',
                        'type'      => 'text',
                        'title'     => esc_html__('View all features text', 'orienko'),
						'desc'      => esc_html__('This is the text on quick view box', 'orienko'),
                        'default'   => 'See all features'
                    ),
				)
			);
			// Blog options
            $this->sections[] = array(
                'title'     => esc_html__('Blog', 'orienko'),
                'desc'      => esc_html__('Use this section to select options for blog', 'orienko'),
                'icon'      => 'el-icon-file',
                'fields'    => array(
					array(
                        'id'        => 'blog_header_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Blog header text', 'orienko'),
                        'default'   => ''
                    ),
					array(
                        'id'        => 'blog_layout',
                        'type'      => 'select',
                        'title'     => esc_html__('Blog Layout', 'orienko'),
                        'options'   => array(
							'nosidebar' => 'No Sidebar',
							'sidebar' => 'Sidebar',
                        ),
                        'default'   => 'sidebar'
                    ),
					array(
                        'id'        => 'blog_column',
                        'type'      => 'select',
                        'title'     => esc_html__('Blog Content Column', 'orienko'),
                        'options'   => array(
							12 => 'One Column',
							6 => 'Two Column',
							4 => 'Three Column',
							3 => 'Four Column'
                        ),
                        'default'   => 6
                    ),
					array(
                        'id'        => 'readmore_text',
                        'type'      => 'text',
                        'title'     => esc_html__('Read more text', 'orienko'),
                        'default'   => 'read more'
                    ),
					array(
						'id'        => 'excerpt_length',
						'type'      => 'slider',
						'title'     => esc_html__('Excerpt length on blog page', 'orienko'),
						"default"   => 22,
						"min"       => 10,
						"step"      => 2,
						"max"       => 120,
						'display_value' => 'text'
					),
					array(
						'id'       => 'blog_social_share',
						'type'     => 'checkbox',
						'title'    => esc_html__('Social share', 'orienko'), 
						'options'  => array(
							'facebook' => esc_html__('Facebook', 'orienko'),
							'twitter' => esc_html__('Twitter', 'orienko'),
							'pinterest' => esc_html__('Pinterest', 'orienko'),
							'gplus' => esc_html__('Gplus', 'orienko'),
							'linkedin' => esc_html__('LinkedIn', 'orienko')
						),
						'default' => array(
							'facebook' => '1', 
							'twitter' => '1', 
							'pinterest' => '1',
							'gplus' => '1',
							'linkedin' => '1',
						)
					)
                ),
            );
			
			// Error 404 page
            $this->sections[] = array(
                'title'     => esc_html__('Error 404 Page', 'orienko'),
                'desc'      => esc_html__('Error 404 page options', 'orienko'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					array(
                        'id'        => 'background_error',
                        'type'      => 'background',
                        'output'    => array('body.error404'),
                        'title'     => esc_html__('Error 404 background', 'orienko'),
                        'subtitle'  => esc_html__('Upload image or select color.', 'orienko'),
						'default'   => array('background-color' => '#444444'),
                    ),
                ),
            );
			
			// Custom CSS
            $this->sections[] = array(
                'title'     => esc_html__('Custom CSS', 'orienko'),
                'desc'      => esc_html__('Add your Custom CSS code', 'orienko'),
                'icon'      => 'el-icon-pencil',
                'fields'    => array(
					array(
						'id'       => 'custom_css',
						'type'     => 'ace_editor',
						'title'    => esc_html__('CSS Code', 'orienko'),
						'subtitle' => esc_html__('Paste your CSS code here.', 'orienko'),
						'mode'     => 'css',
						'theme'    => 'monokai', //chrome
						'default'  => ""
					),
                ),
            );
			
			// Less Compiler
            $this->sections[] = array(
                'title'     => esc_html__('Less Compiler', 'orienko'),
                'desc'      => esc_html__('Turn on this option to apply all theme options. Turn of when you have finished changing theme options and your site is ready.', 'orienko'),
                'icon'      => 'el-icon-wrench',
                'fields'    => array(
					array(
                        'id'        => 'enable_less',
                        'type'      => 'switch',
                        'title'     => esc_html__('Enable Less Compiler', 'orienko'),
						'default'   => true,
                    ),
                ),
            );
			
            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . esc_html__('<strong>Theme URL:</strong> ', 'orienko') . '<a href="' . esc_url($this->theme->get('ThemeURI')) . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . esc_html__('<strong>Author:</strong> ', 'orienko') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . esc_html__('<strong>Version:</strong> ', 'orienko') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . esc_html__('<strong>Tags:</strong> ', 'orienko') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            $this->sections[] = array(
                'title'     => esc_html__('Import / Export', 'orienko'),
                'desc'      => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'orienko'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => esc_html__('Theme Information', 'orienko'),
                //'desc'      => esc_html__('<p class="description">This is the Description. Again HTML is allowed</p>', 'orienko'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html__('Theme Information 1', 'orienko'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'orienko')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'orienko'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'orienko')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'orienko');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'orienko_opt',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html__('Theme Options', 'orienko'),
                'page_title'        => esc_html__('Theme Options', 'orienko'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );

            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                //$this->args['intro_text'] = sprintf(esc_html__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'orienko'), $v);
            } else {
                //$this->args['intro_text'] = esc_html__('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'orienko');
            }

            // Add content after the form.
            //$this->args['footer_text'] = esc_html__('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'orienko');
        }

    }   
    global $reduxConfig;
    $reduxConfig = new Orienko_Theme_Config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
