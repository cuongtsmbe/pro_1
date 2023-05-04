<?php
/**
 * functions.php
 * @package WordPress
 * @subpackage Partdo
 * @since Partdo 1.0.7
 * 
 */

/*************************************************
## Admin style and scripts  
*************************************************/ 
function partdo_admin_styles() {
	wp_enqueue_style('partdo-klbtheme',     get_template_directory_uri() .'/assets/css/admin/klbtheme.css');
	wp_enqueue_script('partdo-init', 	    get_template_directory_uri() .'/assets/js/init.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script('partdo-register',    get_template_directory_uri() .'/assets/js/admin/register.js', array('jquery'), '1.0', true);
	wp_register_style('partdo-klbicon',     get_template_directory_uri() .'/assets/css/klbicon.css');
}
add_action('admin_enqueue_scripts', 'partdo_admin_styles');

 /*************************************************
## Partdo Fonts
*************************************************/
function partdo_fonts_url_krub() {
	$fonts_url = '';

	$krub = _x( 'on', 'Krub font: on or off', 'partdo' );		

	if ( 'off' !== $krub ) {
		$font_families = array();

		if ( 'off' !== $krub ) {
		$font_families[] = 'Krub:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700';
		}
		
		$query_args = array( 
		'family' => rawurldecode( implode( '|', $font_families ) ), 
		'subset' => rawurldecode( 'latin,latin-ext' ), 
		); 
		 
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css2' );
	}
 
	return esc_url_raw( $fonts_url );
}

/*************************************************
## Styles and Scripts
*************************************************/ 
define('PARTDO_INDEX_CSS', 	  get_template_directory_uri()  . '/assets/css');
define('PARTDO_INDEX_JS', 	  get_template_directory_uri()  . '/assets/js');

function partdo_scripts() {

	if ( is_admin_bar_showing() ) {
		wp_enqueue_style( 'partdo-klbtheme', PARTDO_INDEX_CSS . '/admin/klbtheme.css', false, '1.0');    
	}	

	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

	wp_enqueue_style( 'bootstrap', 				PARTDO_INDEX_CSS . '/bootstrap.min.css', false, '1.0');
	wp_enqueue_style( 'partdo-base', 			PARTDO_INDEX_CSS . '/base.css', false, '1.0');
	wp_enqueue_style( 'partdo-klbicon', 		PARTDO_INDEX_CSS . '/klbicon.css', false, '1.0');
	wp_style_add_data( 'partdo-base', 'rtl', 'replace' );
	wp_enqueue_style( 'partdo-font-krub',  		partdo_fonts_url_krub(), array(), null );
	wp_enqueue_style( 'partdo-style',         	get_stylesheet_uri() );
	wp_style_add_data( 'partdo-style', 'rtl', 'replace' );

	$mapkey = get_theme_mod('partdo_mapapi');

	wp_enqueue_script( 'imagesloaded');
	wp_enqueue_script( 'bootstrap-bundle',    	    	 PARTDO_INDEX_JS . '/bootstrap.bundle.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'gsap-min',    	    	 	 	 PARTDO_INDEX_JS . '/plugins/gsap.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'hover-slider-min',    	    	 PARTDO_INDEX_JS . '/plugins/hover-slider.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'jquery-countdown-min',    	     PARTDO_INDEX_JS . '/plugins/jquery.countdown.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'jquery-magnific-popup-min',    	 PARTDO_INDEX_JS . '/plugins/jquery.magnific-popup.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'perfect-scrollbar-min',    	     PARTDO_INDEX_JS . '/plugins/perfect-scrollbar.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'select2-full-min',    	    	 PARTDO_INDEX_JS . '/plugins/select2.full.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'slick-min',    	    	 		 PARTDO_INDEX_JS . '/plugins/slick.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'theia-sticky-sidebar-min',    	 PARTDO_INDEX_JS . '/plugins/theia-sticky-sidebar.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'partdo-siteslider',    	 		 PARTDO_INDEX_JS . '/custom/siteslider.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'partdo-countdown',        	 	 PARTDO_INDEX_JS . '/custom/countdown.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'partdo-stickysidebar',        	 PARTDO_INDEX_JS . '/custom/stickysidebar.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'partdo-productquantity',      	 PARTDO_INDEX_JS . '/custom/productquantity.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'partdo-hoverslider',        	 PARTDO_INDEX_JS . '/custom/hoverslider.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'partdo-productHover',        	 PARTDO_INDEX_JS . '/custom/productHover.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'partdo-sidebarfilter',     	 	 PARTDO_INDEX_JS . '/custom/sidebarfilter.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'partdo-sitescroll',     	 	 PARTDO_INDEX_JS . '/custom/sitescroll.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'partdo-theme-select',     	 	 PARTDO_INDEX_JS . '/custom/theme-select.js', array('jquery'), '1.0', true);
	wp_register_script( 'partdo-flex-thumbs',        	 PARTDO_INDEX_JS . '/custom/flex-thumbs.js', array('jquery'), '1.0', true);
	wp_register_script( 'partdo-mini-cart-scroll',   	 PARTDO_INDEX_JS . '/custom/mini_cart_scroll.js', array('jquery'), '1.0', true);
	wp_register_script( 'partdo-loginform',   		 	 PARTDO_INDEX_JS . '/custom/loginform.js', array('jquery'), '1.0', true);
	wp_register_script( 'partdo-googlemap',              '//maps.googleapis.com/maps/api/js?key='. $mapkey .'', array('jquery'), '1.0', true);
	wp_enqueue_script( 'bundle',    	    	 		 PARTDO_INDEX_JS . '/bundle.js', array('jquery'), '1.0', true);
	
}
add_action( 'wp_enqueue_scripts', 'partdo_scripts' );

/*************************************************
## Theme Setup
*************************************************/ 

if ( ! isset( $content_width ) ) $content_width = 960;

function partdo_theme_setup() {
	
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array('gallery', 'audio', 'video'));
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'woocommerce', array('gallery_thumbnail_image_width' => 99,) );
	load_theme_textdomain( 'partdo', get_template_directory() . '/languages' );
	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'partdo_theme_setup' );

