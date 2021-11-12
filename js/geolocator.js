jQuery(document).on("click", "#calcGPS", function () {
    var indirizzo = jQuery("#indirizzo").val();
    // indirizzo = JSON.stringify(indirizzo);
    $.post("/backoffice/geolocate?XDEBUG_SESSION_START", { indirizzo })
        .done(function (data) {
            if (data != 'error') {
                var latlon = data.split(',');
                $("#latitudine").val(latlon[0]);
                $("#longitudine").val(latlon[1]);
                $("#longitudine").trigger("click");
                jQuery("#hidden-maps").trigger("click");

            } else {
                alert("Calcolo posizione fallito");
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

