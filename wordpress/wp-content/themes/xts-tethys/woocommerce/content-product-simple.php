<?php
/**
 * Default product hover template
 *
 * @package xts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

?>

<?php do_action( 'xts_before_shop_loop_thumbnail' ); ?>
<div class="xts-product-thumb">
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="xts-product-link xts-fill"></a>

	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );
	?>

	<div class="xts-product-actions">
		<?php if ( xts_get_opt( 'product_loop_wishlist' ) ) : ?>
			<?php xts_add_wishlist_button( 'xts-style-icon' ); ?>
		<?php endif; ?>
		<?php if ( xts_get_opt( 'product_loop_compare' ) ) : ?>
			<?php xts_add_compare_button( 'xts-style-icon' ); ?>
		<?php endif; ?>
		<?php xts_quick_view_btn( 'xts-style-icon' ); ?>
	</div>
	<div class="xts-product-swatches-wrapper"><?php xts_grid_swatches_template(); ?><?php xts_grid_variations_template(); // Must be in one line. ?></div>
</div>

<div class="xts-product-content">
	<div class="xts-product-content-head">
		<?php
		/**
		 * Hook: woocommerce_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
		?>

		<?php
		/**
		 * Hook: woocommerce_after_shop_loop_item_title.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>
	</div>

	<?php xts_grid_categories_template(); ?>
	<?php xts_grid_attribute_template(); ?>
	<?php xts_grid_brands_template(); ?>

	<?php if ( xts_get_loop_prop( 'product_rating' ) ) : ?>
		<?php woocommerce_template_loop_rating(); ?>
	<?php endif; ?>

	<?php if ( xts_get_loop_prop( 'product_stock_progress_bar' ) ) : ?>
		<?php xts_stock_progress_bar_template( 'xts-product-spb' ); ?>
	<?php endif; ?>

	<?php if ( xts_get_loop_prop( 'product_countdown' ) ) : ?>
		<?php xts_product_loop_sale_countdown( 'xts-product-countdown' ); ?>
	<?php endif; ?>

	<?php if ( ! xts_get_opt( 'catalog_mode' ) ) : ?>
		<div class="xts-product-add-btn">
			<?php
			/**
			 * Hook: woocommerce_after_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			?>
		</div>
	<?php endif; ?>
</div>