/*************************************************
## Include the TGM_Plugin_Activation class.
*************************************************/ 

require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'partdo_register_required_plugins' );

function partdo_register_required_plugins() {

	$url = 'http://klbtheme.com/partdo/plugins/';
	$mainurl = 'http://klbtheme.com/plugins/';

	$plugins = array(
		
        array(
            'name'                  => esc_html__('Meta Box','partdo'),
            'slug'                  => 'meta-box',
        ),

        array(
            'name'                  => esc_html__('Contact Form 7','partdo'),
            'slug'                  => 'contact-form-7',
        ),
		
		array(
            'name'                  => esc_html__('WooCommerce Wishlist','partdo'),
            'slug'                  => 'ti-woocommerce-wishlist',
        ),
		
		array(
            'name'                  => esc_html__('WooCommerce Compare','partdo'),
            'slug'                  => 'woo-smart-compare',
        ),
		
        array(
            'name'                  => esc_html__('Kirki','partdo'),
            'slug'                  => 'kirki',
        ),
		
		array(
            'name'                  => esc_html__('MailChimp Subscribe','partdo'),
            'slug'                  => 'mailchimp-for-wp',
        ),
		
        array(
            'name'                  => esc_html__('Elementor','partdo'),
            'slug'                  => 'elementor',
            'required'              => true,
        ),
		
        array(
            'name'                  => esc_html__('WooCommerce','partdo'),
            'slug'                  => 'woocommerce',
            'required'              => true,
        ),

        array(
            'name'                  => esc_html__('Partdo Core','partdo'),
            'slug'                  => 'partdo-core',
            'source'                => $url . 'partdo-core.zip',
            'required'              => true,
            'version'               => '1.0.6',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),

        array(
            'name'                  => esc_html__('Envato Market','partdo'),
            'slug'                  => 'envato-market',
            'source'                => $mainurl . 'envato-market.zip',
            'required'              => true,
            'version'               => '2.0.8',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),


	);

	$config = array(
		'id'           => 'partdo',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

/*************************************************
## Partdo Register Menu 
*************************************************/

function partdo_register_menus() {
	register_nav_menus( array( 'main-menu' 	   => esc_html__('Primary Navigation Menu','partdo')) );
	
	$topleftmenu = get_theme_mod('partdo_top_left_menu','0');
	$toprightmenu = get_theme_mod('partdo_top_right_menu','0');
	$sidebarmenu = get_theme_mod('partdo_header_sidebar','0');
	$footermenu = get_theme_mod('partdo_footer_menu','0');
	
	if($topleftmenu == '1'){
		register_nav_menus( array( 'top-left-menu'     => esc_html__('Top Left Menu','partdo')) );
	}
	
	if($toprightmenu == '1'){
		register_nav_menus( array( 'top-right-menu'     => esc_html__('Top Right Menu','partdo')) );
	}
	
	if($sidebarmenu == '1'){
		register_nav_menus( array( 'sidebar-menu'       => esc_html__('Sidebar Menu','partdo')) );
	}
	
	if($footermenu == '1'){
		register_nav_menus( array( 'footer-menu'        => esc_html__('Footer Menu','partdo')) );
	}
}
add_action('init', 'partdo_register_menus');

/*************************************************
## Partdo Sidebar Menu
*************************************************/ 
class partdo_sidebar_walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			
			);
		$class_names = implode( ' ', $classes );
	  
		// build html
		$output .= "\n" . $indent . '<ul class="sub-menu">' . "\n";
	}

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ){
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
      function start_el(&$output, $object, $depth = 0, $args = Array() , $current_object_id = 0) {
           
           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';
		   
		   $classes = empty( $object->classes ) ? array() : (array) $object->classes;
		   $myclasses = empty( $object->classes ) ? array() : (array) $object->classes;
           $icon_class = $classes[0];
		   $classes = array_slice($classes,1);
		   
		 
		   
		   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		   
		   if ( $args->has_children ) {
		   $class_names = 'class="category-parent parent  '. esc_attr( $class_names ) . '"';
		   }elseif(in_array('bottom',$myclasses)){
		   $class_names = 'class="link-parent  '. esc_attr( $class_names ) . '"';   
		   } else {
		   $class_names = 'class="category-parent  '. esc_attr( $class_names ) . '"';
		   }
			
			$output .= $indent . '<li ' . $value . $class_names .'>';

			$datahover = str_replace(' ','',$object->title);


			$attributes = ! empty( $object->url ) ? ' href="'   . esc_attr( $object->url ) .'"' : '';

				
			$object_output = $args->before;

			$object_output .= '<a'. $attributes .'  >';
			if($icon_class){
			$object_output .= ' <span class="menu-icon"><i class="'.esc_attr($icon_class).'"></i></span> ';
			}
			$object_output .= $args->link_before .  apply_filters( 'the_title', $object->title, $object->ID ) . '';
	        $object_output .= $args->link_after;
			$object_output .= '</a>';


			$object_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );            	              	
      }
}

