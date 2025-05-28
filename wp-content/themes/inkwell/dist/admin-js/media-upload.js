jQuery(document).ready(function($) {
    $('.pixelpress-media-upload-button').on('click', function(e) {
        e.preventDefault();
        var $button = $(this),
            $input = $($button.data('target')),
            $preview = $button.closest('.pixelpress-logo-preview');

        var uploader = wp.media({
            title: 'Select or Upload Logo',
            button: { text: 'Use this Logo' },
            multiple: false,
            library: { type: 'image' }
        });

        uploader.on('select', function() {
            var url = uploader.state().get('selection').first().toJSON().url;
            $input.val(url);
            $preview.html('<img src="' + url + '" alt="Logo Preview" style="max-width: 200px; display: block; margin-bottom: 10px;" />');
            $button.val('Change Logo');
            if (!$button.siblings('.pixelpress-media-remove-button').length) {
                $button.after('<input type="button" class="button pixelpress-media-remove-button" value="Remove Logo" style="margin-left: 10px;" />');
            }
        });

        uploader.open();
    });

    $(document).on('click', '.pixelpress-media-remove-button', function(e) {
        e.preventDefault();
        var $button = $(this),
            $input = $button.siblings('input[type="hidden"]'),
            $uploadButton = $button.siblings('.pixelpress-media-upload-button'),
            $preview = $button.closest('.pixelpress-logo-preview');

        $input.val('');
        $preview.html('<p>No logo uploaded yet.</p>');
        $uploadButton.val('Upload Logo');
        $button.remove();
    });
});