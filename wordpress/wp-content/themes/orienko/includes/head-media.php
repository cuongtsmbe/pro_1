<?php
/**
* Theme stylesheet & javascript registration
*
* @package LionThemes
* @subpackage Orienko_theme
* @since Orienko Themes 1.4
*/

//Orienko theme style and script 
function orienko_register_script()
{
	global $orienko_opt, $woocommerce;
	$default_font = "'Arial', Helvetica, sans-serif";
	$primary_color = (!empty($orienko_opt['primary_color'])) ? $orienko_opt['primary_color'] : '#EA1616';
	
	$params = array(
		'heading_font'=> ((!empty($orienko_opt['headingfont']['font-family'])) ? $orienko_opt['headingfont']['font-family'] : $default_font),
		'heading_color'=> ((!empty($orienko_opt['headingfont']['color'])) ? $orienko_opt['headingfont']['color'] : '#181818'),
		'heading_font_weight'=> ((!empty($orienko_opt['headingfont']['font-weight'])) ? $orienko_opt['headingfont']['font-weight'] : '700'),
		'menu_font'=> ((!empty($orienko_opt['menufont']['font-family'])) ? $orienko_opt['menufont']['font-family'] : $default_font),
		'menu_color'=> ((!empty($orienko_opt['menufont']['color'])) ? $orienko_opt['menufont']['color'] : '#fff'),
		'menu_font_size'=> ((!empty($orienko_opt['menufont']['font-size'])) ? $orienko_opt['menufont']['font-size'] : '14px'),
		'menu_font_weight'=> ((!empty($orienko_opt['menufont']['font-weight'])) ? $orienko_opt['menufont']['font-weight'] : '400'),
		'sub_menu_bg'=> ((!empty($orienko_opt['sub_menu_bg'])) ? $orienko_opt['sub_menu_bg'] : '#2c2c2c'),
		'sub_menu_color'=> ((!empty($orienko_opt['sub_menu_color'])) ? $orienko_opt['sub_menu_color'] : '#cfcfcf'),
		'body_font'=> ((!empty($orienko_opt['bodyfont']['font-family'])) ? $orienko_opt['bodyfont']['font-family'] : $default_font),
		'text_color'=> ((!empty($orienko_opt['bodyfont']['color'])) ? $orienko_opt['bodyfont']['color'] : '#6e6e6e'),
		'primary_color' => $primary_color,
		'second_color' => ((!empty($orienko_opt['second_color'])) ? $orienko_opt['second_color'] : '#467ecb'),
		'sale_color' => ((!empty($orienko_opt['sale_color'])) ? $orienko_opt['sale_color'] : '#f49835'),
		'saletext_color' => ((!empty($orienko_opt['saletext_color'])) ? $orienko_opt['saletext_color'] : '#f49835'),
		'rate_color' => ((!empty($orienko_opt['rate_color'])) ? $orienko_opt['rate_color'] : '#f49835'),
		'searchcolor' => ((!empty($orienko_opt['headersearch_color'])) ? $orienko_opt['headersearch_color'] : '#ffb128'),
		'page_width' => (!empty($orienko_opt['box_layout_width'])) ? $orienko_opt['box_layout_width'] . 'px' : '1200px',
		'body_bg_color' => ((!empty($orienko_opt['background_opt']['background-color'])) ? $orienko_opt['background_opt']['background-color'] : '#fff'),
		'popup_bg_color' => ((!empty($orienko_opt['background_popup']['background-color'])) ? $orienko_opt['background_popup']['background-color'] : '#fff'),
		'popup_bg_img' => ((!empty($orienko_opt['background_popup']['background-image'])) ? 'url("' . $orienko_opt['background_popup']['background-image'] . '")' : 'none'),
		'popup_bg_img_repeat' => ((!empty($orienko_opt['background_popup']['background-repeat'])) ? $orienko_opt['background_popup']['background-repeat'] : 'no-repeat'),
		'popup_bg_img_position' => ((!empty($orienko_opt['background_popup']['background-position'])) ? $orienko_opt['background_popup']['background-position'] : 'left top'),
		'thumb_width' => ((!empty($orienko_opt['gallery_thumbnail_size']['width'])) ? $orienko_opt['gallery_thumbnail_size']['width'] . 'px' : '110px'),
	);
	
	
	if( function_exists('compileLess') ){
		compileLess('theme.less', 'theme.css', $params);
	}
	
	wp_enqueue_style( 'base-style', get_template_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css'  );
	wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.min.css'  );
	wp_enqueue_style( 'awesome', get_template_directory_uri() . '/css/font-awesome.min.css'  );
	wp_enqueue_style( 'owl-style', get_template_directory_uri() . '/owl-carousel/owl.carousel.css'  );
	wp_enqueue_style( 'owl-transitions', get_template_directory_uri() . '/owl-carousel/owl.transitions.css'  );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/fancybox/jquery.fancybox.css' );
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	if(class_exists('Vc_Manager')){
		wp_enqueue_style( 'vc_font_awesome_5' );
	}
	if(file_exists( get_template_directory() . '/css/theme.css' )){
		wp_enqueue_style( 'theme-options', get_template_directory_uri() . '/css/theme.css', array(), filemtime( get_template_directory() . '/css/theme.css' ) );
	}
	
	// add custom style sheet
	if ( isset($orienko_opt['custom_css']) && $orienko_opt['custom_css']!='') {
		wp_add_inline_style( 'theme-options', $orienko_opt['custom_css'] );
	}
	
	// just for demo custom background-color
	 if(!empty($_GET['ctbg']) && $_GET['ctbg'] == 1){
		$custom_demo = 'body{ background-color: #f8f8f8 !important;';
		wp_add_inline_style( 'theme-options', $custom_demo );
	} 
	// add add-to-cart-variation js to all other pages without detail. it help quickview work with variable products
	if( class_exists('WooCommerce') && !is_product() ) {
		wp_enqueue_script( 'wc-add-to-cart-variation', $woocommerce->plugin_url() . '/assets/js/frontend/add-to-cart-variation.js', array('jquery'), '', true );
    }
		
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'wowjs', get_template_directory_uri() . '/js/jquery.wow.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'owl-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '', true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/owl-carousel/owl.carousel.js', array('jquery'), '', true );
    wp_enqueue_script( 'auto-grid', get_template_directory_uri() . '/js/autoGrid.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/fancybox/jquery.fancybox.pack.js', array('jquery'), '', true );
    wp_enqueue_script( 'orienko-themejs', get_template_directory_uri() . '/js/custom.js', array('jquery'), filemtime( get_template_directory() . '/js/custom.js' ), true );
	
	// add ajaxurl
	$ajaxurl = 'var ajaxurl = "'. esc_js(admin_url('admin-ajax.php')) .'";';
	wp_add_inline_script( 'orienko-themejs', $ajaxurl, 'before' );
	
	// add newletter popup js
	if(isset($orienko_opt['enable_popup']) && $orienko_opt['enable_popup']){
		if (is_front_page() && (!empty($orienko_opt['popup_onload_form']) || !empty($orienko_opt['popup_onload_content']))) {
			$newletter_js = 'jQuery(document).ready(function($){
								if($(\'#popup_onload\').length){
									$(\'#popup_onload\').fadeIn(400);
								}
								$(\'#popup_onload .close-popup, #popup_onload .overlay-bg-popup\').click(function(){
									var not_again = $(this).closest(\'#popup_onload\').find(\'.not-again input[type="checkbox"]\').prop(\'checked\');
									if(not_again){
										var datetime = new Date();
										var exdays = '. ((!empty($orienko_opt['popup_onload_expires'])) ? intval($orienko_opt['popup_onload_expires']) : 7) . ';
										datetime.setTime(datetime.getTime() + (exdays*24*60*60*1000));
										document.cookie = \'no_again=1; expires=\' + datetime.toUTCString();
									}
									$(this).closest(\'#popup_onload\').fadeOut(400);
								});
							});';
			wp_add_inline_script( 'orienko-themejs', $newletter_js );
		}
	}
	//sticky header
	if(isset($orienko_opt['sticky_header']) && $orienko_opt['sticky_header']){
		$sticky_header_js = '
			jQuery(document).ready(function($){
				$(window).scroll(function() {
					var start = $(".main-wrapper > header").outerHeight() + 10;
					' . ((is_admin_bar_showing()) ? '$(".main-wrapper > header").addClass("has_admin");':'') . '
					if ($(this).scrollTop() > start){  
						$(".main-wrapper > header").addClass("sticky");
					}
					else{
						$(".main-wrapper > header").removeClass("sticky");
					}
				});
			});';
		wp_add_inline_script( 'orienko-themejs', $sticky_header_js );
	}
	
	//ajax search autocomplete products
	if(!empty($orienko_opt['enable_ajaxsearch'])){
		$enable_ajaxsearch_js = '
			var in_request = null;
			jQuery(document).on("keyup focus", ".woocommerce-product-search .search-field", function(e){
				var keyword = jQuery(this).val();
				var _me_result = jQuery(this).siblings(".orienko-autocomplete-search-results");
				var _me_loading = jQuery(this).siblings(".orienko-autocomplete-search-loading");
				_me_result.hide();
				_me_loading.show();
				if (in_request !== null){
					in_request.abort();
				}
				in_request = jQuery.ajax({
					type: "POST",
					dataType: "text",
					url: ajaxurl,
					data: "action=orienko_autocomplete_search&keyword=" + keyword, 
					success: function(data){
						_me_result.html(data).delay(500).show();
						_me_loading.hide();
						in_request = null;
					}
				});
				e.preventDefault();
				return false;
			});
		';
		wp_add_inline_script( 'orienko-themejs', $enable_ajaxsearch_js );
	}
	
	// add remove top cart item
	$remove_cartitem_js = 'jQuery(document).on(\'click\', \'.mini_cart_item .remove\', function(e){
							var product_id = jQuery(this).data("product_id");
							var item_li = jQuery(this).closest(\'li\');
							var a_href = jQuery(this).attr(\'href\');
							jQuery.ajax({
								type: \'POST\',
								dataType: \'json\',
								url: ajaxurl,
								data: \'action=orienko_product_remove&\' + (a_href.split(\'?\')[1] || \'\'), 
								success: function(data){
									if(typeof(data) != \'object\'){
										alert(\'' . esc_html__('Could not remove cart item.', 'orienko') . '\');
										return;
									}
									jQuery(\'.topcart .cart-toggler .qty\').html(data.qty);
									jQuery(\'.topcart_content\').css(\'height\', \'auto\');
									if(data.qtycount > 0){
										jQuery(\'.topcart_content .total .amount\').html(data.subtotal);
									}else{
										jQuery(\'.topcart_content .cart_list\').html(\'<li class="empty">' .  esc_html__('No products in the cart.', 'orienko') .'</li>\');
										jQuery(\'.topcart_content .total\').remove();
										jQuery(\'.topcart_content .buttons\').remove();
									}
									item_li.remove();
								}
							});
							e.preventDefault();
							return false;
						});';
	wp_add_inline_script( 'orienko-themejs', $remove_cartitem_js );
	
	// detect cart & checkout url
	$detect_wooconfig = '
		jQuery(document).on(\'click\', \'.topcart_content .buttons .button\', function(e){
			var my_url = jQuery(this).attr("href");
			var base_url = "'. get_site_url() .'";
			if(!my_url || my_url == base_url){
				alert("'. esc_html__('Woocommerce plugin did not be run the setup wizard.', 'orienko') .'");
				e.preventDefault();
				return false;
			}
		});
	';
	wp_add_inline_script( 'orienko-themejs', $detect_wooconfig );
}
add_action( 'wp_enqueue_scripts', 'orienko_register_script' );
// bootstrap for back-end page
add_action( 'admin_enqueue_scripts', 'orienko_admin_custom' );
function orienko_admin_custom() {
	wp_enqueue_style( 'orienko-admin-custom', get_template_directory_uri() . '/css/admin.css', array(), filemtime( get_template_directory() . '/css/admin.css' ));
}
//Orienko theme gennerate title
function orienko_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() ) return $title;
	
	$title .= get_bloginfo( 'name', 'display' );
	
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'orienko' ), max( $paged, $page ) );
	
	return $title;
}

add_filter( 'wp_title', 'orienko_wp_title', 10, 2 );

// add custom style to header
add_action( 'wp_head', 'orienko_wp_custom_head', 100);
function orienko_wp_custom_head(){
	global $orienko_opt;
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		if(isset($orienko_opt['opt-favicon']) && $orienko_opt['opt-favicon']!="") { 
			if(is_ssl()){
				$orienko_opt['opt-favicon'] = str_replace('http:', 'https:', $orienko_opt['opt-favicon']);
			}
		?>
			<link rel="icon" type="image/png" href="<?php echo esc_url($orienko_opt['opt-favicon']['url']);?>">
		<?php }
	}
}

// body class for wow scroll script
add_filter('body_class', 'orienko_effect_scroll');

function orienko_effect_scroll($classes){
	$classes[] = 'orienko-animate-scroll';
	if (is_admin_bar_showing()) {
		$classes[] = 'has_admin';
	}
	return $classes;
}
?>