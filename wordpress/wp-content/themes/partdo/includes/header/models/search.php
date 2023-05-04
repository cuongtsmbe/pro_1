<?php

if ( ! function_exists( 'partdo_search_icon' ) ) {
	function partdo_search_icon(){
		$headersearch = get_theme_mod('partdo_header_search','0');
		if($headersearch == 1){
		?>
		
		<div class="search-form-wrapper">
			<div class="search-form-inner">
				<?php echo partdo_header_product_search(); ?>
			</div>
		</div>
	<?php  }
	}
}
