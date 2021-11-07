<div class="d-flex d-flex-special">
    <svg xmlns="http://www.w3.org/2000/svg" width="39.195" height="38.203" viewBox="0 0 39.195 38.203"
         class="arrow-back">
        <path id="Icon_awesome-arrow-left" data-name="Icon awesome-arrow-left"
              d="M22.527,38.291l-1.942,1.942a2.091,2.091,0,0,1-2.966,0l-17.006-17a2.091,2.091,0,0,1,0-2.966L17.619,3.264a2.091,2.091,0,0,1,2.966,0l1.942,1.942a2.1,2.1,0,0,1-.035,3L11.951,18.249H37.092a2.094,2.094,0,0,1,2.1,2.1v2.8a2.094,2.094,0,0,1-2.1,2.1H11.951L22.492,35.29A2.087,2.087,0,0,1,22.527,38.291Z"
              transform="translate(0.004 -2.647)" fill="#183a58"/>
    </svg>
    <h2 class="title-in-blue title-section pb0" id="nome-categoria"><?php echo $nome_categoria; ?></h2>
</div>
<div class="padded padded-no-topbar">
    <div class="slide-cat-container owl-carousel owl-theme hidden-mob">

        <?php
        for ($i = 0; $i < sizeof($strutture_collegate); $i++) {
            $query = "SELECT * FROM strutture_categorie WHERE id_categoria = ? AND id_struttura = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(2, $strutture_collegate[$i]['id'], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dati_struttura = getDatiStruttura($dbh, $strutture_collegate[$i]['id']);

                $query_bis = "SELECT * FROM strutture_hotel WHERE id_struttura = ? AND id_hotel = ? AND convenzionato = 1";
                $stmt_bis = $dbh->prepare($query_bis);
                $stmt_bis->bindParam(1, $dati_struttura[0]['id'], PDO::PARAM_INT);
                $stmt_bis->bindParam(2, $_SESSION['id_hotel'], PDO::PARAM_INT);
                $stmt_bis->execute();
                if ($stmt_bis->rowCount() > 0)
                    $is_conv = true;
                else
                    $is_conv = false;
                ?>
                <div class="item-cat-container" id="i-<?php echo $dati_struttura[0]['id']; ?>">
                    <?php
                    $immagini = explode("|", $dati_struttura[0]['immagine_didascalia']);
                    echo '<img src="cp/' . $immagini[$dati_struttura[0]['immagine_principale'] - 1] . '" class="img-cat-item-in" alt="" title="" />'; ?>
                    <a class="info-cat-item" href="javascript:void();"
                       onclick="openCatItem(<?php echo $dati_struttura[0]['related_id']; ?>,<?php echo $_POST['id']; ?>);">
                        <h2><?php echo $dati_struttura[0]['nome_struttura']; ?></h2>
                        <p><?php

                            // we don't want new lines in our preview
                            $text_only_spaces = preg_replace('/\s+/', ' ', $dati_struttura[0]['descrizione']);

                            // truncates the text
                            $text_truncated = mb_substr($text_only_spaces, 0, mb_strpos($text_only_spaces, " ", 120));

                            // prevents last word truncation
                            $preview = trim(mb_substr($text_truncated, 0, mb_strrpos($text_truncated, " ")));

                            $testo = shorten_my_string($dati_struttura[0]['descrizione'], 120);


                            echo $testo; ?></p>

                        <div>
                            <?php
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
                            ?>
                            <div class="data-proposte-time">
                                <?php
                                if ($dati_struttura[0]['tipo_viaggio'] == 1) { ?>
                                    <?php echo $time_travel; ?> <img src="img/walking.svg"
                                                                     class="route-type-cats route-type" alt=""
                                                                     title=""> dall'Hotel
                                <?php } else if ($dati_struttura[0]['tipo_viaggio'] == 2 || $dati_struttura[0]['tipo_viaggio'] == 0) { ?>
                                    <?php echo $time_travel; ?> <img src="img/car.svg"
                                                                     class="route-type-cats route-type" alt=""
                                                                     title=""> dall'Hotel
                                <?php } else if ($dati_struttura[0]['tipo_viaggio'] == 3) { ?>
                                    <?php echo $time_travel; ?> <img src="img/mezzi.svg"
                                                                     class="route-type-cats route-type" alt=""
                                                                     title=""> dall'Hotel
                                <?php } ?>
                            </div>
                            <?php if ($is_conv == true) { ?>
                                <span class="conv-small">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="16.714" viewBox="0 0 18 16.714"
                                 class="svg-conv">
							  <g id="Raggruppa_15" data-name="Raggruppa 15" transform="translate(-256 -617.214)">
							    <path id="Icon_ionic-ios-star-outline" data-name="Icon ionic-ios-star-outline"
                                      d="M33.054,60.476a1.127,1.127,0,0,0-.41,1.278l1.209,3.527a.161.161,0,0,1-.245.185L30.5,63.248a1.119,1.119,0,0,0-.655-.209,1.09,1.09,0,0,0-.651.209l-3.109,2.214a.162.162,0,0,1-.225-.04.16.16,0,0,1-.02-.145l1.21-3.523a1.133,1.133,0,0,0-.414-1.286l-3.255-2.294a.161.161,0,0,1,.09-.293h3.968a1.125,1.125,0,0,0,1.065-.768l1.189-3.543a.162.162,0,0,1,.305,0l1.189,3.543a1.124,1.124,0,0,0,1.065.768h3.91a.159.159,0,0,1,.157.161.162.162,0,0,1-.067.128Z"
                                      transform="translate(236.087 566.994)" fill="#ffab80"/>
							    <path id="Icon_ionic-ios-star-outline-2" data-name="Icon ionic-ios-star-outline"
                                      d="M19.567,9.161h-5.91l-1.8-5.36a.651.651,0,0,0-1.221,0l-1.8,5.36H2.893A.645.645,0,0,0,2.25,9.8a.472.472,0,0,0,.012.108.618.618,0,0,0,.269.454l4.858,3.423-1.864,5.42a.645.645,0,0,0,.221.723.622.622,0,0,0,.362.157.788.788,0,0,0,.4-.145l4.741-3.379,4.741,3.379a.753.753,0,0,0,.4.145.577.577,0,0,0,.358-.157.637.637,0,0,0,.221-.723l-1.864-5.42,4.817-3.455.117-.1a.674.674,0,0,0,.209-.43A.68.68,0,0,0,19.567,9.161Zm-5.111,3.717a1.128,1.128,0,0,0-.41,1.278l1.209,3.524a.161.161,0,0,1-.245.185L11.9,15.646a1.123,1.123,0,0,0-.655-.209,1.1,1.1,0,0,0-.651.209l-3.11,2.214a.161.161,0,0,1-.245-.185L8.45,14.151a1.132,1.132,0,0,0-.414-1.286L4.781,10.571a.162.162,0,0,1,.092-.293H8.839A1.123,1.123,0,0,0,9.9,9.51l1.189-3.544a.162.162,0,0,1,.305,0L12.588,9.51a1.123,1.123,0,0,0,1.065.767h3.909a.159.159,0,0,1,.092.289Z"
                                      transform="translate(253.75 613.839)" fill="#183a58"/>
							  </g>
							</svg>
						</span>
                            <?php } ?>
                        </div>
                    </a>
                </div>
            <?php }
        } ?>

    </div>
