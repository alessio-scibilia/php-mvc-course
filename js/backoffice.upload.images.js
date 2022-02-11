function delPreview(target) {
    var $target = jQuery(target).parent();
    var $input = $target.parent()
        .parent()
        .prev()
        .find('input.custom-file-input');
    $input.prop('disabled', false);
    $input.val(null);
    $target.hide(function () {
        $target.remove();
    });
}

function imageUploadHandler() {
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
    var post_url = $(this).data('post-url');
    $.ajax({
        url: post_url,
        type: 'post',
        data: form_data,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
            if ($(self).prop('multiple')) {
                var tips = $(self).data('tips');
                var placeholders = $(self).data('placeholders');
                var languages = $(self).data("languages");

                var lingue = languages.split("|");
                var placeholders = placeholders.split("|");

                for (var index = 0; index < response.length; index++) {
                    var src = '/' + response[index];

                    var n_pictures_next = n_pictures + 1;
                    var name = $(self).data('name') + `[${n_pictures_next}]`;
                    var html = '<div class="img-form-preview"><span class="delete-preview" onclick="delPreview(this)"><i class="fa fa-close"></i></span><img data-name="' + name + '" class="img-form-preview-item" src="' + src + '" height="200px"><div class="default-image-cont"><div class="pt20"><input type="radio" class="default-image" name="default_image" value="' + n_pictures_next + '"><label class="f15">&nbsp;Immagine principale</label><br></div></div>';

                    if (tips == true) {
                        var html = '<div class="img-form-preview"><span class="delete-preview" onclick="delPreview(this)"><i class="fa fa-close"></i></span><img data-name="' + name + '" class="img-form-preview-item" src="' + src + '" height="200px">';
                        for (let i = 0; i < lingue.length; i++) {
                            html += '<textarea name="didascalia_' + name + '[' + lingue[i] + ']" placeholder="' + placeholders[i] + '">';
                            html += '</textarea>';
                        }
                        html += '</div>';

                    } else
                        var html = '<div class="img-form-preview"><span class="delete-preview" onClick="delPreview(this)"><i class="fa fa-close"></i></span><img data-name="' + name + '" class="img-form-preview-item" src="' + src + '" height="200px"><div class="default-image-cont"><div class="pt20"><input type="radio" class="default-image" name="default_image" value="' + n_pictures_next + '"><label class="f15">&nbsp;Immagine principale</label><br></div></div>';

                    $container.find('.preview').append(html);
                    n_pictures++;
                }
            } else {
                var src = '/' + response[0];
                var name = $(self).data('name') + '[0]';
                var tips = $(self).data('tips');
                var placeholders = $(self).data('placeholders');
                var languages = $(self).data("languages");


                var lingue = languages.split("|");
                var placeholders = placeholders.split("|");

                if (tips == true) {
                    var html = '<div class="img-form-preview"><span class="delete-preview" onclick="delPreview(this)"><i class="fa fa-close"></i></span><img data-name="' + name + '" class="img-form-preview-item" src="' + src + '" height="200px">';
                    for (let i = 0; i < lingue.length; i++) {
                        html += '<textarea name="didascalia_' + name + '[' + lingue[i] + ']" placeholder="' + placeholders[i] + '">';
                        html += '</textarea>';
                    }
                    html += '</div>';

                } else
                    var html = '<div class="img-form-preview"><span class="delete-preview" onclick="delPreview(this)"><i class="fa fa-close"></i></span><img data-name="' + name + '" class="img-form-preview-item" src="' + src + '" height="200px"></div>';
                var $preview = $container.find('.preview');
                $preview.empty();
                $preview.append(html);
                $(self).prop('disabled', true);
            }
            $(".notification-message").fadeOut();
        }
    });
}

$('input.custom-file-input').on("change", imageUploadHandler);
