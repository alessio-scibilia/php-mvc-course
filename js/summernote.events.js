jQuery(document).ready(function() {
    // Summernote always updates textareas
    jQuery(".summernote").each(function () {
        var $target = $(this); // hidden textarea
        var $source = $target.parent().find('.note-editable'); // div created by summernote
        ['drop', 'input', 'paste'].map(function(event) { // , 'keyup', 'keydown'
            $source.on(event, function () {
                $target.text($target.summernote('code'));
            });
        });
    });
});