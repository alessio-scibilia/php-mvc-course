// jQuery(".open-view-action").click(navigate);
jQuery(".open-view-action").click(function (e) {
    let url = jQuery(e.target)
        .closest('a')
        .attr('href');
    window.setTimeout(function () {
        window.location.assign(url);
    }, 500);
    return false;
})

$(window).bind("popstate", function (e) {
    var state = e.originalEvent.state;
    if (state === null) {
        openView("/dashboard", false, true);
    } else {
        openViewParseURL(window.location.pathname, state.debug, false);
    }
});

jQuery(document).on("click", ".view-action", function () {
    //refreshView();
    if ($(this).hasClass("btn-danger")) {
        var isDelete = true;
    } else var isDelete = false;

    if (isDelete == true) {
        if (!$(this).hasClass("toConfirm")) {
            var deleteNext = true;
            $(this).addClass("toConfirm");
            $(this).html("Confermare eliminazione?");
        } else {
            var deleteNext = false;
            isDelete = false;
        }
    }
    var toFunction = jQuery(this).attr("data-function");
    var params = jQuery(this).attr("data-params");
    var callback = jQuery(this).attr("data-callback");
    var success = jQuery(this).attr("data-success");
    var fail = jQuery(this).attr("data-fail");
    var jsonStringParams = JSON.stringify(params);
    if (deleteNext == false) {
        $.post("functions/api?use=" + toFunction, {parameters: jsonStringParams})
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

jQuery(".open-create-service").click(function () {
    jQuery(".form-service-container").fadeIn();
    var val = jQuery("#num_services").val();
    val++;
    jQuery("#num_services").val(val);
    var offset = jQuery(".form-service-container").offset().top;
    offset = offset - 100;
    $('html,body').animate({
        scrollTop: offset
    }, 'slow');
});
jQuery(document).on("click", ".open-create-eccellenza", function () {
    if (jQuery("#num_eccellenze").val() == 0) {
        jQuery(".form-eccellenza-container-container").fadeIn();
        var val = jQuery("#num_eccellenze").val();
        $(".fsc-1").fadeIn();
        val++;
        jQuery("#num_eccellenze").val(val);
        var offset = jQuery(".form-service-container").offset().top;
        offset = offset - 100;
        $('html,body').animate({
            scrollTop: offset
        }, 'slow');
    }
});


jQuery(document).on("change", "#select-language", function () {
    var shortcode_lingua = jQuery(this).val();
    jQuery(".descrizione_ospiti").hide();
    jQuery("#descrizione_ospiti-" + shortcode_lingua).fadeIn();
});
jQuery(document).on("change", "#select-language-desc-evento", function () {
    var shortcode_lingua = jQuery(this).val();
    jQuery(".descrizione_evento").hide();
    jQuery("#descrizione_evento-" + shortcode_lingua).fadeIn();
});
jQuery(document).on("change", "#select-language-benefit", function () {
    var shortcode_lingua = jQuery(this).val();
    jQuery(".descrizione_benefit").hide();
    jQuery("#descrizione_benefit-" + shortcode_lingua).fadeIn();
});

jQuery(document).on("change", "#select-nome-servizi", function () {
    var shortcode_lingua = jQuery(this).val();
    var form_index = jQuery(this).attr("data-form-index");
    jQuery(".nome-servizi-" + form_index).hide();
    jQuery("#nome_servizio-" + shortcode_lingua + '-' + form_index).fadeIn();
});
jQuery(document).on("change", "#select-language-servizi", function () {
    var shortcode_lingua = jQuery(this).val();
    var form_index = jQuery(this).attr("data-form-index");
    jQuery(".descrizione_servizi-" + form_index).hide();
    jQuery("#descrizione-" + shortcode_lingua + '-' + form_index).fadeIn();
});


jQuery(document).on("change", "#select-nome-eccellenze", function () {
    var shortcode_lingua = jQuery(this).val();
    var form_index = jQuery(this).attr("data-form-index");
    jQuery(".nome_eccellenze-" + form_index).hide();
    jQuery("#nome-eccellenza-" + shortcode_lingua + '-' + form_index).fadeIn();
});


jQuery(document).on("click", ".annulla-servizio", function () {
    var id = jQuery(this).attr("id");
    if (jQuery("#num_services").val() > 1) {
        var prec = jQuery("#num_services").val();
        var less = prec - 1;
        jQuery("#num_services").val(less);
        jQuery("#fsc-" + id).remove();
    } else if (id == 'servizio-1' && jQuery("#num_services").val() == 1) {
        var prec = jQuery("#num_services").val();
        var less = 0;
        jQuery("#num_services").val(less);
        jQuery(".form-service-container").hide();
    }
});

jQuery(document).on("click", ".annulla-eccellenza", function () {
    var id = jQuery(this).attr("id");
    if (jQuery("#num_eccellenze").val() > 1) {
        var prec = jQuery("#num_eccellenze").val();
        var less = prec - 1;
        jQuery("#num_eccellenze").val(less);
        jQuery("#fsc-" + id).remove();
    } else if (id == 'eccellenza-1' && jQuery("#num_eccellenze").val() == 1) {
        var prec = jQuery("#num_eccellenze").val();
        var less = 0;
        jQuery("#num_eccellenze").val(less);
        jQuery(".form-eccellenze-container").hide();
    }
});


jQuery(document).on("click", ".annulla-utility", function () {
    var id = jQuery(this).attr("id");
    if (jQuery("#num_utilities").val() > 1) {
        var prec = jQuery("#num_utilities").val();
        var less = prec - 1;
        jQuery("#num_utilities").val(less);
        jQuery("#fsu-" + id).remove();
    } else if (id == 'utility-1' && jQuery("#num_utilities").val() == 1) {
        var prec = jQuery("#num_utilities").val();
        var less = 0;
        jQuery("#num_utilities").val(less);
        jQuery(".form-utility-container").hide();
    }
});

jQuery(document).on("click", ".annulla-eccellenza", function () {
    var id = jQuery(this).attr("id");
    if (jQuery("#num_eccellenze").val() > 1) {
        var prec = jQuery("#num_eccellenze").val();
        var less = prec - 1;
        jQuery("#num_eccellenze").val(less);
        jQuery("#fsc-" + id).remove();
    } else if (id == 'eccellenza-1' && jQuery("#num_eccellenze").val() == 1) {
        var prec = jQuery("#num_eccellenze").val();
        var less = 0;
        jQuery("#num_eccellenze").val(less);
        jQuery(".form-eccellenza-container").hide();
    }
});


function removeRelatedHotel(val) {
    $(".isRelatedTo-" + val).slideDown();
    $(".isRelatedToShow-" + val).slideDown();
    $(".isRelatedTo-" + val).remove();
    $(".isRelatedToShow-" + val).remove();
}

function removeRelatedCat(val) {
    $(".cat-" + val).slideDown();
    $(".relatedCat-" + val).slideDown();
    $(".cat-" + val).remove();
    $(".relatedCat-" + val).remove();
}

jQuery(document).on("changed.bs.select", ".selectpicker, .selectpicker1, .selectpicker3", function (e, clickedIndex, isSelected, previousValue) {
    let val = jQuery(this).val();
    let nome_campo = jQuery(this).data('name');

    switch (nome_campo) {
        case 'related_hotels':
            var classe_ancora = 'relHot';
            var id_append = '#relatedHotels';
            var classe_ancora_2 = 'isRelatedToShow-' + val;
            var onclick_function = 'removeRelatedHotel(' + val + ')';
            var class_hidden = 'isRelatedTo-' + val;
            var nome = jQuery(".selectpicker :selected").text();
            break;
        case 'related_categories':
            var classe_ancora = 'relCat';
            var id_append = '#relatedCat';
            var classe_ancora_2 = 'relatedCat-' + val;
            var onclick_function = 'removeRelatedHotel(' + val + ')';
            var class_hidden = 'cat-' + val;
            var nome = jQuery(".selectpicker1 :selected").text();


            break;
        case 'related_item':
            var classe_ancora = 'relCat';
            var id_append = '#relatedCat';
            var classe_ancora_2 = 'relatedCat-' + val;
            var onclick_function = 'cat(' + val + ')';
            var class_hidden = 'cat-' + val;
            var nome = jQuery(".selectpicker3 :selected").text();
            break;
    }

    $(id_append).append('<a href="javascript:void()" class="tagit2 ' + classe_ancora + ' ' + classe_ancora_2 + '" onclick="' + onclick_function + '" id="' + val + '">' + nome + ' <i class="fa fa-close"></i></a>');
    $(id_append).append('<input type="hidden" name=' + nome_campo + '[]" value="' + val + '" class="' + class_hidden + '">');

});
/*
jQuery(document).on("changed.bs.select", ".selectpicker", function (e, clickedIndex, isSelected, previousValue) {
    var val = $(this).val();
    var nome = $(".selectpicker :selected").text();
    $("#relatedHotels").append('<a href="javascript:void()" class="tagit2 relHot isRelatedToShow-' + val + '" onclick="removeRelatedHotel(' + val + ')" id="' + val + '">' + nome + ' <i class="fa fa-close"></i></a>');
    $("#relatedHotels").append('<input type="hidden" name="hotel_associati[]" value="' + val + '" class="isRelatedTo-' + val + '">');
});

jQuery(document).on("changed.bs.select", ".selectpicker1", function (e, clickedIndex, isSelected, previousValue) {
    var val = $(this).val();
    var nome = $(".selectpicker1 :selected").text();
    $("#relatedCat").append('<a href="javascript:void()" class="tagit2 relCat relatedCat-' + val + '" id="' + val + '" onclick="removeRelatedCat(' + val + ')">' + nome + ' <i class="fa fa-close"></i></a>');
    $("#relatedCat").append('<input type="hidden" name="strutture_associate[]" value="' + val + '" class="cat-' + val + '">');
});

jQuery(document).on("changed.bs.select", ".selectpicker3", function (e, clickedIndex, isSelected, previousValue) {
    var val = $(this).val();
    var nome = $(".selectpicker3 :selected").text();
    $("#relatedCat").append('<a href="javascript:void()" class="tagit2 relCat relatedCat-' + val + '" id="' + val + '" onclick="removeRelatedCat(\'' + val + '\')">' + nome + '<i class="fa fa-close"></i></a>');
    $("#relatedCat").append('<input type="hidden" name="related_item[]" value="' + val + '" class="cat-' + val + '">');
});
*/

jQuery(document).on("click", "#recupera", function () {
    $("#dati_struttura_evento").fadeToggle();
});

jQuery(document).on("click", "#recupera_convenzione", function () {
    $("#rec-conv").fadeToggle();
});

jQuery(document).on("click", ".orario-continuato", function () {
    $targets = $(this).parent().parent().next().next().children().children();
    if ($(this).is(":checked")) {
        $targets.val('');
        $targets.prop("disabled", true);
    } else {
        $targets.prop("disabled", false);
    }
});
