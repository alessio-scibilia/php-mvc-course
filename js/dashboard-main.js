jQuery(document).ready(function () {
    var main_wrapper = document.getElementById("main-wrapper");
    if (main_wrapper) {
        var debug = jQuery(main_wrapper).data('debug');
        openViewParseURL(window.location.pathname, debug, true);
    }
});

function navigate() {
    jQuery(".notification-message").fadeOut();
    var action = jQuery(this).attr("data-action");
    var params = jQuery(this).attr("data-params");
    var debug = jQuery(this).data("debug");
    var title = jQuery(this).attr("data-title");

    var urls = getUrlsFromAction(action, params, debug);

    window.history.pushState({ title, url: urls.url, debug }, title, urls.url);

    $(document).prop("title", title);

    openView(urls.api_url, false);
}

// jQuery(".open-view-action").click(navigate);
jQuery(".open-view-action").click(function (e) {
    let url = jQuery(e.target)
        .closest('a')
        .attr('href');
    window.setTimeout(function () { window.location.assign(url); }, 500);
    return false;
})

jQuery(document).on("click",".open-view-action-inside", navigate);

$(window).bind("popstate", function (e) {
    var state = e.originalEvent.state;
    if (state === null) {
        openView("/dashboard", false,true);
    } else {
        openViewParseURL(window.location.pathname, state.debug,false);
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

jQuery(document).on("click", ".open-create-service", function () {
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

jQuery(document).on("click", "#calcGPS", function () {
    var indirizzo = jQuery("#indirizzo").val();
    var indirizzo = JSON.stringify(indirizzo);
    $.post("process/getPosizione?address=" + indirizzo, {parameters: indirizzo})
        .done(function (data) {
            if (data != 'error') {
                var latlon = data.split(',');
                $("#latitudine").val(latlon[0]);
                $("#longitudine").val(latlon[1]);
                $("#longitudine").trigger("click");
                jQuery("#hidden-maps").trigger("click");

            } else {

            }
        })
        .fail(function (xhr, textStatus, errorThrown) {
            //$(".content-ajax").html('<div class="error_message">Errore</div>');
        });
});

let map;
var marker;

function initMap() {
    var myLatlng = {lat: 44.363, lng: 8.044};
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: myLatlng,
    });
    var lon = document.getElementById("indirizzo");
    var calcGPS = document.getElementById("hidden-maps");
    // Create the initial InfoWindow.


    var lat = parseFloat(jQuery("#latitudine").val());
    var lng = parseFloat(jQuery("#longitudine").val());
    var latlon = '(' + lat + ',' + lng + ')';
    map.setCenter(new google.maps.LatLng(lat, lng));
    map.setZoom(13);
    marker = [];
    marker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        map: map,

        title: ''
    });

    // Configure the click listener.
    calcGPS.addEventListener("click", function () {
        marker.setMap(null);

        var lat = parseFloat(jQuery("#latitudine").val());
        var lng = parseFloat(jQuery("#longitudine").val());
        var latlon = '(' + lat + ',' + lng + ')';
        map.setCenter(new google.maps.LatLng(lat, lng));
        map.setZoom(13);
        marker = [];
        marker = new google.maps.Marker({
            position: {lat: lat, lng: lng},
            map: map,

            title: ''
        });

    });


    map.addListener("click", (mapsMouseEvent) => {
        // Close the current InfoWindow.
        //infoWindow.close();
        if (typeof infoWindow != "undefined")
            infoWindow.close();
        // Create a new InfoWindow.
        infoWindow = new google.maps.InfoWindow({
            position: mapsMouseEvent.latLng,
        });
        var coordinate = mapsMouseEvent.latLng.toJSON();
        jQuery("#latitudine").val(coordinate.lat);
        jQuery("#longitudine").val(coordinate.lng);
        infoWindow.setContent(
            JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
        );
        infoWindow.open(map);
    });


}


jQuery(document).on("change", ".immagine_servizio", function () {

    var id = $(this).attr("id");
    var form_data = new FormData();

    // Read selected files
    var totalfiles = document.getElementById(id).files.length;
    for (var index = 0; index < totalfiles; index++) {
        form_data.append("immagini_form[]", document.getElementById(id).files[index]);
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

            for (var index = 0; index < response.length; index++) {
                var src = response[index];
                $("#preview-" + id).html("");
                // Add img element in <div id='preview'>
                $('#preview-' + id).append('<div class="img-form-preview" id="ifps-prws-' + id + '"><span class="delete-preview" id="prws-' + id + '" onclick="delPreviewServizi(\'' + id + '\')"><i class="fa fa-close"></i></span><img class="img-form-preview-item" src="' + src + '" height="200px"><div class="default-image-cont"></div>');

            }
            $(".notification-message").fadeOut();

        }
    });


});


