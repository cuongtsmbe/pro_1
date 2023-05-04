<?php
if ( ! function_exists( 'partdo_sidebar_menu' ) ) {
	function partdo_sidebar_menu(){
	?>
		<?php $sidebarmenu = get_theme_mod('partdo_header_sidebar','0'); ?>
		<?php if($sidebarmenu == '1'){ ?>
		
		<div class="dropdown-cats dropdown"> 
			<a class="dropdown-toggle" href="#">
				<span class="text"><?php esc_html_e('All Categories','partdo'); ?></span>
				<span class="icon"> <i class="klbth-icon-caret-down"></i></span>
			</a>
			
			<?php if(partdo_page_settings('enable_sidebar_collapse') == 'yes'){ ?>
				<?php $menu_collapse = 'collapse show'; ?>
			<?php } else { ?>
				<?php $menu_collapse = is_front_page() && !get_theme_mod('partdo_header_sidebar_collapse') ? 'collapse show' : 'collapse'; ?>
			<?php } ?>

		    <div class="dropdown-menu <?php echo esc_attr($menu_collapse); ?>">
				<nav class="klbth-menu-wrapper vertical">
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
				</nav>
			</div>
        </div>
				
		<?php  }
	}
}