<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package LionThemes
 * @subpackage Orienko_Themes
 * @since Orienko Themes 1.4
 */
?>
<?php 
$orienko_opt = get_option( 'orienko_opt' );
$ft_col_class = '';
?>
	<div class="footer layout2">
	
		<div class="footer-middle">
			<div class="container">
				<div class="row">
					<?php if(is_active_sidebar('footer_newsletter')){ ?>
						<?php dynamic_sidebar('footer_newsletter'); ?>
					<?php } ?>
					<div class="col-md-6">
						<?php if(isset($orienko_opt['social_icons']) && $orienko_opt['social_icons']!=''){ ?>
							<div class="widget widget-social">
								<h3 class="widget-title"><?php echo esc_html($orienko_opt['follow_title']);?></h3>
								<?php
								if(isset($orienko_opt['social_icons'])) {
									echo '<ul class="social-icons">';
									foreach($orienko_opt['social_icons'] as $key=>$value ) {
										if($value!=''){
											if($key=='vimeo'){
												echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>';
											} else {
												echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-'.esc_attr($key).'"></i></a></li>';
											}
										}
									}
									echo '</ul>';
								}
								?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	
		<?php if(is_active_sidebar('footer_4columns')) { ?>
		<div class="footer-menu">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar('footer_4columns'); ?>
				</div>
			</div>
		</div>
		<?php } ?>
		
		<?php if(is_active_sidebar('footer_payment')){ ?>
			<div class="footer-top">
				<div class="container">
					<div class="footer-top-inner text-center">
						<div class="widget-payment">
							<?php dynamic_sidebar('footer_payment'); ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		
		<?php if(is_active_sidebar('footer_copyright')) { ?>
		<div class="footer-bottom">
			<div class="container">
				<div class="widget-copyright text-center">
					<?php dynamic_sidebar('footer_copyright'); ?>
				</div>
			</div>
		</div>
		<?php } ?>
		
	</div>