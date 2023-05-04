<div class="site-footer">

	<?php $subscribe = get_theme_mod('partdo_footer_subscribe_area',0); ?>
	<?php if($subscribe == 1){ ?>
		<div class="footer-row footer-newsletter border-boxed dark"> 
			<div class="container"> 
				<div class="footer-inner">
					<div class="klbth-newsletter"> 
						<div class="column"> 
							<div class="klbth-newsletter-text">
								<div class="text-icon"><i class="<?php echo partdo_sanitize_data(get_theme_mod('partdo_footer_subscribe_icon')); ?>"></i></div>
								<div class="text-body"> 
								  <h5 class="entry-subtitle"><?php echo partdo_sanitize_data(get_theme_mod('partdo_footer_subscribe_subtitle')); ?></h5>
								  <h3 class="entry-title"><?php echo partdo_sanitize_data(get_theme_mod('partdo_footer_subscribe_title')); ?></h3>
								  <div class="entry-description"> 
									<p><?php echo partdo_sanitize_data(get_theme_mod('partdo_footer_subscribe_desc')); ?></p>
								  </div>
								</div>
							</div>
						</div>
						<div class="column"> 
							<div class="klbth-newsletter-form">
								<?php echo do_shortcode('[mc4wp_form id="'.get_theme_mod('partdo_footer_subscribe_formid').'"]'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	
	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) || is_active_sidebar( 'footer-4' )) { ?>
		<div class="footer-row footer-widgets custom-background-dark light"> 
			<div class="container"> 
				<div class="footer-inner">
					<div class="footer-sidebar"> 
						<?php if(get_theme_mod('partdo_footer_column') == '3columns'){ ?>
							<div class="col col-12 col-lg-4">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div><!-- col -->
							<div class="col col-12 col-lg-4">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div><!-- col -->
							<div class="col col-12 col-lg-4">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</div><!-- col -->
						<?php } elseif(get_theme_mod('partdo_footer_column') == '4columns'){ ?>
							<div class="custom-column"> 
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div><!-- col -->
							<div class="widgets-column">
								<div class="row justify-content-between">
									<div class="col col-12 col-lg-5">
										<?php dynamic_sidebar( 'footer-2' ); ?>
									</div><!-- col -->
									 <div class="col col-12 col-lg-3">
										<?php dynamic_sidebar( 'footer-3' ); ?>
									</div><!-- col -->
									 <div class="col col-12 col-lg-3">
										<?php dynamic_sidebar( 'footer-4' ); ?>
									</div><!-- col -->
								</div>
							</div>
						<?php } else { ?>
							<div class="col col-12 col-lg-4">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div><!-- col -->
							<div class="col col-12 col-lg-2">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div><!-- col -->
							<div class="col col-12 col-lg-2">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</div><!-- col -->
							<div class="col col-12 col-lg-2">
								<?php dynamic_sidebar( 'footer-4' ); ?>
							</div><!-- col -->
							<div class="col col-12 col-lg-2">
								<?php dynamic_sidebar( 'footer-5' ); ?>
							</div><!-- col -->
						<?php } ?>
				
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	
	<?php $extra_box = get_theme_mod('partdo_footer_extra_box'); ?>
	<?php if($extra_box){ ?>
		<div class="footer-row subfooter border-boxed custom-background-dark light"> 
			<div class="container"> 
				<div class="footer-inner">
					<div class="sub-banners"> 
						<ul> 
							<?php foreach($extra_box as $extra){ ?>
								<li><?php echo esc_html($extra['extra_box_content']); ?></li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	
	<div class="footer-row footer-copyright border-boxed custom-background-dark light"> 
		<div class="container"> 
			<div class="footer-inner">
				<?php $footermenu = get_theme_mod('partdo_footer_menu',0); ?>
				<?php if($footermenu == 1){ ?>
					<div class="copyright-row">
						<nav class="footer-menu"> 
							<?php 
							wp_nav_menu(array(
							'theme_location' => 'footer-menu',
							'container' => '',
							'fallback_cb' => 'show_top_menu',
							'menu_id' => '',
							'menu_class' => 'menu',
							'echo' => true,
							"walker" => '',
							'depth' => 0 
							));
							?>

						</nav>
					</div>
				<?php } ?>
				
				<div class="copyright-row">
				
					<div class="column"> 
					  <div class="site-copyright"> 
						<?php if(get_theme_mod( 'partdo_copyright' )){ ?>
							<p><?php echo partdo_sanitize_data(get_theme_mod( 'partdo_copyright' )); ?></p>
						<?php } else { ?>
							<p><?php esc_html_e('Copyright 2022.KlbTheme . All rights reserved','partdo'); ?></p>
						<?php } ?>
					  </div>
					</div>
					
					<?php if(get_theme_mod('partdo_footer_payment_image')){ ?>
						<div class="column">
							<div class="card-icons">
								<a href="<?php echo esc_url(get_theme_mod('partdo_footer_payment_image_url')); ?>">
									<img class="credit-cards" src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod('partdo_footer_payment_image'))); ?>" alt="<?php esc_attr_e('payment','partdo'); ?>"/>
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
				
				<div class="copyright-row">
					<div class="mobile-app-content"> <span><?php echo esc_html(get_theme_mod('partdo_footer_app_title')); ?> </span>
						<?php $appimage = get_theme_mod('partdo_footer_app_image'); ?>
						<?php if($appimage){ ?>
							<div class="buttons"> 
								<?php foreach($appimage as $app){ ?>
								  <a class="apple-store" href="<?php echo esc_url($app['app_url']); ?>">
									<img src="<?php echo esc_url( partdo_get_image($app['app_image'])); ?>" alt="<?php esc_attr_e('app','partdo'); ?>"/>
								  </a>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>

			</div>
		</div>
	</div>	
</div>