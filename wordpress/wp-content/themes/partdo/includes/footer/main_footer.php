<?php

/*************************************************
## Main Footer Function
*************************************************/

add_action('partdo_main_footer','partdo_main_footer_function',20);

if ( ! function_exists( 'partdo_main_footer_function' ) ) {
	function partdo_main_footer_function(){

		if(partdo_page_settings('page_footer_type') == 'type2') {
			
			get_template_part( 'includes/footer/footer-type2' );

		} elseif(partdo_page_settings('page_footer_type') == 'type1') {
			
			get_template_part( 'includes/footer/footer-type1' );
		} elseif(get_theme_mod('partdo_footer_type') == 'type2'){
			
			get_template_part( 'includes/footer/footer-type2' );
			
		} else {
			
			get_template_part( 'includes/footer/footer-type1' );
			
		}
		
	}
}
