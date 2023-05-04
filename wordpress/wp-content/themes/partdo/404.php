<?php
/**
 * 404.php
 * @package WordPress
 * @subpackage Partdo
 * @since Partdo 1.0
 */
?>

<?php get_header(); ?>

			
<div class="page-not-found"> 
	<div class="error-image"> 
		<img src="<?php echo get_template_directory_uri(); ?>/assets/img/error-image.png" alt="<?php bloginfo("name"); ?>">
	</div>
	<h2 class="entry-subtitle"><?php esc_html_e('That Page Cant Be Found','partdo'); ?></h2>
	<div class="entry-description"> 
		<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try to search for what you are looking for?','partdo'); ?></p>
	</div>
	<a class="btn primary" href="<?php echo esc_url( home_url('/') ); ?>"><?php esc_html_e('Go To Homepage','partdo'); ?></a>
</div>


<?php get_footer(); ?>