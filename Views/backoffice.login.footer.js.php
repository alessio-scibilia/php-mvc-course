<script>
    jQuery(document).on("click",".forgot-password",function() {
        jQuery("#alert-restore").remove();
        jQuery(".alert-login").fadeOut();
        jQuery("#type_login").val("1");
        jQuery(".error_message").remove();
        if(jQuery("#password").is(":visible")) {
            jQuery("#password").hide("fast");
            jQuery("#password").prev().hide("fast");
            jQuery(".validate-it").val("'.$langs['ricevi_codice_recupero'].'");
            jQuery(".validate-it").addClass("get-reset-code");
            jQuery(".validate-it").attr("type","button");
            jQuery(".validate-it").attr("id","");
            jQuery(".validate-it").removeClass("validate-it");
            jQuery(".forgot-password").addClass("to-login");
            jQuery(".forgot-password").text("Accedi");
            jQuery(".title-login").text("Recupera i tuoi dati");
        } else {
            jQuery(".toverifycode").text("Login");
            jQuery(".toverifycode").addClass("validate-it");
            jQuery(".toverifycode").attr("id","validate-1");
            jQuery(".toverifycode").attr("type","submit");
            jQuery(".toverifycode").removeClass("toverifycode");
            jQuery("#email").fadeIn();
            jQuery("#digits-code").hide();
            jQuery("#type_login").val("0");
            jQuery(".get-reset-code").addClass("validate-it");
            jQuery(".validate-it").attr("id","validate-1");
            jQuery(".validate-it").attr("type","submit");
            jQuery(".get-reset-code").removeClass("get-reset-code");
            jQuery("#password").show("fast");
            jQuery("#password").prev().show("fast");
            jQuery(".validate-it").val("Accedi");
            jQuery(".to-login").addClass("forgot-password");
            jQuery(".forgot-password").text("Hai dimenticato la password?");
            jQuery(".forgot-password").removeClass("to-login");
            jQuery(".title-login").text("Accedi");
        }
    });

    jQuery(document).on("click",".get-reset-code",function() {
        var email = jQuery("#email").val();
        if(email != undefined && email != "") {
            var jsonStringParams = JSON.stringify(email);
            $.post("functions/api?use=getResetCode", {parameters: email})
            .done( function(data) {
                if(data != "error") {
                    jQuery("#labelmail").hide();
                    jQuery("#email").before(\'<div class="alert alert-info text-left" id="alert-restore">Inserisci il codice di 6 cifre che abbiamo inviato al tuo indirizzo email</div>\');
                    jQuery("#email").hide();
                    jQuery("#digits-code").css("display","block");
                    jQuery(".get-reset-code").attr("value","Verifica codice");
                    jQuery(".get-reset-code").addClass("toverifycode");
                    jQuery(".get-reset-code").removeClass("get-reset-code");
                } else {

                }
            })
            .fail( function(xhr, textStatus, errorThrown) {
                alert("Connection error");
            });
        }
    });


    jQuery(document).on("click",".toverifycode",function() {
        var code = jQuery("#digits-code").val();
        var email = jQuery("#email").val();
        $.post("functions/api?use=verifyReset", {email:email, code: code})
        .done( function(data) {
            if(data != "error") {
                jQuery(".validate-it-form").attr("action","process/restore_password");
                jQuery("#alert-restore").hide();
                jQuery("#digits-code").hide();
                jQuery("#digits-code").before(\'<input type="password" id="new_password" class="form-control input-md mb5" name="new_password" placeholder="Nuova password">\');
                jQuery("#digits-code").before(\'<input type="password" id="new_password_confirm" class="form-control input-md mb5" placeholder="Conferma nuova password">\');
                jQuery(".toverifycode").attr("value","Reimposta la mia password");
                jQuery(".toverifycode").attr("type","submit");
                jQuery(".toverifycode").addClass("submitReset");
                jQuery(".toverifycode").removeClass("toverifycode");
            } else {
                jQuery("#alert-restore").addClass("alert-warning");
                jQuery("#alert-restore").removeClass("alert-info");
                jQuery("#alert-restore").text("Il codice di verifica inserito non è valido");
            }
        })
        .fail( function(xhr, textStatus, errorThrown) {
            alert("Connection error");
        });
    });


    jQuery(document).on("click",".submitReset",function() {
        jQuery(".validate-it-form").submit();
    });
</script>
