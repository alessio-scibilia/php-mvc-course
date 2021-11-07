<div class="content-one-container" <?php if ($tab != false && $tab != 'info' && $tab != 'info') echo 'style="display:none;"'; ?>>
    <!-- OGNI DUE CARD_SERVICE METTERE LA FLEX-SPECIAL!!!!!!!! -->
    <div class="flex-special"> <!-- PT100 SOLO NEL PRIMO -->
        <?php
        /*$servizi = getDatiServizi($dbh, $_SESSION['id_hotel'], $_SESSION['lang']);
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
							  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"
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
        } */
        ?>
    </div>
</div>