</div>
<div class="cat-cont">
    <div class="mob-in-cat">
        <?php
        for ($i = 0; $i < sizeof($strutture_collegate); $i++) {
            $query = "SELECT * FROM strutture_categorie WHERE id_categoria = ? AND id_strutt˜ura = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(2, $strutture_collegate[$i]['id'], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dati_struttura = getDatiStruttura($dbh, $strutture_collegate[$i]['id']);
                ?>
                <div class="item-cat-container">
                    <div class="owl-cat owl-carousel owl-theme">
                        <?php
                        $immagini = explode("|", $dati_struttura[0]['immagine_didascalia']);
                        echo '<img src="cp/' . $immagini[$dati_struttura[0]['immagine_principale'] - 1] . '" class="img-cat-item-in" alt="" title="" />'; ?>

                    </div>
                    <a class="info-cat-item" href="javascript:void();"
                       onclick="openCatItem(<?php echo $dati_struttura[0]['related_id']; ?>,<?php echo $_POST['id']; ?>);">
                        <h2><?php echo $dati_struttura[0]['nome_struttura']; ?></h2>
                        <p><?php echo $dati_struttura[0]['descrizione']; ?></p>
                        <div>
                            <?php
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
                            ?>
                            <div class="data-proposte-time">
                                <?php
                                if ($dati_struttura[0]['tipo_viaggio'] == 1) { ?>
                                    <?php echo $time_travel; ?> <img src="img/walking.svg" alt=""
                                                                     title=""> dall'Hotel                                  <?php } else if ($dati_struttura[0]['tipo_viaggio'] == 2 || $dati_struttura[0]['tipo_viaggio'] == 0) { ?>
                                    <?php echo $time_travel; ?> <img src="img/car.svg" alt="" title=""> dall'Hotel
                                <?php } else if ($dati_struttura[0]['tipo_viaggio'] == 3) { ?>
                                    <?php echo $time_travel; ?><img src="img/mezzi.svg" alt="" title=""> dall'Hotel
                                <?php } ?>
                            </div>
                            <?php if ($is_conv == true) { ?>
                                <span class="conv-small">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="16.714" viewBox="0 0 18 16.714"
                             class="svg-conv">	  <g id="Raggruppa_15" data-name="Raggruppa 15"
                                                       transform="translate(-256 -617.214)">
							    <path id="Icon_ionic-ios-star-outline" data-name="Icon ionic-ios-star-outline"
                                      d="M33.054,60.476a1.127,1.127,0,0,0-.41,1.278l1.209,3.527a.161.161,0,0,1-.245.185L30.5,63.248a1.119,1.119,0,0,0-.655-.209,1.09,1.09,0,0,0-.651.209l-3.109,2.214a.162.162,0,0,1-.225-.04.16.16,0,0,1-.02-.145l1.21-3.523a1.133,1.133,0,0,0-.414-1.286l-3.255-2.294a.161.161,0,0,1,.09-.293h3.968a1.125,1.125,0,0,0,1.065-.768l1.189-3.543a.162.162,0,0,1,.305,0l1.189,3.543a1.124,1.124,0,0,0,1.065.768h3.91a.159.159,0,0,1,.157.161.162.162,0,0,1-.067.128Z"
                                      transform="translate(236.087 566.994)" fill="#ffab80"/>
							    <path id="Icon_ionic-ios-star-outline-2" data-name="Icon ionic-ios-star-outline"
                                      d="M19.567,9.161h-5.91l-1.8-5.36a.651.651,0,0,0-1.221,0l-1.8,5.36H2.893A.645.645,0,0,0,2.25,9.8a.472.472,0,0,0,.012.108.618.618,0,0,0,.269.454l4.858,3.423-1.864,5.42a.645.645,0,0,0,.221.723.622.622,0,0,0,.362.157.788.788,0,0,0,.4-.145l4.741-3.379,4.741,3.379a.753.753,0,0,0,.4.145.577.577,0,0,0,.358-.157.637.637,0,0,0,.221-.723l-1.864-5.42,4.817-3.455.117-.1a.674.674,0,0,0,.209-.43A.68.68,0,0,0,19.567,9.161Zm-5.111,3.717a1.128,1.128,0,0,0-.41,1.278l1.209,3.524a.161.161,0,0,1-.245.185L11.9,15.646a1.123,1.123,0,0,0-.655-.209,1.1,1.1,0,0,0-.651.209l-3.11,2.214a.161.161,0,0,1-.245-.185L8.45,14.151a1.132,1.132,0,0,0-.414-1.286L4.781,10.571a.162.162,0,0,1,.092-.293H8.839A1.123,1.123,0,0,0,9.9,9.51l1.189-3.544a.162.162,0,0,1,.305,0L12.588,9.51a1.123,1.123,0,0,0,1.065.767h3.909a.159.159,0,0,1,.092.289Z"
                                      transform="translate(253.75 613.839)" fill="#183a58"/>
							  </g>
							</svg>
					</span>
                            <?php } ?>
                        </div>
                    </a>
                </div>


                <?php
            }
            ?>


            <?php
        }
        ?>    </div>
</div>