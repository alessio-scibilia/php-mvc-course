<script>
    $('#immagini_evento').on("change", function () {
    var n_pictures = ($(".img-form-preview-item").length) - 1;
    var form_data = new FormData();

    // Read selected files
    var totalfiles = document.getElementById('immagini_evento').files.length;
    for (var index = 0; index < totalfiles; index++) {
    form_data.append("immagini_form[]", document.getElementById('immagini_evento').files[index]);
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
    var src = response[0];

    $("#preview").html("");
    $('#preview').append('<div class="img-form-preview" id="ifp-prw-' + n_pictures + '"><span class="delete-preview" id="prw-' + n_pictures + '" onclick="delPreview(' + n_pictures + ')"><i class="fa fa-close"></i></span><img class="img-form-preview-item img_evento" src="' + src + '" height="200px"></div>');

    $(".notification-message").fadeOut();
}

});

});
</script>