jQuery(document).on("change", ".immagine_eccellenza", function () {

    var id = $(this).attr("id");
    var form_data = new FormData();

    // Read selected files
    var totalfiles = document.getElementById(id).files.length;
    for (var index = 0; index < totalfiles; index++) {
        form_data.append("immagini_form[]", document.getElementById(id).files[index]);
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

            for (var index = 0; index < response.length; index++) {
                var src = response[index];
                $("#preview-" + id).html("");
                // Add img element in <div id='preview'>
                $('#preview-' + id).append('<div class="img-form-preview" id="ifps-prws-' + id + '"><span class="delete-preview" id="prws-' + id + '" onclick="delPreviewEccellenza(\'' + id + '\')"><i class="fa fa-close"></i></span><img class="img-form-preview-item" src="' + src + '" height="200px"><div class="default-image-cont"></div>');

            }
            $(".notification-message").fadeOut();

        }
    });


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

jQuery(document).on("changed.bs.select", ".selectpicker", function (e, clickedIndex, isSelected, previousValue) {
    var val = $(this).val();
    var nome = $(".selectpicker :selected").text();
    $("#relatedHotels").append('<a href="javascript:void()" class="tagit2 relHot isRelatedToShow-' + val + '" onclick="removeRelatedHotel(' + val + ')" id="' + val + '">' + nome + ' <i class="fa fa-close"></i></a>');
    $("#relatedHotels").append('<input type="hidden" value="' + val + '" class="isRelatedTo-' + val + '">');
});
jQuery(document).on("changed.bs.select", ".selectpicker1", function (e, clickedIndex, isSelected, previousValue) {
    var val = $(this).val();
    var nome = $(".selectpicker1 :selected").text();
    $("#relatedCat").append('<a href="javascript:void()" class="tagit2 relCat relatedCat-' + val + '" id="' + val + '" onclick="removeRelatedCat(' + val + ')">' + nome + ' <i class="fa fa-close"></i></a>');
    $("#relatedCat").append('<input type="hidden" value="' + val + '" class="cat-' + val + '">');
});
jQuery(document).on("changed.bs.select", ".selectpicker3", function (e, clickedIndex, isSelected, previousValue) {
    var val = $(this).val();
    var nome = $(".selectpicker3 :selected").text();
    $("#relatedCat").append('<a href="javascript:void()" class="tagit2 relCat relatedCat-' + val + '" id="' + val + '" onclick="removeRelatedCat(\'' + val + '\')">' + nome + '<i class="fa fa-close"></i></a>');
    $("#relatedCat").append('<input type="hidden" value="' + val + '" class="cat-' + val + '">');
});


jQuery(document).on("click", "#recupera", function () {
    $("#dati_struttura_evento").fadeToggle();
});

jQuery(document).on("click", "#recupera_convenzione", function () {
    $("#rec-conv").fadeToggle();
});

jQuery(document).on("click", ".orario-continuato", function () {
    if ($(this).is(":checked")) {
        $(this).parent().parent().next().next().children().children().attr("disabled", "disabled");
    } else
        $(this).parent().parent().next().next().children().children().removeAttr("disabled");
});






