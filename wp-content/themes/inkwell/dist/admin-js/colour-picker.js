jQuery(document).ready(function($) {
    // Initialize color pickers
    $('.pixelpress-colour-picker').wpColorPicker({
        change: function(event, ui) {
            var $input = $(this),
                colour = ui.color.toString(),
                $preview = $input.siblings('.pixelpress-colour-preview'),
                $hex = $input.siblings('.pixelpress-colour-hex');

            $preview.css('background-color', colour);
            $hex.text(colour);
        },
        clear: function() {
            var $input = $(this),
                $preview = $input.siblings('.pixelpress-colour-preview'),
                $hex = $input.siblings('.pixelpress-colour-hex');

            $preview.css('background-color', '');
            $hex.text('');
        }
    });
});