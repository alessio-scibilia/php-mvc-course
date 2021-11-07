<?php
// C'è l'html del content che va renderizzato dentro la sezione frontoffice.php
// E' il content di default che appare appena loggati, gli altri content sono raggiungibili tramite tab
?>

<div
    class="menu-content-container" <?php if ($tab == 'info' || $tab == 'prop' || $tab == 'sugg' || $tab == 'suggestions') echo 'style="display:block;"'; ?>>
    <div
        class="content-one-container" <?php if ($tab != false && $tab != 'info' && $tab != 'info') echo 'style="display:none;"'; ?>>
        <!-- OGNI DUE CARD_SERVICE METTERE LA FLEX-SPECIAL!!!!!!!! -->
        <div class="flex-special"> <!-- PT100 SOLO NEL PRIMO -->
            <?php
            $servizi = getDatiServizi($dbh, $_SESSION['id_hotel'], $_SESSION['lang']);
            for ($i = 0; $i < sizeof($servizi); $i++) {
                if ($servizi[$i]['abilitato'] == 1) {
                    $today = date("l");
                    switch (date('N', strtotime($today))) {
                        case '1':
                            $giorno = 'lunedi';
                            break;
                        case '2':
                            $giorno = 'martedi';
                            break;
                        case '3':
                            $giorno = 'mercoledi';
                            break;
                        case '4':
                            $giorno = 'giovedi';
                            break;
                        case '5':
                            $giorno = 'venerdi';
                            break;
                        case '6':
                            $giorno = 'sabato';
                            break;
                        case '7':
                            $giorno = 'domenica';
                            break;

                        default:
                            break;
                    }
                    $giorno_real = $giorno;
                    $orari_oggi = $servizi[$i][$giorno];
                    $orari_expanded = explode("|", $orari_oggi);
                    if ($orari_expanded[0] == 0) {
                        if ($orari_expanded[1] == "" && $orari_expanded[2] == "" && $orari_expanded[3] == "" && $orari_expanded[4] == "")
                            $orari = substr($langs[$giorno], 0, 3) . ': ' . '-- --';
                        else
                            $orari = substr($langs[$giorno], 0, 3) . ': ' . $orari_expanded[1] . '-' . $orari_expanded[2] . ' | ' . $orari_expanded[3] . '-' . $orari_expanded[4];
                    } else if ($orari_expanded[0] == 1) {
                        if ($orari_expanded[1] == "" && $orari_expanded[2] == "" && $orari_expanded[3] == "" && $orari_expanded[4] == "")
                            $orari = substr($langs[$giorno], 0, 3) . ': ' . '-- --';
                        else
                            $orari = substr($langs[$giorno], 0, 3) . ': ' . $orari_expanded[1] . '-' . $orari_expanded[2];
                    }
                    ?>
                    <div class="card-service">
                        <img src="cp/<?php echo $servizi[$i]['immagine']; ?>" class="icon-service" alt="" title=""/>
                        <div>
                            <h2 class="title-service"><?php echo $servizi[$i]['titolo']; ?></h2>
                            <span class="hour-service"><?php echo $orari; ?> <a href="javascript:void();"
                                                                                onclick="openOrariFull(<?php echo $servizi[$i]['id']; ?>)">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="caretOrari"
                                 viewBox="0 0 16 16">
							  <path
                                  d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"
                                  class="pathcaretorari"/>
							</svg>
						</a></span>
                            <div class="dn orariFullContainer orariFullContainer-<?php echo $servizi[$i]['id']; ?>">
                                <?php
                                for ($f = 1; $f <= 7; $f++) {
                                    switch ($f) {
                                        case '1':
                                            $giorno = 'lunedi';
                                            break;
                                        case '2':
                                            $giorno = 'martedi';
                                            break;
                                        case '3':
                                            $giorno = 'mercoledi';
                                            break;
                                        case '4':
                                            $giorno = 'giovedi';
                                            break;
                                        case '5':
                                            $giorno = 'venerdi';
                                            break;
                                        case '6':
                                            $giorno = 'sabato';
                                            break;
                                        case '7':
                                            $giorno = 'domenica';
                                            break;

                                        default:
                                            break;
                                    }
                                    if ($giorno_real == $giorno)
                                        $nowClass = true;
                                    else $nowClass = false;
                                    $orari_oggi = $servizi[$i][$giorno];
                                    $orari_expanded = explode("|", $orari_oggi);
                                    if ($orari_expanded[1] == "" && $orari_expanded[2] == "" && $orari_expanded[3] == "" && $orari_expanded[4] == "")
                                        $orari = substr($langs[$giorno], 0, 3) . ': ' . '-- --';
                                    else
                                        if ($orari_expanded[0] == 1)
                                            $orari = substr($langs[$giorno], 0, 3) . ': ' . $orari_expanded[1] . '-' . $orari_expanded[2];
                                        else
                                            $orari = substr($langs[$giorno], 0, 3) . ': ' . $orari_expanded[1] . '-' . $orari_expanded[2] . " | " . $orari_expanded[3] . '-' . $orari_expanded[4];
                                    echo '<div class="orariFull OrariFull-">';
                                    if ($nowClass == true) echo '<span style="font-family: Main bold;">' . $orari . '</b>';
                                    else echo $orari;
                                    echo '</div>';
                                } ?>
                            </div>
                            <p class="p-service"><?php echo $servizi[$i]['descrizione']; ?></p>
                        </div>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>

    <div
        class="content-two-container" <?php if ($tab == 'sugg' || $tab == 'suggestions') echo 'style="display:block;"'; else if ($tab != false && $tab != 'sugg' && $tab != 'suggestions') echo 'style="display:none;"'; ?>>
        <h2 class="title-in-blue"><?php echo $langs['selezionati_per_voi']; ?></h2>
        <div class="center-self">
            <?php
            $strutture_collegate = getStruttureHotelID($dbh, $_SESSION['id_hotel']);
            $categorie_attive_strutture_collegate = array();

            if ($strutture_collegate != false) {
                for ($i = 0; $i < sizeof($strutture_collegate); $i++) {
                    $id = $strutture_collegate[$i]['id'];
                    $cats_struttura = getCatStruttura($dbh, $id);

                    $dati = getDatiStruttura($dbh, $id);

                    if (is_array($cats_struttura)) {
                        for ($z = 0; $z < sizeof($cats_struttura); $z++) {
                            if ($cats_struttura[$z]['id_categoria'] != 'e' && $dati[0]['indicizza'] == 1) // e = errore dell'api
                                array_push($categorie_attive_strutture_collegate, $cats_struttura[$z]['id_categoria']);
                        }
                    }
                }
            }

            //A questo punto abbiamo un elenco di tutte le categorie di tutte le strutture collegate
            //Rimuoviamo quindi i doppioni dall'array
            $k = 0;
            $cats_final = array();
            for ($i = 0; $i < sizeof($categorie_attive_strutture_collegate); $i++) {
                $found = false;
                for ($x = $i + 1; $x <= sizeof($categorie_attive_strutture_collegate) - 1; $x++) {
                    if ($categorie_attive_strutture_collegate[$i] == $categorie_attive_strutture_collegate[$x])
                        $found = true;
                }
                if ($found == false) {
                    $cats_final[$k] = $categorie_attive_strutture_collegate[$i];
                    $k++;
                }
            }

            $cats_final_lang = array();
            $z = 0;
            for ($i = 0; $i < sizeof($cats_final); $i++) {
                $query = "SELECT * FROM categorie_strutture WHERE id = ?";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $cats_final[$i], PDO::PARAM_INT);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                    $current_id = $dati['related_id'];
                    if (!empty($current_id)) {
                        $id_current_lang = $current_id + $_SESSION['lang'] - 1;
                        $cats_final_lang[$z] = $id_current_lang;
                        $z++;
                    } else {
                        $cats_final_lang[$z] = $cats_final[$i];
                        $z++;
                    }

                }
            }
            $final_array = array_unique($cats_final_lang);


            for ($i = 0; $i < sizeof($final_array); $i++) {
                $categoria = getCategoriaByID($dbh, $final_array[$i]);
                ?>
                <a class="card-service-cat" href="javascript:void()"
                   onclick="open_cat(<?php echo $final_array[$i]; ?>);">
                    <div class="overlay">
                        <img src="cp/<?php echo $categoria['immagine']; ?>" class="icon-cat" alt="" title=""/>
                    </div>
                    <label><?php echo $categoria['nome']; ?></label>
                </a>
            <?php }
            ?>
        </div>
    </div>

    <div
        class="content-three-container" <?php if ($tab == 'prop') echo 'style="display:block;"'; else if ($tab != false && $tab != 'prop') echo 'style="display:none;"'; ?>>
        <div class="eventi-container">
            <div class="title-eventi">
                <h2 class="title-in-blue title-padded"><?php echo $langs['eventi_in_corso']; ?></h2>
                <div>
                    <a class="arrow-car arrow-car-prev">
                        <svg xmlns="http://www.w3.org/2000/svg" class="customPrevBtn" width="53.606" height="53.606"
                             viewBox="0 0 53.606 53.606">
                            <path id="Icon_awesome-arrow-alt-circle-right"
                                  data-name="Icon awesome-arrow-alt-circle-right"
                                  d="M26.8,0A26.8,26.8,0,1,1,0,26.8,26.8,26.8,0,0,1,26.8,0ZM14.266,31.558H26.8v7.663a1.3,1.3,0,0,0,2.216.919L41.371,27.721a1.285,1.285,0,0,0,0-1.826L29.018,13.466a1.3,1.3,0,0,0-2.216.919v7.663H14.266a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.266,31.558Z"
                                  transform="translate(53.606 53.606) rotate(180)" fill="#5ae9d1"/>
                        </svg>
                    </a>
                    <a class="arrow-car arrow-car-next">
                        <svg xmlns="http://www.w3.org/2000/svg" class="customNextBtn" width="53.606" height="53.606"
                             viewBox="0 0 53.606 53.606">
                            <path id="Icon_awesome-arrow-alt-circle-right"
                                  data-name="Icon awesome-arrow-alt-circle-right"
                                  d="M27.365.563a26.8,26.8,0,1,1-26.8,26.8A26.8,26.8,0,0,1,27.365.563ZM14.829,32.121H27.365v7.663a1.3,1.3,0,0,0,2.216.919L41.934,28.284a1.285,1.285,0,0,0,0-1.826L29.581,14.029a1.3,1.3,0,0,0-2.216.919V22.61H14.829a1.3,1.3,0,0,0-1.3,1.3v6.917A1.3,1.3,0,0,0,14.829,32.121Z"
                                  transform="translate(-0.563 -0.563)" fill="#5ae9d1"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="carousel-eventi owl-theme owl-carousel">
                <?php
                $showed = 0;
                $o = 0;
                $strutture_collegate = getStruttureHotelID($dbh, $_SESSION['id_hotel']);
                $showed_id = array();
                for ($i = 0; $i < sizeof($strutture_collegate); $i++) {
                    $query = "SELECT * FROM eventi WHERE struttura_collegata = ? OR struttura_collegata = ? AND abilitato = 1";
                    $stmt = $dbh->prepare($query);
                    $id1 = '1-' . $_SESSION['id_hotel'];
                    $id2 = '2-' . $strutture_collegate[$i]['id'];
                    $stmt->bindParam(1, $id1, PDO::PARAM_STR);
                    $stmt->bindParam(2, $id2, PDO::PARAM_STR);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            if ($dati['abilitato'] == 1) {
                                $found = false;
                                for ($f = 0; $f < sizeof($showed_id); $f++) {
                                    if ($showed_id[$f] == $dati['id'])
                                        $found = true;
                                }
                                if ($showed <= 3 && $found == false) {
                                    $showed_id[$o] = $dati['id'];
                                    $o++;
                                    $id_struttura = $dati['struttura_collegata'];
                                    if ($id_struttura[0] == 1) {
                                        //recupero da hotel
                                        $dati_struttura = getHotel($dbh, substr($id_struttura, 2));
                                        if ($dati_struttura['shortcode_lingua'] != $_SESSION['lang']) {
                                            $new_id = $dati_struttura['id'] + $_SESSION['lang'] - 1;
                                            $dati_struttura = getHotel($dbh, $new_id);
                                        }
                                    } else if ($id_struttura[0] == 2) {
                                        //recupero da struttura
                                        $dati_struttura = getDatiStruttura($dbh, substr($id_struttura, 2));
                                    }
                                    $mese = substr($dati['data_inizio_evento'], 5, 2);
                                    $mese_fine = substr($dati['data_fine_evento'], 5, 2);

                                    if ($dati['data_fine_evento'] >= date("Y-m-d")) {
                                        if ($mese == '01')
                                            $mese = $langs['gennaio'];
                                        else if ($mese == '02')
                                            $mese = $langs['febbraio'];
                                        else if ($mese == '03')
                                            $mese = $langs['marzo'];
                                        else if ($mese == '04')
                                            $mese = $langs['aprile'];
                                        else if ($mese == '05')
                                            $mese = $langs['maggio'];
                                        else if ($mese == '06')
                                            $mese = $langs['giugno'];
                                        else if ($mese == '07')
                                            $mese = $langs['luglio'];
                                        else if ($mese == '08')
                                            $mese = $langs['agosto'];
                                        else if ($mese == '09')
                                            $mese = $langs['settembre'];
                                        else if ($mese == '10')
                                            $mese = $langs['ottobre'];
                                        else if ($mese == '11')
                                            $mese = $langs['novembre'];
                                        else if ($mese == '12')
                                            $mese = $langs['dicembre'];

                                        if ($mese_fine == '01')
                                            $mese_fine = $langs['gennaio'];
                                        else if ($mese_fine == '02')
                                            $mese_fine = $langs['febbraio'];
                                        else if ($mese_fine == '03')
                                            $mese_fine = $langs['marzo'];
                                        else if ($mese_fine == '04')
                                            $mese_fine = $langs['aprile'];
                                        else if ($mese_fine == '05')
                                            $mese_fine = $langs['maggio'];
                                        else if ($mese_fine == '06')
                                            $mese_fine = $langs['giugno'];
                                        else if ($mese_fine == '07')
                                            $mese_fine = $langs['luglio'];
                                        else if ($mese_fine == '08')
                                            $mese_fine = $langs['agosto'];
                                        else if ($mese_fine == '09')
                                            $mese_fine = $langs['settembre'];
                                        else if ($mese_fine == '10')
                                            $mese_fine = $langs['ottobre'];
                                        else if ($mese_fine == '11')
                                            $mese_fine = $langs['novembre'];
                                        else if ($mese_fine == '12')
                                            $mese_fine = $langs['dicembre'];

                                        ?>
                                        <a class="item-evento" onclick="openEvento(<?php echo $dati['id']; ?>)">
                                            <div class="overlay">
                                                <img src="cp/<?php echo $dati['img_evento']; ?>" class="img-eventi"
                                                     title="" alt="">
                                            </div>
                                            <div class="item-evento-desc">
                                                <h3 class="title-evento"><?php echo $dati['nome_evento']; ?></h3>
                                                <?php if ($dati['data_fine_evento'] > date("Y-m-d")) {
                                                    if ($dati['data_inizio_evento'] != $dati['data_fine_evento']) {
                                                        if ($mese == $mese_fine) { ?>
                                                            <p class="data-evento"><?php echo substr($dati['data_inizio_evento'], 8) . '-' . substr($dati['data_fine_evento'], 8) . ' ' . substr($mese, 0, 3); ?></p>
                                                        <?php } else { ?>
                                                            <p class="data-evento"><?php echo substr($dati['data_inizio_evento'], 8) . ' ' . substr($mese, 0, 3) . '-' . substr($dati['data_fine_evento'], 8) . ' ' . substr($mese_fine, 0, 3); ?></p>
                                                        <?php }
                                                    } else { ?>
                                                        <p class="data-evento"><?php echo substr($dati['data_inizio_evento'], 8) . ' ' . substr($mese, 0, 3); ?></p>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <p class="data-evento"><?php echo substr($dati['data_fine_evento'], 8) . ' ' . substr($mese, 0, 3); ?></p>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        <?php
                                        $showed++;
                                    }
                                }
                            }
                        }
                    }
                }
                if ($showed == 0) {
                    echo '<div class="alert-info-eventi">' . $langs['no_eventi'] . '</div>';
                }
                ?>
                <?php
                if ($showed >= 1) { ?>
                    <a class="last-eventi-carousel" onclick="openCurEvent();">
                        <input type="button" class="see-all-eventi" value="<?php echo $langs['vedi_tutti']; ?>">
                    </a>
                <?php } ?>
            </div>
            <h2 class="title-in-blue title-padded mt25"><?php echo $langs['riservato_nostri_ospiti']; ?></h2>
            <div class="container-proposte">
                <?php

                $ids = array();
                $query = "SELECT * FROM strutture_hotel WHERE id_hotel = ? AND convenzionato = 1";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $_SESSION['id_hotel'], PDO::PARAM_INT);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $k = 0;
                    while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $id_struttura = $dati['id_struttura'];
                        $descs = getDescrizioniStruttura($dbh, $_SESSION['lang'], $id_struttura);
                        $desc_benefit = $descs['descrizione_benefit'];
                        $dati_struttura = getDatiStruttura($dbh, $id_struttura);

                        $query_my_hotel = "SELECT latitudine,longitudine FROM hotel WHERE id = ?";
                        $stmt_hotel = $dbh->prepare($query_my_hotel);
                        $stmt_hotel->bindParam(1, $_SESSION['id_hotel'], PDO::PARAM_INT);
                        $stmt_hotel->execute();
                        if ($stmt_hotel->rowCount() > 0) {
                            $dati_hotel = $stmt_hotel->fetch(PDO::FETCH_ASSOC);
                            $lat = $dati_hotel['latitudine'];
                            $lon = $dati_hotel['longitudine'];
                        }

                        $ch = curl_init();
                        if ($dati_struttura[0]['tipo_viaggio'] == 1)
                            $type = 'walking';
                        else if ($dati_struttura[0]['tipo_viaggio'] == 2 || $dati_struttura[0]['tipo_viaggio'] == 0)
                            $type = 'driving';
                        else if ($dati_struttura[0]['tipo_viaggio'] == 3)
                            $type = 'transit';
                        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $lat . "," . $lon . "&destinations=" . $dati_struttura[0]['latitudine'] . "," . $dati_struttura[0]['longitudine'] . "&mode=" . $type . "&language=it&key=AIzaSyD6DoJBgy3wuk3dCVUlQL3YbJUDtebSvhc";
                        curl_setopt($ch, CURLOPT_URL, $url);

                        // In real life you should use something like:
                        // curl_setopt($ch, CURLOPT_POSTFIELDS,
                        //          http_build_query(array('postvar1' => 'value1')));

                        // Receive server response ...
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $server_output = curl_exec($ch);
                        $output = json_decode($server_output, true);
                        //echo $server_output;
                        //print_r($output);
                        //echo $output['status'];
                        $time_travel = $output['rows'][0]['elements'][0]['duration']['text'];
                        $distance = $output['rows'][0]['elements'][0]['distance']['text'];
                        curl_close($ch);


                        if ($dati_struttura[0]['abilitata'] == 1) {

                            $immagini = explode("|", $dati_struttura[0]['immagine_didascalia']);
                            $img = $immagini[$dati_struttura[0]['immagine_principale'] - 1];
                            ?>
                            <a class="card-proposte" onclick="openProposta(<?php echo $id_struttura; ?>);">
                                <div class="head-proposte">
                                    <div>
                                        <img src="cp/<?php echo $img; ?>" class="img-prop" alt="" title=""/>
                                    </div>
                                    <div class="prop-right jcl">
                                        <p><?php if (strlen($desc_benefit) > 65) echo substr($desc_benefit, 0, 65) . '...'; else echo $desc_benefit; ?></p>
                                    </div>
                                </div>
                                <div class="foo-proposte">
                                    <div class="data-prop">
                                        <span></span>
                                    </div>
                                    <div class="prop-right">
                                        <div>
                                            <h4><?php echo $dati_struttura[0]['nome_struttura']; ?></h4>
                                            <span>A <?php echo $distance; ?> dall'Hotel</span>
                                        </div>
                                        <div class="data-proposte-time">
                                            <?php
                                            if ($dati_struttura[0]['tipo_viaggio'] == 1) { ?>
                                                <?php echo $time_travel; ?> <img src="img/walking.svg"
                                                                                 class="route-type route-home" alt=""
                                                                                 title="">
                                            <?php } else if ($dati_struttura[0]['tipo_viaggio'] == 2) { ?>
                                                <?php echo $time_travel; ?> <img src="img/car.svg"
                                                                                 class="route-type route-home" alt=""
                                                                                 title="">
                                            <?php } else if ($dati_struttura[0]['tipo_viaggio'] == 3) { ?>
                                                <?php echo $time_travel; ?> <img src="img/mezzi.svg"
                                                                                 class="route-type route-home" alt=""
                                                                                 title="">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php }
                    }
                } ?>


            </div>
        </div>
    </div>
</div>