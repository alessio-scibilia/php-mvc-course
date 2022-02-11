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

jQuery(document).on("click", ".annulla-servizio,.annulla-eccellenza,.annulla-utility", function () {
    var num_id = jQuery(this).data("num"); // "#num_services"; "#num_utilities"; "#num_eccellenze";
    var num = parseInt(jQuery(num_id).val());
    if (num > 0) {
        jQuery(num_id).val(num - 1);
        var $container = jQuery(this).closest(".form-container");
        var last = parseInt($container.attr('class').split(' ').pop().split('-').pop());
        $container.remove();

        for (var i = last + 1; i <= num; i++) {

            var next_class = '.form-container.fc-' + i;
            var $target = jQuery(next_class);
            var items_prev = i - 1;

            $target.find("[data-target]").each(function () {
                let name = $(this).attr("data-target");
                let regex = /^([^\d]+)(\d+)(.*)$/;
                let replacer = `$1${items_prev}$3`;
                let next = name.replace(regex, replacer);
                $(this).attr("data-target", next);
            });

            $target.find("[data-name]").each(function () {
                let name = $(this).attr("data-name");
                let regex = /^([^\d]+)(\d+)(.*)$/;
                let replacer = `$1${items_prev}$3`;
                let next = name.replace(regex, replacer);
                $(this).attr("data-name", next);
            });

            $target.find("[name]").each(function () {
                let name = $(this).attr("name");
                let regex = /^([^\d]+)(\d+)(.*)$/;
                let replacer = `$1${items_prev}$3`;
                let next = name.replace(regex, replacer);
                $(this).attr("name", next);
            });

            // class and id end with /-\d+$/
            $target.find("[id]").each(function () {
                let id = $(this).attr("id");
                let regex = /^(.+)(-\d+)$/;
                let replacer = `$1-${items_prev}`;
                let next = id.replace(regex, replacer);
                $(this).attr("id", next);
            });

            var $targets = $target.find("[class]").filter(function () {
                let classes = $(this).attr("class").split(' ');
                let regex = /^([^-]{4,}-)+\d+$/;
                let matches = classes.filter(function (c) {
                    return c.match(regex);
                });
                return matches.length > 0;
            });

            $targets.each(function () {
                let classes = $(this).attr("class").split(' ');
                let regex = /^(.+)(-\d+)$/;
                let replacer = `$1-${items_prev}`;
                let new_classes = classes.map(function (c) {
                    return c.replace(regex, replacer);
                });
                let next = new_classes.join(' ');
                $(this).attr("class", next);
            });
        }
    }
});

jQuery(document).on("click", ".save-servizio,.save-eccellenza,.save-utility", function () {
    var num_id = jQuery(this).data("num"); // "#num_services"; "#num_utilities"; "#num_eccellenze";
    var items_total = parseInt($(num_id).val());
    var items_next = items_total; // this array is zero-based!
    jQuery(num_id).val(items_next + 1);

    if ($(this).closest(".form-container").hasClass("utc"))
        var utc = true;
    else var utc = false;

    let $container = jQuery(this).closest(".form-container");
    let $last = $container.parent().children().last();
    var form = $last.clone();
    $last.after(form);
    $last = $(form);

    // register handlers
    registerMultilanguageHandler($last.find('.multilanguage-textbox-button'));
    $last.find('.map').each(bindMap);
    $last.find('input.custom-file-input').on("change", imageUploadHandler);

    // div[class^='apple-'],div[class*=' apple-']
    $("[class^='annulla-'],[class*=' annulla-']").prop('disabled', false);

    $container.fadeIn();

    // SI: vanno lasciati perché hanno "fc-*" che è < 4 caratteri!
    if (utc == true) {
        $(".utc-active").removeClass("utc-active");
        $last.attr("class", "form-container utc utc-active fc-" + items_next + ' utc-' + items_next);
        $last.attr("id", 'drags-' + items_next);
        $last.attr("ondrop", 'drop(event)');
        $last.attr("ondragover", 'allowDrop(event)');

    } else {

        $(".atc-active").removeClass("act-active");
        $last.attr("class", "form-container atc atc-active fc-" + items_next + ' atc-' + items_next);
        $last.attr("id", 'dragsatc-' + items_next);
        $last.attr("ondrop", 'dropatc(event)');
        $last.attr("ondragover", 'allowDropatc(event)');
    }

    // Clean all fields
    // $last.find("[value]").val('');

    $last.find("[data-target]").each(function () {
        let name = $(this).attr("data-target");
        let regex = /^([^\d]+)(\d+)(.*)$/;
        let replacer = `$1${items_next}$3`;
        let next = name.replace(regex, replacer);
        $(this).attr("data-target", next);
    });

    $last.find("[data-name]").each(function () {
        let name = $(this).attr("data-name");
        let regex = /^([^\d]+)(\d+)(.*)$/;
        let replacer = `$1${items_next}$3`;
        let next = name.replace(regex, replacer);
        $(this).attr("data-name", next);
    });

    $last.find("[name]").each(function () {
        let name = $(this).attr("name");
        let regex = /^([^\d]+)(\d+)(.*)$/;
        let replacer = `$1${items_next}$3`;
        let next = name.replace(regex, replacer);
        $(this).attr("name", next);
    });

    // class and id end with /-\d+$/
    $last.find("[id]").each(function () {
        let id = $(this).attr("id");
        let regex = /^(.+)(-\d+)$/;
        let replacer = `$1-${items_next}`;
        let next = id.replace(regex, replacer);
        $(this).attr("id", next);
    });
    var $targets = $last.find("[class]").filter(function () {
        let classes = $(this).attr("class").split(' ');
        let regex = /^([^-]{4,}-)+\d+$/;
        let matches = classes.filter(function (c) {
            return c.match(regex);
        });
        return matches.length > 0;
    });
    $targets.each(function () {
        let classes = $(this).attr("class").split(' ');
        let regex = /^(.+)(-\d+)$/;
        let replacer = `$1-${items_next}`;
        let new_classes = classes.map(function (c) {
            return c.replace(regex, replacer);
        });
        let next = new_classes.join(' ');
        $(this).attr("class", next);
    });


    //var offset = $last.offset().top+350;
    //$('html,body').animate({scrollTop: offset}, 'slow');
});


