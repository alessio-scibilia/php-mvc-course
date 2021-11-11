<?php
require_once 'Views/JsonView.class.php';

class BackofficeGeolocateController
{
    public function http_post(array &$params): IView
    {
        //qua
        $opts = array('http' => array('header' => "User-Agent: StevesCleverAddressScript 3.7.6\r\n"));
        $context = stream_context_create($opts);

        $endpoint[0]["url_first"] = "https://nominatim.openstreetmap.org/search?format=json&limit=1&q=";
        $endpoint[1]["url_first"] = "https://api.opencagedata.com/geocode/v1/json?&key=85a485bb45474d0392a08102fccb237f&limit=1&q=";
        $endpoint[2]["url_first"] = "https://eu1.locationiq.com/v1/search.php?key=b289e7af578621&format=json&q=";
        $endpoint[3]["url_first"] = "http://open.mapquestapi.com/nominatim/v1/search.php?key=bpgk4ITQ07r9kbqVOjV2WeYnsDRRktny&format=json&limit=1&q=";

        $api_google = 'bpgk4ITQ07r9kbqVOjV2WeYnsDRRktny';


        //$indirizzo_formattato = 'Via+24+maggi+56+alessandria';

        $indirizzo_formattato = $params['indirizzo'];

        $endpoint_to_use = 0;

        $found = false;
        $tentativi = 0;
        $coordinate = 'error';
        while ($found == false) {
            $tentativi++;
            $response = file_get_contents($endpoint[$endpoint_to_use]["url_first"] . $regione_formattata . '+' . $provincia_formattata . '+' . $citta_paese_formattati . '+' . $indirizzo_formattato . '+' . $civico_formattato, false, $context);
            //echo $endpoint[$endpoint_to_use]["url_first"].$regione_formattata.'+'.$provincia_formattata.'+'.$citta_paese_formattati.'+'.$indirizzo_formattato.'+'.$civico_formattato;


            $last_block_after = 0;
            if (!json_decode($response, TRUE)) {
                if ($tentativi == 100) {
                    $tentativi = 0;
                }
                if ($endpoint_to_use == 3)
                    $endpoint_to_use = 0;
                else
                    $endpoint_to_use++;

            } else {
                $end = microtime(TRUE);
                //if (empty(array_filter($resp))) {return false;}else{
                $resp = json_decode($response, true);

                $coordinate = $resp[0]['lat'] . ',' . $resp[0]['lon'];
                $found = true;
            }
            //echo "<br>Found: ".$found_sum." coordinates in ".($end - $start)." seconds";

        }

        return new JsonView($coordinate);

    }
}