<script>
    $('#immagini_evento, #immagini_form, .immagine_servizio, #immagini_cat').on("change", function () {
    var n_pictures = ($(".img-form-preview-item").length) - 1;
    var form_data = new FormData();
    var self = this;
    // Read selected files
    if($(this).attr("id") == 'immagini_evento')
    var totalfiles = document.getElementById('immagini_evento').files.length;

    else if($(this).attr("id") == 'immagini_form')
    var totalfiles = document.getElementById('immagini_form').files.length;

    else if($(this).hasClass("immagine_servizio"))
    var totalfiles = 1;

    for (var index = 0; index < totalfiles; index++) {
    form_data.append("immagini_form[]", document.getElementById('immagini_form').files[index]);
}

    $(".notification-message").html("Caricamento immagini in corso....");
    $(".notification-message").addClass("nm-info");
    $(".notification-message").fadeIn();

    // AJAX request
    $.ajax({
    url: "/backoffice/upload/images<?php include 'Views/xdebug.querystring.first.php'; ?>",
    type: 'post',
    data: form_data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (response) {

    if($(self).attr("id") == 'immagini_evento') {
    var src = response[0];
    $("#preview").html("");
    $('#preview').append('<div class="img-form-preview" id="ifp-prw-' + n_pictures + '"><span class="delete-preview" id="prw-' + n_pictures + '" onclick="delPreview(' + n_pictures + ')"><i class="fa fa-close"></i></span><img class="img-form-preview-item img_evento" src="' + src + '" height="200px"></div>');

} else if($(self).attr("id") == 'immagini_form') {
    let lunghezza = response.length;
    for(var index = 0; index < response.length; index++) {
    var src = response[index];
    n_pictures++;
    var n_pictures_next = n_pictures+1;
    $('#preview').append('<div class="img-form-preview" id="ifp-prw-'+n_pictures+'"><span class="delete-preview" id="prw-'+n_pictures+'" onclick="delPreview('+n_pictures+')"><i class="fa fa-close"></i></span><img class="img-form-preview-item img-hotel" src="'+src+'" height="200px"><div class="default-image-cont"><div class="pt20"><input type="radio" class="default-image" name="default_image" value="'+n_pictures_next+'"><label class="f15">&nbsp;Immagine principale</label><br></div></div>');

}
} else if($(self).hasClass("immagine_servizio")) {
    var src = response[0];
    var $target = $(self).closest(".preview_servizio");
    $(self).html("");
    $target.append('<div class="img-form-preview" id="ifp-prw-' + n_pictures + '"><span class="delete-preview" id="prw-' + n_pictures + '" onclick="delPreview(' + n_pictures + ')"><i class="fa fa-close"></i></span><img class="img-form-preview-item img_evento" src="' + src + '" height="200px"></div>');

}
    $(".notification-message").fadeOut();
}

});

});
</script>