<?php
if ( ! function_exists( 'partdo_discount_products' ) ) {
	function partdo_discount_products(){
	?>	
	
	<?php $discount_products = get_theme_mod('partdo_header_products_tab','0'); ?>
		<?php if($discount_products == '1'){ ?>

		<div class="mega-items">
			<div class="mega-item"> 
				<a href="#"> <span class="menu-icon"> 
					<i class="klbth-icon-ecommerce-discount-black"></i>
					</span><?php echo esc_html(get_theme_mod('partdo_header_products_button_title')); ?>
				</a>
				<div class="sub-item"> 
					<div class="discount-products-header">
						<h4 class="entry-title"><?php echo esc_html(get_theme_mod('partdo_header_products_tab_title')); ?></h4>
						<p><?php echo esc_html(get_theme_mod('partdo_header_products_tab_subtitle')); ?></p>
					</div><!-- discount-products-header -->
						<?php

							$args = array(
								'post_type' => 'product',
								'posts_per_page' => get_theme_mod('partdo_header_products_tab_post_count','6'),
								'order'          => 'DESC',
								'post_status'    => 'publish',
							);

							$args['klb_special_query'] = true;

							if(get_theme_mod('partdo_header_products_tab_best_selling') == '1'){
								$args['meta_key'] = 'total_sales';
								$args['orderby'] = 'meta_value_num';
							}

							if(get_theme_mod('partdo_header_products_tab_featured') == '1'){
								$args['tax_query'] = array( array(
									'taxonomy' => 'product_visibility',
									'field'    => 'name',
									'terms'    => array( 'featured' ),
										'operator' => 'IN',
								) );
							}
							
							if(get_theme_mod('partdo_header_products_tab_on_sale') == '1'){
								$args['meta_key'] = '_sale_price';
								$args['meta_value'] = array('');
								$args['meta_compare'] = 'NOT IN';
							}

							$loop = new \WP_Query( $args );
						?>
						
						
					<div class="products column-5">
						<?php 					
							if ( $loop->have_posts() ) {
								while ( $loop->have_posts() ) : $loop->the_post();
									global $product;
									global $post;
									global $woocommerce;
						?>
							
							<div class="product">
								<?php echo partdo_product_type_header(); ?>
							</div>
						
						<?php 
								endwhile;
							}
							wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</div>
	<?php } 

	}
}