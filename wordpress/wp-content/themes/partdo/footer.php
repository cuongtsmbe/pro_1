<?php
/**
 * footer.php
 * @package WordPress
 * @subpackage Partdo
 * @since Partdo 1.0
 * 
 */
 ?>
 
        </div><!-- site-content -->
      </div><!-- site-primary -->
      
	<?php partdo_do_action( 'partdo_before_main_footer'); ?>

	<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) { ?>
	
		<?php
        /**
        * Hook: partdo_main_footer
        *
        * @hooked partdo_main_footer_function - 10
        */
        do_action( 'partdo_main_footer' );
	
		?>
		
	<?php } ?>
	
	<?php partdo_do_action( 'partdo_after_main_footer'); ?>
	
	</div>	
	<div class="site-mask"></div>
	  
	<?php wp_footer(); ?>
	</body>
</html>