function removeRelatedHotel(val) {
    $(".isRelatedTo-" + val).slideDown();
    $(".isRelatedToShow-" + val).slideDown();
    $(".isRelatedTo-" + val).next().remove();
    $(".isRelatedTo-" + val).remove();
    $(".isRelatedToShow-" + val).next().remove();
    $(".isRelatedToShow-" + val).remove();
}

function removeRelatedCat(val) {
    $(".cat-" + val).slideDown();
    $(".relatedCat-" + val).slideDown();
    $(".cat-" + val).next().remove();
    $(".cat-" + val).remove();
    $(".relatedCat-" + val).next().remove();
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
            var onclick_function = "removeRelatedCat('" + val + "')";
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



jQuery(document).on("click", ".save-eccellenza", function () {
    $(".summernote").last().parent().prev().children().children().remove()
    $(".summernote").last().next().remove()
    $(".summernote").summernote({
        height: 190,
        minHeight: null,
        disableDragAndDrop:true,
        maxHeight: null,
        focus: !1
    })
});



//MODIFICHE PER POSIZIONI

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
    if(!$('#'+ev.target.id).parent().parent().parent().hasClass("utc-active") && $('#'+ev.target.id).hasClass('startdrag-utc')) {
         $(".utc-active").find(".stopsee").each(function () {
                $(this).removeClass("dblock-see");
            });
         var id = $('#'+ev.target.id).parent().parent().parent().attr("id");
        //$(".utc-active").removeClass("utc-active");
        ev.dataTransfer.setData("text", id);
    }
}

