<?php
/**
 * Orienko Themes functions and definitions
 *
 * @package LionThemes
 * @subpackage Orienko_theme
 * @since Orienko Themes 1.4
 */
//Plugin-Activation
require_once( get_template_directory().'/class-tgm-plugin-activation.php' );

 //Init the Redux Framework
if ( class_exists( 'ReduxFramework' ) && !isset( $redux_demo ) && file_exists( get_template_directory().'/theme-config.php' ) ) {
	require_once( get_template_directory().'/theme-config.php' );
}

// require system parts
if ( file_exists( get_template_directory().'/includes/theme-helper.php' ) ) {
	require_once( get_template_directory().'/includes/theme-helper.php' );
}
if ( file_exists( get_template_directory().'/includes/widget-areas.php' ) ) {
	require_once( get_template_directory().'/includes/widget-areas.php' );
}
if ( file_exists( get_template_directory().'/includes/head-media.php' ) ) {
	require_once( get_template_directory().'/includes/head-media.php' );
}
if ( file_exists( get_template_directory().'/includes/bootstrap-extras.php' ) ) {
	require_once( get_template_directory().'/includes/bootstrap-extras.php' );
}
if ( file_exists( get_template_directory().'/includes/bootstrap-tags.php' ) ) {
	require_once( get_template_directory().'/includes/bootstrap-tags.php' );
}
if ( file_exists( get_template_directory().'/includes/woo-hook.php' ) ) {
	require_once( get_template_directory().'/includes/woo-hook.php' );
}

// theme setup
function orienko_setup(){
	update_option( 'envato_purchase_code_orienko', 'valid' );
	// Load languages
	load_theme_textdomain( 'orienko', get_template_directory() . '/languages' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );

	if ( ! isset( $content_width ) ) $content_width = 625;

	add_theme_support( 'title-tag' );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 800, 9999 ); // Unlimited height, soft crop
	add_image_size( 'orienko-category-thumb', 800, 550, true ); // (cropped)
	add_image_size( 'orienko-category-full', 800, 550, true ); // (cropped)
	add_image_size( 'orienko-post-thumb', 800, 550, true ); // (cropped)
	add_image_size( 'orienko-post-thumbwide', 590, 378, true ); // (cropped)

	add_theme_support( 'woocommerce' );
	add_theme_support( 'custom-background', array() );
	add_theme_support( 'custom-header', array() );

	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'orienko' ) );
	register_nav_menu( 'categories', esc_html__( 'Categories Menu', 'orienko' ) );
	register_nav_menu( 'mobilemenu', esc_html__( 'Mobile Menu', 'orienko' ) );

	if(class_exists('WooCommerce')){
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}
add_action( 'after_setup_theme', 'orienko_setup');

/**
* TGM-Plugin-Activation
*/
add_action( 'tgmpa_register', 'orienko_register_required_plugins');
function orienko_register_required_plugins(){
	$plugins = array(
				array(
					'name'               => esc_html__('LionThemes Helper', 'orienko'),
					'slug'               => 'lionthemes-helper',
					'source'             => get_template_directory() . '/plugins/lionthemes-helper.zip',
					'required'           => true,
				),
				array(
					'name'               => esc_html__('Mega Main Menu', 'orienko'),
					'slug'               => 'mega_main_menu',
					'source'             => 'https://lion-themes.net/plugins/mega_main_menu.zip',
					'required'           => true,
				),
				array(
					'name'               => esc_html__('Revolution Slider', 'orienko'),
					'slug'               => 'revslider',
					'source'             => 'https://lion-themes.net/plugins/revslider.zip',
					'required'           => true,
				),
				array(
					'name'               => esc_html__('WPBackery Page Builder', 'orienko'),
					'slug'               => 'js_composer',
					'source'             => 'https://lion-themes.net/plugins/js_composer.zip',
					'required'           => true,
				),
				// Plugins from the Online WordPress Plugin
				array(
					'name'               => esc_html__('Redux Framework', 'orienko'),
					'slug'               => 'redux-framework',
					'required'           => true,
				),
				array(
					'name'      => esc_html__('Classic Editor', 'organix'),
					'slug'      => 'classic-editor',
					'required'  => false,
				),
				array(
					'name'      => esc_html__('Classic Widgets', 'organix'),
					'slug'      => 'classic-widgets',
					'required'  => false,
				),
				array(
					'name'      => esc_html__('Mailchimp for WP', 'orienko'),
					'slug'      => 'mailchimp-for-wp',
					'required'  => false,
				),
				array(
					'name'      => esc_html__('WooCommerce', 'orienko'),
					'slug'      => 'woocommerce',
					'required'  => true,
				),
				array(
					'name'      => esc_html__('Contact Form 7', 'orienko'),
					'slug'      => 'contact-form-7',
					'required'  => false,
				),
				array(
					'name'      => esc_html__('Projects', 'orienko'),
					'slug'      => 'projects-by-woothemes',
					'source'	=> 'https://lion-themes.net/plugins/projects-by-woothemes.zip',
					'required'  => false,
				),
				array(
					'name'      => esc_html__('Shortcodes Ultimate', 'orienko'),
					'slug'      => 'shortcodes-ultimate',
					'required'  => false,
				),
				array(
					'name'      => esc_html__('Testimonials', 'orienko'),
					'slug'      => 'testimonials-by-woothemes',
					'source'	=> 'https://lion-themes.net/plugins/testimonials-by-woothemes.zip',
					'required'  => false,
				),
				array(
					'name'      => esc_html__('TinyMCE Advanced', 'orienko'),
					'slug'      => 'tinymce-advanced',
					'required'  => false,
				),
				array(
					'name'      => esc_html__('Widget Importer & Exporter', 'orienko'),
					'slug'      => 'widget-importer-exporter',
					'required'  => false,
				),

				array(
					'name'      => esc_html__('YITH WooCommerce Compare', 'orienko'),
					'slug'      => 'yith-woocommerce-compare',
					'required'  => false,
				),
				array(
					'name'      => esc_html__('YITH WooCommerce Wishlist', 'orienko'),
					'slug'      => 'yith-woocommerce-wishlist',
					'required'  => false,
				),
				array(
					'name'      => esc_html__('YITH WooCommerce Zoom Magnifier', 'orienko'),
					'slug'      => 'yith-woocommerce-zoom-magnifier',
					'required'  => false,
				),
			);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'orienko' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'orienko' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'orienko' ), // %s = plugin name.
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'orienko' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'orienko' ),
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'orienko' ), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'orienko' ), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'orienko' ), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'orienko' ), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'orienko' ), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'orienko' ), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'orienko' ), // %1$s = plugin name(s).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'orienko' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'orienko' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'orienko' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'orienko' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'orienko' ), // %s = dashboard link.
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);
	tgmpa( $plugins, $config );
}
