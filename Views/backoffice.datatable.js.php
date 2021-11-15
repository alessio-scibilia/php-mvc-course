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

    jQuery(document).on("click", ".save-servizio", function () {

    var items_service = $("#num_services").val();
    var items_next = parseInt(items_service) + 1;
    jQuery("#num_services").val(items_next);

    let $last = jQuery(".form-service-container").last();
    var form = $last.clone();
    $last.after(form);

    if (items_service > 0) {
        // div[class^='apple-'],div[class*=' apple-']
        $("[class^='annulla-',[class*=' annulla-']").prop('disabled', false);

        $last.find("#abilitato-" + items_service).attr("id", "abilitato-" + items_next);
        $last.find("#servizio-" + items_service).attr("id", "servizio-" + items_next);
        $last.find("#select-language-servizi").attr("data-form-index", items_next);
        $last.find("#annulla-servizio-" + items_service).attr("id", "annulla-servizio-" + items_next);
        $last.attr("id", "servizio-" + items_next);

        jQuery(".form-service-container").fadeIn();

        // SI: vanno lasciati perché hanno "fsc-*" che è < 4 caratteri!
        $last.attr("class", " form-service-container fsc-" + items_next);
        $last.attr("id", "fsc-servizio-" + items_next);

        $last.find("[name]").each(function() {
            let name = $(this).attr("name");
            let regex = /^([^\d]+)(\d+)(.*)$/;
            let replacer = `$1${items_next}$3`;
            let next = name.replace(regex, replacer);
            $(this).attr("name", next);
        });

        // class and id end with /-\d+$/
        $last.find("[id]").each(function() {
            let id = $(this).attr("id");
            let regex = /^(.+)(-\d+)$/;
            let replacer = `$1-${items_next}`;
            let next = id.replace(regex, replacer);
            $(this).attr("id", next);
        });
        var $targets = $last.find("[class]").filter(function() {
            let classes = $(this).attr("class").split(' ');
            let regex = /^([^-]{4,}-)+\d+$/;
            let matches = classes.filter(function (c) {return c.match(regex);} );
            return matches.length > 0;
        });
        $targets.each(function() {
            let classes = $(this).attr("class").split(' ');
            let regex = /^(.+)(-\d+)$/;
            let replacer = `$1-${items_next}`;
            let new_classes = classes.map(function(c) {return c.replace(regex, replacer);});
            let next = new_classes.join(' ');
            $(this).attr("class", next);
        });

        var offset = jQuery("#servizio-" + items_next).offset().top;
        offset = offset;
        $('html,body').animate({ scrollTop: offset }, 'slow');
    }
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

    //TODO final combinazione con script precedente
    jQuery(document).on("click", ".save-utility", function () {

    var item_utility = $("#num_utilities").val();
    var items_next = parseInt(item_utility) + 1;
    jQuery("#num_utilities").val(items_next);

    let $last = jQuery(".form-utility-container").last();
    var form = $last.clone();
    $last.after(form);

    if (item_utility >= 0) {
    $last.find("#utility-" + item_utility).attr("id", "utility-" + items_next);
    $last.find("#select-language-utilities").attr("data-form-index", items_next);
    $last.find("#annulla-utility-" + item_utility).attr("id", "annulla-utility-" + items_next);
    $last.attr("id", "utility-" + items_next);

    jQuery(".form-utility-container").fadeIn();

    // SI: vanno lasciati perché hanno "fsc-*" che è < 4 caratteri!
    $last.attr("class", " form-utility-container fsu-" + items_next);
    $last.attr("id", "fsu-utility-" + items_next);

    $last.find("[name]").each(function() {
    let name = $(this).attr("name");
    let regex = /^([^\d]+)(\d+)(.*)$/;
    let replacer = `$1${items_next}$3`;
    let next = name.replace(regex, replacer);
    $(this).attr("name", next);
});

    // class and id end with /-\d+$/
    $last.find("[id]").each(function() {
    let id = $(this).attr("id");
    let regex = /^(.+)(-\d+)$/;
    let replacer = `$1-${items_next}`;
    let next = id.replace(regex, replacer);
    $(this).attr("id", next);
});
    $last.find("[class]").filter(function() {
    let classes = $(this).attr("class").split(' ');
    let regex = /^([^-]{4,}-)+\d+$/;
    let matches = classes.filter(function (c) {return c.match(regex);} );
    return matches.length > 0;
})
    .each(function() {
    let classes = $(this).attr("class").split(' ');
    let regex = /^(.+)(-\d+)$/;
    let replacer = `$1-${items_next}`;
    let new_classes = classes.map(function(c) {return c.replace(regex, replacer);});
    let next = new_classes.join(' ');
    $(this).attr("class", next);
});

    var offset = jQuery("#utility-" + items_next).offset().top;
    offset = offset;
    $('html,body').animate({
    scrollTop: offset
}, 'slow');

}
});


    jQuery(document).on("click",".save-eccellenza",function() {
    var items_eccellenza = $(".form-eccellenza-container").length;
    items_next = items_eccellenza+1;
    jQuery("#num_eccellenze").val(items_next);
    let $last = jQuery(".form-eccellenza-container").last();
    var form = $last.clone();
    $last.after(form);
    if(items_eccellenza >= 0) {
    jQuery(".form-eccellenza-container").last().find("#abilitato-"+items_eccellenza).attr("id","abilitato-"+items_next);
    jQuery(".form-eccellenza-container").last().find("#eccellenza-"+items_eccellenza).attr("id","eccellenza-"+items_next);
    jQuery(".form-eccellenza-container").last().find("#select-nome-eccellenze").attr("data-form-index",items_next);
    jQuery(".form-eccellenza-container").last().find("#annulla-eccellenza-"+items_eccellenza).attr("id","annulla-eccellenza-"+items_next);
    jQuery(".form-eccellenza-container").last().attr("id","eccellenza-"+items_next);

    jQuery(".form-eccellenza-container").fadeIn();

    // SI: vanno lasciati perché hanno "fsc-*" che è < 4 caratteri!
    $last.attr("class", " form-eccellenza-container fsc-" + items_next);
    $last.attr("id", "fsc-eccellenza-" + items_next);

    $last.find("[name]").each(function() {
    let name = $(this).attr("name");
    let regex = /^([^\d]+)(\d+)(.*)$/;
    let replacer = `$1${items_next}$3`;
    let next = name.replace(regex, replacer);
    $(this).attr("name", next);
});

    // class and id end with /-\d+$/
    $last.find("[id]").each(function() {
    let id = $(this).attr("id");
    let regex = /^(.+)(-\d+)$/;
    let replacer = `$1-${items_next}`;
    let next = id.replace(regex, replacer);
    $(this).attr("id", next);
});
    $last.find("[class]").filter(function() {
    let classes = $(this).attr("class").split(' ');
    let regex = /^([^-]{4,}-)+\d+$/;
    let matches = classes.filter(function (c) {return c.match(regex);} );
    return matches.length > 0;
})
    .each(function() {
    let classes = $(this).attr("class").split(' ');
    let regex = /^(.+)(-\d+)$/;
    let replacer = `$1-${items_next}`;
    let new_classes = classes.map(function(c) {return c.replace(regex, replacer);});
    let next = new_classes.join(' ');
    $(this).attr("class", next);
});

    var offset = jQuery("#eccellenza-"+items_next).offset().top;
    offset = offset-100;
    $('html,body').animate({
    scrollTop: offset
}, 'slow');

    jQuery(".form-eccellenza-container").last().attr("class"," form-eccellenza-container fsc-"+items_next);
    jQuery(".form-eccellenza-container").last().attr("id","fsc-eccellenza-"+items_next);
    jQuery(".form-eccellenza-container").last().find("#immagine_eccellenza-"+items_eccellenza).attr("id","immagine_eccellenza-"+items_next);
    jQuery(".form-eccellenza-container").last().find("#ifps-prws-immagine_eccellenza-"+items_eccellenza).attr("id","ifps-prws-immagine_eccellenza-"+items_next);
    jQuery(".form-eccellenza-container").last().find("#prws-immagine_eccellenza-"+items_eccellenza).attr("id","prws-immagine_eccellenza-"+items_next);
    jQuery(".form-eccellenza-container").last().find("#prws-immagine_eccellenza-"+items_next).attr("onclick","delPreviewServizi('immagine_eccellenza-"+items_next+"')");
    jQuery(".form-eccellenza-container").last().find("#preview-immagine_eccellenza-"+items_eccellenza).attr("id","preview-immagine_eccellenza-"+items_next);

}});

</script>
