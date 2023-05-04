<?php
if ( ! function_exists( 'partdo_top_notification2' ) ) {
	function partdo_top_notification2(){
		$topnotification2 = get_theme_mod('partdo_top_notification2_toggle','0'); 
		if($topnotification2 == '1'){ ?>
			
			<div class="header-notice"> 
				<p><?php echo partdo_sanitize_data(get_theme_mod('partdo_top_notification2_content')); ?></p>
			</div>

		<?php  }
	}
}