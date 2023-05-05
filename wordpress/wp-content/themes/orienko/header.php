<?php
/**
 * The Header template for our theme
 *
 * @package LionThemes
 * @subpackage Orienko_theme
 * @since Orienko Themes 1.4
 */
?>
<?php 

$orienko_opt = get_option( 'orienko_opt' );

?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<?php
	$orienko_layout = (isset($orienko_opt['page_layout']) && $orienko_opt['page_layout'] == 'box') ? 'box-layout':'';
	$orienko_header = (empty($orienko_opt['header_layout']) || $orienko_opt['header_layout'] == 'default') ? 'first': $orienko_opt['header_layout'];
	if(get_post_meta( get_the_ID(), 'orienko_header_page', true )){
		$orienko_header = get_post_meta( get_the_ID(), 'orienko_header_page', true );
	}
	if(get_post_meta( get_the_ID(), 'orienko_layout_page', true )){
		$orienko_layout = (get_post_meta( get_the_ID(), 'orienko_layout_page', true ) == 'box') ? 'box-layout' : '';
	}
?>
<body <?php body_class(); ?>>
<div class="main-wrapper <?php echo esc_attr($orienko_layout); ?>">
<?php do_action('before'); ?> 
	<header>
	<?php
		get_header($orienko_header);
	?>
	</header>
	<div id="content" class="site-content">