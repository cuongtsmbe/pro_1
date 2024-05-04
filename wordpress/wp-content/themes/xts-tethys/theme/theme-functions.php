<?php
/**
 * Theme functions
 *
 * @package xts
 */

if ( ! function_exists( 'xts_tethys_hooks' ) ) {
	/**
	 * Hooks.
	 *
	 * @since 1.0.0
	 */
	function xts_tethys_hooks() {
		remove_action( 'xts_shop_tools_left_area', 'xts_current_shop_breadcrumbs' );
		remove_action( 'woocommerce_before_shop_loop', 'xts_products_per_page_select', 25 );
		remove_action( 'woocommerce_before_shop_loop', 'xts_products_per_row_select', 26 );
		remove_action( 'woocommerce_before_shop_loop', 'xts_shop_filters_area_button', 40 );
		remove_action( 'xts_shop_page_title', 'xts_shop_page_title', 10 );

		if ( xts_get_opt( 'shop_filters_area' ) ) {
			add_action( 'xts_shop_tools_left_area', 'xts_shop_filters_area_button', 24 );
		}

		add_action( 'xts_shop_tools_left_area', 'xts_products_per_page_select', 25 );
		add_action( 'xts_shop_tools_left_area', 'xts_products_per_row_select', 26 );
	}

	add_action( 'wp', 'xts_tethys_hooks', 500 );
}

if ( ! function_exists( 'xts_custom_content_after_page_title' ) ) {
	/**
	 * Add content after page title.
	 *
	 * @since 1.0.0
	 */
	function xts_custom_content_after_page_title() {
		if ( ! xts_is_shop_archive() ) {
			return;
		}

		$is_title_enabled = xts_get_opt( 'page_title_shop_title' );

		?>
			<div class="container">
				<div class="xts-shop-head-nav row row-spacing-0">
					<div class="col xts-shop-tools">
						<?php if ( $is_title_enabled ) : ?>
							<?php xts_shop_page_title(); ?>
						<?php endif; ?>
					</div>

					<div class="col-auto xts-shop-tools">
						<?php xts_current_shop_breadcrumbs(); ?>
					</div>
				</div>
			</div>
		<?php
	}

	add_action( 'xts_before_site_content_container', 'xts_custom_content_after_page_title', 20 );
}
