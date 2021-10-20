
/* 
	Questa funzione crea un set predefinito di regole per la validazione dei campi lato
	frontend, per eseguirla basta applicare al bottone submit del form da analizzare la classe "validate-it", e un campo id="validate-#" dove
	# corrisponde al numero del form rispetto agli altri da analizzare (es ci sono due form? il primo submit avrà id="validate-1" e il secondo "validate-2")
	bisogna anche applicare la classe "validate-#" (uguale al nome del campo id del form), negli elementi (input,textarea ecc) da analizzare all'interno del form
*/
var using = false;


jQuery(".validate-it").on('click', function(e) {
	e.preventDefault();
	console.log(id);
	var id = jQuery(this).attr("id");
	if(id != undefined) {
	var classToValidate = '.'+id;

	var is_error = false; //se alla fine del controllo è ancora false viene inviata la richiesta di submit del form

	var error_message = '';

	jQuery(".error_message").remove(); //rimuove tutti gli errori già visualizzati

	jQuery(classToValidate).each(function() {
		//Tipi di validazione predefiniti in base all'id del campo in analisi

		if(jQuery(this).attr("id") == 'email')
		{
			//Validazione email, se non passata mettere is_error = true
			if (! /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(jQuery(this).val()))
  			{
    			error_message = "<p>- Il formato dell'indirizzo email non è valido</p>";
    			is_error = true;

    			jQuery(this).after('<div class="error_message">'+error_message+'</div>');

  			}
    		
		}

		if(jQuery(this).attr("id") == 'password')
		{
			//Validazione password
			let password = jQuery(this).val();
			if(password.length < 8) {
				error_message = "- La password deve contenere almeno 8 caratteri";
				is_error = true;

    			jQuery(this).after('<div class="error_message">'+error_message+'</div>');
			}
		}

		if(jQuery(this).attr("id") == 'telefono')
		{
			let telefono = jQuery(this).val();
			if(telefono.length < 9) {
				alert();
				error_message = "- Inserire un numero di telefono valido";
				is_error = true;

    			jQuery(this).after('<div class="error_message">'+error_message+'</div>');
			}
		}

		/* AGGIUNGERE ALTRI CAMPI DA QUI IN POI */

	});

	//Se non ci sono stati errori in precedenza, si prosegue all'invio del form per controllarlo lato server
	if(is_error == false)
		jQuery(".validate-it-form").submit();
}
 

});


function hideEasy(hide_or_display) {

	if(hide_or_display == 'hide') {
		jQuery(".display-ease-in").addClass("hide-ease-in");
		jQuery(".display-ease-in").removeClass("display-ease-in");
	}

	else if(hide_or_display == 'display') {
		jQuery(".display-ease-in").addClass("hide-ease-in");
		jQuery(".display-ease-in").removeClass("display-ease-in");
	}
}



function openView(url,params,first_view,search_val,val) {
	if(url != null) {
		    var scroll = $(window).scrollTop();
		if(params == null) {
			//inizializza la view
			$.post("pages/"+url,
			  {
			    parameters: null,
			  },
			  function(data, status){
			  	if(scroll > 0)
			  	$('html, body').animate({scrollTop: '0px'}, 300);
			    $(".content-ajax").html(data);
			  });
		} else {
			if(first_view == false) {
				var jsonStringParams = JSON.stringify(params);
				if(search_val == false || search_val == undefined) {
					$.post("pages/"+url, {parameters: jsonStringParams})
				    .done( function(data) { if(scroll > 0) $('html, body').animate({scrollTop: '0px'}, 300); $(".content-ajax").html(data);
				    	$(this).data('requestRunning', false);
				    	if(val != false) {
					    	jQuery(".dataTables_filter").children().children().val(val);
					    }
	 				})
				    .fail( function(xhr, textStatus, errorThrown) {
				        $(".content-ajax").html('<div class="error_message">Errore</div>');
				    });
				} else {
					var search_val_string = JSON.stringify(search_val);


					$.post("pages/"+url, {parameters: jsonStringParams, search_val: search_val_string})
				    .done( function(data) { $(".content-ajax").html(data);
				    	$(this).data('requestRunning', false);
	 				})
				    .fail( function(xhr, textStatus, errorThrown) {
				        $(".content-ajax").html('<div class="error_message">Errore</div>');
				    });
				}
			} else {
				var jsonStringParams = JSON.stringify(params);
			    $.post("pages/"+url, {parameters: jsonStringParams})
			    .done( function(data) {
			    	$(".content-ajax").html(data);
			    	$(this).data('requestRunning', false);
				})
			    .fail( function(xhr, textStatus, errorThrown) {
			        $(".content-ajax").html('<div class="error_message">Errore</div>');
			    });
			}
		}
	}
}

function openViewParseURL(action,first_view,search_val,val) {
	var page = window.location.pathname;
	var splitURL=page.toString().split("/");
	var parameters = [];
	var composed = false;
	for(let i = 0;i<splitURL.length;i++) {
		if(splitURL[i] == "cp") {
			var z = 0;
			for(let y=i+1;y<splitURL.length;y++) {
				parameters[z] = splitURL[y];
				z++;
			}
			composed = true;
		}

		if(composed == true)
			break;
	}

	openView(action,parameters,first_view,search_val,val);
}

function delPreview(id) {
    id = 'prw-'+id;
    jQuery("#ifp-"+id).hide(function() {
        jQuery("#ifp-"+id).remove();
        jQuery("#immagini_form").val(null);
    });
}

function delPreviewDidascalie(id) {
    id = 'prw-'+id;
    jQuery("#ifp-"+id).hide(function() {
        jQuery("#ifp-"+id).remove();
        jQuery("#immagini_form").val(null);
    });
}


function delPreviewEccellenza(id) {
    id = 'prws-'+id;
    jQuery("#ifps-"+id).hide(function() {
        jQuery("#ifps-"+id).remove();
    });
}

function delPreviewServizi(id) {
    id = 'prws-'+id;
    jQuery("#ifps-"+id).hide(function() {
        jQuery("#ifps-"+id).remove();
    });
}




jQuery(document).on("click",".open-view-action-inside",function() {    var search_val = false;

    
    if(jQuery(".dataTables_filter").children().children())
        search_val = jQuery(".dataTables_filter").children().children().val();

    jQuery(".notification-message").fadeOut();
    var action = jQuery(this).attr("data-action");
    var params = jQuery(this).attr("data-params");
    var id = jQuery(this).attr("id");
    if(id != '' && id != undefined)
    //jQuery("#menu-"+id).trigger("click");
    var success = jQuery(this).attr("data-success");
    if(params == "false") params = "";
    var title = jQuery(this).attr("data-title");
    if(params != "") 
        window.history.pushState("object or string", title,"/cp/"+action+"/"+params);
    else
        window.history.pushState("object or string", title,"/cp/"+action);
        $(document).prop("title", title);

    var val = false;
    if(jQuery("#gobacksearch").length) {
        var val = jQuery("#gobacksearch").attr("data-search");
    }
    
    openViewParseURL(action,false,search_val,val);
       

});


$(document).click(function(event) { 
  var $target = $(event.target);
  if(!$target.closest('.toConfirm').length) {
    $('.toConfirm').html('<i class="fa fa-trash"></i>');
    $('.toConfirm').removeClass('toConfirm');

  }        
});



