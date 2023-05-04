<?php
if ( ! function_exists( 'partdo_top_notification1' ) ) {
	function partdo_top_notification1(){
		$topnotification1 = get_theme_mod('partdo_top_notification1_toggle','0'); 
		if($topnotification1 == '1'){ ?>
		
		<div class="header-row header-notify hide-below-1200">
			<div class="container">
				<div class="header-inner">
					<?php $partdotopnotification1 = get_theme_mod('partdo_top_notification1_content'); ?>
					<?php if(!empty($partdotopnotification1)){ ?>				
						<div class="column left align-center">
							<div class="header-notify-messages"> 
								<ul> 
									<?php foreach($partdotopnotification1 as $f){ ?>
										<li><?php echo esc_html($f['top_notification1_text']); ?></li>
									<?php } ?>	
								</ul>
							</div>
						</div>
					<?php } ?>	
					<div class="column right align-center"><span class="counter-text"><?php echo esc_html(get_theme_mod('partdo_top_notification_count_text')); ?></span>
						<div class="klbth-countdown-wrapper">
							<div class="kblth-countdown" data-date="<?php echo esc_attr(get_theme_mod('partdo_top_notification_count_date')); ?>" data-text="<?php esc_attr_e('Expired', 'partdo'); ?>">
								<div class="count-item days"></div><span class="separator">:</span>
								<div class="count-item hours"></div><span class="separator">:</span>
								<div class="count-item minutes"></div><span class="separator">:</span>
								<div class="count-item second"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
	
		<?php  }
	}
}