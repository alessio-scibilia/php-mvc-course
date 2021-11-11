<?php $lingue = $view_model->languages->list_all(); ?>

<script>

    (function ($) {
    "use strict"
    //example 1
    var table = $('#example').DataTable({
    "language": {
    "lengthMenu": "Display _MENU_ records per page",
    "paginate": {
    "first": "Primo",
    "last": "Ulimo",
    "next": "<?php echo $view_model->translations->get('successiva');?>",
    "previous": "<?php echo $view_model->translations->get('precedente');?>"
},
    "zeroRecords": "Nessun risultato",
    "info": "<?php echo $view_model->translations->get('pagina');?> _PAGE_ <?php echo $view_model->translations->get('di');?> _PAGES_",
    "infoEmpty": "",
    "emptyTable": "",
    "thousands": ",",
    "lengthMenu": "<?php echo $view_model->translations->get('mostra');?> _MENU_ <?php echo $view_model->translations->get('risultati_per_volta');?>",
    "loadingRecords": "Caricamento...",
    "processing": "Caricamento...",
    "search": "<?php echo $view_model->translations->get('cerca');?>: ",
    "zeroRecords": "Nessuna dato trovato",
    "aria": {
    "sortAscending": ": In ordine crescente",
    "sortDescending": ": In ordine decrescente"
}
},
    createdRow: function (row, data, index) {
    $(row).addClass('selected')
}
});

    table.on('click', 'tbody tr', function () {
    var $row = table.row(this).nodes().to$();
    var hasClass = $row.hasClass('selected');
    if (hasClass) {
    $row.removeClass('selected')
} else {
    $row.addClass('selected')
}
});

    table.rows().every(function () {
    this.nodes().to$().removeClass('selected')
});

})(jQuery);

    /* Estensione per leggere dati delle form */
    jQuery.fn.extend({
    serializeObject: function() {
    if (this.serializeArray) {
    return this.serializeArray().reduce(function (obj, item) {
    obj[item.name] = item.value;
    return obj;
}, {});
} else {
    return {};
}
}
});

    jQuery(document).on("click", ".save-servizio", function () {
    var items_service = $(".form-service-container").length;
    items_next = items_service + 1;
    jQuery("#num_services").val(items_next);
    var form = jQuery(".form-service-container").last().clone();
    jQuery(".form-service-container").last().after(form);
    if (items_service >= 0) {
    jQuery(".form-service-container").last().find("#abilitato-" + items_service).attr("id", "abilitato-" + items_next);
    jQuery(".form-service-container").last().find("#servizio-" + items_service).attr("id", "servizio-" + items_next);
    jQuery(".form-service-container").last().find("#select-language-servizi").attr("data-form-index", items_next);
    jQuery(".form-service-container").last().find("#annulla-servizio-" + items_service).attr("id", "annulla-servizio-" + items_next);
    jQuery(".form-service-container").last().attr("id", "servizio-" + items_next);

    jQuery(".form-service-container").fadeIn();

    var offset = jQuery("#servizio-" + items_next).offset().top;
    offset = offset - 100;
    $('html,body').animate({
    scrollTop: offset
}, 'slow');

    jQuery(".form-service-container").last().attr("class", " form-service-container fsc-" + items_next);
    jQuery(".form-service-container").last().attr("id", "fsc-servizio-" + items_next);
    <?php
    for($i = 0;$i < sizeof($lingue);$i++) {
    ?>
    jQuery(".form-service-container").last().find("#descrizione-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_service).attr("id", "descrizione-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_next);

    jQuery(".form-service-container").last().find("#nome_servizio-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_service).attr("id", "nome_servizio-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_next);

    jQuery(".form-service-container").last().find("#nome_servizio-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_next).removeClass("nome-servizi-" + items_service);

    jQuery(".form-service-container").last().find("#nome_servizio-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_next).addClass("nome-servizi-" + items_next);

    jQuery(".form-service-container").last().find("#descrizione-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_next).removeClass("descrizione_servizi-" + items_service);

    jQuery(".form-service-container").last().find("#descrizione-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_next).addClass("descrizione_servizi-" + items_next);

    jQuery(".form-service-container").last().find("#select-nome-servizi").attr("data-form-index", items_next);
    <?php } ?>

    jQuery(".form-service-container").last().find("#immagine_servizio-" + items_service).attr("id", "immagine_servizio-" + items_next);
    jQuery(".form-service-container").last().find("#ifps-prws-immagine_servizio-" + items_service).attr("id", "ifps-prws-immagine_servizio-" + items_next);


    jQuery(".form-service-container").last().find("#prws-immagine_servizio-" + items_service).attr("id", "prws-immagine_servizio-" + items_next);


    jQuery(".form-service-container").last().find("#prws-immagine_servizio-" + items_next).attr("onclick", "delPreviewServizi('immagine_servizio-" + items_next + "')");


    jQuery(".form-service-container").last().find("#preview-immagine_servizio-" + items_service).attr("id", "preview-immagine_servizio-" + items_next);

    jQuery(".form-service-container").last().find("#0-lun-" + items_service).attr("id", "0-lun-" + items_next);

    jQuery(".form-service-container").last().find("#1-lun-" + items_service).attr("id", "1-lun-" + items_next);

    jQuery(".form-service-container").last().find("#orario-continuato-1-" + items_service).attr("id", "orario-continuato-1-" + items_next);
    jQuery(".form-service-container").last().find("#orario-continuato-2-" + items_service).attr("id", "orario-continuato-2-" + items_next);
    jQuery(".form-service-container").last().find("#orario-continuato-3-" + items_service).attr("id", "orario-continuato-3-" + items_next);
    jQuery(".form-service-container").last().find("#orario-continuato-4-" + items_service).attr("id", "orario-continuato-4-" + items_next);
    jQuery(".form-service-container").last().find("#orario-continuato-5-" + items_service).attr("id", "orario-continuato-5-" + items_next);
    jQuery(".form-service-container").last().find("#orario-continuato-6-" + items_service).attr("id", "orario-continuato-6-" + items_next);
    jQuery(".form-service-container").last().find("#orario-continuato-7-" + items_service).attr("id", "orario-continuato-7-" + items_next);

    jQuery(".form-service-container").last().find("#2-lun-" + items_service).attr("id", "2-lun-" + items_next);

    jQuery(".form-service-container").last().find("#3-lun-" + items_service).attr("id", "3-lun-" + items_next);

    jQuery(".form-service-container").last().find("#0-mar-" + items_service).attr("id", "0-mar-" + items_next);

    jQuery(".form-service-container").last().find("#1-mar-" + items_service).attr("id", "1-mar-" + items_next);

    jQuery(".form-service-container").last().find("#2-mar-" + items_service).attr("id", "2-mar-" + items_next);

    jQuery(".form-service-container").last().find("#3-mar-" + items_service).attr("id", "3-mar-" + items_next);

    jQuery(".form-service-container").last().find("#0-mer-" + items_service).attr("id", "0-mer-" + items_next);

    jQuery(".form-service-container").last().find("#1-mer-" + items_service).attr("id", "1-mer-" + items_next);

    jQuery(".form-service-container").last().find("#2-mer-" + items_service).attr("id", "2-mer-" + items_next);

    jQuery(".form-service-container").last().find("#3-mer-" + items_service).attr("id", "3-mer-" + items_next);

    jQuery(".form-service-container").last().find("#0-gio-" + items_service).attr("id", "0-gio-" + items_next);

    jQuery(".form-service-container").last().find("#1-gio-" + items_service).attr("id", "1-gio-" + items_next);

    jQuery(".form-service-container").last().find("#2-gio-" + items_service).attr("id", "2-gio-" + items_next);

    jQuery(".form-service-container").last().find("#3-gio-" + items_service).attr("id", "3-gio-" + items_next);

    jQuery(".form-service-container").last().find("#0-ven-" + items_service).attr("id", "0-ven-" + items_next);

    jQuery(".form-service-container").last().find("#1-ven-" + items_service).attr("id", "1-ven-" + items_next);

    jQuery(".form-service-container").last().find("#2-ven-" + items_service).attr("id", "2-ven-" + items_next);

    jQuery(".form-service-container").last().find("#3-ven-" + items_service).attr("id", "3-ven-" + items_next);

    jQuery(".form-service-container").last().find("#0-sab-" + items_service).attr("id", "0-sab-" + items_next);

    jQuery(".form-service-container").last().find("#1-sab-" + items_service).attr("id", "1-sab-" + items_next);

    jQuery(".form-service-container").last().find("#2-sab-" + items_service).attr("id", "2-sab-" + items_next);

    jQuery(".form-service-container").last().find("#3-sab-" + items_service).attr("id", "3-sab-" + items_next);

    jQuery(".form-service-container").last().find("#0-dom-" + items_service).attr("id", "0-dom-" + items_next);

    jQuery(".form-service-container").last().find("#1-dom-" + items_service).attr("id", "1-dom-" + items_next);

    jQuery(".form-service-container").last().find("#2-dom-" + items_service).attr("id", "2-dom-" + items_next);

    jQuery(".form-service-container").last().find("#3-dom-" + items_service).attr("id", "3-dom-" + items_next);
}
});


    jQuery(document).on("click", ".save-eccellenza", function () {
    var items_eccellenza = $(".form-eccellenza-container").length;
    items_next = items_eccellenza + 1;
    jQuery("#num_eccellenze").val(items_next);
    var form = jQuery(".form-eccellenza-container").last().clone();
    jQuery(".form-eccellenza-container").last().append(form);
    if (items_eccellenza >= 0) {
    jQuery(".form-eccellenza-container").last().find("#abilitato-" + items_eccellenza).attr("id", "abilitato-" + items_next);
    jQuery(".form-eccellenza-container").last().find("#eccellenza-" + items_eccellenza).attr("id", "eccellenza-" + items_next);
    jQuery(".form-eccellenza-container").last().find("#select-nome-eccellenze").attr("data-form-index", items_next);
    jQuery(".form-eccellenza-container").last().find("#annulla-eccellenza-" + items_eccellenza).attr("id", "annulla-eccellenza-" + items_next);
    jQuery(".form-eccellenza-container").last().attr("id", "eccellenza-" + items_next);

    jQuery(".form-eccellenza-container").fadeIn();

    var offset = jQuery("#eccellenza-" + items_next).offset().top;
    offset = offset - 100;
    $('html,body').animate({
    scrollTop: offset
}, 'slow');

    jQuery(".form-eccellenza-container").last().attr("class", " form-eccellenza-container fsc-" + items_next);
    jQuery(".form-eccellenza-container").last().attr("id", "fsc-eccellenza-" + items_next);
    <?php
    for($i = 0;$i < sizeof($lingue);$i++) {
    ?>
    jQuery(".form-eccellenza-container").last().find("#descrizione-eccellenza-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_eccellenza).attr("id", "descrizione-eccellenza-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_next);

    jQuery(".form-eccellenza-container").last().find("#nome-eccellenza-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_eccellenza).attr("id", "nome-eccellenza-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_next);


    jQuery(".form-eccellenza-container").last().find("#nome-eccellenza-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_next).removeClass("nome_eccellenze-" + items_eccellenza);

    jQuery(".form-eccellenza-container").last().find("#nome-eccellenza-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + items_next).addClass("nome_eccellenze-" + items_next);

    jQuery(".form-eccellenza-container").last().find("#select-nome-eccellenze").attr("data-form-index", items_next);
    <?php } ?>

    jQuery(".form-eccellenza-container").last().find("#immagine_eccellenza-" + items_eccellenza).attr("id", "immagine_eccellenza-" + items_next);


    jQuery(".form-eccellenza-container").last().find("#ifps-prws-immagine_eccellenza-" + items_eccellenza).attr("id", "ifps-prws-immagine_eccellenza-" + items_next);


    jQuery(".form-eccellenza-container").last().find("#prws-immagine_eccellenza-" + items_eccellenza).attr("id", "prws-immagine_eccellenza-" + items_next);


    jQuery(".form-eccellenza-container").last().find("#prws-immagine_eccellenza-" + items_next).attr("onclick", "delPreviewServizi('immagine_eccellenza-" + items_next + "')");


    jQuery(".form-eccellenza-container").last().find("#preview-immagine_eccellenza-" + items_eccellenza).attr("id", "preview-immagine_eccellenza-" + items_next);

}
});


    $('#immagini_form').on("change", function () {
    var n_pictures = ($(".img-form-preview-item").length) - 1;
    var form_data = new FormData();

    // Read selected files
    var totalfiles = document.getElementById('immagini_form').files.length;
    for (var index = 0; index < totalfiles; index++) {
    form_data.append("immagini_form[]", document.getElementById('immagini_form').files[index]);
}
    $(".notification-message").html("Caricamento immagini in corso....");
    $(".notification-message").addClass("nm-info");
    $(".notification-message").fadeIn();

    // AJAX request
    $.ajax({
    url: 'process/uploadImages.php',
    type: 'post',
    data: form_data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (response) {
    let lunghezza = response.length;
    for (var index = 0; index < response.length; index++) {
    var src = response[index];
    n_pictures++;
    var n_pictures_next = n_pictures + 1;
    if (jQuery(this).attr("data-function") != 'addCategory')
    $('#preview').append('<div class="img-form-preview" id="ifp-prw-' + n_pictures + '"><span class="delete-preview" id="prw-' + n_pictures + '" onclick="delPreview(' + n_pictures + ')"><i class="fa fa-close"></i></span><img class="img-form-preview-item img-hotel" src="' + src + '" height="200px"><div class="default-image-cont"><div class="pt20"><input type="radio" class="default-image" name="default-image" value="' + n_pictures_next + '"><label class="f15">&nbsp;Immagine principale</label><br></div></div>');
    else
    $('#preview').append('<div class="img-form-preview "><img class="img-form-preview-item" src="' + src + '" height="200px"></div>');
}

    if (lunghezza == 1) {
    $(".default-image").attr("checked", "checked");
}
    $(".notification-message").fadeOut();

}
});

});

    $('#immagini_form_strutture').on("change", function () {
    var n_pictures = ($(".img-form-preview-item").length) - 1;
    var form_data = new FormData();

    // Read selected files
    var totalfiles = document.getElementById('immagini_form_strutture').files.length;
    for (var index = 0; index < totalfiles; index++) {
    form_data.append("immagini_form[]", document.getElementById('immagini_form_strutture').files[index]);
}
    $(".notification-message").html("Caricamento immagini in corso....");
    $(".notification-message").addClass("nm-info");
    $(".notification-message").fadeIn();

    // AJAX request
    $.ajax({
    url: 'process/uploadImages.php',
    type: 'post',
    data: form_data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (response) {
    let lunghezza = response.length;
    for (var index = 0; index < response.length; index++) {
    var src = response[index];
    n_pictures++;
    var n_pictures_next = n_pictures + 1;
    if (jQuery(this).attr("data-function") != 'addCategory')
    $('#preview').append('<div class="img-form-preview" id="ifp-prw-' + n_pictures + '"><span class="delete-preview" id="prw-' + n_pictures + '" onclick="delPreview(' + n_pictures + ')"><i class="fa fa-close"></i></span><img class="img-form-preview-item img-hotel" src="' + src + '" height="200px"><div class="default-image-cont"><div class="pt20"><input type="radio" class="default-image" name="default-image" value="' + n_pictures_next + '"><label class="f15">&nbsp;Immagine principale</label><br></div></div>');
    else
    $('#preview').append('<div class="img-form-preview "><img class="img-form-preview-item" src="' + src + '" height="200px"></div>');
}

    if (lunghezza == 1) {
    $(".default-image").attr("checked", "checked");
}
    $(".notification-message").fadeOut();

}
});

});


    $('#immagini_form_didascalie').on("change", function () {
    var n_pictures = ($(".img-form-preview-item-d.img-didascalia").length) - 1;
    var form_data = new FormData();

    // Read selected files
    var totalfiles = document.getElementById('immagini_form_didascalie').files.length;
    for (var index = 0; index < totalfiles; index++) {
    form_data.append("immagini_form[]", document.getElementById('immagini_form_didascalie').files[index]);
}
    $(".notification-message").html("Caricamento immagini in corso....");
    $(".notification-message").addClass("nm-info");
    $(".notification-message").fadeIn();

    // AJAX request
    $.ajax({
    url: 'process/uploadImages.php',
    type: 'post',
    data: form_data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (response) {
    let lunghezza = response.length;
    for (var index = 0; index < response.length; index++) {
    var src = response[index];
    n_pictures++;
    var n_pictures_next = n_pictures + 1;
    if (jQuery(this).attr("data-function") != 'addCategory') {
    $('#preview-didascalie').append('<div class="img-form-preview" id="ifp-prw-' + n_pictures + '"><span class="delete-preview" id="prw-' + n_pictures + '" onclick="delPreview(' + n_pictures + ')"><i class="fa fa-close"></i></span><img class="img-form-preview-item-d img-didascalia" src="' + src + '" height="200px"><div class="default-image-cont"><div class="pt20 apt-' + n_pictures + '">');


} else
    $('#preview-didascalie').append('<div class="img-form-preview "><img class="img-form-preview-item" src="' + src + '" height="200px"></div>');
}

    <?php for($i = 0;$i < sizeof($lingue);$i++) { ?>
    $('.apt-' + n_pictures).append('<textarea id="testo-didascalia-<?php echo $lingue[$i]['shortcode_lingua'];?>-' + n_pictures + '" placeholder="Didascalia <?php echo $lingue[$i]['abbreviazione'];?>"></textarea>');
    <?php } ?>

    if (lunghezza == 1) {
    $(".default-image-didascalie").attr("checked", "checked");
}
    $(".notification-message").fadeOut();

}
});

});

    $('#immagini_cat').on("change", function () {
    var n_pictures = $("img-form-preview-item").length;
    var form_data = new FormData();

    // Read selected files
    var totalfiles = document.getElementById('immagini_cat').files.length;
    for (var index = 0; index < totalfiles; index++) {
    form_data.append("immagini_form[]", document.getElementById('immagini_cat').files[index]);
}

    // AJAX request
    $.ajax({
    url: 'process/uploadImages.php',
    type: 'post',
    data: form_data,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function (response) {

    for (var index = 0; index < response.length; index++) {
    var src = response[index];
    n_pictures++;
    $("#preview").html("");
    $("#img_path").val(src);
    $('#preview').append('<div class="img-form-preview "><img class="img-form-preview-item" src="' + src + '" height="200px"></div>');
}

}
});

});


    function refreshView() {
    var page = window.location.pathname;
    var splitURL = page.toString().split("/");
    var parameters = [];
    var composed = false;
    for (let i = 0; i < splitURL.length; i++) {
    if (splitURL[i] == "cp") {
    var z = 0;
    for (let y = i + 1; y < splitURL.length; y++) {
    parameters[z] = splitURL[y];
    z++;
}
    composed = true;
}

    if (composed == true)
    break;
}
    openViewParseURL(parameters[0], false);
}

    jQuery("#example tbody").on("click", '.open-edit-translation', function () {
    var success = jQuery(this).attr("data-success");
    var fail = jQuery(this).attr("data-fail");
    if (!jQuery(this).hasClass('save-translation')) {
    var id_translation = jQuery(this).attr("id");
    var key_translation = jQuery(".key-" + id_translation).text();
    var value_translation = jQuery(".value-" + id_translation).text();
    jQuery(this).removeClass('btn-primary');
    jQuery(this).addClass('btn-success');
    jQuery(this).children().removeClass('fa-pencil');
    jQuery(this).children().addClass('fa-check');
    jQuery(this).addClass('save-translation');
    jQuery(".value-translation-" + key_translation).html('<input type="text" class=".value-translation-' + key_translation + '" value="' + value_translation + '">');
} else {
    var id_translation = jQuery(this).attr("id");
    var new_translation = jQuery(".value-" + id_translation).children().val();
    var translation_key = id_translation.replace('translation-', '');
    var id_lingua = jQuery(".lang-selector").val();
    var id_lingua = document.getElementById("lang-selector").value;
    var toFunction = 'updateTranslation';
    var id = JSON.stringify(id_translation);
    var translation = JSON.stringify(new_translation);
    var key = JSON.stringify(translation_key);
    var lingua = JSON.stringify(id_lingua);
    $.post("backoffice/api?use=" + toFunction, {
    parameters: 'traduzioni',
    id: id,
    translation: translation,
    key: key,
    id_lingua: lingua
})
    .done(function (data) {
    if (data != 'error') {
    $(".notification-message").html(success);
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();
    jQuery("#" + id_translation).removeClass('btn-success');
    jQuery("#" + id_translation).addClass('btn-primary');
    jQuery("#" + id_translation).children().removeClass('fa-check');
    jQuery("#" + id_translation).children().addClass('fa-pencil');
    jQuery("#" + id_translation).removeClass('save-translation');
    jQuery(".value-translation-" + translation_key).html('<div class=".value-translation-' + key_translation + '">' + new_translation + '</div>');
} else {
    refreshView();
    $(".notification-message").html(fail);
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});
}
});


    jQuery(".lang-selector").change(function () {
    var value = jQuery(this).val();
    var abbreviazione = jQuery(this).text();
    var search_val = false;
    if (jQuery(".dataTables_filter").children().children())
    search_val = jQuery(".dataTables_filter").children().children().val();
    jQuery(".notification-message").fadeOut();
    var action = jQuery(this).attr("data-action");
    var params = jQuery(this).val();
    if (params == "false") params = "";
    var title = jQuery(this).attr("data-title");
    if (params != "")
    window.history.pushState("object or string", title, "/backoffice/" + action + "/" + params);
    else
    window.history.pushState("object or string", title, "/backoffice/" + action);
    $(document).prop("title", title);

    var val = false;
    if (jQuery("#gobacksearch").length) {
    var val = jQuery("#gobacksearch").attr("data-search");
}

    openViewParseURL(action, false, search_val, val);

});

    jQuery(".enable").click(function () {
    var successo = jQuery(this).attr("data-success");
    var failure = jQuery(this).attr("data-fail");
    if (jQuery(this).prop("checked") == true) {
    var toFunction = '';
    if (jQuery(this).hasClass("enable-language"))
    toFunction = 'enableLanguage';
    else if (jQuery(this).hasClass("disable-language"))
    toFunction = 'disableLanguage';
    else if (jQuery(this).hasClass("enable-hotel"))
    toFunction = 'enableHotel';
    else if (jQuery(this).hasClass("disable-hotel"))
    toFunction = 'disableHotel';
    else if (jQuery(this).hasClass("enable-admin"))
    toFunction = 'enableAdmin';
    else if (jQuery(this).hasClass("enable-categoria"))
    toFunction = 'enableCategoria';
    else if (jQuery(this).hasClass("enable-guest"))
    toFunction = 'enableGuest';
    else if (jQuery(this).hasClass("enable-evento"))
    toFunction = 'enableEvento';
    else if (jQuery(this).hasClass("enable-struttura"))
    toFunction = 'enableStruttura';

    else if (jQuery(this).hasClass("disable-admin"))
    toFunction = 'disableAdmin';

    params = jQuery(this).val();
    var jsonStringParams = JSON.stringify(params);
    $.post("backoffice/api?use=" + toFunction, {parameters: jsonStringParams})
    .done(function (data) {
    //refreshView();
    if (data != 'error') {
    $(".notification-message").html(successo);
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();
} else {
    //refreshView();
    $(".notification-message").html(failure);
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});
} else {
    var toFunction = '';
    if (jQuery(this).hasClass("enable-language"))
    toFunction = 'disableLanguage';
    else if (jQuery(this).hasClass("disable-language"))
    toFunction = 'disableLanguage';
    else if (jQuery(this).hasClass("enable-hotel"))
    toFunction = 'disableHotel';
    else if (jQuery(this).hasClass("enable-guest"))
    toFunction = 'disableGuest';
    else if (jQuery(this).hasClass("enable-evento"))
    toFunction = 'disableEvento';
    else if (jQuery(this).hasClass("enable-struttura"))
    toFunction = 'disableStruttura';

    else if (jQuery(this).hasClass("enable-categoria"))
    toFunction = 'disableCategoria';

    else if (jQuery(this).hasClass("enable-admin"))
    toFunction = 'disableAdmin';

    params = jQuery(this).val();
    var jsonStringParams = JSON.stringify(params);
    $.post("backoffice/api?use=" + toFunction, {parameters: jsonStringParams})
    .done(function (data) {
    //refreshView();
    if (data != 'error') {
    $(".notification-message").html(successo);
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();
} else {
    //refreshView();
    $(".notification-message").html(failure);
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});
}
})


    jQuery(document).on("click", "#annulla_servizio", function () {
    jQuery(".form-service-container").fadeOut();
})


    jQuery("#saveHotel").on("click", function () {
    var successo = jQuery(this).attr("data-success");
    var failure = jQuery(this).attr("data-failure");

    var nome = $("#nome").val();
    var email = $("#email").val();
    var sito = $("#sito").val();
    var telefono = $("#telefono").val();
    var indirizzo = $("#indirizzo").val();
    var latitudine = $("#latitudine").val();
    var longitudine = $("#longitudine").val();
    var password = $("#password").val();
    var password1 = $("#conferma_password").val();
    var utente_abilitato = $("#utente_abilitato").val();
    var pro = $("#utente-pro").val();
    var default_image = undefined;

    $(".default-image").each(function (i) {
    if (this.checked)
    default_image = i + 1;
});
    var num_services = $("#num_services").val();
    var is_error = false;
    jQuery(".error_message").remove(); //rimuove tutti gli errori già visualizzati
    //Validazione email, se non passata mettere is_error = true

    if (default_image == undefined) {
    is_error = true;
    error_message = '<p>- Devi scegliere un\'immagine principale';
    jQuery("#preview-img-container").after('<div class="error_message">' + error_message + '</div>');
}
    if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
    error_message = "<p>- Inserire un indirizzo email valido</p>";
    is_error = true;

    jQuery("#email").after('<div class="error_message">' + error_message + '</div>');

}

    if (password.length < 8) {
    error_message = "- La password deve contenere almeno 8 caratteri";
    is_error = true;

    jQuery("#password").after('<div class="error_message">' + error_message + '</div>');
}

    if (!/^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/.test(sito)) {
    error_message = "<p>- Inserire un indirizzo web valido</p>";
    is_error = true;

    jQuery("#sito").after('<div class="error_message">' + error_message + '</div>');

}

    if (nome.length < 1) {
    error_message = "- Inserire un nome per l'hotel";
    is_error = true;

    jQuery("#nome").after('<div class="error_message">' + error_message + '</div>');
}

    if (telefono.length < 9) {
    error_message = "- Inserire un numero di telefono";
    is_error = true;

    jQuery("#telefono").after('<div class="error_message">' + error_message + '</div>');
}

    if (indirizzo.length < 1) {
    error_message = "- Inserire un indirizzo";
    is_error = true;

    jQuery("#indirizzo").after('<div class="error_message">' + error_message + '</div>');
}

    if (latitudine.length < 1) {
    error_message = "- Inserire la latitudine dell'hotel";
    is_error = true;

    jQuery("#latitudine").after('<div class="error_message">' + error_message + '</div>');
}

    if (longitudine.length < 1) {
    error_message = "- Inserire la longitudine dell'hotel";
    is_error = true;

    jQuery("#longitudine").after('<div class="error_message">' + error_message + '</div>');
}

    if (password.length < 8) {
    error_message = "- La password deve contenere almeno 8 caratteri";
    is_error = true;

    jQuery("#password1").after('<div class="error_message">' + error_message + '</div>');
}


    if (password != password1) {
    error_message = "- Le due password non corrispondono";
    is_error = true;

    jQuery("#conferma_password").after('<div class="error_message">' + error_message + '</div>');
}


    var immagini_hotel = [];
    var z = 0;
    $(".img-hotel").each(function () {
    src = $(this).attr("src");
    immagini_hotel.push(src);
})
    var descrizioni_ospiti
    = [];
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    descrizioni_ospiti
    .push($('#descrizione-ospiti-<?php echo $i;?>').summernote('code'));
    <?php } ?>

    var nomi_servizi = [];
    var abilitato = [];
    var descrizioni_servizi = [];
    var z = 0;
    for (let i = 1; i <= num_services; i++) {
    nomi_servizi[z] = '';
    abilitato[z] = '';
    descrizioni_servizi[z] = '';
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    nomi_servizi[z] += jQuery("#nome_servizio-<?php echo $i;?>-" + i).val() + '||';
    abilitato[z] += jQuery("#abilitato-" + i).val() + '||';
    descrizioni_servizi[z] += jQuery("#descrizione-<?php echo $i;?>-" + i).val() + '||';
    <?php } ?>
    z++;
}


    var immagine_servizio = [];
    for (let i = 1; i <= num_services; i++) {
    immagine_servizio.push($("#prws-immagine_servizio-" + i).next().attr("src"));
}
    var lunedi = [];
    var martedi = [];
    var mercoledi = [];
    var giovedi = [];
    var venerdi = [];
    var sabato = [];
    var domenica = [];
    for (let i = 1; i <= num_services; i++) {
    if (!$("#orario-continuato-1-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    lunedi[i] = orario_continuato + '|' + jQuery("#0-lun-" + i).val() + '|' + jQuery("#1-lun-" + i).val() + '|' + jQuery("#2-lun-" + i).val() + '|' + jQuery("#3-lun-" + i).val() + '|';


    if (!$("#orario-continuato-2-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    martedi[i] = orario_continuato + '|' + jQuery("#0-mar-" + i).val() + '|' + jQuery("#1-mar-" + i).val() + '|' + jQuery("#2-mar-" + i).val() + '|' + jQuery("#3-mar-" + i).val() + '|';


    if (!$("#orario-continuato-3-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    mercoledi[i] = orario_continuato + '|' + jQuery("#0-mer-" + i).val() + '|' + jQuery("#1-mer-" + i).val() + '|' + jQuery("#2-mer-" + i).val() + '|' + jQuery("#3-mer-" + i).val() + '|';


    if (!$("#orario-continuato-4-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    giovedi[i] = orario_continuato + '|' + jQuery("#0-gio-" + i).val() + '|' + jQuery("#1-gio-" + i).val() + '|' + jQuery("#2-gio-" + i).val() + '|' + jQuery("#3-gio-" + i).val() + '|';


    if (!$("#orario-continuato-5-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    venerdi[i] = orario_continuato + '|' + jQuery("#0-ven-" + i).val() + '|' + jQuery("#1-ven-" + i).val() + '|' + jQuery("#2-ven-" + i).val() + '|' + jQuery("#3-ven-" + i).val() + '|';


    if (!$("#orario-continuato-6-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    sabato[i] = orario_continuato + '|' + jQuery("#0-sab-" + i).val() + '|' + jQuery("#1-sab-" + i).val() + '|' + jQuery("#2-sab-" + i).val() + '|' + jQuery("#3-sab-" + i).val() + '|';


    if (!$("#orario-continuato-7-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    domenica[i] = orario_continuato + '|' + jQuery("#0-dom-" + i).val() + '|' + jQuery("#1-dom-" + i).val() + '|' + jQuery("#2-dom-" + i).val() + '|' + jQuery("#3-dom-" + i).val() + '|';


}


    if (is_error == false) {

    $.post("backoffice/api?use=addHotel", {
    nome: nome,
    email: email,
    telefono: telefono,
    sito: sito,
    indirizzo: indirizzo,
    latitudine: latitudine,
    longitudine: longitudine,
    password: password,
    utente_abilitato: utente_abilitato,
    pro: pro,
    num_services: num_services,
    descrizioni_ospiti: descrizioni_ospiti,
    nomi_servizi: nomi_servizi,
    abilitato: abilitato,
    descrizioni_servizi: descrizioni_servizi,
    immagine_servizio: immagine_servizio,
    lunedi: lunedi,
    martedi: martedi,
    mercoledi: mercoledi,
    giovedi: giovedi,
    venerdi: venerdi,
    sabato: sabato,
    domenica: domenica,
    immagini_hotel: immagini_hotel,
    default_image: default_image
})
    .done(function (data) {
    //refreshView();
    if (data != 'error' && data != 'exists') {
    $(".notification-message").html(successo);
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();
    callback = '/backoffice/hotels';
    var params = [];
    params[0] = '<?php echo $view_model->translations->get('link_hotels');?>';
    var jsonStringParams = JSON.stringify(params);
    openView(callback, params);
} else if (data == 'exists') {
    $(".notification-message").html("L'indirizzo email inserito appartiene già ad un hotel");
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
} else {
    //refreshView();
    $(".notification-message").html(failure);
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});
} else {
    $(".notification-message").html("Alcuni campi non sono compilati in modo corretto");
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
    $("#saveHotel").after("<span style=\"    color: red;padding: 5px 20px;border: 1px solid;margin: 0 15px;border-radius: 3px;\">Alcuni campi non sono corretti<span>");

}


});


    jQuery("#updateHotel").on("click", function () {

    var successo = jQuery(this).attr("data-success");
    var failure = jQuery(this).attr("data-failure");


    var hotel_id = $("#hotel_id").val();
    var nome = $("#nome").val();
    var email = $("#email").val();
    var sito = $("#sito").val();
    var telefono = $("#telefono").val();
    var indirizzo = $("#indirizzo").val();
    var latitudine = $("#latitudine").val();
    var longitudine = $("#longitudine").val();
    var password = $("#password").val();
    var password = $("#conferma_password").val();
    var utente_abilitato = $("#utente_abilitato").val();
    var pro = $("#utente-pro").val();
    var default_image = undefined;
    $(".default-image").each(function (i) {
    if (this.checked)
    default_image = i + 1;
});
    var num_services = $("#num_services").val();

    var is_error = false;
    jQuery(".error_message").remove(); //rimuove tutti gli errori già visualizzati

    if (default_image == undefined) {
    is_error = true;
    error_message = '<p>- Devi scegliere un\'immagine principale';
    jQuery("#preview-img-container").after('<div class="error_message">' + error_message + '</div>');
}

    //Validazione email, se non passata mettere is_error = true
    if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
    error_message = "<p>- Inserire un indirizzo email valido</p>";
    is_error = true;

    jQuery("#email").after('<div class="error_message">' + error_message + '</div>');

}


    if (!/^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/.test(sito)) {
    error_message = "<p>- Inserire un indirizzo web valido</p>";
    is_error = true;

    jQuery("#sito").after('<div class="error_message">' + error_message + '</div>');

}

    if (nome.length < 1) {
    error_message = "- Inserire un nome per l'hotel";
    is_error = true;

    jQuery("#nome").after('<div class="error_message">' + error_message + '</div>');
}

    if (telefono.length < 9) {
    error_message = "- Inserire un numero di telefono";
    is_error = true;

    jQuery("#telefono").after('<div class="error_message">' + error_message + '</div>');
}

    if (indirizzo.length < 1) {
    error_message = "- Inserire un indirizzo";
    is_error = true;

    jQuery("#indirizzo").after('<div class="error_message">' + error_message + '</div>');
}

    if (latitudine.length < 1) {
    error_message = "- Inserire la latitudine dell'hotel";
    is_error = true;

    jQuery("#latitudine").after('<div class="error_message">' + error_message + '</div>');
}

    if (longitudine.length < 1) {
    error_message = "- Inserire la longitudine dell'hotel";
    is_error = true;

    jQuery("#longitudine").after('<div class="error_message">' + error_message + '</div>');
}


    var immagini_hotel = [];
    var z = 0;
    $(".img-hotel").each(function () {
    src = $(this).attr("src");
    immagini_hotel.push(src);
})
    var descrizioni_ospiti
    = [];
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    descrizioni_ospiti
    .push($('#descrizione-ospiti-<?php echo $i;?>').summernote('code'));
    <?php } ?>

    var nomi_servizi = [];
    var abilitato = [];
    var descrizioni_servizi = [];
    var z = 0;
    for (let i = 1; i <= num_services; i++) {
    nomi_servizi[z] = '';
    abilitato[z] = '';
    descrizioni_servizi[z] = '';
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    nomi_servizi[z] += jQuery("#nome_servizio-<?php echo $i;?>-" + i).val() + '||';
    abilitato[z] += jQuery("#abilitato-" + i).val() + '||';
    descrizioni_servizi[z] += jQuery("#descrizione-<?php echo $i;?>-" + i).val() + '||';
    <?php } ?>
    z++;
}


    var immagine_servizio = [];
    for (let i = 1; i <= num_services; i++) {
    immagine_servizio.push($("#prws-immagine_servizio-" + i).next().attr("src"));
}
    var lunedi = [];
    var martedi = [];
    var mercoledi = [];
    var giovedi = [];
    var venerdi = [];
    var sabato = [];
    var domenica = [];
    for (let i = 1; i <= num_services; i++) {
    if (!$("#orario-continuato-1-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    lunedi[i] = orario_continuato + '|' + jQuery("#0-lun-" + i).val() + '|' + jQuery("#1-lun-" + i).val() + '|' + jQuery("#2-lun-" + i).val() + '|' + jQuery("#3-lun-" + i).val() + '|';


    if (!$("#orario-continuato-2-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    martedi[i] = orario_continuato + '|' + jQuery("#0-mar-" + i).val() + '|' + jQuery("#1-mar-" + i).val() + '|' + jQuery("#2-mar-" + i).val() + '|' + jQuery("#3-mar-" + i).val() + '|';


    if (!$("#orario-continuato-3-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    mercoledi[i] = orario_continuato + '|' + jQuery("#0-mer-" + i).val() + '|' + jQuery("#1-mer-" + i).val() + '|' + jQuery("#2-mer-" + i).val() + '|' + jQuery("#3-mer-" + i).val() + '|';


    if (!$("#orario-continuato-4-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    giovedi[i] = orario_continuato + '|' + jQuery("#0-gio-" + i).val() + '|' + jQuery("#1-gio-" + i).val() + '|' + jQuery("#2-gio-" + i).val() + '|' + jQuery("#3-gio-" + i).val() + '|';


    if (!$("#orario-continuato-5-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    venerdi[i] = orario_continuato + '|' + jQuery("#0-ven-" + i).val() + '|' + jQuery("#1-ven-" + i).val() + '|' + jQuery("#2-ven-" + i).val() + '|' + jQuery("#3-ven-" + i).val() + '|';


    if (!$("#orario-continuato-6-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    sabato[i] = orario_continuato + '|' + jQuery("#0-sab-" + i).val() + '|' + jQuery("#1-sab-" + i).val() + '|' + jQuery("#2-sab-" + i).val() + '|' + jQuery("#3-sab-" + i).val() + '|';


    if (!$("#orario-continuato-7-" + i).is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    domenica[i] = orario_continuato + '|' + jQuery("#0-dom-" + i).val() + '|' + jQuery("#1-dom-" + i).val() + '|' + jQuery("#2-dom-" + i).val() + '|' + jQuery("#3-dom-" + i).val() + '|';


}
    if (is_error == false) {
    jQuery(".error_message").remove();
    $.post("backoffice/api?use=updateHotel", {
    nome: nome,
    email: email,
    telefono: telefono,
    sito: sito,
    indirizzo: indirizzo,
    latitudine: latitudine,
    longitudine: longitudine,
    password: password,
    utente_abilitato: utente_abilitato,
    pro: pro,
    num_services: num_services,
    descrizioni_ospiti
    :
    descrizioni_ospiti, nomi_servizi
    :
    nomi_servizi, abilitato
    :
    abilitato, descrizioni_servizi
    :
    descrizioni_servizi, immagine_servizio
    :
    immagine_servizio, lunedi
    :
    lunedi, martedi
    :
    martedi, mercoledi
    :
    mercoledi, giovedi
    :
    giovedi, venerdi
    :
    venerdi, sabato
    :
    sabato, domenica
    :
    domenica, immagini_hotel
    :
    immagini_hotel, default_image
    :
    default_image, hotel_id
    :
    hotel_id
})
    .
    done(function (data) {
    //refreshView();
    if (data != 'error') {
    $(".notification-message").html(successo);
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();
} else {
    //refreshView();
    $(".notification-message").html(failure);
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});


} else {
    $(".notification-message").html("Alcuni campi non sono compilati in modo corretto");
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
    $("#updateHotel").after("<span style=\"color: red;padding: 5px 20px;border: 1px solid;margin: 0 15px;border-radius: 3px;\">Alcuni campi non sono corretti<span>");

}

});


    jQuery("#createStruttura").on("click", function () {
    var successo = jQuery(this).attr("data-success");
    var failure = jQuery(this).attr("data-failure");


    var hotel_associati = [];
    var i = 0;

    $(".relHot").each(function () {
    hotel_associati[i] = $(this).attr("id");
    i++;
});

    //recupero recapiti
    var categorie_associate = [];
    var t = 0;

    $(".relCat").each(function () {
    categorie_associate[t] = $(this).attr("id");
    t++;
});
    var nome = $("#nome_struttura").val();

    var email = $("#email").val();
    var sito = $("#sito").val();
    var telefono = $("#telefono").val();
    var indirizzo = $("#indirizzo").val();
    var latitudine = $("#latitudine").val();
    var longitudine = $("#longitudine").val();
    var immagini_hotel = [];
    var immagini_didascalia = [];
    var z = 0;

    $(".img-hotel").each(function () {
    src = $(this).attr("src");
    immagini_hotel.push(src);
})

    let k = 0;
    var testi_didascalia = '';
    $(".img-didascalia").each(function (i) {
    let id_testo = $(this).next().children().children().attr("id");
    let id_testo_new = id_testo.substr(id_testo.length - 1);

    let src = $(this).attr("src");
    immagini_didascalia.push(src);
    <?php
    for($i = 0;$i < sizeof($lingue);$i++) {
    ?>
    testi_didascalia += $("#testo-didascalia-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + id_testo_new).val();
    testi_didascalia += '||';
    <?php } ?>
    testi_didascalia += '&&';
    k++;


})

    var descrizioni_normali
    = [];
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    descrizioni_normali.push($('#descrizione-ospiti-<?php echo $i;?>').summernote('code'));
    <?php } ?>

    <?php if($view_model->user->level > 2) { ?>
    var descrizione_benefit
    = [];
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    descrizione_benefit.push($('#descrizione-benefit-<?php echo $i;?>').summernote('code'));
    <?php } ?>
    <?php } else { ?>
    var descrizione_benefit = '';
    <?php } ?>



    var utente_abilitato = $("#abilitato-struttura").val();
    var indicizza = $("#indicizza").val();
    var is_convenzionato = $("#is_convenzionato").val();
    var default_image = $(".default-image:checked").val();
    var num_services = $("#num_eccellenze").val();
    var tipo_viaggio = $(".tipo_viaggio:checked").val();


    var is_error = false;
    jQuery(".error_message").remove(); //rimuove tutti gli errori già visualizzati
    //Validazione email, se non passata mettere is_error = true
    if (default_image == undefined) {
    is_error = true;
    error_message = '<p>- Devi scegliere un\'immagine principale';
    jQuery("#preview-img-container").after('<div class="error_message">' + error_message + '</div>');
}
    if (!/^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/.test(sito)) {
    if (sito != '') {
    error_message = "<p>- Inserire un indirizzo web valido</p>";
    is_error = true;

    jQuery("#sito").after('<div class="error_message">' + error_message + '</div>');
}
}


    if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
    if (email != '') {
    error_message = "<p>- Inserire un indirizzo email valido</p>";
    is_error = true;

    jQuery("#email").after('<div class="error_message">' + error_message + '</div>');
}

}

    if (nome.length < 1) {
    error_message = "- Inserire un nome per la struttura";
    is_error = true;

    jQuery("#nome_struttura").after('<div class="error_message">' + error_message + '</div>');
}


    if (nome.length < 1) {
    error_message = "- Inserire un nome per la struttura";
    is_error = true;

    jQuery("#nome").after('<div class="error_message">' + error_message + '</div>');
}

    if (telefono.length < 9 && telefono.length > 0) {
    error_message = "- Inserire un numero di telefono valido";
    is_error = true;

    jQuery("#telefono").after('<div class="error_message">' + error_message + '</div>');
}

    if (indirizzo.length < 1) {
    error_message = "- Inserire un indirizzo";
    is_error = true;

    jQuery("#indirizzo").after('<div class="error_message">' + error_message + '</div>');
}

    if (latitudine.length < 1) {
    error_message = "- Inserire la latitudine della struttura";
    is_error = true;

    jQuery("#latitudine").after('<div class="error_message">' + error_message + '</div>');
}

    if (longitudine.length < 1) {
    error_message = "- Inserire la longitudine della struttura";
    is_error = true;

    jQuery("#longitudine").after('<div class="error_message">' + error_message + '</div>');
}


    var z = 0;
    var lunedi = [];
    var martedi = [];
    var mercoledi = [];
    var giovedi = [];
    var venerdi = [];
    var sabato = [];
    var domenica = [];
    if (!$("#orario-continuato-1-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    lunedi[i] = orario_continuato + '|' + jQuery("#0-lun-1").val() + '|' + jQuery("#1-lun-1").val() + '|' + jQuery("#2-lun-1").val() + '|' + jQuery("#3-lun-1").val() + '|';


    if (!$("#orario-continuato-2-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    martedi[i] = orario_continuato + '|' + jQuery("#0-mar-1").val() + '|' + jQuery("#1-mar-1").val() + '|' + jQuery("#2-mar-1").val() + '|' + jQuery("#3-mar-1").val() + '|';


    if (!$("#orario-continuato-3-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    mercoledi[i] = orario_continuato + '|' + jQuery("#0-mer-1").val() + '|' + jQuery("#1-mer-1").val() + '|' + jQuery("#2-mer-1").val() + '|' + jQuery("#3-mer-1").val() + '|';


    if (!$("#orario-continuato-4-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    giovedi[i] = orario_continuato + '|' + jQuery("#0-gio-1").val() + '|' + jQuery("#1-gio-1").val() + '|' + jQuery("#2-gio-1").val() + '|' + jQuery("#3-gio-1").val() + '|';


    if (!$("#orario-continuato-5-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    venerdi[i] = orario_continuato + '|' + jQuery("#0-ven-1").val() + '|' + jQuery("#1-ven-1").val() + '|' + jQuery("#2-ven-1").val() + '|' + jQuery("#3-ven-1").val() + '|';


    if (!$("#orario-continuato-6-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    sabato[i] = orario_continuato + '|' + jQuery("#0-sab-1").val() + '|' + jQuery("#1-sab-1").val() + '|' + jQuery("#2-sab-1").val() + '|' + jQuery("#3-sab-1").val() + '|';


    if (!$("#orario-continuato-7-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    domenica[i] = orario_continuato + '|' + jQuery("#0-dom-1").val() + '|' + jQuery("#1-dom-1").val() + '|' + jQuery("#2-dom-1").val() + '|' + jQuery("#3-dom-1").val() + '|';


    var nomi_eccellenza = [];
    var abilitato = [];
    var descrizioni_eccellenza = [];
    var z = 0;
    for (let i = 1; i <= num_services; i++) {
    nomi_eccellenza[z] = '';
    abilitato[z] = '';
    descrizioni_eccellenza[z] = '';
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    nomi_eccellenza[z] += jQuery("#nome-eccellenza-<?php echo $i;?>-" + i).val() + '||';
    abilitato[z] += jQuery("#abilitato-" + i).val() + '||';
    descrizioni_eccellenza[z] += jQuery("#descrizione-eccellenza-<?php echo $i;?>-" + i).summernote('code') + '||||';
    <?php } ?>
    z++;
}

    var immagine_eccellenze = [];
    for (let i = 1; i <= num_services; i++) {
    immagine_eccellenze.push($("#prws-immagine_eccellenza-" + i).next().attr("src"));

}

    if (is_error == false) {
    $.post("backoffice/api?use=addStruttura", {
    nome: nome,
    email: email,
    telefono: telefono,
    sito: sito,
    indirizzo: indirizzo,
    latitudine: latitudine,
    longitudine: longitudine,
    utente_abilitato: utente_abilitato,
    num_eccellenze: num_services,
    descrizioni_normali: descrizioni_normali,
    descrizione_benefit: descrizione_benefit,
    nomi_eccellenza: nomi_eccellenza,
    abilitato: abilitato,
    descrizioni_eccellenza: descrizioni_eccellenza,
    immagine_eccellenze: immagine_eccellenze,
    lunedi: lunedi,
    martedi: martedi,
    mercoledi: mercoledi,
    giovedi: giovedi,
    venerdi: venerdi,
    sabato: sabato,
    domenica: domenica,
    immagini_hotel: immagini_hotel,
    default_image: default_image,
    hotel_associati: hotel_associati,
    categorie_associate: categorie_associate,
    indicizza: indicizza,
    convenzionato: is_convenzionato,
    immagini_didascalia: immagini_didascalia,
    testi_didascalia: testi_didascalia,
    tipo_viaggio: tipo_viaggio
}).done(function (data) {
    //refreshView();
    if (data != 'error') {
    $(".notification-message").html(successo);
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();
    callback = 'facilities';
    var params = [];
    params[0] = '<?php echo $view_model->translations->get('link_strutture');?>';
    var jsonStringParams = JSON.stringify(params);
    openView(callback, params);
} else {
    //refreshView();
    $(".notification-message").html(failure);
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});

} else {
    $(".notification-message").html("Alcuni campi non sono compilati in modo corretto");
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
    $("#createStruttura").after("<span style=\"    color: red;padding: 5px 20px;border: 1px solid;margin: 0 15px;border-radius: 3px;\">Alcuni campi non sono corretti<span>");

}


});


    jQuery("#updateStruttura").on("click", function () {
    var successo = jQuery(this).attr("data-success");
    var failure = jQuery(this).attr("data-failure");

    var hotel_associati = [];
    var i = 0;

    $(".relHot").each(function () {
    hotel_associati[i] = $(this).attr("id");
    i++;
});

    //recupero recapiti
    var categorie_associate = [];
    var t = 0;

    $(".relCat").each(function () {
    categorie_associate[t] = $(this).attr("id");
    t++;
});
    var nome = $("#nome_struttura").val();
    var email = $("#email").val();
    var sito = $("#sito").val();
    var tipo_viaggio = $(".tipo_viaggio:checked").val();
    var telefono = $("#telefono").val();
    var indirizzo = $("#indirizzo").val();
    var latitudine = $("#latitudine").val();
    var longitudine = $("#longitudine").val();
    var id_struttura = $("#id_struttura").val();
    var immagini_hotel = [];
    var immagini_didascalia = [];
    var z = 0;

    $(".img-hotel").each(function () {
    src = $(this).attr("src");
    immagini_hotel.push(src);
})

    let k = 0;
    var testi_didascalia = '';
    $(".img-didascalia").each(function (i) {
    let id_testo = $(this).next().children().children().attr("id");
    let id_testo_new = id_testo.substr(id_testo.length - 1);

    let src = $(this).attr("src");
    immagini_didascalia.push(src);
    <?php
    for($i = 0;$i < sizeof($lingue);$i++) {
    ?>
    testi_didascalia += $("#testo-didascalia-<?php echo $lingue[$i]['shortcode_lingua'];?>-" + id_testo_new).val();
    testi_didascalia += '||';
    <?php } ?>
    testi_didascalia += '&&';
    k++;


})

    var descrizioni_normali
    = [];
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    descrizioni_normali.push($('#descrizione-ospiti-<?php echo $i;?>').summernote('code'));
    <?php } ?>
    <?php if($view_model->user->level > 2) { ?>
    var descrizione_benefit
    = [];
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    descrizione_benefit.push($('#descrizione-benefit-<?php echo $i;?>').summernote('code'));
    <?php } ?>
    <?php } else { ?>
    var descrizione_benefit = '';
    <?php } ?>



    var utente_abilitato = $("#abilitato-struttura").val();
    var indicizza = $("#indicizza").val();
    var is_convenzionato = $("#is_convenzionato").val();
    var default_image = undefined;

    $(".default-image").each(function (i) {
    if (this.checked)
    default_image = i + 1;
});
    var num_services = $("#num_eccellenze").val();

    var is_error = false;
    jQuery(".error_message").remove(); //rimuove tutti gli errori già visualizzati
    //Validazione email, se non passata mettere is_error = true
    if (default_image == undefined) {
    is_error = true;
    error_message = '<p>- Devi scegliere un\'immagine principale';
    jQuery("#preview-img-container").after('<div class="error_message">' + error_message + '</div>');
}
    if (!/^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/.test(sito)) {
    if (sito != '') {
    error_message = "<p>- Inserire un indirizzo web valido</p>";
    is_error = true;

    jQuery("#sito").after('<div class="error_message">' + error_message + '</div>');
}
}


    if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
    if (email != '') {
    error_message = "<p>- Inserire un indirizzo email valido</p>";
    is_error = true;

    jQuery("#email").after('<div class="error_message">' + error_message + '</div>');
}
}

    if (nome.length < 1) {
    error_message = "- Inserire un nome per la struttura";
    is_error = true;

    jQuery("#nome_struttura").after('<div class="error_message">' + error_message + '</div>');
}


    if (nome.length < 1) {
    error_message = "- Inserire un nome per la struttura";
    is_error = true;

    jQuery("#nome").after('<div class="error_message">' + error_message + '</div>');
}

    if (telefono.length < 9) {
    if (telefono != '') {
    error_message = "- Inserire un numero di telefono valido";
    is_error = true;

    jQuery("#telefono").after('<div class="error_message">' + error_message + '</div>');
}
}

    if (indirizzo.length < 1) {
    error_message = "- Inserire un indirizzo";
    is_error = true;

    jQuery("#indirizzo").after('<div class="error_message">' + error_message + '</div>');
}

    if (latitudine.length < 1) {
    error_message = "- Inserire la latitudine della struttura";
    is_error = true;

    jQuery("#latitudine").after('<div class="error_message">' + error_message + '</div>');
}

    if (longitudine.length < 1) {
    error_message = "- Inserire la longitudine della struttura";
    is_error = true;

    jQuery("#longitudine").after('<div class="error_message">' + error_message + '</div>');
}

    var z = 0;
    var lunedi = [];
    var martedi = [];
    var mercoledi = [];
    var giovedi = [];
    var venerdi = [];
    var sabato = [];
    var domenica = [];
    if (!$("#orario-continuato-1-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    lunedi[i] = orario_continuato + '|' + jQuery("#0-lun-1").val() + '|' + jQuery("#1-lun-1").val() + '|' + jQuery("#2-lun-1").val() + '|' + jQuery("#3-lun-1").val() + '|';


    if (!$("#orario-continuato-2-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    martedi[i] = orario_continuato + '|' + jQuery("#0-mar-1").val() + '|' + jQuery("#1-mar-1").val() + '|' + jQuery("#2-mar-1").val() + '|' + jQuery("#3-mar-1").val() + '|';


    if (!$("#orario-continuato-3-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    mercoledi[i] = orario_continuato + '|' + jQuery("#0-mer-1").val() + '|' + jQuery("#1-mer-1").val() + '|' + jQuery("#2-mer-1").val() + '|' + jQuery("#3-mer-1").val() + '|';


    if (!$("#orario-continuato-4-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    giovedi[i] = orario_continuato + '|' + jQuery("#0-gio-1").val() + '|' + jQuery("#1-gio-1").val() + '|' + jQuery("#2-gio-1").val() + '|' + jQuery("#3-gio-1").val() + '|';


    if (!$("#orario-continuato-5-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    venerdi[i] = orario_continuato + '|' + jQuery("#0-ven-1").val() + '|' + jQuery("#1-ven-1").val() + '|' + jQuery("#2-ven-1").val() + '|' + jQuery("#3-ven-1").val() + '|';


    if (!$("#orario-continuato-6-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    sabato[i] = orario_continuato + '|' + jQuery("#0-sab-1").val() + '|' + jQuery("#1-sab-1").val() + '|' + jQuery("#2-sab-1").val() + '|' + jQuery("#3-sab-1").val() + '|';


    if (!$("#orario-continuato-7-1").is(":checked"))
    var orario_continuato = 0;
    else
    var orario_continuato = 1;
    domenica[i] = orario_continuato + '|' + jQuery("#0-dom-1").val() + '|' + jQuery("#1-dom-1").val() + '|' + jQuery("#2-dom-1").val() + '|' + jQuery("#3-dom-1").val() + '|';


    var nomi_eccellenza = [];
    var abilitato = [];
    var descrizioni_eccellenza = [];
    var z = 0;
    for (let i = 1; i <= num_services; i++) {
    nomi_eccellenza[z] = '';
    abilitato[z] = '';
    descrizioni_eccellenza[z] = '';
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    nomi_eccellenza[z] += jQuery("#nome-eccellenza-<?php echo $i;?>-" + i).val() + '||';
    abilitato[z] += jQuery("#abilitato-" + i).val() + '||';
    descrizioni_eccellenza[z] += jQuery("#descrizione-eccellenza-<?php echo $i;?>-" + i).summernote('code') + '||||';
    <?php } ?>
    z++;
}

    var immagine_eccellenze = [];
    for (let i = 1; i <= num_services; i++) {
    immagine_eccellenze.push($("#prws-immagine_eccellenza-" + i).next().attr("src"));

}

    if (is_error == false) {
    $.post("backoffice/api?use=updateStruttura", {
    nome: nome,
    email: email,
    telefono: telefono,
    sito: sito,
    indirizzo: indirizzo,
    latitudine: latitudine,
    longitudine: longitudine,
    utente_abilitato: utente_abilitato,
    num_eccellenze: num_services,
    descrizioni_normali: descrizioni_normali,
    descrizione_benefit: descrizione_benefit,
    nomi_eccellenza: nomi_eccellenza,
    abilitato: abilitato,
    descrizioni_eccellenza: descrizioni_eccellenza,
    immagine_eccellenze: immagine_eccellenze,
    lunedi: lunedi,
    martedi: martedi,
    mercoledi: mercoledi,
    giovedi: giovedi,
    venerdi: venerdi,
    sabato: sabato,
    domenica: domenica,
    immagini_hotel: immagini_hotel,
    default_image: default_image,
    hotel_associati: hotel_associati,
    categorie_associate: categorie_associate,
    indicizza: indicizza,
    convenzionato: is_convenzionato,
    id_struttura: id_struttura,
    immagini_didascalia: immagini_didascalia,
    testi_didascalia: testi_didascalia,
    tipo_viaggio: tipo_viaggio
}).done(function (data) {
    //refreshView();
    if (data != 'error') {
    $(".notification-message").html(successo);
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();
} else {
    //refreshView();
    $(".notification-message").html(failure);
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});
} else {
    $(".notification-message").html("Alcuni campi non sono compilati in modo corretto");
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
    $("#updateStruttura").after("<span style=\"    color: red;padding: 5px 20px;border: 1px solid;margin: 0 15px;border-radius: 3px;\">Alcuni campi non sono corretti<span>");

}


});

    jQuery("#updateAffiliation").click(function () {
    var id_struttura = jQuery("#id_struttura").val();
    var successo = jQuery(this).attr("data-success");
    var failure = jQuery(this).attr("data-failure");
    var descrizione_benefit = [];
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    descrizione_benefit.push($('#descrizione-benefit-<?php echo $i;?>').summernote('code'));
    <?php } ?>

    $.post("backoffice/api?use=updateConvenzione", {parameters: descrizione_benefit, id_struttura: id_struttura})
    .done(function (data) {
    if (data != 'error') {
    $(".notification-message").html(successo);
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();

    refreshView();


} else {

    $(".notification-message").html(failure);
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});


});


    function setScriptTable() {
    $.post("backoffice/api?use=setScriptTable", {})
        .done(function (data) {
        })
        .fail(function (xhr, textStatus, errorThrown) {
        });
}


    jQuery("#updateEventoSmall").click(function () {

    var successo = jQuery(this).attr("data-success");
    var failure = jQuery(this).attr("data-failure");


    var id_evento = jQuery("#id_evento").val();

    var descrizione_benefit = [];

    var z = 0;
    <?php
    for($i = 1;$i < sizeof($lingue) + 1;$i++) {
    ?>
    descrizione_benefit.push($('#descrizione-ospiti-<?php echo $i;?>').summernote('code'));    <?php } ?>
    var is_error = false;
    jQuery(".error_message").remove(); //rimuove tutti gli errori già visualizzati


    if (is_error == false) {

    $.post("backoffice/api?use=updateEventoSmall", {
    descrizione_benefit: descrizione_benefit, id_evento: id_evento
})
    .done(function (data) {
    //refreshView();
    if (data != 'error') {
    $(".notification-message").html(successo);
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();
} else {
    //refreshView();
    $(".notification-message").html(failure);
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});
}
});


    $('.delHot').on("click", function () {
    if (!$(this).hasClass("doNow")) {
    var nome = $(this).text();
    $(this).text("Confermare eliminazione?");
    $(this).addClass("doNow");
} else {
    $(this).removeClass("doNow");
    var toFunction = jQuery(this).attr("data-function");
    var params = jQuery(this).attr("data-params");
    var callback = jQuery(this).attr("data-callback");
    var success = jQuery(this).attr("data-success");
    var fail = jQuery(this).attr("data-fail");
    var jsonStringParams = JSON.stringify(params);
    $.post("backoffice/api?use=" + toFunction, {parameters: jsonStringParams})
    .done(function (data) {

    if (data != 'error') {
    refreshView();
    $(".notification-message").html(success);
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();
} else {
    refreshView();
    $(".notification-message").html(fail);
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});

}
});


    $('.delStrutturaEvento').on("click", function () {
    if (!$(this).hasClass("doNow")) {
    var nome = $(this).text();
    $(this).text("Confermare eliminazione?");
    $(this).addClass("doNow");
} else {
    $(this).removeClass("doNow");
    var type = jQuery(this).attr("data-type");
    var id = jQuery(this).attr("data-id");
    var id_evento = jQuery(this).attr("data-id-evento");
    var callback = jQuery(this).attr("data-callback");
    var success = jQuery(this).attr("data-success");
    var fail = jQuery(this).attr("data-fail");
    $.post("backoffice/api?use=delRelatedStrutturaEvento", {type: type, id: id, id_evento: id_evento})
    .done(function (data) {

    if (data != 'error') {
    refreshView();
    $(".notification-message").html(success);
    $(".notification-message").removeClass("nm-error");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-success");
    $(".notification-message").fadeIn();
} else {
    refreshView();
    $(".notification-message").html(fail);
    $(".notification-message").removeClass("nm-success");
    $(".notification-message").removeClass("nm-info");
    $(".notification-message").addClass("nm-error");
    $(".notification-message").fadeIn();
}
})
    .fail(function (xhr, textStatus, errorThrown) {
    $(".content-ajax").html('<div class="error_message">Errore</div>');
});

}
});

</script>
