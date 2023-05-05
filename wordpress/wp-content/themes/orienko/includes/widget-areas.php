<?php
/**
* Theme specific widgets or widget overrides
*
* @package LionThemes
* @subpackage Orienko_theme
* @since Orienko Themes 1.4
*/
 
/**
 * Register widgets
 *
 * @return void
 */
function orienko_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Blog Sidebar', 'orienko' ),
		'id' => 'blog',
		'description' => esc_html__( 'Appears on blog page', 'orienko' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s first_last">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Shop Sidebar', 'orienko' ),
		'id' => 'shop',
		'description' => esc_html__( 'Sidebar on shop page', 'orienko' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s first_last">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Top Bar Header', 'orienko' ),
		'id' => 'top_header',
		'description' => esc_html__( 'This area on top bar of header to display language switcher, currency switcher, hotline ...', 'orienko' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer Newsletter', 'orienko' ),
		'id' => 'footer_newsletter',
		'description' => esc_html__( 'This area display Newsletter form', 'orienko' ),
		'before_widget' => '<div class="newsletter-widget col-sm-6">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer 4 columns', 'orienko' ),
		'id' => 'footer_4columns',
		'description' => esc_html__( 'This area display 4 widget in 4 columns of footer', 'orienko' ),
		'before_widget' => '<div class="col-sm-6 col-md-3">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer Payment Support', 'orienko' ),
		'id' => 'footer_payment',
		'description' => esc_html__( 'This area display Payment support in website', 'orienko' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Footer Copyright', 'orienko' ),
		'id' => 'footer_copyright',
		'description' => esc_html__( 'This area display Copyright of website in footer', 'orienko' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'orienko_widgets_init' ); 
