<?php

if ( ! function_exists( 'partdo_toggle_menu_button' ) ) {
	function partdo_toggle_menu_button(){
		$togglemenubutton = get_theme_mod('partdo_toggle_menu_button','0');
		if($togglemenubutton == 1){
		?>
		
		<div class="quick-button toggle-button">
			<div class="quick-button-inner">
				<div class="quick-icon"><i class="klbth-icon-menu"></i></div>
			</div>
		</div>

	<?php  }
	}
}
