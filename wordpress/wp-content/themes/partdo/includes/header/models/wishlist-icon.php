<?php
if ( ! function_exists( 'partdo_wishlist_icon' ) ) {
	function partdo_wishlist_icon(){
	?>

	<?php $wishlistheader = get_theme_mod('partdo_header_wishlist',0); ?>
	<?php if($wishlistheader == 1){ ?>

		<?php if ( function_exists( 'tinv_url_wishlist_default' ) ) { ?>
		<div class="quick-button wishlist-button">
			<a class="quick-button-inner" href="<?php echo tinv_url_wishlist_default(); ?>">
				<div class="quick-icon"><i class="klbth-icon-heart-round"></i></div>
			</a>
			<div class="count"><?php echo do_shortcode('[ti_wishlist_products_counter]'); ?></div>
		</div>
		
		<?php } ?>

	<?php } ?>
	
	<?php 
	
	}
}