function drop(ev) {
  ev.preventDefault();
  $(".utc").each(function() {
      $(this).find(".stopsee").each(function () {
          $(this).removeClass("dblock-see");
      });
  });

  id_parent = ev.target.closest(".utc").id;
  ev.target = $("#"+id_parent).children();
  var data = ev.dataTransfer.getData("text");

  //prelevo la posizione del tile selezionato
  var selected_index =  $("#"+data).closest(".utc").children().attr('id').split(' ').pop();
  selected_index = selected_index.substr(selected_index.indexOf("-") + 1);

  //inserisco il tile selezionato nella posizione di destinazione
  ev.target.closest(".utc").appendChild(document.getElementById(data));


  //recupero il nuovo indice del tile selezionato
  var new_index_full = $("#"+data).closest(".utc").children().attr('id').split(' ').pop();
  new_index = new_index_full.substr(new_index_full.indexOf("-") + 1);

  //registro il vecchio contenuto del div di destinazione
  var old = $("#draggable-"+new_index);

  target_old_data = $("#draggable-"+new_index);


  if(selected_index > new_index) {
    //riordino verso il basso

    var i = 0;
    var list_to_reindex = [];

    $(".form-draggable").each(function() {

        let id = $(this).attr("id")
        let form_row_index = id.substr(id.indexOf("-")+1);

        if(form_row_index > new_index && form_row_index <= selected_index) {
          //Se il tile esaminato è uno di quelli da aggiornare
          if(i>0)
            list_to_reindex[i] = $(this).clone();
          else
            list_to_reindex[i] = $(this).prev().clone();

          i++;
        }
    });


    var i = 0;
    $(".form-draggable").each(function() {

      let id = $(this).attr("id")
      let form_row_index = id.substr(id.indexOf("-")+1)+1;

      if(form_row_index > new_index && form_row_index <= selected_index) {
        $(this).css("background-color","red");
        $(this).parent().next().append(list_to_reindex[i]);
        $(this).remove();
        i++;
      }
    });


    var i = 0;
    $(".utc").each(function () {

      $(this).find('*').each(function() {
        console.log($(this).attr("name"));
        if($(this).attr("name") != undefined) {
          var name = $(this).attr("name");
          name = name.replace(/\[.*?\]/, '['+i+']');
          $(this).attr("name",name);
        }

        if($(this).hasClass("form-draggable")) {
          $(this).attr("id",'fd-'+i);
        }
        
        if($(this).hasClass("startdrag-utc")) {
          $(this).attr("id",'draggable-'+i);
        }
      });
      i++;
    });





  } else {
    //riordino verso l'alto

    var i = 0;
    var list_to_reindex = [];

    $(".form-draggable").each(function() {

        let id = $(this).attr("id")
        let form_row_index = id.substr(id.indexOf("-")+1);

        if(form_row_index <= new_index && form_row_index > selected_index) {
          //Se il tile esaminato è uno di quelli da aggiornare
          if(i>0)
            list_to_reindex[i] = $(this).clone();
          else
            list_to_reindex[i] = $(this).clone();

          console.log("SCAMBIO:"+$(list_to_reindex[i]).html());
          i++;
        }
    });
    //console.log(list_to_reindex);


    var i = 0;
    $(".form-draggable").each(function() {

      let id = $(this).attr("id")
      let form_row_index = id.substr(id.indexOf("-")+1);

      if(form_row_index <= new_index && form_row_index > selected_index) {
      //alert(form_row_index);
        $(this).css("background-color","red");
        $(this).parent().prev().append(list_to_reindex[i]);
        //console.log($(this).parent().prev());

        //alert(i);

        $(this).remove();
        i++;
      }
    });

    var i = 0;
    $(".utc").each(function () {

      $(this).find('*').each(function() {
        //console.log($(this).attr("name"));
        if($(this).attr("name") != undefined) {
          var name = $(this).attr("name");
          name = name.replace(/\[.*?\]/, '['+i+']');
          $(this).attr("name",name);
        }

        if($(this).hasClass("form-draggable")) {
          $(this).attr("id",'fd-'+i);
        }
        if($(this).hasClass("startdrag-utc")) {
          $(this).attr("id",'draggable--'+i);
        }
      });
      i++;
    });

  }


  /*var inputs = $("#"+data+" *");

  //console.log(inputs[0]);
  //console.log(inputs[1]);

  for(let i = 0;i <= inputs.length; i++) {

   $(this).val(new_index);
  }*/


}

$(".utc").on("mouseout",function() {
$(this).css("background","#eaeaea");
});

$(".utc").on("mouseover",function() {
$(this).css("background","white");
});

$(document).on('click', ".open-close-utc", function(e) {

        if($(this).parent().parent().parent().parent().hasClass('utc-active')) {
            $(this).parent().parent().parent().parent().find(".stopsee").each(function () {
                $(this).removeClass("dblock-see");
            });
        } else {
            $(this).parent().parent().parent().parent().find(".stopsee").each(function () {
                $(this).addClass("dblock-see");
            });
        }

        $(this).parent().parent().parent().parent().toggleClass('utc-active');


});


function allowDropatc(ev) {
  ev.preventDefault();
}

function dragatc(ev) {
    if(!$('#'+ev.target.id).parent().parent().parent().hasClass("atc-active") && $('#'+ev.target.id).hasClass('startdrag-atc')) {
         $(".atc-active").find(".stopsee").each(function () {
                $(this).removeClass("dblock-see");
            });
         var id = $('#'+ev.target.id).parent().parent().parent().attr("id");
        //$(".utc-active").removeClass("utc-active");
        ev.dataTransfer.setData("text", id);
    }
}

