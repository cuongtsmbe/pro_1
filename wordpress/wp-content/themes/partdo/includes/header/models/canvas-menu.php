<?php
if ( ! function_exists( 'partdo_canvas_menu' ) ) {
	function partdo_canvas_menu(){
	?>

	<div class="site-drawer">
		<div class="site-scroll"> 
			<div class="site-drawer-row site-drawer-header">
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
				<div class="site-close"> <a href="#" aria-hidden="false"> <i class="klbth-icon-xmark"></i></a></div>
			</div>
			<div class="site-drawer-row site-drawer-body"><span class="drawer-heading"><?php esc_html_e('Main Menu','partdo'); ?></span>
				  <nav class="klbth-menu-wrapper vertical drawer-primary">
					  <?php 
						wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'container' => '',
						'fallback_cb' => 'show_top_menu',
						'menu_id' => '',
						'menu_class' => 'klbth-menu',
						'echo' => true,
						"walker" => '',
						'depth' => 0 
						));
						?>
				  </nav>
				<span class="drawer-heading"><?php esc_html_e('Category Menu','partdo'); ?></span>
				<nav class="klbth-menu-wrapper vertical">
					<?php $sidebarmenu = get_theme_mod('partdo_header_sidebar','0'); ?>
						<?php if($sidebarmenu == '1'){ ?>
						<span class="offcanvas-heading"></span>
						<nav class="site-nav vertical categories">
							<?php
							wp_nav_menu(array(
							'theme_location' => 'sidebar-menu',
							'container' => '',
							'fallback_cb' => 'show_top_menu',
							'menu_id' => 'category-menu',
							'menu_class' => 'klbth-menu ',
							'echo' => true,
							"walker" => new partdo_sidebar_walker(),
							'depth' => 0 
							));
							?>
						</nav><!-- site-nav -->
					<?php } ?>
				</nav>
				
				<?php $menucontactbox = get_theme_mod('partdo_menu_contact_box'); ?>
				<?php if($menucontactbox){ ?>
					<span class="drawer-heading"><?php echo esc_html(get_theme_mod( 'partdo_menu_contact_title' )); ?></span>
					<nav class="drawer-contacts"> 
						<ul> 
						<?php foreach($menucontactbox as $contactbox){ ?>
							<li class="contact-item"> <span class="contact-icon"> <i class="<?php echo esc_attr($contactbox['menu_contact_box_icon']); ?>"></i></span>
								<p class="contact-detail"><?php echo partdo_sanitize_data($contactbox['menu_contact_box_title']); ?></p>
								<div class="contact-description"><?php echo esc_html($contactbox['menu_contact_box_subtitle']); ?></div>
							</li>
						<?php } ?>	
						</ul>
					</nav>
				<?php } ?>
				
			</div>
			<div class="site-drawer-row site-drawer-footer">
				<div class="site-copyright">
					<?php if(get_theme_mod( 'partdo_copyright' )){ ?>
						<p><?php echo partdo_sanitize_data(get_theme_mod( 'partdo_copyright' )); ?></p>
					<?php } else { ?>
						<p><?php esc_html_e('Copyright 2022.KlbTheme . All rights reserved','partdo'); ?></p>
					<?php } ?>
				</div>
			</div>
		</div>
    </div>

	<?php

	}
}

add_action('wp_footer', 'partdo_canvas_menu');