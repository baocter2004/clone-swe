/**
 * Nút chọn ảnh trong WP Admin (Media Library).
 */
(function ($) {
	'use strict';

	var frame;

	$(document).on('click', '.swe-upload-btn', function (e) {
		e.preventDefault();
		var targetId = $(this).data('target');
		var previewId = $(this).data('preview');
		var $input = $('#' + targetId);
		var $preview = $('#' + previewId);

		if (frame) {
			frame.open();
			frame.off('select');
		} else {
			frame = wp.media({
				title: 'Chọn ảnh',
				button: { text: 'Dùng ảnh này' },
				multiple: false,
			});
		}

		frame.on('select', function () {
			var attachment = frame.state().get('selection').first().toJSON();
			$input.val(attachment.id);
			$preview.html(
				'<img src="' + (attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url) + '" style="max-width:200px;height:auto;">'
			);
		});

		frame.open();
	});

	$(document).on('click', '.swe-remove-btn', function (e) {
		e.preventDefault();
		$('#' + $(this).data('target')).val('');
		$('#' + $(this).data('preview')).empty();
	});
})(jQuery);
