<?php

if ( ! function_exists( 'partdo_account_icon1' ) ) {
	function partdo_account_icon1(){
		$headersearch = get_theme_mod('partdo_header_account','0');
		if($headersearch == 1){
		?>
		
		<div class="quick-button login-button">
			<div class="quick-button-inner">
			  <div class="quick-text">
				<?php if(is_user_logged_in()){ ?>
					<?php $current_user = wp_get_current_user(); ?>
					<p class="primary-text"><?php esc_html_e('My Account','partdo'); ?></p><span class="sub-text"><?php esc_html_e('Hello','partdo'); ?> <?php echo esc_html($current_user->user_login); ?></span>
				<?php } else { ?>
					<p class="primary-text"><?php esc_html_e('My Account','partdo'); ?></p><span class="sub-text"><?php esc_html_e('Hello, Sign in','partdo'); ?></span>
				<?php } ?>
			 </div>
			  <div class="arrow">
				<i class="klbth-icon-chevron-down"></i>
			  </div>
			</div>

			<?php if(is_user_logged_in()){ ?>
				<div class="login-dropdown user-logged-in"> 
				  <div class="login-dropdown-wrapper">
					<ul class="myaccount-navigation">
						<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
							<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
								<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul>
				  </div>
				</div>
			<?php } else { ?>
				<div class="login-dropdown"> 
			  	<div class="login-dropdown-wrapper">
					<div class="login-text"> 
					  <p><?php esc_html_e('Sign up now and enjoy discounted shopping!','partdo'); ?></p>
					</div>
					<a class="btn secondary wide" href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>"><?php esc_html_e('Log In','partdo'); ?></a>
					<div class="new-customer"> <?php esc_html_e('New Customer?','partdo'); ?> 
						<?php if(get_theme_mod('partdo_my_account_layout') == 'logintab'){ ?>
							<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>#register"><?php esc_html_e('Sign Up','partdo'); ?> </a>
						<?php } else { ?>
							<a href="<?php echo wc_get_page_permalink( 'myaccount' ); ?>"><?php esc_html_e('Sign Up','partdo'); ?> </a>
						<?php } ?>
					</div>

				  </div>
				</div>
				<?php } ?>
		 </div>
	<?php  }
	}
}
