$('input.custom-file-input').on("change", function () {
    var $container = $(this).parent().parent().next();
    var $previews = $container.find(".img-form-preview");
    var n_pictures = ($previews.length) - 1;
    var self = this;

    // Read selected files
    var form_data = new FormData();
    for (var i = 0; i < this.files.length; i++) {
        form_data.append("immagini_form[]", this.files[i]);
    }

    $(".notification-message").html("Caricamento immagini in corso....");
    $(".notification-message").addClass("nm-info");
    $(".notification-message").fadeIn();

    // AJAX request
    $.ajax({
        url: "/backoffice/upload/images?XDEBUG_SESSION_START", // <?php include 'Views/xdebug.querystring.first.php'; ?>
        type: 'post',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
            if ($(self).prop('multiple')) {
                for (var index = 0; index < response.length; index++) {
                    var src = response[index];
                    n_pictures++;
                    var n_pictures_next = n_pictures + 1;
                    var name = $(self).data('name') + `[${n_pictures_next}]`;
                    var html = '<div class="img-form-preview"><span class="delete-preview" onclick="delPreview(this)"><i class="fa fa-close"></i></span><img data-name="' + name + '" class="img-form-preview-item" src="'+src+'" height="200px"><div class="default-image-cont"><div class="pt20"><input type="radio" class="default-image" name="default_image" value="'+n_pictures_next+'"><label class="f15">&nbsp;Immagine principale</label><br></div></div>';
                    $container.find('.preview').append(html);
                }
            } else {
                var src = response[0];
                var name = $(self).data('name') + '[1]';
                var html = '<div class="img-form-preview"><span class="delete-preview" onclick="delPreview(this)"><i class="fa fa-close"></i></span><img data-name="' + name + '" class="img-form-preview-item" src="'+src+'" height="200px"></div>';
                $preview = $container.find('.preview');
                $preview.empty();
                $preview.append(html);
                $(self).prop('disabled', true);
            }
            $(".notification-message").fadeOut();
        }
    });
});
