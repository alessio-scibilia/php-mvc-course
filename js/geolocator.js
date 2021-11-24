jQuery(document).on("click", ".calcGPS", function () {
    var name_indirizzo = $(this).data('indirizzo');
    var name_longitudine = $(this).data('longitudine');
    var name_latitudine = $(this).data('latitudine');
    var class_hidden_maps = $(this).data('hidden_maps');

    var $indirizzo = $("[name='"+ name_indirizzo +"']");
    var $latitudine = $("[name='" + name_latitudine + "']");
    var $longitudine = $("[name='" + name_longitudine + "']");
    var $hidden_maps = $("." + class_hidden_maps);

    var indirizzo = $indirizzo.val();
    $.post("/backoffice/geolocate?XDEBUG_SESSION_START", { indirizzo })
        .done(function (data) {
            if (data != 'error') {
                var latlon = data.split(',');
                $latitudine.val(latlon[0]);
                $longitudine.val(latlon[1]);
                $longitudine.trigger("click");
                $hidden_maps.trigger("click");
            } else {
                alert("Calcolo posizione fallito");
            }
        })
        .fail(function (xhr, textStatus, errorThrown) {
            //$(".content-ajax").html('<div class="error_message">Errore</div>');
        });
});

var marker;
var infoWindow;

function centerMap(map, $lat, $lng) {
    let lat = parseFloat($lat.val());
    let lng = parseFloat($lng.val());
    map.setCenter(new google.maps.LatLng(lat, lng));
    map.setZoom(13);
    marker = [];
    marker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        map: map,
        title: ''
    });
}

function bindMap() {
    var name_longitudine = $(this).data('longitudine');
    var name_latitudine = $(this).data('latitudine');
    var class_hidden_maps = $(this).data('hidden_maps');

    var $latitudine = $("[name='" + name_latitudine + "']");
    var $longitudine = $("[name='" + name_longitudine + "']");
    var $hidden_maps = $("." + class_hidden_maps);

    var myLatlng = {lat: 44.363, lng: 8.044};
    var map = new google.maps.Map($(this).get(0), {
        zoom: 5,
        center: myLatlng,
    });
    // Create the initial InfoWindow.

    centerMap(map, $latitudine, $longitudine);

    // Configure the click listener.
    $hidden_maps.click(function () {
        marker.setMap(null);
        centerMap(map, $latitudine, $longitudine);
    });

    map.addListener("click", (mapsMouseEvent) => {
        // Close the current InfoWindow.
        if (typeof infoWindow != "undefined")
            infoWindow.close();
        // Create a new InfoWindow.
        infoWindow = new google.maps.InfoWindow({
            position: mapsMouseEvent.latLng,
        });
        let coordinate = mapsMouseEvent.latLng.toJSON();
        $latitudine.val(coordinate.lat);
        $longitudine.val(coordinate.lng);
        infoWindow.setContent(
            JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
        );
        infoWindow.open(map);
    });
}

function initMap() {

    $('.map').each(bindMap);

}

