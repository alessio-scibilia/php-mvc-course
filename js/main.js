/*
	Questa funzione crea un set predefinito di regole per la validazione dei campi lato
	frontend, per eseguirla basta applicare al bottone submit del form da analizzare la classe "validate-it", e un campo id="validate-#" dove
	# corrisponde al numero del form rispetto agli altri da analizzare (es ci sono due form? il primo submit avrà id="validate-1" e il secondo "validate-2")
	bisogna anche applicare la classe "validate-#" (uguale al nome del campo id del form), negli elementi (input,textarea ecc) da analizzare all'interno del form
*/
var using = false;

function hideEasy(hide_or_display) {

    if (hide_or_display == 'hide') {
        jQuery(".display-ease-in").addClass("hide-ease-in");
        jQuery(".display-ease-in").removeClass("display-ease-in");
    } else if (hide_or_display == 'display') {
        jQuery(".display-ease-in").addClass("hide-ease-in");
        jQuery(".display-ease-in").removeClass("display-ease-in");
    }
}


function delPreview(id) {
    id = 'prw-' + id;
    jQuery("#ifp-" + id).hide(function () {
        jQuery("#ifp-" + id).remove();
        jQuery("#immagini_form").val(null);
    });
}

function delPreviewDidascalie(id) {
    id = 'prw-' + id;
    jQuery("#ifp-" + id).hide(function () {
        jQuery("#ifp-" + id).remove();
        jQuery("#immagini_form").val(null);
    });
}


function delPreviewEccellenza(id) {
    id = 'prws-' + id;
    jQuery("#ifps-" + id).hide(function () {
        jQuery("#ifps-" + id).remove();
    });
}

function delPreviewServizi(id) {
    id = 'prws-' + id;
    jQuery("#ifps-" + id).hide(function () {
        jQuery("#ifps-" + id).remove();
    });
}


$(document).click(function (event) {
    var $target = $(event.target);
    if (!$target.closest('.toConfirm').length) {
        $('.toConfirm').html('<i class="fa fa-trash"></i>');
        $('.toConfirm').removeClass('toConfirm');

    }
});


jQuery(".validate-it").click(function (e) {
        e.preventDefault;

        jQuery(".error_message").remove(); //rimuove tutti gli errori già visualizzati
        jQuery(".related_item-hidden").remove();
        jQuery(".img_hidden").remove();


        if (jQuery("#recupera").length && jQuery("#recupera").is(":checked"))
            var recupera = 1;
        else
            var recupera = 0;

        if (jQuery("#recupera_convenzione").length && jQuery("#recupera_convenzione").is(":checked"))
            var recupera_convenzione = 1;
        else
            var recupera_convenzione = 0;


        var strutture_associate = [];
        var t = 0;

        if (jQuery(".relCat").length) {
            $(".relCat").each(function () {
                strutture_associate[t] = $(this).attr("id");

                t++;
            });
        }

        if (jQuery("#nome_struttura").length)
            var nome_struttura = jQuery("#nome_struttura").val();

        if (jQuery("#nome_evento").length)
            var nome_evento = jQuery("#nome_evento").val();

        if (jQuery("#email").length)
            var email = jQuery("#email").val();

        if (jQuery("#sito").length)
            var sito = jQuery("#sito").val();

        if (jQuery("#telefono").length)
            var telefono = jQuery("#telefono").val();

        if (jQuery("#indirizzo").length)
            var indirizzo = jQuery("#indirizzo").val();

        if (jQuery("#latitudine").length)
            var latitudine = jQuery("#latitudine").val();

        if (jQuery("#longitudine").length)
            var longitudine = jQuery("#longitudine").val();

        if (jQuery("#data_inizio").length)
            var data_inizio = jQuery("#data_inizio").val();

        if (jQuery("#ora_inizio").length)
            var ora_inizio = jQuery("#ora_inizio").val();

        if (jQuery("#data_fine").length)
            var data_fine = jQuery("#data_fine").val();

        if (jQuery("#ora_fine").length)
            var ora_fine = jQuery("#ora_fine").val();

        if (jQuery(".img_evento").length) {
            var img_evento = jQuery(".img_evento").attr("src");
            $(jQuery("#preview").append('<input type="hidden" name="img_evento" class="img_hidden" value="' + img_evento + '">'));
        }


        $(".summernote").each(function () {
            $(this).val($(this).code());
        });

        var is_error = false;


        jQuery(".error_message").remove(); //rimuove tutti gli errori già visualizzati

        if (data_inizio == "" || data_inizio == undefined) {
            error_message = "- Inserire una data";
            is_error = true;
            jQuery("#data_inizio").after('<div class="error_message">' + error_message + '</div>');
        }

        if (ora_inizio == "" || ora_inizio == undefined) {
            error_message = "- Inserire un' ora";
            is_error = true;

            jQuery("#ora_inizio").after('<div class="error_message">' + error_message + '</div>');
        }

        if (data_fine == "" || data_fine == undefined) {
            error_message = "- Inserire una data";
            is_error = true;
            jQuery("#data_fine").after('<div class="error_message">' + error_message + '</div>');
        }

        if (ora_fine == "" || ora_fine == undefined) {
            error_message = "- Inserire un' ora";
            is_error = true;

            jQuery("#ora_fine").after('<div class="error_message">' + error_message + '</div>');
        }

        if (nome_evento.length < 1) {
            error_message = "- Inserire un nome per l'evento";
            is_error = true;

            jQuery("#nome_evento").after('<div class="error_message">' + error_message + '</div>');
        }

        if (recupera != 1) {
            //Validazione email, se non passata mettere is_error = true
            if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email)) {
                if (email != '') {
                    error_message = "<p>- Inserire un indirizzo email valido</p>";
                    is_error = true;

                    jQuery("#email").after('<div class="error_message">' + error_message + '</div>');
                }
            }


            if (!/^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/.test(sito)) {
                if (sito != '') {
                    error_message = "<p>- Inserire un indirizzo web valido</p>";
                    is_error = true;

                    jQuery("#sito").after('<div class="error_message">' + error_message + '</div>');
                }
            }


            if (nome_struttura.length < 1) {
                error_message = "- Inserire un nome per la struttura";
                is_error = true;

                jQuery("#nome_struttura").after('<div class="error_message">' + error_message + '</div>');
            }

            if (telefono.length < 9) {
                if (telefono != '') {
                    error_message = "- Inserire un numero di telefono";
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
                error_message = "- Inserire la latitudine dell'hotel";
                is_error = true;

                jQuery("#latitudine").after('<div class="error_message">' + error_message + '</div>');
            }

            if (longitudine.length < 1) {
                error_message = "- Inserire la longitudine dell'hotel";
                is_error = true;

                jQuery("#longitudine").after('<div class="error_message">' + error_message + '</div>');
            }
        }

        if (is_error == false) {
            alert();
        } else {
            $(".notification-message").html("Alcuni campi non sono compilati in modo corretto");
            $(".notification-message").removeClass("nm-error");
            $(".notification-message").removeClass("nm-info");
            $(".notification-message").addClass("nm-error");
            $(".notification-message").fadeIn();
            $(this).after("<span style=\"    color: red;padding: 5px 20px;border: 1px solid;margin: 0 15px;border-radius: 3px;\">Alcuni campi non sono corretti<span>");
            return false;
        }
    }
)
;



