<?php
if ( ! function_exists( 'partdo_header_attribute_search' ) ) {
	function partdo_header_attribute_search(){
		$custombutton = get_theme_mod('partdo_header_attribute_search_toggle','0'); 
		if($custombutton == '1'){ ?>

		<div class="quick-button custom-button">
			<div class="quick-button-inner">
				<div class="quick-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="partdo-tooltip white arrow-hide" data-bs-title="<?php echo esc_attr(get_theme_mod('partdo_header_attribute_search_title')); ?>" data-klbth-modal="service-modal"><i class="klbth-icon-garage-house"></i></div>
				<div class="klbth-modal-holder" id="service-modal" tabindex="-1" aria-labelledby="service-modal" aria-modal="true" role="dialog"> 
					<div class="klbth-modal-inner size--sm"> 
						<div class="klbth-modal-header"> 
							<h3 class="entry-title"><?php echo esc_html(get_theme_mod('partdo_header_attribute_search_title')); ?></h3>
							<div class="site-close"> <a href="#" aria-hidden="false"> <i class="klbth-icon-xmark"></i></a></div>
						</div>
						<div class="klbth-modal-body"> 
							<div class="service-search-modal">
								<?php if(get_theme_mod( 'partdo_header_attribute_search_image' )){ ?>
									<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'partdo_header_attribute_search_image' )) ); ?>" alt="<?php esc_attr_e('search','partdo'); ?>"/>
								<?php } ?>
								
								<div class="entry-description">
									<p><?php echo partdo_sanitize_data(get_theme_mod('partdo_header_attribute_search_subtitle')); ?></p>
								</div>

								<?php
									$attribute_items = get_theme_mod('partdo_header_attribute_search_attribute_name');
									
									if($attribute_items){
										
										wp_enqueue_script('partdo-attribute-filter');
										
										$str = str_replace(' ','',$attribute_items);
										$attribute_array = explode(',',$str);
								 
										echo '<form class="service-search-form" id="klb-attribute-filter" action="' . wc_get_page_permalink( 'shop' ) . '" method="get">';
										
										foreach($attribute_array as $item_name){

											$terms = get_terms( 'pa_'.$item_name, array(
												'orderby' => 'menu_order',
												'hide_empty' => true,
												'parent' => 0,
											));

											$label_name = wc_attribute_label( 'pa_'.$item_name );

											echo '<div class="form-column">';
											echo '<select class="theme-select" name="filter_'.esc_attr($item_name).'" id="filter_'.esc_attr($item_name).'" tax="pa_'.$item_name.'" data-placeholder="'.esc_attr__('Select', 'partdo').' '.esc_attr($label_name).'" data-search="true" data-searchplaceholder="'.esc_attr__('Search item...', 'partdo').'">';
											
											echo '<option value="">'.sprintf(esc_html__('Select %s', 'partdo'), $label_name).'</option>';
											foreach ($terms as $term) {
												echo '<option id="'.esc_attr($term->term_id).'" value="'.esc_attr($term->slug).'">'.esc_html($term->name).'</option>';
											}
											echo '</select>';
											echo '</div>';
											
											$childcount = 1;
											foreach ($terms as $term) {
												$term_children = get_term_children( $term->term_id, 'pa_'.$item_name );
												
												if($term_children && $childcount == 1){
													echo '<div class="form-column">';
													echo '<select class="child-attr theme-select" id="child_filter_'.esc_attr($item_name).'" name="filter_'.esc_attr($item_name).'" data-placeholder="'.esc_attr__('Select Model', 'partdo').'" data-search="true" data-searchplaceholder="'.esc_attr__('Search item...', 'partdo').'" disabled>';
													echo '<option value="0">'.sprintf(esc_html__('Select %s First','partdo'), $item_name).'</option>';
													echo '</select>';
													echo '</div>';
												}
												$childcount++;
											}
											
											echo '<input type="text" id="klb_filter_'.esc_attr($item_name).'" name="filter_'.esc_attr($item_name).'" value="" hidden/>';
										}
										echo '<div class="form-column">';
										echo '<button class="btn primary">'.esc_html__('Find Auto Parts','partdo').'</button>';
										echo '</div>';
										
										echo '</form>';
									}
								?>
								<div class="service-description"> 
									<p><?php echo esc_html(get_theme_mod('partdo_header_attribute_search_second_subtitle')); ?></p>
								</div>
							</div>
						</div>
					</div>
					<div class="klbth-modal-overlay"></div>
				</div>
			</div>
		</div>

		<?php  }
	}
}