/*************************************************
## Excerpt More
*************************************************/ 

function partdo_excerpt_more($more) {
  global $post;
  return '<div class="klb-readmore button"><a class="btn link" href="'. esc_url(get_permalink($post->ID)) . '">' . esc_html__('Read More', 'partdo') . ' <i class="klbth-icon-right-arrow"></i></a></div>';
  }
 add_filter('excerpt_more', 'partdo_excerpt_more');
 
/*************************************************
## Word Limiter
*************************************************/ 
function partdo_limit_words($string, $limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $limit));
}

/*************************************************
## Widgets
*************************************************/ 

function partdo_widgets_init() {
	register_sidebar( array(
	  'name' => esc_html__( 'Blog Sidebar', 'partdo' ),
	  'id' => 'blog-sidebar',
	  'description'   => esc_html__( 'These are widgets for the Blog page.','partdo' ),
	  'before_widget' => '<div class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Shop Sidebar', 'partdo' ),
	  'id' => 'shop-sidebar',
	  'description'   => esc_html__( 'These are widgets for the Shop.','partdo' ),
	  'before_widget' => '<div class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer First Column', 'partdo' ),
	  'id' => 'footer-1',
	  'description'   => esc_html__( 'These are widgets for the Footer.','partdo' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Second Column', 'partdo' ),
	  'id' => 'footer-2',
	  'description'   => esc_html__( 'These are widgets for the Footer.','partdo' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Third Column', 'partdo' ),
	  'id' => 'footer-3',
	  'description'   => esc_html__( 'These are widgets for the Footer.','partdo' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Fourth Column', 'partdo' ),
	  'id' => 'footer-4',
	  'description'   => esc_html__( 'These are widgets for the Footer.','partdo' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	
	register_sidebar( array(
	  'name' => esc_html__( 'Footer Fifth Column', 'partdo' ),
	  'id' => 'footer-5',
	  'description'   => esc_html__( 'These are widgets for the Footer.','partdo' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
}
add_action( 'widgets_init', 'partdo_widgets_init' );
 
/*************************************************
## Partdo Comment
*************************************************/

if ( ! function_exists( 'partdo_comment' ) ) :
 function partdo_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
   case 'pingback' :
   case 'trackback' :
  ?>

   <article class="post pingback">
   <p><?php esc_html_e( 'Pingback:', 'partdo' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'partdo' ), ' ' ); ?></p>
  <?php
    break;
   default :
  ?>
  
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		  <article class="klb-comment-body">
			  <div class="vcard">
				<img src="<?php echo get_avatar_url( $comment, 90 ); ?>" alt="<?php comment_author(); ?>" class="avatar">
			  </div>
			<div class="comment-right-side comment-meta">
				<div class="comment-author">
				<b class="fn"><a class="url"><?php comment_author(); ?></a></b>
				</div>
				<div class="comment-metadata">
				  <time><?php comment_date(); ?></time>
				</div><!-- comment-metadata -->
			
				<div class="comment-content">
					<div class="klb-post">
						<?php comment_text(); ?>
						<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'partdo' ); ?></em>
						<?php endif; ?>
					</div>
				</div><!-- comment-content -->
				<div class="reply">
				  <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- reply -->
			</div><!-- comment-right-side -->

		  </article>
	    </div>
	</li>



  <?php
    break;
  endswitch;
 }
endif;

/*************************************************
## Partdo Widget Count Filter
 *************************************************/

function partdo_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span class="catcount">(', $links);
  $links = str_replace(')', ')</span>', $links);
  return partdo_sanitize_data($links);
}
add_filter('wp_list_categories', 'partdo_cat_count_span');
 
function partdo_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span class="catcount">(', $links );
	$links = str_replace( ')', ')</span>', $links );
	return partdo_sanitize_data($links);
}
add_filter( 'get_archives_link', 'partdo_archive_count_span' );


/*************************************************
## Pingback url auto-discovery header for single posts, pages, or attachments
 *************************************************/
function partdo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'partdo_pingback_header' );

/*************************************************
## Nav Description
 *************************************************/
function partdo_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="badge rounded-pill theme-secondary large">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }
 
    return partdo_sanitize_data($item_output);
}
add_filter( 'walker_nav_menu_start_el', 'partdo_nav_description', 10, 4 );

/************************************************************
## DATA CONTROL FROM PAGE METABOX OR ELEMENTOR PAGE SETTINGS
*************************************************************/
function partdo_page_settings( $opt_id){
	
	if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
		// Get the current post id
		$post_id = get_the_ID();

		// Get the page settings manager
		$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

		// Get the settings model for current post
		$page_settings_model = $page_settings_manager->get_model( $post_id );

		// Retrieve the color we added before
		$output = $page_settings_model->get_settings( 'partdo_elementor_'.$opt_id );
		
		return $output;
	}
}

