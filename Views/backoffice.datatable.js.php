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
    /**
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
    **/


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


    function setScriptTable() {
    $.post("backoffice/api?use=setScriptTable", {})
        .done(function (data) {
        })
        .fail(function (xhr, textStatus, errorThrown) {
        });
}


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
