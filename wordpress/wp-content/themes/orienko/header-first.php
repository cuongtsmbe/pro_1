<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package LionThemes
 * @subpackage Orienko_Themes
 * @since Orienko Themes 1.4
 */
 
$orienko_opt = get_option( 'orienko_opt' );
$logo = ( !empty($orienko_opt['logo_main']['url']) ) ? $orienko_opt['logo_main']['url'] : '';
if(get_post_meta( get_the_ID(), 'orienko_logo_page', true )){
	$logo = get_post_meta( get_the_ID(), 'orienko_logo_page', true );
}
?>

<div class="header-container layout1">
	<?php if(!empty($orienko_opt['enable_topbar'])){ ?>
	<div class="top-bar">
		<div class="container">
			<?php if (is_active_sidebar('top_header')) { ?> 
				<div class="widgets-top pull-left">
				<?php dynamic_sidebar('top_header'); ?> 
				</div>
			<?php } ?>
		
			<?php if(isset($orienko_opt['top_menu']) && $orienko_opt['top_menu']!=''){ ?>
				<div class="pull-right top-menu">
					<?php if( isset($orienko_opt['top_menu']) ) {
						$menu_object = wp_get_nav_menu_object( $orienko_opt['top_menu'] );
						if(is_object($menu_object)){
						$menu_args = array(
							'menu_class'      => 'nav_menu',
							'menu'         => $orienko_opt['top_menu'],
						); ?>
						<?php wp_nav_menu( $menu_args ); ?>
						<?php } ?>
					<?php } ?>
				</div>
			<?php } ?>
		

		</div>
	</div>
	<?php } ?>
	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-lg-4">
					<?php if( $logo ){ ?>
						<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a></div>
					<?php
					} else { ?>
						<h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					} ?>
				</div>
				<div class="col-md-9 col-lg-8">
					<?php if(class_exists('WC_Widget_Product_Search')) { ?>						
							<?php the_widget('WC_Widget_Product_Search', array('title' => '')); ?>
					<?php } ?>
					
					<?php if(class_exists('WC_Widget_Cart')) { ?>
						<?php the_widget('WC_Widget_Cart', array('title' => '')); ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="nav-menus">
		<div class="nav-menus-inner">
			<div class="container">
				<div class="labnav-menu clearfix">
					<div class="bothmenu-container">
						<?php if ( has_nav_menu( 'categories' ) ){ ?>
						<div class=" categories-menu showmore-menu pull-left">
							<div class="catmenu-opener">
								<i class="fa fa-bars"></i>
								<span><?php echo esc_html__('All Categories', 'orienko'); ?></span>
								<i class="fa fa-angle-down"></i>
							</div>
							<div class="menu-widget-container vc-menu-widget<?php echo (!empty($orienko_opt['categories_menu_items'])) ? ' showmore-menu':''; ?>">
								<?php 
									ob_start();
									wp_nav_menu( array( 'theme_location' => 'categories', 'container_class' => 'categories-menu-container', 'menu_class' => 'nav-menu' ) ); 
									$content = ob_get_contents();
									ob_end_clean();
									if(function_exists('orienko_make_id')){
										$get_id = orienko_make_id();
									}else{
										$get_id = substr(str_shuffle(md5(time())),0, 6);
									}
									$new_menu_id = 'id="mega_menu_widget_'. $get_id .'"';
									$new_menu_ul_id = 'id="mega_menu_ul_widget_'. $get_id .'"';
									$content = preg_replace('/id="mega_main_menu"/', $new_menu_id, $content, 1);
									$content = preg_replace('/id="mega_main_menu_ul"/', $new_menu_ul_id, $content, 1);
									echo '' . $content;
								?>
								<?php if(!empty($orienko_opt['categories_menu_items'])){ ?>
								<div data-items="<?php echo (!empty($orienko_opt['categories_menu_items'])) ? intval($orienko_opt['categories_menu_items']) : 8; ?>" class="showmore-items"><i class="fa fa-plus-square-o"></i><span><?php echo (!empty($orienko_opt['showmore_menu_text'])) ? esc_html($orienko_opt['showmore_menu_text']) : esc_html__('More Categories', 'orienko'); ?></span></div>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
						<?php if ( has_nav_menu( 'primary' ) ){ ?>
						<div class="nav-desktop  pull-left visible-lg visible-md">
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'primary-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
						</div>
						<?php } ?>
					</div>		
					<?php if ( has_nav_menu( 'mobilemenu' ) ){ ?>					
					<div class="nav-mobile visible-xs visible-sm">
						<div class="mobile-menu-overlay"></div>
						<div class="toggle-menu"><i class="fa fa-bars"></i></div>
						<div class="mobile-navigation">
							<?php wp_nav_menu( array( 'theme_location' => 'mobilemenu', 'container_class' => 'mobile-menu-container', 'menu_class' => 'nav-menu mobile-menu' ) ); ?>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>