/************************************************************
## Elementor Register Location
*************************************************************/
function partdo_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_location( 'header' );
    $elementor_theme_manager->register_location( 'footer' );
    $elementor_theme_manager->register_location( 'single' );
	$elementor_theme_manager->register_location( 'archive' );

}
add_action( 'elementor/theme/register_locations', 'partdo_register_elementor_locations' );

/************************************************************
## Elementor Get Templates
*************************************************************/
function partdo_get_elementor_template($template_id){
	if($template_id){

	    $frontend = new \Elementor\Frontend;
	    printf( '<div class="partdo-elementor-template template-'.esc_attr($template_id).'">%1$s</div>', $frontend->get_builder_content_for_display( $template_id, true ) );
	
	    if ( class_exists( '\Elementor\Plugin' ) ) {
	        $elementor = \Elementor\Plugin::instance();
	        $elementor->frontend->enqueue_styles();
			$elementor->frontend->enqueue_scripts();
	    }
	
	    if ( class_exists( '\ElementorPro\Plugin' ) ) {
	        $elementor_pro = \ElementorPro\Plugin::instance();
	        $elementor_pro->enqueue_styles();
	    }

	}

}
add_action( 'partdo_before_main_shop', 	 'partdo_get_elementor_template', 10);
add_action( 'partdo_after_main_shop', 	 'partdo_get_elementor_template', 10);
add_action( 'partdo_before_main_footer', 'partdo_get_elementor_template', 10);
add_action( 'partdo_after_main_footer',  'partdo_get_elementor_template', 10);
add_action( 'partdo_before_main_header', 'partdo_get_elementor_template', 10);
add_action( 'partdo_after_main_header',  'partdo_get_elementor_template', 10);

