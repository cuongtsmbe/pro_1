<?php
/**
 * The sidebar containing the main widget area
 *
 * @package LionThemes
 * @subpackage Orienko_theme
 * @since Orienko Themes 1.4
 */
?>

<?php if ( is_active_sidebar( 'page' ) ) : ?>
	<div class="col-md-3" id="sidebar-page">
		<?php do_action('before_sidebar'); ?> 
		<?php dynamic_sidebar( 'page' ); ?>
	</div><!-- #sidebar -->
<?php endif; ?>