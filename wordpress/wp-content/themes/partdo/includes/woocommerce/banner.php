<?php $categorybanner = get_theme_mod('partdo_shop_banner_each_category'); ?>
<?php if($categorybanner && is_product_category() && array_search(get_queried_object()->term_id, array_column($categorybanner, 'category_id')) !== false){ ?>
	<?php foreach($categorybanner as $c){ ?>
		<?php if($c['category_id'] == get_queried_object()->term_id){ ?>
			<div class="klbth-banner shop-banner style-inner color-scheme-light space-md align-center justify-start hover-zoom">
				<div class="entry-wrapper overlay-25-dark-max768 dump">
					<div class="entry-inner w-50">
						<div class="entry-heading banner-heading"><span class="badge"><?php echo esc_html($c['category_subtitle']); ?></span>
							<h2 class="entry-title font-banner-xlg"><?php echo esc_html($c['category_title']); ?></h2>
						</div>
						<div class="entry-excerpt font-sm weight-300">
							<p><?php echo partdo_sanitize_data($c['category_desc']); ?></p>
						</div>
						<div class="entry-footer vertical banner-footer">
							<div class="banner-button">
								<button href="<?php echo esc_url($c['category_button_url']); ?>" class="btn link"><?php echo esc_html($c['category_button_text']); ?><i class="klbth-icon-arrow-right-long"></i></button>
							</div>
						</div>
					</div>
				</div>
				<div class="entry-media overlay-15-dark-min768">
					<img src="<?php echo esc_url(partdo_get_image($c['category_image'])); ?>" alt="<?php echo esc_attr($c['category_title']); ?>"/>
				</div>
				<a class="link-mask" href="<?php echo esc_url($c['category_button_url']); ?>"> </a>
			</div>
		<?php } ?>
	<?php } ?>
<?php } else { ?>
	<?php $banner = get_theme_mod('partdo_shop_banner_image'); ?>
	<?php $bannertitle = get_theme_mod('partdo_shop_banner_title'); ?>
	<?php $bannersubtitle = get_theme_mod('partdo_shop_banner_subtitle'); ?>
	<?php $bannerdesc = get_theme_mod('partdo_shop_banner_desc'); ?>
	<?php $bannerbuttontext = get_theme_mod('partdo_shop_banner_button_text'); ?>
	<?php $bannerbuttonurl = get_theme_mod('partdo_shop_banner_button_url'); ?>
	<?php if($banner){ ?>
	
	<div class="klbth-banner shop-banner style-inner color-scheme-light space-md align-center justify-start hover-zoom">
		<div class="entry-wrapper overlay-25-dark-max768 dump">
			<div class="entry-inner w-50">
				<div class="entry-heading banner-heading">
					<?php if($bannersubtitle){ ?>
						<span class="badge"><?php echo esc_html($bannersubtitle); ?></span>
					<?php } ?>
					<h2 class="entry-title font-banner-xlg"><?php echo esc_html($bannertitle); ?></h2>
				</div>
				<div class="entry-excerpt font-sm weight-300">
					<p><?php echo partdo_sanitize_data($bannerdesc); ?></p>
				</div>
				<?php if($bannerbuttontext){ ?>
					<div class="entry-footer vertical banner-footer">
						<div class="banner-button">
							<button href="<?php echo esc_url($bannerbuttonurl); ?>" class="btn link"><?php echo esc_html($bannerbuttontext); ?><i class="klbth-icon-arrow-right-long"></i></button>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="entry-media overlay-15-dark-min768">
			<img src="<?php echo esc_url(wp_get_attachment_url($banner)); ?>" alt="<?php echo esc_attr($bannertitle); ?>"/>
		</div>
		<a class="link-mask" href="<?php echo esc_url($bannerbuttonurl); ?>"> </a>
	</div>

	<?php } ?>
<?php } ?>