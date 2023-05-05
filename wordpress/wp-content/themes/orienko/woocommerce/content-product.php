<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 7.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $orienko_opt, $orienko_productsfound;
$time_modifiy = get_the_modified_date('Y-m-d');
$new_hot = '';
if(!empty($orienko_opt['new_pro_from'])){
	if(strtotime($time_modifiy) >= strtotime($orienko_opt['new_pro_from']) && !empty($orienko_opt['new_pro_label'])){
		$new_hot = '<span class="newlabel"><span>'. esc_html($orienko_opt['new_pro_label']) .'</span></span>';
	}elseif($product->is_featured() && !empty($orienko_opt['featured_pro_label'])){
		$new_hot = '<span class="hotlabel"><span>'. esc_html($orienko_opt['featured_pro_label']) .'</span></span>';
	}
}elseif($product->is_featured() && !empty($orienko_opt['featured_pro_label'])){
	$new_hot = '<span class="hotlabel"><span>'. esc_html($orienko_opt['featured_pro_label']) .'</span></span>';
}
// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}


// Extra post classes
$classes = array();
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == ($woocommerce_loop['loop'] + 1) % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
if($woocommerce_loop['columns'] > 1){
	$orienko_opt['product_per_row'] = $woocommerce_loop['columns'];
	$colwidth = round(12/$woocommerce_loop['columns']);
	$classes[] = ' item-col col-xs-12 col-sm-'.$colwidth;
}
if ( ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) && ( $woocommerce_loop['columns'] >= 2 ) ) {
	if( $orienko_opt['product_per_row'] != 1 ){
		echo '<div class="group">';
	}
} ?>
<div <?php post_class( $classes ); ?>>
	<div class="product-wrapper">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		
		<?php if ( $product->is_on_sale() ) : ?>
			<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale"><span class="sale-text">' . esc_html__( 'Sale', 'orienko' ) . '</span></span>', $post, $product ); ?>
		<?php endif; ?>
		<?php echo '' . $new_hot; ?>
		<div class="list-col4">
			<div class="product-image">
												
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $product->get_name() ); ?>">
					<?php 
					echo wp_get_attachment_image( get_post_thumbnail_id($product->get_id()), apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), false, empty($orienko_opt['second_image']) ? array() : array('class'=>'primary_image') );
					if(!empty($orienko_opt['second_image'])) {
						$attachment_ids = $product->get_gallery_image_ids();
						if ( $attachment_ids ) {
							echo wp_get_attachment_image( $attachment_ids[0], apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), false, array('class'=>'secondary_image') );
						}
					}
					?>
				</a>
				<?php if(!empty($orienko_opt['quickview_btn'])){ ?>
				<div class="detail-link">
					<a class="quickview" data-quick-id="<?php the_ID();?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php esc_html_e('Quick View', 'orienko');?></a>
				</div>
				<?php } ?>
				<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
			</div>
		</div>
		<div class="list-col8">
			<div class="gridview">
				<h2 class="product-name">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<div class="ratings"><?php echo wc_get_rating_html($product->get_average_rating()); ?></div>
				<div class="price-box"><?php echo ''.$product->get_price_html(); ?></div>
				
				<div class="actions">
					<ul class="add-to-links clearfix">
						<li class="addwishlist">	
							<?php if ( class_exists( 'YITH_WCWL' ) ) {
								echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]'));
							} ?>
						</li>
						<li>
							<?php orienko_ajax_add_to_cart_button(); ?>
						</li>
						<li class="addcompare">
							<?php if( class_exists( 'YITH_Woocompare' ) ) {
							echo do_shortcode('[yith_compare_button]');
							} ?>
						</li>							
					</ul>
				</div>

			</div>
		</div>
		<div class="clearfix"></div>
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
</div>
<?php if ( ( ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] || $orienko_productsfound == $woocommerce_loop['loop'] ) && $woocommerce_loop['columns'] >= 2 )  ) {
	if( $orienko_opt['product_per_row'] != 1 ){
		echo '</div>';
	}
} ?>
