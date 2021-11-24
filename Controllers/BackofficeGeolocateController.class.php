<?php
require_once 'Views/JsonView.class.php';

class BackofficeGeolocateController
{
    public function http_post(array &$params): IView
    {
        //qua
        $opts = array('http' => array('header' => "User-Agent: StevesCleverAddressScript 3.7.6\r\n"));
        $context = stream_context_create($opts);

        $endpoint[0]["url_first"] = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyD6DoJBgy3wuk3dCVUlQL3YbJUDtebSvhc&address=";
        /*$endpoint[1]["url_first"] = "https://api.opencagedata.com/geocode/v1/json?&key=85a485bb45474d0392a08102fccb237f&limit=1&q=";
        $endpoint[2]["url_first"] = "https://eu1.locationiq.com/v1/search.php?key=b289e7af578621&format=json&q=";
        $endpoint[3]["url_first"] = "http://open.mapquestapi.com/nominatim/v1/search.php?key=bpgk4ITQ07r9kbqVOjV2WeYnsDRRktny&format=json&limit=1&q=";
        */

        $api_google = 'AIzaSyD6DoJBgy3wuk3dCVUlQL3YbJUDtebSvhc';


        //$indirizzo_formattato = 'Via+24+maggi+56+alessandria';

        $indirizzo_formattato = urlencode($params['indirizzo']);

        $endpoint_to_use = 0;

        $found = false;
        $tentativi = 0;
        $coordinate = 'error';
        while ($found == false) {
            $tentativi++;
            $response = file_get_contents($endpoint[$endpoint_to_use]["url_first"] . $indirizzo_formattato, false, $context);

            if (!json_decode($response, TRUE)) {
                if ($tentativi == 4) {
                    return new JsonView($coordinate);
                }
                if ($endpoint_to_use >= count($endpoint))
                    $endpoint_to_use = 0;
                else
                    $endpoint_to_use++;

            } else {
                $resp = json_decode($response, true);

                $coordinate = $resp['results'][0]['geometry']['location']['lat'] . ',' . $resp['results'][0]['geometry']['location']['lng'];
                $found = true;
            }
        }

        return new JsonView($coordinate);

    }
}