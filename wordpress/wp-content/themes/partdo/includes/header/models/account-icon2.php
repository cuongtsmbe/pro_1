<?php

if ( ! function_exists( 'partdo_account_icon2' ) ) {
	function partdo_account_icon2(){
		$headersearch = get_theme_mod('partdo_header_account','0');
		if($headersearch == 1){
		?>
		
		<div class="quick-button login-button">
			<div class="quick-button-inner">
				<div class="quick-icon">
					<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>" class="login-button">
						<i class="klbth-icon-profile-round"></i>
					</a>
				</div>
			</div>
		</div>
		
	<?php  }
	}
}
