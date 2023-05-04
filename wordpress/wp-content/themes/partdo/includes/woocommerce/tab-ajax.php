<?php
/*************************************************
## Tab View
*************************************************/ 

add_action( 'wp_ajax_nopriv_tab_view', 'partdo_tab_view_callback' );
add_action( 'wp_ajax_tab_view', 'partdo_tab_view_callback' );
function partdo_tab_view_callback() {
	
	global $product;
	global $woocommerce;
	$catid = intval( $_POST['catid'] );
	$items = intval( $_POST['items'] );
	$mobile = intval( $_POST['mobile'] );
	$speed = intval( $_POST['speed'] );
	$dots = $_POST['dots'];
	$arrows = $_POST['arrows'];
	$autoplay = $_POST['autoplay'];
	$autospeed = intval( $_POST['autospeed'] );
	
	$output = '';
		
	$output .= '<div id="'.esc_attr($catid).'" class="klbth-slider klbth-carousel arrows-center arrow-size-def arrows-light arrows-animate dots-style-def dots-align-def slider-noflow slider-no-radius products" data-items="'.esc_attr($items).'" data-mobileitems="'.esc_attr($mobile).'" data-tabletitems="3" data-arrows="'.esc_attr($arrows).'" data-dots="'.esc_attr($dots).'" data-speed="'.esc_attr($speed).'" data-autoplay="'.esc_attr($autoplay).'" data-autospeed="'.esc_attr($autospeed).'" data-css="cubic-bezier(.48,0,.12,1)" data-margin="30">';

	$loop = array(
		'post_type' => 'product',
		'posts_per_page'         => 8,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish',
	);

	$loop['tax_query'][] = array(
		'taxonomy' 	=> 'product_cat',
		'field' 	=> 'term_id',
		'terms' 	=> $catid,
	);
	
    query_posts( $loop );

	while ( have_posts() ) : the_post(); 
	
		$id = get_the_ID();
		$allproduct = wc_get_product( get_the_ID() );
		
		$product = new WC_Product(get_the_ID());
		$cart_url = wc_get_cart_url();
		$price = $allproduct->get_price_html();
		$weight = $product->get_weight();
		$stock_status = $product->get_stock_status();
		$stock_text = $product->get_availability();
		$short_desc = $product->get_short_description();
		$rating = wc_get_rating_html($product->get_average_rating());
		$ratingcount = $product->get_review_count();
		$wishlist = get_theme_mod( 'partdo_wishlist_button', '0' );
		$compare = get_theme_mod( 'partdo_compare_button', '0' );
		$quickview = get_theme_mod( 'partdo_quick_view_button', '0' );
		$sale_price_dates_to    = ( $date = get_post_meta( $id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';

		$managestock = $product->managing_stock();
		$stock_quantity = $product->get_stock_quantity();
		$stock_format = esc_html__('Only %s left in stock','partdo');
		$stock_poor = '';
		if($managestock && $stock_quantity < 10) {
			$stock_poor .= '<div class="product-message color-danger">'.sprintf($stock_format, $stock_quantity).'</div>';
		}
		
		$output .= '<div class="slider-item"> ';
		$output .= '<div class="product"> ';
		$output .= ' <div class="product-wrapper product-type-2 ">'; 	
		$output .= '<div class="product-content">';		
		$output .= '<div class="thumbnail-wrapper entry-media"> ';
		$output .= partdo_sale_percentage();
		$output .= '<a class="product-thumbnail" href="'.get_permalink().'">';
			ob_start();
			$output .= partdo_product_second_image();
			$output .= ob_get_clean();
		$output .= '</a>';
		$output .= '<div class="product-buttons"> ';
			
		$output .= partdo_wishlist_shortcode();
					
		$output .= partdo_compare_shortcode();
					
		if($quickview == '1'){
			$output .= '<a class="detail-bnt quickview" href="'.$product->get_id().'"><i class="klbth-icon-eye-empty"></i></a>';
		}	
					
		$output .= ' </div>';
		$output .= ' </div>';
		
		$output .= '<div class="content-wrapper">';
		$output .= '<h3 class="product-title"> <a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
		
		if(partdo_vendor_name()){
			$output .= '<div class="content-switcher">';
			$output .= '<div class="switcher-wrapper">';			  
			$output .= partdo_vendor_name();
			if($ratingcount){	
				$output .= '<div class="product-rating">';
				  $output .= $rating;
				  $output .= '<div class="rating-count"> <span class="count-text">'.sprintf(_n('%d review', '%d reviews', $ratingcount, 'partdo'), $ratingcount).'</span></div>';
				$output .= '</div>';
			}				  
			$output .= '</div>';
			$output .= '</div>';
		} else {
			if($ratingcount){	
				$output .= '<div class="product-rating">';
				$output .= $rating;
				$output .= '<div class="rating-count"> <span class="count-text">'.sprintf(_n('%d review', '%d reviews', $ratingcount, 'partdo'), $ratingcount).'</span></div>';
				$output .= '</div>';
			}
		}
		
		$output .= '<div class="product-cart-form">';
		$output .= '<span class="price">'; 
		$output .= $price;
		$output .= '</span>';
			ob_start();
			woocommerce_template_loop_add_to_cart();
			$output .= ob_get_clean();;
		$output .= '</div>';
		if($stock_status == 'instock' && $stock_text['availability']){
			$output .= '<div class="product-stock in-stock"> <i class="klbth-icon-ecommerce-package-ready"></i><span>'.$stock_text['availability'].'</span></div>';
		} elseif($stock_text['availability']) {
			$output .= '<div class="product-stock outof-stock"> <i class="klbth-icon-ecommerce-package-ready"></i><span>'.$stock_text['availability'].'</span></div>';
		}
		
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
		
		endwhile; 
		wp_reset_query();

		$output .= '</div>';
			
	 	$output_escaped = $output;
	 	echo $output_escaped;

	
		wp_die();

}