function dropatc(ev) {
  ev.preventDefault();
  $(this).find(".stopsee").each(function () {
          $(this).removeClass("dblock-see");
      });
  id_parent = ev.target.closest(".atc").id;
  ev.target = $("#"+id_parent).children();
  var data = ev.dataTransfer.getData("text");

  //prelevo la posizione del tile selezionato
  var selected_index =  $("#"+data).closest(".atc").children().attr('id').split(' ').pop();
  selected_index = selected_index.substr(selected_index.indexOf("-") + 1);

  //inserisco il tile selezionato nella posizione di destinazione
  ev.target.closest(".atc").appendChild(document.getElementById(data));


  //recupero il nuovo indice del tile selezionato
  var new_index_full = $("#"+data).closest(".atc").children().attr('id').split(' ').pop();
  new_index = new_index_full.substr(new_index_full.indexOf("-") + 1);


  //registro il vecchio contenuto del div di destinazione
  var old = $("#draggableatc-"+new_index);

  target_old_data = $("#draggableatc-"+new_index);


  if(selected_index > new_index) {
    //riordino verso il basso

    var i = 0;
    var list_to_reindex = [];

    $(".form-draggableatc").each(function() {

        let id = $(this).attr("id")
        let form_row_index = id.substr(id.indexOf("-")+1);

        if(form_row_index > new_index && form_row_index <= selected_index) {
          //Se il tile esaminato è uno di quelli da aggiornare
          if(i>0)
            list_to_reindex[i] = $(this).clone();
          else
            list_to_reindex[i] = $(this).prev().clone();

          i++;
        }
    });


    var i = 0;
    $(".form-draggableatc").each(function() {

      let id = $(this).attr("id")
      let form_row_index = id.substr(id.indexOf("-")+1)+1;

      if(form_row_index > new_index && form_row_index <= selected_index) {
        $(this).css("background-color","red");
        $(this).parent().next().append(list_to_reindex[i]);
        $(this).remove();
        i++;
      }
    });


    var i = 0;
    $(".atc").each(function () {

      $(this).find('*').each(function() {
        console.log($(this).attr("name"));
        if($(this).attr("name") != undefined) {
          var name = $(this).attr("name");
          name = name.replace(/\[.*?\]/, '['+i+']');
          $(this).attr("name",name);
        }

        if($(this).hasClass("form-draggableatc")) {
          $(this).attr("id",'fdatc-'+i);
        }
        if($(this).hasClass("startdrag-atc")) {
          $(this).attr("id",'draggableatc-'+i);
        }
      });
      i++;
    });







  } else {
    //riordino verso l'alto

    var i = 0;
    var list_to_reindex = [];

    $(".form-draggableatc").each(function() {

        let id = $(this).attr("id")
        let form_row_index = id.substr(id.indexOf("-")+1);

        if(form_row_index <= new_index && form_row_index > selected_index) {
          //Se il tile esaminato è uno di quelli da aggiornare
          if(i>0)
            list_to_reindex[i] = $(this).clone();
          else
            list_to_reindex[i] = $(this).clone();

          console.log("SCAMBIO:"+$(list_to_reindex[i]).html());
          i++;
        }
    });
    //console.log(list_to_reindex);


    var i = 0;
    $(".form-draggableatc").each(function() {

      let id = $(this).attr("id")
      let form_row_index = id.substr(id.indexOf("-")+1);

      if(form_row_index <= new_index && form_row_index > selected_index) {
      //alert(form_row_index);
        $(this).css("background-color","red");
        $(this).parent().prev().append(list_to_reindex[i]);
        //console.log($(this).parent().prev());

        //alert(i);

        $(this).remove();
        i++;
      }
    });

    var i = 0;
    $(".atc").each(function () {

      $(this).find('*').each(function() {
        //console.log($(this).attr("name"));
        if($(this).attr("name") != undefined) {
          var name = $(this).attr("name");
          name = name.replace(/\[.*?\]/, '['+i+']');
          $(this).attr("name",name);
        }

        if($(this).hasClass("form-draggableatc")) {
          $(this).attr("id",'fdatc-'+i);
        }
        if($(this).hasClass("startdrag-atc")) {
          $(this).attr("id",'draggableatc-'+i);
        }
      });
      i++;
    });

  }


  /*var inputs = $("#"+data+" *");

  //console.log(inputs[0]);
  //console.log(inputs[1]);

  for(let i = 0;i <= inputs.length; i++) {

   $(this).val(new_index);
  }*/


}

$(".atc").on("mouseout",function() {
$(this).css("background","#eaeaea");
});

$(".atc").on("mouseover",function() {
$(this).css("background","white");
});

$(document).on('click', ".open-close-atc", function(e) {

        if($(this).parent().parent().parent().parent().hasClass('atc-active')) {
            $(this).parent().parent().parent().parent().find(".stopsee").each(function () {
                $(this).removeClass("dblock-see");
            });
        } else {
            $(this).parent().parent().parent().parent().find(".stopsee").each(function () {
                $(this).addClass("dblock-see");
            });
        }

        $(this).parent().parent().parent().parent().toggleClass('atc-active');


});


$(document).ready(function() {
    $(".utc").removeClass("utc-active");
    $(".atc").removeClass("atc-active");
    $(".dblock-see").removeClass("dblock-see");
})