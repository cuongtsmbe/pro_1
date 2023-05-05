<?php
//WooCommerce Hook

//add brands after product detail page
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
add_action( 'woocommerce_archive_description', 'orienko_woocommerce_category_image', 2 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );

//reset woocommerce_single_product_summary 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

add_action( 'woocommerce_single_product_left_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_left_summary', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_left_summary', 'woocommerce_template_single_excerpt', 20 );

//remove product link before - after product inner
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

// hook to custom thumbnail for categories list
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
add_action('woocommerce_before_subcategory_title', 'orienko_subcategory_thumbnail', 10);

// related product option
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'woocommerce_show_related_products', 'orienko_woocommerce_output_related_products', 20 );

function orienko_woocommerce_output_related_products(){
	$orienko_opt = get_option( 'orienko_opt' );
	if(!empty($orienko_opt['enable_related'])){
		woocommerce_output_related_products();
	}
}
// setting related product counter 
add_filter( 'woocommerce_output_related_products_args', 'orienko_related_products_args', 200 );
function orienko_related_products_args($args) {
	$orienko_opt = get_option( 'orienko_opt' );
	if (!empty($orienko_opt['related_amount'])) $args['posts_per_page'] = $orienko_opt['related_amount'];
	return $args;
}

function orienko_subcategory_thumbnail($category){
	$image = get_term_meta($category->term_id, '_square_image');
	if ( !empty($image[0]) ) {
		echo '<img src="' . esc_url($image[0]) . '" alt="'. $category->name .'" />';
	}else{
		woocommerce_subcategory_thumbnail( $category );
	}
	return;
}


// hook to custom gallery thumbnail images size in product page
add_filter ('woocommerce_get_image_size_gallery_thumbnail', 'orienko_get_image_size_gallery_thumbnail');
function orienko_get_image_size_gallery_thumbnail($size) {
	$orienko_opt = get_option( 'orienko_opt' );
	if (!empty($orienko_opt['gallery_thumbnail_size'])) {
		$size['width'] = $orienko_opt['gallery_thumbnail_size']['width'];
		$size['height'] = $orienko_opt['gallery_thumbnail_size']['height'];
		if (!$size['height']) {
			$size['crop']   = 0;
		}
	}
	return $size;
}


// hook before mini cart
add_action('woocommerce_before_mini_cart', 'orienko_woocommerce_before_mini_cart');
function orienko_woocommerce_before_mini_cart(){
	$qty = WC()->cart->get_cart_contents_count();
	?>
	<div class="topcart">
	<a class="cart-toggler" href="javascript:void(0)">
		<i class="icon"></i>
		<span class="my-cart"><?php echo esc_html__('Shopping cart', 'orienko'); ?></span>
		<span class="qty"><?php echo sprintf( _n( '%s Item', '%s Items', $qty, 'orienko' ), $qty ); ?></span>
		<span class="fa fa-angle-down"></span>
	</a>
	<div class="topcart_content">
	<?php
}
// hook after mini cart
add_action('woocommerce_after_mini_cart', 'orienko_woocommerce_after_mini_cart');
function orienko_woocommerce_after_mini_cart(){
	?>
	</div></div>
	<?php
}

// Add image to category description
function orienko_woocommerce_category_image() {
	if ( is_product_category() ){
		global $wp_query;
		
		$cat = $wp_query->get_queried_object();
		$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image = wp_get_attachment_url( $thumbnail_id );
		
		if ( $image ) {
			echo '<p class="category-image-desc"><img src="' . esc_url($image) . '" alt="' . $cat->name . '" /></p>';
		}
	}
}

// add search by category hook
add_action('pre_get_posts', 'orienko_woo_search_pre_get_posts');
function orienko_woo_search_pre_get_posts($query){
	
	if ( !$query->is_search ) return $query;
	
	if(!empty($_GET['catid']) && isset($_GET['post_type']) && $_GET['post_type'] == 'product'){
		$taxquery = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'term_id',
				'terms' => $_GET['catid']
			)
		);
		$query->set( 'tax_query', $taxquery );
	}
}

