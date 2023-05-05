/* Theme Verify JS */

(function($) {
	"use strict";
	// Create by Nguyen Duc Viet
	$(document).on('click', '#orienko-submit-code', function(){
		var $this = $(this);
		var $code = $('#purchased_code').val();
		if (!$code) {
			$('#purchased_code').addClass('empty');
			return false;
		}
		$('.orienko-verify img.loading').show();
		$(this).attr('disabled', 'disabled');
		$.ajax({
			url: 'https://lion-themes.net/api/',
			type: 'POST',
			dataType: 'json',
			data: 'theme=orienko&code=' + $code,
			success: function(result) {
				if (result.success && result.success == 1) {
					$.ajax({
						type: 'POST',
						url: ajaxurl,
						data: 'action=orienko_save_purchased_code&item_id=' + result.item_id + '&code=' + $code, 
						success: function(data){
							$('#purchased_code').prev('.correct').show();
						}
					});
				}else{
					$('#purchased_code').next('.incorrect').show();
				}
				$('.orienko-verify img.loading').hide();
				$this.removeAttr('disabled');
			}
		});
	});
	$(document).on('change', '#purchased_code', function(){
		$(this).removeClass('empty').next('.incorrect').hide();
	});
})(jQuery);