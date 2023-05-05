<?php
/**
 * The template for displaying the footer
 *
 * @package LionThemes
 * @subpackage Orienko_theme
 * @since Orienko Themes 1.4
 */
?>
<?php $orienko_opt = get_option( 'orienko_opt' ); ?>
		
		</div><!--.site-content-->
		<footer id="site-footer">
			<?php
			$orienko_footer = (empty($orienko_opt['footer_layout']) || $orienko_opt['footer_layout'] == 'default') ? 'first': $orienko_opt['footer_layout'];
			if(get_post_meta( get_the_ID(), 'orienko_footer_page', true )){
				$orienko_footer = get_post_meta( get_the_ID(), 'orienko_footer_page', true );
			}
			get_footer($orienko_footer);
			?>
		</footer>
		<?php if ( isset($orienko_opt['back_to_top']) && $orienko_opt['back_to_top'] ) { ?>
		<div id="back-top" class="hidden-xs"><i class="fa fa-angle-double-up"></i></div>
		<?php } ?>
	</div><!--.main wrapper-->
	<?php wp_footer(); ?>
</body>
</html>