add_action( 'wp_ajax_orienko_product_remove', 'orienko_product_remove' );
add_action( 'wp_ajax_nopriv_orienko_product_remove', 'orienko_product_remove' );
function orienko_product_remove(){
    global $wpdb, $woocommerce;
	$cart = WC()->instance()->cart;
	if(!empty($_POST['remove_item'])){
	   $cart->remove_cart_item($_POST['remove_item']);
	}
	$qty = WC()->cart->get_cart_contents_count();
	$subtotal = WC()->cart->get_cart_subtotal();
    echo json_encode(array(
			'qty'=> sprintf( _n( '%s Item', '%s Items', $qty, 'orienko' ), $qty ), 
			'subtotal' => strip_tags($subtotal),
			'qtycount' => intval($qty)
		));
    die();
}

//quickview ajax
add_action( 'wp_ajax_product_quickview', 'orienko_product_quickview' );
add_action( 'wp_ajax_nopriv_product_quickview', 'orienko_product_quickview' );

function orienko_product_quickview() {
	global $product, $post, $woocommerce_loop, $orienko_opt;
	if($_POST['data']){
		$productid = intval( $_POST['data'] );
		$product = wc_get_product( $productid );
		$post = get_post( $productid );
	}
	?>
	<div class="woocommerce product">
		<div class="product-images">
			<?php $image_link = wp_get_attachment_url( $product->get_image_id() );?>
			<div class="main-image">
				<?php echo wp_kses($product->get_image('shop_single'),array(
					'img'=>array(
						'src'=>array(),
						'alt'=>array(),
						'class'=>array(),
						'id'=>array()
					)
				)); ?>
			</div>
			<?php
			$attachment_ids = $product->get_gallery_image_ids();

			if ( $attachment_ids ) {
				?>
				<div class="quick-thumbnails">
					<?php $image_link = wp_get_attachment_url( $product->get_image_id() );?>
					<div>
						<a href="<?php echo esc_attr($image_link);?>">
							<?php echo wp_kses($product->get_image('shop_thumbnail'),array(
								'img'=>array(
									'src'=>array(),
									'alt'=>array(),
									'class'=>array(),
									'id'=>array()
								)
							));?>
						</a>
					</div>
					<?php

					$loop = 0;
					$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

					foreach ( $attachment_ids as $attachment_id ) {
						$image_link = wp_get_attachment_url( $attachment_id );

						if ( ! $image_link )
							continue;
						
						?>
						<div>
						<?php
						$classes = array( 'zoom' );

						if ( $loop == 0 || $loop % $columns == 0 )
							$classes[] = 'first';

						if ( ( $loop + 1 ) % $columns == 0 )
							$classes[] = 'last';

						$image_link = wp_get_attachment_url( $attachment_id );

						if ( ! $image_link )
							continue;

						$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
						$image_class = esc_attr( implode( ' ', $classes ) );
						$image_title = esc_attr( get_the_title( $attachment_id ) );

						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $productid, $image_class );

						$loop++;
						?>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			} ?>
		</div>
		<div class="product-info">
			<h1><?php echo esc_html($product->get_name()); ?></h1>
			
			<div class="price-box" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<p class="price">
					<?php echo '' . $product->get_price_html(); ?>
				</p>
			</div>
			
			<a class="see-all" href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($orienko_opt['quickview_link_text']); ?></a>
			<div class="quick-add-to-cart">
				<?php woocommerce_template_single_add_to_cart(); ?>
			</div>
			<div class="quick-desc"><?php echo do_shortcode(get_post($productid)->post_excerpt); ?></div>
			<div class="social-sharing"><?php orienko_product_sharing(); ?></div>
		</div>
	</div>
	<?php
	die();
}