/************************************************************
## Do Action for Templates and Product Categories
*************************************************************/
function partdo_do_action($hook){
	
	if ( !class_exists( 'woocommerce' ) ) {
		return;
	}

	$categorytemplate = get_theme_mod('partdo_elementor_template_each_shop_category');
	if(is_product_category()){
		if($categorytemplate && array_search(get_queried_object()->term_id, array_column($categorytemplate, 'category_id')) !== false){
			foreach($categorytemplate as $c){
				if($c['category_id'] == get_queried_object()->term_id){
					do_action( $hook, $c[$hook.'_elementor_template_category']);
				}
			}
		} else {
			do_action( $hook, get_theme_mod($hook.'_elementor_template'));
		}
	} else {
		do_action( $hook, get_theme_mod($hook.'_elementor_template'));
	}
	
}

/*************************************************
## Partdo Get Image
*************************************************/
function partdo_get_image($image){
	$app_image = ! wp_attachment_is_image($image) ? $image : wp_get_attachment_url($image);
	
	return esc_html($app_image);
}

/*************************************************
## Partdo Get options
*************************************************/
function partdo_get_option(){	
	$getopt  = isset( $_GET['opt'] ) ? $_GET['opt'] : '';

	return esc_html($getopt);
}

/*************************************************
## Partdo Theme options
*************************************************/
	
	require_once get_template_directory() . '/includes/metaboxes.php';
	require_once get_template_directory() . '/includes/woocommerce.php';
	require_once get_template_directory() . '/includes/woocommerce-filter.php';
	require_once get_template_directory() . '/includes/pjax/filter-functions.php';
	require_once get_template_directory() . '/includes/sanitize.php';
	require_once get_template_directory() . '/includes/header/main-header.php';
	require_once get_template_directory() . '/includes/footer/main_footer.php';
	require_once get_template_directory() . '/includes/woocommerce/tab-ajax.php';
	require_once get_template_directory() . '/includes/merlin/theme-register.php';
	require_once get_template_directory() . '/includes/merlin/setup-wizard.php';
