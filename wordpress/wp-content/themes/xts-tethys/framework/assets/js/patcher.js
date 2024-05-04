/* global xtsAdminConfig */

(function($) {
	'use strict';

	$(document).on('click', '.xts-patch-apply', function (e) {
		e.preventDefault();

		var $this = $(this);
		var patchesMap = $this.data('patches-map');
		var themeSlug = 'xts-' + xtsAdminConfig.theme_slug.toLowerCase();
		var fileMap = [];

		for (var i = 0; i < patchesMap.length; i++) {
			fileMap[i] = themeSlug + '/' + patchesMap[i];
		}

		var confirmation = confirm( xtsAdminConfig.patcher_confirmation + '\r\r\n' + fileMap.join('\r\n') );

		if ( ! confirmation ) {
			return;
		}

		$('.xts-patcher-content').addClass('xts-loading');

		cleanNotice();

		$.ajax({
			url    : xtsAdminConfig.ajaxUrl,
			data   : {
				action   : 'xts_patch_action',
				security : xtsAdminConfig.patcher_nonce,
				id       : $this.data('id'),
			},
			timeout: 1000000,
			error  : function() {
				printNotice('error', 'Something wrong with removing data. Please, try to remove data manually or contact our support center for further assistance.');
			},
			success: function(response) {
				if ( 'undefined' !== typeof response.message ) {
					printNotice(response.status, response.message);
				}

				if ( 'undefined' !== typeof response.status && 'success' === response.status ) {
					$this.parents('.xts-patch-item').addClass('xts-applied');
					updatePatcherCounter();
				}

				$('.xts-patcher-content').removeClass('xts-loading');
			}
		});
	});

	// Helpers.
	function printNotice(type, message) {
		$('.xts-notices-wrapper').append(`
			<div class="xts-notice xts-${type}">
				${message}
			</div>
		`);

		$('.xts-notice:not(.xts-info)').on('click', function() {
			$(this).addClass('xts-hidden');
		});

		setTimeout(function(){
			$('.xts-notice.xts-success').addClass('xts-hidden');
		}, 10000);
	}

	function cleanNotice() {
		$('.xts-notices-wrapper').text('');
	}

	function updatePatcherCounter() {
		var $counter = $('.xts-patcher-counter');

		if ($counter.length) {
			var $count = parseInt($counter.find('.patcher-count').text());

			if ( 1 === $count ) {
				$counter.hide();
			} else {
				$counter.find('.patcher-count').text(--$count);
			}
		}
	}

})(jQuery);