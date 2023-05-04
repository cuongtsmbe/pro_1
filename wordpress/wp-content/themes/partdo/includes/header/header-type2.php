<header class="site-header header-type-2 shadow-enable" id="masthead">
	
	<?php partdo_top_notification1(); ?>
	
	<?php if(get_theme_mod('partdo_top_left_menu','0') == 1 || get_theme_mod('partdo_top_right_menu','0') == 1){ ?>
		<div class="header-row header-topbar border-bottom-full hide-below-1200">
			<div class="container"> 
				<div class="header-inner">
				
					<div class="column left align-center">
						<?php if(get_theme_mod('partdo_top_left_menu','0') == 1){ ?>
							<nav class="klbth-menu-wrapper horizontal topbar shadow-enable">
								<?php 
								wp_nav_menu(array(
								'theme_location' => 'top-left-menu',
								'container' => '',
								'fallback_cb' => 'show_top_menu',
								'menu_id' => 'topbar-left',
								'menu_class' => 'klbth-menu',
								'echo' => true,
								"walker" => '',
								'depth' => 0 
								));
								?>
							</nav>
						<?php } ?>
					</div>
					
					<div class="column right align-center">
						<?php if(get_theme_mod('partdo_top_right_menu','0') == 1){ ?>
							<?php partdo_top_notification2(); ?>
							<div class="header-switcher"> 
								<nav class="klbth-menu-wrapper horizontal topbar shadow-enable">
									<?php 
									wp_nav_menu(array(
									'theme_location' => 'top-right-menu',
									'container' => '',
									'fallback_cb' => 'show_top_menu',
									'menu_id' => 'topbar-right',
									'menu_class' => 'klbth-menu',
									'echo' => true,
									"walker" => '',
									'depth' => 0 
									));
									?>
								</nav>
							</div>
						<?php } ?>
					</div>
					
				</div>
			</div>
		</div>
	<?php } ?>
	
	<div class="header-row header-main height hide-below-1200">
		<div class="container">
			<div class="header-inner"> 
				<div class="column left align-center">
					<?php partdo_toggle_menu_button(); ?>
					<div class="site-brand">
						<a href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
							<?php if (get_theme_mod( 'partdo_logo' )) { ?>
								<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'partdo_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>">
							<?php } elseif (get_theme_mod( 'partdo_logo_text' )) { ?>
								<span class="brand-text"><?php echo esc_html(get_theme_mod( 'partdo_logo_text' )); ?></span>
							<?php } else { ?>
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-dark.png" alt="<?php bloginfo("name"); ?>">
							<?php } ?>
						</a>
					</div><!-- site-brand -->
					<nav class="klbth-menu-wrapper horizontal primary shadow-enable">
						<?php 
						wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'container' => '',
						'fallback_cb' => 'show_top_menu',
						'menu_id' => 'primary-menu',
						'menu_class' => 'klbth-menu',
						'echo' => true,
						"walker" => '',
						'depth' => 0 
						));
						?>
					</nav>
				</div>
				<div class="column right align-center">
				
					<?php partdo_account_icon2(); ?>
				  
					<?php partdo_search_icon_holder(); ?>
					
					<?php partdo_wishlist_icon(); ?>

					<?php partdo_cart_icon2(); ?> 
					
				</div>
			</div>
		</div>
	</div>

	<div class="header-row header-mobile hide-above-1200">
		<div class="container">
			<div class="header-inner"> 
				<div class="column left align-center">
					<div class="quick-button toggle-button">
					  <div class="quick-button-inner">
						<div class="quick-icon"><i class="klbth-icon-menu"></i></div>
					  </div>
					</div>
				</div>
				<div class="column center align-center">
					<div class="site-brand">
						<a href="<?php echo esc_url( home_url( "/" ) ); ?>" title="<?php bloginfo("name"); ?>">
							<?php if (get_theme_mod( 'partdo_mobile_logo' )) { ?>
						<img src="<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'partdo_mobile_logo' )) ); ?>" alt="<?php bloginfo("name"); ?>">
							<?php } elseif (get_theme_mod( 'partdo_logo_text' )) { ?>
						<span><?php echo esc_html(get_theme_mod( 'partdo_logo_text' )); ?></span>
							<?php } else { ?>
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-dark.png" alt="<?php bloginfo("name"); ?>">   
							<?php } ?>
						</a>
					</div><!-- site-brand -->
				</div>
				<div class="column right align-center">
					<?php partdo_cart_icon2(); ?>
				</div>
			</div>
		</div>
	</div>
</header>