add_action( 'wp_ajax_orienko_autocomplete_search', 'orienko_autocomplete_search' );
add_action( 'wp_ajax_nopriv_orienko_autocomplete_search', 'orienko_autocomplete_search' );
function orienko_autocomplete_search(){
	$html = '';
	if(!empty($_POST['keyword'])){
		$limit = (!empty($orienko_opt['ajaxsearch_result_items'])) ? intval($orienko_opt['ajaxsearch_result_items']) : 6;
		$loop = orienko_woocommerce_query('recent_product', $limit, '', $_POST['keyword']);
		if ( $loop->have_posts() ){
			while ( $loop->have_posts() ){
				$loop->the_post(); 
				global $product; 
				$html .= wc_get_template( 'content-widget-product.php', array( 
								'show_rating' => false , 
								'showon_effect' => '' , 
								'class_column' => '', 
								'show_category'=> false , 
								'delay' => 0 ) 
							);
			}
			$total = $loop->found_posts;
			$html .= '<div class="last-total-result"><span>'. sprintf(esc_html__('%s results found.', 'orienko'), $total) .'</span></div>';
		}else{
			$html .= '<div class="item-product-widget"><span class="no-results">'. esc_html__('No products found!', 'orienko') .'</span></div>';
		}
	}else{
		$html .= '<div class="item-product-widget"><span class="no-results">'. esc_html__('No products found!', 'orienko') .'</span></div>';
	}
	echo '' . $html;
	die();
}

// Count number of products from shortcode
add_filter( 'woocommerce_shortcode_products_query', 'orienko_woocommerce_shortcode_count');
function orienko_woocommerce_shortcode_count( $args ) {
	global $orienko_opt, $orienko_productsfound;
	$orienko_productsfound = new WP_Query($args);
	$orienko_productsfound = $orienko_productsfound->post_count;
	return $args;
}

// number products per page
add_filter( 'loop_shop_per_page', 'orienko_shop_per_page', 20 );
function orienko_shop_per_page() {
	global $orienko_opt;
	return $orienko_opt['product_per_page'];
}

//WooProjects - Project organize
remove_action( 'projects_before_single_project_summary', 'projects_template_single_title', 10 );
add_action( 'projects_single_project_summary', 'projects_template_single_title', 5 );
remove_action( 'projects_before_single_project_summary', 'projects_template_single_short_description', 20 );
remove_action( 'projects_before_single_project_summary', 'projects_template_single_gallery', 40 );
add_action( 'projects_single_project_gallery', 'projects_template_single_gallery', 40 );
add_action( 'woocommerce_share', 'orienko_product_sharing', 40 );

function orienko_ajax_add_to_cart_button(){
	global $product;
	
	if ( $product ) {
		echo '<p class="woocommerce add_to_cart_inline">';
		$defaults = array(
			'quantity' => 1,
			'class'    => implode( ' ', array_filter( array(
					'button',
					'product_type_' . $product->get_type(),
					$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
					$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
			) ) ),
			'attributes' => array(
				'data-product_id'  => $product->get_id(),
				'data-product_sku' => $product->get_sku(),
				'aria-label'       => $product->add_to_cart_description(),
				'rel'              => 'nofollow',
			),
		);
		$args = array();
		$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

		wc_get_template( 'loop/add-to-cart.php', $args );
		echo '</p>';
	}
}
function orienko_get_product_schema(){
	return ((is_ssl()) ? 'https' : 'http') . '://schema.org/Product';
}

add_action('woocommerce_single_product_left_summary', 'orienko_woocommerce_template_single_title', 5);
function orienko_woocommerce_template_single_title() {
	echo '<h1 class="product_title entry-title" itemprop="name" content="'. get_the_title() .'">' . get_the_title() . '</h1>';
}

function orienko_get_shop_display_mode() {
	$settings = array(
		'showsubcats' => false,
		'showproducts' => true,
		'cateID' => 0,
	);
	$shop_view = get_option('woocommerce_shop_page_display');
	$cat_view = get_option('woocommerce_category_archive_display');

	if (is_product_category()) {
		$settings['showproducts'] = ($cat_view != 'subcategories');
		$settings['showsubcats'] = ($cat_view == 'subcategories' || $cat_view == 'both');
		$cate = get_queried_object();
		$settings['cateID'] = $cate->term_id;
		$display_type = get_term_meta($settings['cateID'], 'display_type', true); 
		if ($display_type) {
			if ($display_type == 'subcategories') $settings['showproducts'] = false;
			if ($display_type == 'subcategories' || $display_type == 'both') $settings['showsubcats'] = true;
		}
	}
	if(is_shop()) {
		$settings['showproducts'] = ($shop_view != 'subcategories');
		$settings['showsubcats'] = ($shop_view == 'subcategories' || $shop_view == 'both');
	}
	if(is_search() || count(WC_Query::get_layered_nav_chosen_attributes()) > 0) $settings['showproducts'] = true;
	return $settings;
}
?>
