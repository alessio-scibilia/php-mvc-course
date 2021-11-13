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
            for (var index = 0; index < response.length; index++) {
                var src = response[index];
                n_pictures++;
                var n_pictures_next = n_pictures + 1;
                var id = 'custom-id';
                var html = $(self).prop('multiple') ?
                    '<div class="img-form-preview" id="ifp-prw-'+n_pictures+'"><span class="delete-preview" id="prw-'+n_pictures+'" onclick="delPreview()"><i class="fa fa-close"></i></span><img class="img-form-preview-item img-hotel" src="'+src+'" height="200px"><div class="default-image-cont"><div class="pt20"><input type="radio" class="default-image" name="default_image" value="'+n_pictures_next+'"><label class="f15">&nbsp;Immagine principale</label><br></div></div>' :
                    '<div class="img-form-preview"><span class="delete-preview" id="prws-'+id+'" onclick="delPreview()"><i class="fa fa-close"></i></span><img class="img-form-preview-item" src="'+src+'" height="200px"></div>';
                $container.find('.preview').append(html);
            }
            $(".notification-message").fadeOut();
        }
    });
});
