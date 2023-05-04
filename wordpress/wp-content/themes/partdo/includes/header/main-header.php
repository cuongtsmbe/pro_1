<?php

/*************************************************
## Partdo Theme options
*************************************************/

require_once get_template_directory() . '/includes/header/models/canvas-menu.php';
require_once get_template_directory() . '/includes/header/models/top-notification1.php';
require_once get_template_directory() . '/includes/header/models/top-notification2.php';
require_once get_template_directory() . '/includes/header/models/header-attribute-search.php';
require_once get_template_directory() . '/includes/header/models/sidebar-menu.php';
require_once get_template_directory() . '/includes/header/models/search.php';
require_once get_template_directory() . '/includes/header/models/search-holder.php';
require_once get_template_directory() . '/includes/header/models/account-icon1.php';
require_once get_template_directory() . '/includes/header/models/account-icon2.php';
require_once get_template_directory() . '/includes/header/models/cart1.php';
require_once get_template_directory() . '/includes/header/models/cart2.php';
require_once get_template_directory() . '/includes/header/models/wishlist-icon.php';
require_once get_template_directory() . '/includes/header/models/toggle-menu-button.php';
require_once get_template_directory() . '/includes/header/models/discount-products.php';


/*************************************************
## Main Header Function
*************************************************/

add_action('partdo_main_header','partdo_main_header_function',20);

if ( ! function_exists( 'partdo_main_header_function' ) ) {
	function partdo_main_header_function(){

		if(partdo_page_settings('page_header_type') == 'type4') {
			
			get_template_part( 'includes/header/header-type4' );

		}elseif(partdo_page_settings('page_header_type') == 'type3') {
			
			get_template_part( 'includes/header/header-type3' );
			
		}elseif(partdo_page_settings('page_header_type') == 'type2') {
			
			get_template_part( 'includes/header/header-type2' );
			
		} elseif(partdo_page_settings('page_header_type') == 'type1') {
			
			get_template_part( 'includes/header/header-type1' );
			
		} elseif(get_theme_mod('partdo_header_type') == 'type4'){
			
			get_template_part( 'includes/header/header-type4' );
			
		} elseif(get_theme_mod('partdo_header_type') == 'type3'){
			
			get_template_part( 'includes/header/header-type3' );
			
		} elseif(get_theme_mod('partdo_header_type') == 'type1'){
			
			get_template_part( 'includes/header/header-type1' );
			
		} else {
			
			get_template_part( 'includes/header/header-type2' );
			
		}
		
	}
}
