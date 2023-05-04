<?php

if ( ! function_exists( 'partdo_search_icon_holder' ) ) {
	function partdo_search_icon_holder(){
		$headersearch = get_theme_mod('partdo_header_search','0');
		if($headersearch == 1){
		?>
		
		<div class="quick-button search-button">
			  <div class="quick-button-inner">
				<div class="quick-icon"><i class="klbth-icon-search"></i></div>
			  </div>
		</div>

	<?php  }
	}
}


if ( ! function_exists( 'partdo_search_holder' ) ) {
	function partdo_search_holder(){
		$headersearch = get_theme_mod('partdo_header_search','0');
		if($headersearch == 1){
		
		?>
	    <div class="search-holder">
			<div class="search-holder-inner"> 
				<div class="container"> 
					<div class="search-holder-header search-holder-item"> <span><?php esc_html_e('What are you looking for in Partdo?', 'partdo'); ?></span>
						<div class="site-close"> <a href="#" aria-hidden="false"> <i class="klbth-icon-xmark"></i></a></div>
					</div>
					<div class="search-holder-form search-holder-item"> 
						<div class="search-form-wrapper">
							<div class="search-form-inner">
								<?php echo partdo_header_product_search(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	  
		<?php  }
	}
}
add_action('wp_footer', 'partdo_search_holder');