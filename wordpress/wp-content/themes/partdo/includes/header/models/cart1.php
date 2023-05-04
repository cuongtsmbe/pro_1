<?php
if ( ! function_exists( 'partdo_cart_icon1' ) ) {
	function partdo_cart_icon1(){
		$headercart = get_theme_mod('partdo_header_cart','0');
		if($headercart == '1'){
			global $woocommerce;
			$carturl = wc_get_cart_url(); 
			?>
			
			<div class="quick-button cart-button">
				<a class="quick-button-inner" href="<?php echo esc_url($carturl); ?>"> 
				  <div class="quick-icon"><i class="klbth-icon-shopping-bag-large"></i><span class="cart-count count"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'partdo'), $woocommerce->cart->cart_contents_count);?></span></div>
				  <div class="quick-text"><span class="cart-count-text count-text"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'partdo'), $woocommerce->cart->cart_contents_count);?></span>
					<p class="cart-price price"><?php echo WC()->cart->get_cart_subtotal(); ?></p>
				  </div>
				</a>
				<div class="cart-dropdown hide">
				  <div class="cart-dropdown-wrapper">
					<div class="fl-mini-cart-content">
						<?php woocommerce_mini_cart(); ?>
					</div>
				  </div>
				</div>
			</div>
		<?php }
	}
}