<?php
include('../main.php');
include($GLOBALS['where_path'] . 'functions/functions.php');
session_start();

if (!isset($_SESSION['lang'])) {
    $lang = 1;
    $_SESSION['lang'] = 1;
} else
    $lang = $_SESSION['lang'];
/* Recupero le traduzioni del sito */
$langs = getTraduzioniBackend($dbh, $lang);

$id_evento = $_POST['id'];

$query = "SELECT * FROM eventi WHERE id = ?";
$stmt = $dbh->prepare($query);
$stmt->bindParam(1, $id_evento, PDO::PARAM_INT);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {


        $mese_fine = substr($dati['data_fine_evento'], 5, 2);
        $mese_inizio = substr($dati['data_inizio_evento'], 5, 2);
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

        if ($mese_inizio == '01')
            $mese_inizio = $langs['gennaio'];
        else if ($mese_inizio == '02')
            $mese_inizio = $langs['febbraio'];
        else if ($mese_inizio == '03')
            $mese_inizio = $langs['marzo'];
        else if ($mese_inizio == '04')
            $mese_inizio = $langs['aprile'];
        else if ($mese_inizio == '05')
            $mese_inizio = $langs['maggio'];
        else if ($mese_inizio == '06')
            $mese_inizio = $langs['giugno'];
        else if ($mese_inizio == '07')
            $mese_inizio = $langs['luglio'];
        else if ($mese_inizio == '08')
            $mese_inizio = $langs['agosto'];
        else if ($mese_inizio == '09')
            $mese_inizio = $langs['settembre'];
        else if ($mese_inizio == '10')
            $mese_inizio = $langs['ottobre'];
        else if ($mese_inizio == '11')
            $mese_inizio = $langs['novembre'];
        else if ($mese_inizio == '12')
            $mese_inizio = $langs['dicembre'];


        $id_evento = $dati['id'];
        $query_bis = "SELECT * FROM strutture_eventi WHERE id_evento = ? AND shortcode_lingua = ?";
        $stmt_bis = $dbh->prepare($query_bis);
        $stmt_bis->bindParam(1, $id_evento, PDO::PARAM_INT);
        $stmt_bis->bindParam(2, $_SESSION['lang'], PDO::PARAM_INT);
        $stmt_bis->execute();
        if ($stmt_bis->rowCount() > 0) {
            $dati_bis = $stmt_bis->fetch(PDO::FETCH_ASSOC);
            $testo_convenzione = $dati_bis['testo_convenzione'];
            $desc_evento = $dati_bis['descrizione_evento'];
        }
        if ($dati['recupera_struttura'] == 1) {
            $id_struttura = $dati['struttura_collegata'];
            if ($id_struttura[0] == 1) {
                //recupero da hotel
                $dati_struttura = getHotel($dbh, substr($id_struttura, 2));
                $lats = $dati_struttura[0]['latitudine'];
                $longs = $dati_struttura[0]['longs'];
                if ($dati_struttura['shortcode_lingua'] != $_SESSION['lang']) {
                    $new_id = $dati_struttura['id'] + $_SESSION['lang'] - 1;
                    $dati_struttura = getHotel($dbh, $new_id);
                }
            } else if ($id_struttura[0] == 2) {
                //recupero da struttura
                $dati_struttura = getDatiStruttura($dbh, substr($id_struttura, 2));
            }
            ?>
            <div class="mob-p20">
                <div class="d-flex d-flex-special">
                    <svg xmlns="http://www.w3.org/2000/svg" width="39.195" height="38.203" viewBox="0 0 39.195 38.203"
                         class="arrow-back-item-evento">
                        <path id="Icon_awesome-arrow-left" data-name="Icon awesome-arrow-left"
                              d="M22.527,38.291l-1.942,1.942a2.091,2.091,0,0,1-2.966,0l-17.006-17a2.091,2.091,0,0,1,0-2.966L17.619,3.264a2.091,2.091,0,0,1,2.966,0l1.942,1.942a2.1,2.1,0,0,1-.035,3L11.951,18.249H37.092a2.094,2.094,0,0,1,2.1,2.1v2.8a2.094,2.094,0,0,1-2.1,2.1H11.951L22.492,35.29A2.087,2.087,0,0,1,22.527,38.291Z"
                              transform="translate(0.004 -2.647)" fill="#183a58"/>
                    </svg>
                    <div class="plat40 pl0mob">
                        <h3 class="title-in-blue-small"
                            id="title-eventi"><?php echo strtoupper($langs['eventi']); ?></h3>
                        <h2 class="title-in-blue title-section title-less-mobile"
                            id="nome-evento"><?php echo $dati['nome_evento']; ?></h2>
                    </div>
                </div>
                <div class="padded">
                    <div class="evento-item-container hidden-mob">
                        <div>
                            <?php
                            $giorno_fine = substr($dati['data_fine_evento'], 8, 2);
                            $giorno_inizio = substr($dati['data_inizio_evento'], 8, 2);
                            if ($dati['data_inizio_evento'] != $dati['data_fine_evento']) {
                                ?>
                                <div class="item-data-evento"><?php echo $giorno_inizio; ?>
                                    <span><?php echo strtoupper(substr($mese_inizio, 0, 3)); ?></span><?php echo $giorno_fine; ?>
                                    <span><?php echo strtoupper(substr($mese_fine, 0, 3)); ?></span></div>
                            <?php } else { ?>
                                <div class="item-data-evento"><?php echo $giorno_inizio; ?>
                                    <span><?php echo strtoupper(substr($mese_inizio, 0, 3)); ?></span></div>
                            <?php } ?>
                        </div>
                        <div class="evento-desc">
                            <?php echo $desc_evento; ?>
                        </div>
                    </div>
                    <div class="hidden-lg pb0">
                        <img src="cp/<?php echo $dati['img_evento']; ?>"
                             class="cat-item-open cat-item-open-small cat-item-open-small-event">
                        <div class="data-event-cont">
                            <?php
                            if ($dati['data_inizio_evento'] != $dati['data_fine_evento']) {
                                ?>
                                <div class="event-date"><?php echo $giorno_inizio; ?>
                                    <span><?php echo strtoupper(substr($mese_inizio, 0, 3)); ?></span><?php echo $giorno_fine; ?>
                                    <span><?php echo strtoupper(substr($mese_fine, 0, 3)); ?></span></div>
                            <?php } else { ?>
                                <div class="event-date"><?php echo $giorno_inizio; ?>
                                    <span><?php echo strtoupper(substr($mese_inizio, 0, 3)); ?></span></div>
                            <?php } ?>
                            <div class="p-desc-service">
                                <?php echo $desc_evento; ?>
                            </div>
                        </div>
                    </div>
                    <div class="actions-small hidden-lg-actions">
                        <a class="info-evento" href="#"
                           onclick="openPrenota('ev',<?php if ($id_struttura[0] == 2) echo $dati_struttura[0]['id'] . ',2'; else echo $dati_struttura['id'] . ',1'; ?>);">
                            <div class="info-evento-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                     viewBox="0 0 68.624 68.544" class="info-img-item-in">
                                    <g id="Raggruppa_36" data-name="Raggruppa 36" transform="translate(0)">
                                        <g id="Livello_2" data-name="Livello 2" transform="translate(3.186 9.917)">
                                            <circle id="Ellisse_30" data-name="Ellisse 30" cx="12.573" cy="12.573"
                                                    r="12.573" transform="translate(32.325 24.348)" fill="#e0eeeb"/>
                                            <path id="Rettangolo_34" data-name="Rettangolo 34"
                                                  d="M0,0H36.229a2,2,0,0,1,2,2V7.926a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V0A0,0,0,0,1,0,0Z"
                                                  transform="translate(0 0)" fill="#5ae9d1"/>
                                        </g>
                                        <g id="Livello_1" data-name="Livello 1" transform="translate(0 0)">
                                            <g id="Raggruppa_35" data-name="Raggruppa 35">
                                                <path id="Tracciato_56" data-name="Tracciato 56"
                                                      d="M50.935,31.4V13.448a5.761,5.761,0,0,0-5.761-5.761H38.006V5.677a2.077,2.077,0,1,0-4.154,0V7.62H19.583V5.677a2.077,2.077,0,1,0-4.154,0V7.62H8.261A5.761,5.761,0,0,0,2.5,13.381V44.733a5.761,5.761,0,0,0,5.761,5.761H31.776A17.209,17.209,0,1,0,50.935,31.4ZM8.261,11.773h7.168v1.943a2.077,2.077,0,0,0,4.154,0V11.773H33.852v1.943a2.077,2.077,0,1,0,4.154,0V11.773h7.168a1.659,1.659,0,0,1,1.675,1.675v7.034H6.654V13.448A1.645,1.645,0,0,1,8.261,11.773ZM6.654,44.8V24.569h40.2V31.4A17.214,17.214,0,0,0,31.843,46.408H8.261A1.63,1.63,0,0,1,6.654,44.8ZM48.926,61.615a13.1,13.1,0,1,1,13.13-13.063A13.152,13.152,0,0,1,48.926,61.615Z"
                                                      transform="translate(-2.5 -3.6)" fill="#183a58"/>
                                                <path id="Tracciato_57" data-name="Tracciato 57"
                                                      d="M76.438,64.034H72.754V59.077a2.077,2.077,0,1,0-4.154,0v7.034a2.087,2.087,0,0,0,2.077,2.077h5.761a2.077,2.077,0,0,0,0-4.154Z"
                                                      transform="translate(-24.318 -21.226)" fill="#183a58"/>
                                            </g>
                                            <circle id="Ellisse_31" data-name="Ellisse 31" cx="6.443" cy="6.443"
                                                    r="6.443" transform="translate(9.172 55.659)" fill="#5ae9d1"/>
                                            <circle id="Ellisse_32" data-name="Ellisse 32" cx="3.221" cy="3.221"
                                                    r="3.221" transform="translate(51.762 8.173)" fill="#5ae9d1"/>
                                            <path id="Tracciato_58" data-name="Tracciato 58"
                                                  d="M5.851,0A5.851,5.851,0,1,1,0,5.851,5.851,5.851,0,0,1,5.851,0Z"
                                                  transform="translate(56.922 14.616)" fill="#e0eeeb"/>
                                        </g>
                                    </g>
                                </svg>
                            </div>

                            <div class="info-item-title"><?php echo $langs['prenota']; ?></div>
                        </a>
                        <a class="info-evento" href="tel:<?php echo $dati_struttura[0]['telefono']; ?>">
                            <div class="info-evento-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                     viewBox="0 0 64.445 52.308" class="info-img-item-in">
                                    <g id="Raggruppa_37" data-name="Raggruppa 37" transform="translate(5.312)">
                                        <path id="Tracciato_59" data-name="Tracciato 59"
                                              d="M34.927,45.658c-.046.046-5.591,3.689-20.877-11.6C-1.566,18.448,2.458,13.185,2.452,13.185L9.411,6.224l6.959,6.961-5.8,5.8a1.638,1.638,0,0,0,0,2.319L26.808,37.538a1.638,1.638,0,0,0,2.319,0l5.8-5.8L41.884,38.7Z"
                                              transform="translate(4.675 3.984)" fill="#e0eeeb"/>
                                        <path id="Tracciato_60" data-name="Tracciato 60"
                                              d="M38.032,17.468h-3.28a1.636,1.636,0,0,0-1.16.481L27.2,21.71v-2.6a1.641,1.641,0,0,0-1.64-1.64H18.35V2.707H38.032Z"
                                              transform="translate(15.147 1.733)" fill="#5ae9d1"/>
                                        <path id="Tracciato_61" data-name="Tracciato 61"
                                              d="M38.52,29.042a3.251,3.251,0,0,0-2.318-.961h0a3.258,3.258,0,0,0-2.318.961L29.244,33.68,15.327,19.763l4.638-4.638a3.285,3.285,0,0,0,0-4.642L13,3.524a3.257,3.257,0,0,0-2.318-.959,3.373,3.373,0,0,0-2.321.963L1.407,10.487C1.2,10.7-.638,12.683.233,17.043,1.26,22.174,5.557,28.555,13,36,23.664,46.662,30.387,49.02,34.249,49.02A5.955,5.955,0,0,0,38.52,47.6l6.957-6.957a3.285,3.285,0,0,0,0-4.643ZM36.2,45.277c-.046.046-5.591,3.689-20.877-11.6C-.292,18.068,3.733,12.8,3.727,12.8l6.959-6.961L17.645,12.8l-5.8,5.8a1.638,1.638,0,0,0,0,2.319L28.083,37.157a1.638,1.638,0,0,0,2.319,0l5.8-5.8,6.959,6.961Z"
                                              transform="translate(3.4 1.642)" fill="#183a58"/>
                                        <path id="Tracciato_62" data-name="Tracciato 62"
                                              d="M37.841,0H18.159a3.284,3.284,0,0,0-3.28,3.28V18.042a3.284,3.284,0,0,0,3.28,3.28h8.2v4.92a1.64,1.64,0,0,0,2.8,1.16l6.08-6.08h2.6a3.284,3.284,0,0,0,3.28-3.28V3.28A3.284,3.284,0,0,0,37.841,0Zm0,18.042h-3.28a1.636,1.636,0,0,0-1.16.481L29.64,22.283v-2.6A1.641,1.641,0,0,0,28,18.042H18.159V3.28H37.841Z"
                                              transform="translate(12.925)" fill="#183a58"/>
                                        <circle id="Ellisse_33" data-name="Ellisse 33" cx="7.834" cy="7.834" r="7.834"
                                                transform="translate(-5.312 32.78)" fill="#5ae9d1"/>
                                        <circle id="Ellisse_34" data-name="Ellisse 34" cx="2.5" cy="2.5" r="2.5"
                                                transform="translate(12.979 47.307)" fill="#5ae9d1"/>
                                        <circle id="Ellisse_35" data-name="Ellisse 35" cx="4.647" cy="4.647" r="4.647"
                                                transform="translate(49.839 24.846)" fill="#e0eeeb"/>
                                    </g>
                                </svg>
                            </div>

                            <div class="info-item-title"><?php echo $langs['chiama']; ?></div>
                        </a>
                        <a class="info-evento"
                           href="https://www.google.com/maps/search/?api=1&query=<?php echo $dati_struttura[0]['latitudine'] . ',' . $dati_struttura[0]['longitudine']; ?>"
                           target="_blank">
                            <div class="info-evento-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                     viewBox="0 0 52.887 55.9" class="info-img-item-in">
                                    <g id="Raggruppa_39" data-name="Raggruppa 39" transform="translate(-16.66 -18.364)">
                                        <path id="Tracciato_63" data-name="Tracciato 63"
                                              d="M80.957,45.835c-2.636-3.85-5.916-8.642-5.916-11.377a8.626,8.626,0,0,1,17.251,0c0,2.735-3.281,7.526-5.916,11.377-1.113,1.625-2.025,2.97-2.709,4.109C82.981,48.8,82.069,47.46,80.957,45.835Z"
                                              transform="translate(-29.538 -3.779)" fill="#5ae9d1"/>
                                        <path id="Tracciato_64" data-name="Tracciato 64"
                                              d="M31.457,82.437,20.375,86.1V56.844l11.082-4.652Z"
                                              transform="translate(-1.88 -17.115)" fill="#e0eeeb"/>
                                        <path id="Tracciato_65" data-name="Tracciato 65"
                                              d="M86.522,82.976l-9.62,3.7V57.428l1.754-.737,7.866,11.4Z"
                                              transform="translate(-30.479 -19.392)" fill="#e0eeeb"/>
                                        <path id="Tracciato_66" data-name="Tracciato 66"
                                              d="M102.106,85.547l10.6,4.082V60.378l-3.61-1.516-6.994,11.5Z"
                                              transform="translate(-43.232 -20.49)" fill="#e0eeeb"/>
                                        <path id="Tracciato_67" data-name="Tracciato 67"
                                              d="M44.708,79.011,55.79,82.669V53.417L44.708,48.765Z"
                                              transform="translate(-14.191 -15.381)" fill="#e0eeeb"/>
                                        <path id="Tracciato_68" data-name="Tracciato 68"
                                              d="M67.858,35.379a12.713,12.713,0,0,0,1.655-5.425,11.59,11.59,0,0,0-23.18,0,12.711,12.711,0,0,0,1.655,5.425l-2.087.764-12.022-4.4-13.5,4.941V71.362l13.5-4.941,12.022,4.4,12.022-4.4,13.5,4.941V36.685ZM32.4,63.808l-9.057,3.314V38.757L32.4,35.442Zm12.022,3.314-9.057-3.314V35.442l9.057,3.315ZM56.441,49.215v.006h0V63.808l-9.058,3.314V38.757L49.463,38c1.029,1.685,2.193,3.387,3.3,5.009,1.54,2.249,3.649,5.33,3.674,6.206v0ZM55.213,41.33C52.577,37.48,49.3,32.689,49.3,29.954a8.626,8.626,0,1,1,17.251,0c0,2.735-3.281,7.526-5.916,11.377-1.113,1.625-2.025,2.97-2.709,4.109C57.237,44.3,56.325,42.955,55.213,41.33ZM68.462,67.121l-9.057-3.314V49.21c.024-.875,2.133-3.956,3.674-6.206,1.111-1.622,2.275-3.324,3.3-5.009l2.08.761V67.121Z"
                                              transform="translate(-1.88 0)" fill="#183a58"/>
                                        <circle id="Ellisse_36" data-name="Ellisse 36" cx="2.355" cy="2.355" r="2.355"
                                                transform="translate(35.665 20.444)" fill="#e0eeeb"/>
                                        <circle id="Ellisse_37" data-name="Ellisse 37" cx="2.355" cy="2.355" r="2.355"
                                                transform="translate(55.511 69.555)" fill="#e0eeeb"/>
                                        <circle id="Ellisse_38" data-name="Ellisse 38" cx="5.55" cy="5.55" r="5.55"
                                                transform="translate(16.66 21.369)" fill="#5ae9d1"/>
                                    </g>
                                </svg>
                            </div>

                            <div onclick="openPrenota('ev',<?php if ($id_struttura[0] == 2) echo $dati_struttura[0]['id'] . ',2'; else echo $dati_struttura[0]['id'] . ',1'; ?>);"
                                 class="info-item-title"><?php echo $langs['mappa']; ?></div>
                        </a>
                    </div>

                    <div class="info-item-container hidden-mob">
                        <a class="info-item">
                            <div class="info-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                     viewBox="0 0 68.624 68.544" class="info-img-item">
                                    <g id="Raggruppa_36" data-name="Raggruppa 36" transform="translate(0)">
                                        <g id="Livello_2" data-name="Livello 2" transform="translate(3.186 9.917)">
                                            <circle id="Ellisse_30" data-name="Ellisse 30" cx="12.573" cy="12.573"
                                                    r="12.573" transform="translate(32.325 24.348)" fill="#e0eeeb"/>
                                            <path id="Rettangolo_34" data-name="Rettangolo 34"
                                                  d="M0,0H36.229a2,2,0,0,1,2,2V7.926a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V0A0,0,0,0,1,0,0Z"
                                                  transform="translate(0 0)" fill="#5ae9d1"/>
                                        </g>
                                        <g id="Livello_1" data-name="Livello 1" transform="translate(0 0)">
                                            <g id="Raggruppa_35" data-name="Raggruppa 35">
                                                <path id="Tracciato_56" data-name="Tracciato 56"
                                                      d="M50.935,31.4V13.448a5.761,5.761,0,0,0-5.761-5.761H38.006V5.677a2.077,2.077,0,1,0-4.154,0V7.62H19.583V5.677a2.077,2.077,0,1,0-4.154,0V7.62H8.261A5.761,5.761,0,0,0,2.5,13.381V44.733a5.761,5.761,0,0,0,5.761,5.761H31.776A17.209,17.209,0,1,0,50.935,31.4ZM8.261,11.773h7.168v1.943a2.077,2.077,0,0,0,4.154,0V11.773H33.852v1.943a2.077,2.077,0,1,0,4.154,0V11.773h7.168a1.659,1.659,0,0,1,1.675,1.675v7.034H6.654V13.448A1.645,1.645,0,0,1,8.261,11.773ZM6.654,44.8V24.569h40.2V31.4A17.214,17.214,0,0,0,31.843,46.408H8.261A1.63,1.63,0,0,1,6.654,44.8ZM48.926,61.615a13.1,13.1,0,1,1,13.13-13.063A13.152,13.152,0,0,1,48.926,61.615Z"
                                                      transform="translate(-2.5 -3.6)" fill="#183a58"/>
                                                <path id="Tracciato_57" data-name="Tracciato 57"
                                                      d="M76.438,64.034H72.754V59.077a2.077,2.077,0,1,0-4.154,0v7.034a2.087,2.087,0,0,0,2.077,2.077h5.761a2.077,2.077,0,0,0,0-4.154Z"
                                                      transform="translate(-24.318 -21.226)" fill="#183a58"/>
                                            </g>
                                            <circle id="Ellisse_31" data-name="Ellisse 31" cx="6.443" cy="6.443"
                                                    r="6.443" transform="translate(9.172 55.659)" fill="#5ae9d1"/>
                                            <circle id="Ellisse_32" data-name="Ellisse 32" cx="3.221" cy="3.221"
                                                    r="3.221" transform="translate(51.762 8.173)" fill="#5ae9d1"/>
                                            <path id="Tracciato_58" data-name="Tracciato 58"
                                                  d="M5.851,0A5.851,5.851,0,1,1,0,5.851,5.851,5.851,0,0,1,5.851,0Z"
                                                  transform="translate(56.922 14.616)" fill="#e0eeeb"/>
                                        </g>
                                    </g>
                                </svg>
                            </div>

                            <div onclick="openPrenota('ev',<?php if ($id_struttura[0] == 2) echo $dati_struttura[0]['id'] . ',2'; else echo $dati_struttura['id'] . ',1'; ?>);"
                                 class="info-item-title"><?php echo $langs['scegli_data_esteso']; ?></div>
                        </a>
                        <?php if ($dati_struttura[0]['telefono'] != '') { ?>

                            <a class="info-item" href="tel:<?php echo $dati_struttura[0]['telefono']; ?>">
                                <div class="info-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                         viewBox="0 0 64.445 52.308" class="info-img-item">
                                        <g id="Raggruppa_37" data-name="Raggruppa 37" transform="translate(5.312)">
                                            <path id="Tracciato_59" data-name="Tracciato 59"
                                                  d="M34.927,45.658c-.046.046-5.591,3.689-20.877-11.6C-1.566,18.448,2.458,13.185,2.452,13.185L9.411,6.224l6.959,6.961-5.8,5.8a1.638,1.638,0,0,0,0,2.319L26.808,37.538a1.638,1.638,0,0,0,2.319,0l5.8-5.8L41.884,38.7Z"
                                                  transform="translate(4.675 3.984)" fill="#e0eeeb"/>
                                            <path id="Tracciato_60" data-name="Tracciato 60"
                                                  d="M38.032,17.468h-3.28a1.636,1.636,0,0,0-1.16.481L27.2,21.71v-2.6a1.641,1.641,0,0,0-1.64-1.64H18.35V2.707H38.032Z"
                                                  transform="translate(15.147 1.733)" fill="#5ae9d1"/>
                                            <path id="Tracciato_61" data-name="Tracciato 61"
                                                  d="M38.52,29.042a3.251,3.251,0,0,0-2.318-.961h0a3.258,3.258,0,0,0-2.318.961L29.244,33.68,15.327,19.763l4.638-4.638a3.285,3.285,0,0,0,0-4.642L13,3.524a3.257,3.257,0,0,0-2.318-.959,3.373,3.373,0,0,0-2.321.963L1.407,10.487C1.2,10.7-.638,12.683.233,17.043,1.26,22.174,5.557,28.555,13,36,23.664,46.662,30.387,49.02,34.249,49.02A5.955,5.955,0,0,0,38.52,47.6l6.957-6.957a3.285,3.285,0,0,0,0-4.643ZM36.2,45.277c-.046.046-5.591,3.689-20.877-11.6C-.292,18.068,3.733,12.8,3.727,12.8l6.959-6.961L17.645,12.8l-5.8,5.8a1.638,1.638,0,0,0,0,2.319L28.083,37.157a1.638,1.638,0,0,0,2.319,0l5.8-5.8,6.959,6.961Z"
                                                  transform="translate(3.4 1.642)" fill="#183a58"/>
                                            <path id="Tracciato_62" data-name="Tracciato 62"
                                                  d="M37.841,0H18.159a3.284,3.284,0,0,0-3.28,3.28V18.042a3.284,3.284,0,0,0,3.28,3.28h8.2v4.92a1.64,1.64,0,0,0,2.8,1.16l6.08-6.08h2.6a3.284,3.284,0,0,0,3.28-3.28V3.28A3.284,3.284,0,0,0,37.841,0Zm0,18.042h-3.28a1.636,1.636,0,0,0-1.16.481L29.64,22.283v-2.6A1.641,1.641,0,0,0,28,18.042H18.159V3.28H37.841Z"
                                                  transform="translate(12.925)" fill="#183a58"/>
                                            <circle id="Ellisse_33" data-name="Ellisse 33" cx="7.834" cy="7.834"
                                                    r="7.834" transform="translate(-5.312 32.78)" fill="#5ae9d1"/>
                                            <circle id="Ellisse_34" data-name="Ellisse 34" cx="2.5" cy="2.5" r="2.5"
                                                    transform="translate(12.979 47.307)" fill="#5ae9d1"/>
                                            <circle id="Ellisse_35" data-name="Ellisse 35" cx="4.647" cy="4.647"
                                                    r="4.647" transform="translate(49.839 24.846)" fill="#e0eeeb"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="info-item-title"><?php echo $langs['chiamaci_al']; ?>
                                    : <?php echo $dati_struttura[0]['telefono']; ?></div>
                            </a>
                        <?php } ?>
                        <a class="info-item"
                           href="https://www.google.com/maps/search/?api=1&query=<?php echo $dati_struttura[0]['latitudine'] . ',' . $dati_struttura[0]['longitudine']; ?>"
                           target="_blank">
                            <div class="info-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                     viewBox="0 0 52.887 55.9" class="info-img-item">
                                    <g id="Raggruppa_39" data-name="Raggruppa 39" transform="translate(-16.66 -18.364)">
                                        <path id="Tracciato_63" data-name="Tracciato 63"
                                              d="M80.957,45.835c-2.636-3.85-5.916-8.642-5.916-11.377a8.626,8.626,0,0,1,17.251,0c0,2.735-3.281,7.526-5.916,11.377-1.113,1.625-2.025,2.97-2.709,4.109C82.981,48.8,82.069,47.46,80.957,45.835Z"
                                              transform="translate(-29.538 -3.779)" fill="#5ae9d1"/>
                                        <path id="Tracciato_64" data-name="Tracciato 64"
                                              d="M31.457,82.437,20.375,86.1V56.844l11.082-4.652Z"
                                              transform="translate(-1.88 -17.115)" fill="#e0eeeb"/>
                                        <path id="Tracciato_65" data-name="Tracciato 65"
                                              d="M86.522,82.976l-9.62,3.7V57.428l1.754-.737,7.866,11.4Z"
                                              transform="translate(-30.479 -19.392)" fill="#e0eeeb"/>
                                        <path id="Tracciato_66" data-name="Tracciato 66"
                                              d="M102.106,85.547l10.6,4.082V60.378l-3.61-1.516-6.994,11.5Z"
                                              transform="translate(-43.232 -20.49)" fill="#e0eeeb"/>
                                        <path id="Tracciato_67" data-name="Tracciato 67"
                                              d="M44.708,79.011,55.79,82.669V53.417L44.708,48.765Z"
                                              transform="translate(-14.191 -15.381)" fill="#e0eeeb"/>
                                        <path id="Tracciato_68" data-name="Tracciato 68"
                                              d="M67.858,35.379a12.713,12.713,0,0,0,1.655-5.425,11.59,11.59,0,0,0-23.18,0,12.711,12.711,0,0,0,1.655,5.425l-2.087.764-12.022-4.4-13.5,4.941V71.362l13.5-4.941,12.022,4.4,12.022-4.4,13.5,4.941V36.685ZM32.4,63.808l-9.057,3.314V38.757L32.4,35.442Zm12.022,3.314-9.057-3.314V35.442l9.057,3.315ZM56.441,49.215v.006h0V63.808l-9.058,3.314V38.757L49.463,38c1.029,1.685,2.193,3.387,3.3,5.009,1.54,2.249,3.649,5.33,3.674,6.206v0ZM55.213,41.33C52.577,37.48,49.3,32.689,49.3,29.954a8.626,8.626,0,1,1,17.251,0c0,2.735-3.281,7.526-5.916,11.377-1.113,1.625-2.025,2.97-2.709,4.109C57.237,44.3,56.325,42.955,55.213,41.33ZM68.462,67.121l-9.057-3.314V49.21c.024-.875,2.133-3.956,3.674-6.206,1.111-1.622,2.275-3.324,3.3-5.009l2.08.761V67.121Z"
                                              transform="translate(-1.88 0)" fill="#183a58"/>
                                        <circle id="Ellisse_36" data-name="Ellisse 36" cx="2.355" cy="2.355" r="2.355"
                                                transform="translate(35.665 20.444)" fill="#e0eeeb"/>
                                        <circle id="Ellisse_37" data-name="Ellisse 37" cx="2.355" cy="2.355" r="2.355"
                                                transform="translate(55.511 69.555)" fill="#e0eeeb"/>
                                        <circle id="Ellisse_38" data-name="Ellisse 38" cx="5.55" cy="5.55" r="5.55"
                                                transform="translate(16.66 21.369)" fill="#5ae9d1"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="info-item-title"><?php echo $langs['come_raggiungerci']; ?></div>
                        </a>
                    </div>


                    <?php if ($id_struttura[0] == 2) { ?>
                        <div class="arrow-more hidden-mob">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27.493" height="15.161"
                                 viewBox="0 0 27.493 15.161">
                                <path id="Tracciato_45" data-name="Tracciato 45"
                                      d="M3134.321,1983.433l13.039,13.039,13.039-13.039"
                                      transform="translate(-3133.614 -1982.726)" fill="none" stroke="#919f9c"
                                      stroke-width="2"/>
                            </svg>
                        </div>
                        <div class="excellence-container" id="more">
                            <h2 class="title-in-blue title-in-page mb60 pb30"
                                id="ex-cont"><?php if ($id_struttura[0] == 1) echo $dati_struttura['nome']; else echo $dati_struttura[0]['nome_struttura']; ?></h2>
                            <div class="item-excellence">
                                <?php
                                if ($id_struttura[0] == 1) {
                                    $immagini = explode("|", $dati_struttura['immagini_secondarie']);
                                    $index = intval($dati_struttura['immagine_principale']) - 1;
                                } else {
                                    $immagini = explode("|", $dati_struttura[0]['immagine_didascalia']);
                                    $index = $dati_struttura[0]['immagine_principale'] - 1;
                                }
                                ?>
                                <img src="cp/<?php echo $immagini[$index]; ?>" class="img-excellence" alt="" title=""/>
                                <div class="p-excellence"><?php if ($id_struttura[0] == 1) echo $dati_struttura['descrizione_ospiti']; else echo $dati_struttura[0]['descrizione']; ?>
                                    <input type="submit" class="openStruttura"
                                           data-id="<?php echo $dati_struttura[0]['id']; ?>"
                                           data-type="<?php if ($id_struttura[0] == 1) echo '1'; else echo '2'; ?>"
                                           value="PIÙ INFORMAZIONI">
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
            </div>
            <div class="image_cat_item_evento <?php if ($tab == 'item' && $section == 'e') echo 'image_cat_item_evento_active'; ?>">
                <img src="cp/<?php echo $dati['img_evento']; ?>" class="cat-item-open">
            </div>
            <div>
        <?php } else {
            ?>
            <div class="mob-p20">
                <div class="d-flex d-flex-special">
                    <svg xmlns="http://www.w3.org/2000/svg" width="39.195" height="38.203" viewBox="0 0 39.195 38.203"
                         class="arrow-back-item-evento">
                        <path id="Icon_awesome-arrow-left" data-name="Icon awesome-arrow-left"
                              d="M22.527,38.291l-1.942,1.942a2.091,2.091,0,0,1-2.966,0l-17.006-17a2.091,2.091,0,0,1,0-2.966L17.619,3.264a2.091,2.091,0,0,1,2.966,0l1.942,1.942a2.1,2.1,0,0,1-.035,3L11.951,18.249H37.092a2.094,2.094,0,0,1,2.1,2.1v2.8a2.094,2.094,0,0,1-2.1,2.1H11.951L22.492,35.29A2.087,2.087,0,0,1,22.527,38.291Z"
                              transform="translate(0.004 -2.647)" fill="#183a58"/>
                    </svg>
                    <div class="plat40 pl0mob">
                        <h3 class="title-in-blue-small"
                            id="title-eventi"><?php echo strtoupper($langs['eventi']); ?></h3>
                        <h2 class="title-in-blue title-section title-less-mobile"
                            id="nome-evento"><?php echo $dati['nome_evento']; ?></h2>
                    </div>
                </div>
                <div class="padded">
                    <div class="evento-item-container hidden-mob">
                        <div>
                            <?php
                            $giorno_fine = substr($dati['data_fine_evento'], 8, 2);
                            $giorno_inizio = substr($dati['data_inizio_evento'], 8, 2);
                            if ($dati['data_inizio_evento'] != $dati['data_fine_evento']) {
                                ?>
                                <div class="item-data-evento"><?php echo $giorno_inizio; ?>
                                    <span><?php echo strtoupper(substr($mese_inizio, 0, 3)); ?></span><?php echo $giorno_fine; ?>
                                    <span><?php echo strtoupper(substr($mese_fine, 0, 3)); ?></span></div>
                            <?php } else { ?>
                                <div class="item-data-evento"><?php echo $giorno_inizio; ?>
                                    <span><?php echo strtoupper(substr($mese_inizio, 0, 3)); ?></span></div>
                            <?php } ?>
                        </div>
                        <div class="evento-desc">
                            <?php echo $desc_evento; ?>
                        </div>
                    </div>
                    <div class="hidden-lg pb0">
                        <img src="cp/<?php echo $dati['img_evento']; ?>"
                             class="cat-item-open cat-item-open-small cat-item-open-small-event">
                        <div class="data-event-cont">
                            <?php
                            if ($dati['data_inizio_evento'] != $dati['data_fine_evento']) {
                                ?>
                                <div class="event-date"><?php echo $giorno_inizio; ?>
                                    <span><?php echo strtoupper(substr($mese_inizio, 0, 3)); ?></span><?php echo $giorno_fine; ?>
                                    <span><?php echo strtoupper(substr($mese_fine, 0, 3)); ?></span></div>
                            <?php } else { ?>
                                <div class="event-date"><?php echo $giorno_inizio; ?>
                                    <span><?php echo strtoupper(substr($mese_inizio, 0, 3)); ?></span></div>
                            <?php } ?>
                            <div class="p-desc-service">
                                <?php echo $desc_evento; ?>
                            </div>
                        </div>
                    </div>
                    <div class="actions-small hidden-lg-actions">
                        <a class="info-evento" href="#" onclick="openPrenota('ev',<?php echo $dati['id']; ?>,3);">
                            <div class="info-evento-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                     viewBox="0 0 68.624 68.544" class="info-img-item-in">
                                    <g id="Raggruppa_36" data-name="Raggruppa 36" transform="translate(0)">
                                        <g id="Livello_2" data-name="Livello 2" transform="translate(3.186 9.917)">
                                            <circle id="Ellisse_30" data-name="Ellisse 30" cx="12.573" cy="12.573"
                                                    r="12.573" transform="translate(32.325 24.348)" fill="#e0eeeb"/>
                                            <path id="Rettangolo_34" data-name="Rettangolo 34"
                                                  d="M0,0H36.229a2,2,0,0,1,2,2V7.926a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V0A0,0,0,0,1,0,0Z"
                                                  transform="translate(0 0)" fill="#5ae9d1"/>
                                        </g>
                                        <g id="Livello_1" data-name="Livello 1" transform="translate(0 0)">
                                            <g id="Raggruppa_35" data-name="Raggruppa 35">
                                                <path id="Tracciato_56" data-name="Tracciato 56"
                                                      d="M50.935,31.4V13.448a5.761,5.761,0,0,0-5.761-5.761H38.006V5.677a2.077,2.077,0,1,0-4.154,0V7.62H19.583V5.677a2.077,2.077,0,1,0-4.154,0V7.62H8.261A5.761,5.761,0,0,0,2.5,13.381V44.733a5.761,5.761,0,0,0,5.761,5.761H31.776A17.209,17.209,0,1,0,50.935,31.4ZM8.261,11.773h7.168v1.943a2.077,2.077,0,0,0,4.154,0V11.773H33.852v1.943a2.077,2.077,0,1,0,4.154,0V11.773h7.168a1.659,1.659,0,0,1,1.675,1.675v7.034H6.654V13.448A1.645,1.645,0,0,1,8.261,11.773ZM6.654,44.8V24.569h40.2V31.4A17.214,17.214,0,0,0,31.843,46.408H8.261A1.63,1.63,0,0,1,6.654,44.8ZM48.926,61.615a13.1,13.1,0,1,1,13.13-13.063A13.152,13.152,0,0,1,48.926,61.615Z"
                                                      transform="translate(-2.5 -3.6)" fill="#183a58"/>
                                                <path id="Tracciato_57" data-name="Tracciato 57"
                                                      d="M76.438,64.034H72.754V59.077a2.077,2.077,0,1,0-4.154,0v7.034a2.087,2.087,0,0,0,2.077,2.077h5.761a2.077,2.077,0,0,0,0-4.154Z"
                                                      transform="translate(-24.318 -21.226)" fill="#183a58"/>
                                            </g>
                                            <circle id="Ellisse_31" data-name="Ellisse 31" cx="6.443" cy="6.443"
                                                    r="6.443" transform="translate(9.172 55.659)" fill="#5ae9d1"/>
                                            <circle id="Ellisse_32" data-name="Ellisse 32" cx="3.221" cy="3.221"
                                                    r="3.221" transform="translate(51.762 8.173)" fill="#5ae9d1"/>
                                            <path id="Tracciato_58" data-name="Tracciato 58"
                                                  d="M5.851,0A5.851,5.851,0,1,1,0,5.851,5.851,5.851,0,0,1,5.851,0Z"
                                                  transform="translate(56.922 14.616)" fill="#e0eeeb"/>
                                        </g>
                                    </g>
                                </svg>
                            </div>

                            <div class="info-item-title"><?php echo $langs['prenota']; ?></div>
                        </a>
                        <a class="info-evento" href="tel:<?php echo $dati['telefono']; ?>">
                            <div class="info-evento-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                     viewBox="0 0 64.445 52.308" class="info-img-item-in">
                                    <g id="Raggruppa_37" data-name="Raggruppa 37" transform="translate(5.312)">
                                        <path id="Tracciato_59" data-name="Tracciato 59"
                                              d="M34.927,45.658c-.046.046-5.591,3.689-20.877-11.6C-1.566,18.448,2.458,13.185,2.452,13.185L9.411,6.224l6.959,6.961-5.8,5.8a1.638,1.638,0,0,0,0,2.319L26.808,37.538a1.638,1.638,0,0,0,2.319,0l5.8-5.8L41.884,38.7Z"
                                              transform="translate(4.675 3.984)" fill="#e0eeeb"/>
                                        <path id="Tracciato_60" data-name="Tracciato 60"
                                              d="M38.032,17.468h-3.28a1.636,1.636,0,0,0-1.16.481L27.2,21.71v-2.6a1.641,1.641,0,0,0-1.64-1.64H18.35V2.707H38.032Z"
                                              transform="translate(15.147 1.733)" fill="#5ae9d1"/>
                                        <path id="Tracciato_61" data-name="Tracciato 61"
                                              d="M38.52,29.042a3.251,3.251,0,0,0-2.318-.961h0a3.258,3.258,0,0,0-2.318.961L29.244,33.68,15.327,19.763l4.638-4.638a3.285,3.285,0,0,0,0-4.642L13,3.524a3.257,3.257,0,0,0-2.318-.959,3.373,3.373,0,0,0-2.321.963L1.407,10.487C1.2,10.7-.638,12.683.233,17.043,1.26,22.174,5.557,28.555,13,36,23.664,46.662,30.387,49.02,34.249,49.02A5.955,5.955,0,0,0,38.52,47.6l6.957-6.957a3.285,3.285,0,0,0,0-4.643ZM36.2,45.277c-.046.046-5.591,3.689-20.877-11.6C-.292,18.068,3.733,12.8,3.727,12.8l6.959-6.961L17.645,12.8l-5.8,5.8a1.638,1.638,0,0,0,0,2.319L28.083,37.157a1.638,1.638,0,0,0,2.319,0l5.8-5.8,6.959,6.961Z"
                                              transform="translate(3.4 1.642)" fill="#183a58"/>
                                        <path id="Tracciato_62" data-name="Tracciato 62"
                                              d="M37.841,0H18.159a3.284,3.284,0,0,0-3.28,3.28V18.042a3.284,3.284,0,0,0,3.28,3.28h8.2v4.92a1.64,1.64,0,0,0,2.8,1.16l6.08-6.08h2.6a3.284,3.284,0,0,0,3.28-3.28V3.28A3.284,3.284,0,0,0,37.841,0Zm0,18.042h-3.28a1.636,1.636,0,0,0-1.16.481L29.64,22.283v-2.6A1.641,1.641,0,0,0,28,18.042H18.159V3.28H37.841Z"
                                              transform="translate(12.925)" fill="#183a58"/>
                                        <circle id="Ellisse_33" data-name="Ellisse 33" cx="7.834" cy="7.834" r="7.834"
                                                transform="translate(-5.312 32.78)" fill="#5ae9d1"/>
                                        <circle id="Ellisse_34" data-name="Ellisse 34" cx="2.5" cy="2.5" r="2.5"
                                                transform="translate(12.979 47.307)" fill="#5ae9d1"/>
                                        <circle id="Ellisse_35" data-name="Ellisse 35" cx="4.647" cy="4.647" r="4.647"
                                                transform="translate(49.839 24.846)" fill="#e0eeeb"/>
                                    </g>
                                </svg>
                            </div>

                            <div class="info-item-title"><?php echo $langs['chiama']; ?></div>
                        </a>
                        <a class="info-evento"
                           href="https://www.google.com/maps/search/?api=1&query=<?php echo $dati['latitudine'] . ',' . $dati['longitudine']; ?>"
                           target="_blank">
                            <div class="info-evento-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                     viewBox="0 0 52.887 55.9" class="info-img-item-in">
                                    <g id="Raggruppa_39" data-name="Raggruppa 39" transform="translate(-16.66 -18.364)">
                                        <path id="Tracciato_63" data-name="Tracciato 63"
                                              d="M80.957,45.835c-2.636-3.85-5.916-8.642-5.916-11.377a8.626,8.626,0,0,1,17.251,0c0,2.735-3.281,7.526-5.916,11.377-1.113,1.625-2.025,2.97-2.709,4.109C82.981,48.8,82.069,47.46,80.957,45.835Z"
                                              transform="translate(-29.538 -3.779)" fill="#5ae9d1"/>
                                        <path id="Tracciato_64" data-name="Tracciato 64"
                                              d="M31.457,82.437,20.375,86.1V56.844l11.082-4.652Z"
                                              transform="translate(-1.88 -17.115)" fill="#e0eeeb"/>
                                        <path id="Tracciato_65" data-name="Tracciato 65"
                                              d="M86.522,82.976l-9.62,3.7V57.428l1.754-.737,7.866,11.4Z"
                                              transform="translate(-30.479 -19.392)" fill="#e0eeeb"/>
                                        <path id="Tracciato_66" data-name="Tracciato 66"
                                              d="M102.106,85.547l10.6,4.082V60.378l-3.61-1.516-6.994,11.5Z"
                                              transform="translate(-43.232 -20.49)" fill="#e0eeeb"/>
                                        <path id="Tracciato_67" data-name="Tracciato 67"
                                              d="M44.708,79.011,55.79,82.669V53.417L44.708,48.765Z"
                                              transform="translate(-14.191 -15.381)" fill="#e0eeeb"/>
                                        <path id="Tracciato_68" data-name="Tracciato 68"
                                              d="M67.858,35.379a12.713,12.713,0,0,0,1.655-5.425,11.59,11.59,0,0,0-23.18,0,12.711,12.711,0,0,0,1.655,5.425l-2.087.764-12.022-4.4-13.5,4.941V71.362l13.5-4.941,12.022,4.4,12.022-4.4,13.5,4.941V36.685ZM32.4,63.808l-9.057,3.314V38.757L32.4,35.442Zm12.022,3.314-9.057-3.314V35.442l9.057,3.315ZM56.441,49.215v.006h0V63.808l-9.058,3.314V38.757L49.463,38c1.029,1.685,2.193,3.387,3.3,5.009,1.54,2.249,3.649,5.33,3.674,6.206v0ZM55.213,41.33C52.577,37.48,49.3,32.689,49.3,29.954a8.626,8.626,0,1,1,17.251,0c0,2.735-3.281,7.526-5.916,11.377-1.113,1.625-2.025,2.97-2.709,4.109C57.237,44.3,56.325,42.955,55.213,41.33ZM68.462,67.121l-9.057-3.314V49.21c.024-.875,2.133-3.956,3.674-6.206,1.111-1.622,2.275-3.324,3.3-5.009l2.08.761V67.121Z"
                                              transform="translate(-1.88 0)" fill="#183a58"/>
                                        <circle id="Ellisse_36" data-name="Ellisse 36" cx="2.355" cy="2.355" r="2.355"
                                                transform="translate(35.665 20.444)" fill="#e0eeeb"/>
                                        <circle id="Ellisse_37" data-name="Ellisse 37" cx="2.355" cy="2.355" r="2.355"
                                                transform="translate(55.511 69.555)" fill="#e0eeeb"/>
                                        <circle id="Ellisse_38" data-name="Ellisse 38" cx="5.55" cy="5.55" r="5.55"
                                                transform="translate(16.66 21.369)" fill="#5ae9d1"/>
                                    </g>
                                </svg>
                            </div>

                            <div onclick="openPrenota('ev',<?php echo $dati['id']; ?>,3);"
                                 class="info-item-title"><?php echo $langs['mappa']; ?></div>
                        </a>
                    </div>

                    <div class="info-item-container hidden-mob">
                        <a class="info-item">
                            <div class="info-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                     viewBox="0 0 68.624 68.544" class="info-img-item">
                                    <g id="Raggruppa_36" data-name="Raggruppa 36" transform="translate(0)">
                                        <g id="Livello_2" data-name="Livello 2" transform="translate(3.186 9.917)">
                                            <circle id="Ellisse_30" data-name="Ellisse 30" cx="12.573" cy="12.573"
                                                    r="12.573" transform="translate(32.325 24.348)" fill="#e0eeeb"/>
                                            <path id="Rettangolo_34" data-name="Rettangolo 34"
                                                  d="M0,0H36.229a2,2,0,0,1,2,2V7.926a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V0A0,0,0,0,1,0,0Z"
                                                  transform="translate(0 0)" fill="#5ae9d1"/>
                                        </g>
                                        <g id="Livello_1" data-name="Livello 1" transform="translate(0 0)">
                                            <g id="Raggruppa_35" data-name="Raggruppa 35">
                                                <path id="Tracciato_56" data-name="Tracciato 56"
                                                      d="M50.935,31.4V13.448a5.761,5.761,0,0,0-5.761-5.761H38.006V5.677a2.077,2.077,0,1,0-4.154,0V7.62H19.583V5.677a2.077,2.077,0,1,0-4.154,0V7.62H8.261A5.761,5.761,0,0,0,2.5,13.381V44.733a5.761,5.761,0,0,0,5.761,5.761H31.776A17.209,17.209,0,1,0,50.935,31.4ZM8.261,11.773h7.168v1.943a2.077,2.077,0,0,0,4.154,0V11.773H33.852v1.943a2.077,2.077,0,1,0,4.154,0V11.773h7.168a1.659,1.659,0,0,1,1.675,1.675v7.034H6.654V13.448A1.645,1.645,0,0,1,8.261,11.773ZM6.654,44.8V24.569h40.2V31.4A17.214,17.214,0,0,0,31.843,46.408H8.261A1.63,1.63,0,0,1,6.654,44.8ZM48.926,61.615a13.1,13.1,0,1,1,13.13-13.063A13.152,13.152,0,0,1,48.926,61.615Z"
                                                      transform="translate(-2.5 -3.6)" fill="#183a58"/>
                                                <path id="Tracciato_57" data-name="Tracciato 57"
                                                      d="M76.438,64.034H72.754V59.077a2.077,2.077,0,1,0-4.154,0v7.034a2.087,2.087,0,0,0,2.077,2.077h5.761a2.077,2.077,0,0,0,0-4.154Z"
                                                      transform="translate(-24.318 -21.226)" fill="#183a58"/>
                                            </g>
                                            <circle id="Ellisse_31" data-name="Ellisse 31" cx="6.443" cy="6.443"
                                                    r="6.443" transform="translate(9.172 55.659)" fill="#5ae9d1"/>
                                            <circle id="Ellisse_32" data-name="Ellisse 32" cx="3.221" cy="3.221"
                                                    r="3.221" transform="translate(51.762 8.173)" fill="#5ae9d1"/>
                                            <path id="Tracciato_58" data-name="Tracciato 58"
                                                  d="M5.851,0A5.851,5.851,0,1,1,0,5.851,5.851,5.851,0,0,1,5.851,0Z"
                                                  transform="translate(56.922 14.616)" fill="#e0eeeb"/>
                                        </g>
                                    </g>
                                </svg>
                            </div>

                            <div onclick="openPrenota('ev',<?php echo $dati['id']; ?>,3);"
                                 class="info-item-title"><?php echo $langs['scegli_data_esteso']; ?></div>
                        </a>
                        <?php if ($dati['telefono'] != '') { ?>
                            <a class="info-item" href="tel:<?php echo $dati['telefono']; ?>">
                                <div class="info-svg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                         viewBox="0 0 64.445 52.308" class="info-img-item">
                                        <g id="Raggruppa_37" data-name="Raggruppa 37" transform="translate(5.312)">
                                            <path id="Tracciato_59" data-name="Tracciato 59"
                                                  d="M34.927,45.658c-.046.046-5.591,3.689-20.877-11.6C-1.566,18.448,2.458,13.185,2.452,13.185L9.411,6.224l6.959,6.961-5.8,5.8a1.638,1.638,0,0,0,0,2.319L26.808,37.538a1.638,1.638,0,0,0,2.319,0l5.8-5.8L41.884,38.7Z"
                                                  transform="translate(4.675 3.984)" fill="#e0eeeb"/>
                                            <path id="Tracciato_60" data-name="Tracciato 60"
                                                  d="M38.032,17.468h-3.28a1.636,1.636,0,0,0-1.16.481L27.2,21.71v-2.6a1.641,1.641,0,0,0-1.64-1.64H18.35V2.707H38.032Z"
                                                  transform="translate(15.147 1.733)" fill="#5ae9d1"/>
                                            <path id="Tracciato_61" data-name="Tracciato 61"
                                                  d="M38.52,29.042a3.251,3.251,0,0,0-2.318-.961h0a3.258,3.258,0,0,0-2.318.961L29.244,33.68,15.327,19.763l4.638-4.638a3.285,3.285,0,0,0,0-4.642L13,3.524a3.257,3.257,0,0,0-2.318-.959,3.373,3.373,0,0,0-2.321.963L1.407,10.487C1.2,10.7-.638,12.683.233,17.043,1.26,22.174,5.557,28.555,13,36,23.664,46.662,30.387,49.02,34.249,49.02A5.955,5.955,0,0,0,38.52,47.6l6.957-6.957a3.285,3.285,0,0,0,0-4.643ZM36.2,45.277c-.046.046-5.591,3.689-20.877-11.6C-.292,18.068,3.733,12.8,3.727,12.8l6.959-6.961L17.645,12.8l-5.8,5.8a1.638,1.638,0,0,0,0,2.319L28.083,37.157a1.638,1.638,0,0,0,2.319,0l5.8-5.8,6.959,6.961Z"
                                                  transform="translate(3.4 1.642)" fill="#183a58"/>
                                            <path id="Tracciato_62" data-name="Tracciato 62"
                                                  d="M37.841,0H18.159a3.284,3.284,0,0,0-3.28,3.28V18.042a3.284,3.284,0,0,0,3.28,3.28h8.2v4.92a1.64,1.64,0,0,0,2.8,1.16l6.08-6.08h2.6a3.284,3.284,0,0,0,3.28-3.28V3.28A3.284,3.284,0,0,0,37.841,0Zm0,18.042h-3.28a1.636,1.636,0,0,0-1.16.481L29.64,22.283v-2.6A1.641,1.641,0,0,0,28,18.042H18.159V3.28H37.841Z"
                                                  transform="translate(12.925)" fill="#183a58"/>
                                            <circle id="Ellisse_33" data-name="Ellisse 33" cx="7.834" cy="7.834"
                                                    r="7.834" transform="translate(-5.312 32.78)" fill="#5ae9d1"/>
                                            <circle id="Ellisse_34" data-name="Ellisse 34" cx="2.5" cy="2.5" r="2.5"
                                                    transform="translate(12.979 47.307)" fill="#5ae9d1"/>
                                            <circle id="Ellisse_35" data-name="Ellisse 35" cx="4.647" cy="4.647"
                                                    r="4.647" transform="translate(49.839 24.846)" fill="#e0eeeb"/>
                                        </g>
                                    </svg>
                                </div>
                                <div class="info-item-title"><?php echo $langs['chiamaci_al']; ?>
                                    : <?php echo $dati['telefono']; ?></div>
                            </a>
                        <?php } ?>
                        <a class="info-item"
                           href="https://www.google.com/maps/search/?api=1&query=<?php echo $dati['latitudine'] . ',' . $dati['longitudine']; ?>"
                           target="_blank">
                            <div class="info-svg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto"
                                     viewBox="0 0 52.887 55.9" class="info-img-item">
                                    <g id="Raggruppa_39" data-name="Raggruppa 39" transform="translate(-16.66 -18.364)">
                                        <path id="Tracciato_63" data-name="Tracciato 63"
                                              d="M80.957,45.835c-2.636-3.85-5.916-8.642-5.916-11.377a8.626,8.626,0,0,1,17.251,0c0,2.735-3.281,7.526-5.916,11.377-1.113,1.625-2.025,2.97-2.709,4.109C82.981,48.8,82.069,47.46,80.957,45.835Z"
                                              transform="translate(-29.538 -3.779)" fill="#5ae9d1"/>
                                        <path id="Tracciato_64" data-name="Tracciato 64"
                                              d="M31.457,82.437,20.375,86.1V56.844l11.082-4.652Z"
                                              transform="translate(-1.88 -17.115)" fill="#e0eeeb"/>
                                        <path id="Tracciato_65" data-name="Tracciato 65"
                                              d="M86.522,82.976l-9.62,3.7V57.428l1.754-.737,7.866,11.4Z"
                                              transform="translate(-30.479 -19.392)" fill="#e0eeeb"/>
                                        <path id="Tracciato_66" data-name="Tracciato 66"
                                              d="M102.106,85.547l10.6,4.082V60.378l-3.61-1.516-6.994,11.5Z"
                                              transform="translate(-43.232 -20.49)" fill="#e0eeeb"/>
                                        <path id="Tracciato_67" data-name="Tracciato 67"
                                              d="M44.708,79.011,55.79,82.669V53.417L44.708,48.765Z"
                                              transform="translate(-14.191 -15.381)" fill="#e0eeeb"/>
                                        <path id="Tracciato_68" data-name="Tracciato 68"
                                              d="M67.858,35.379a12.713,12.713,0,0,0,1.655-5.425,11.59,11.59,0,0,0-23.18,0,12.711,12.711,0,0,0,1.655,5.425l-2.087.764-12.022-4.4-13.5,4.941V71.362l13.5-4.941,12.022,4.4,12.022-4.4,13.5,4.941V36.685ZM32.4,63.808l-9.057,3.314V38.757L32.4,35.442Zm12.022,3.314-9.057-3.314V35.442l9.057,3.315ZM56.441,49.215v.006h0V63.808l-9.058,3.314V38.757L49.463,38c1.029,1.685,2.193,3.387,3.3,5.009,1.54,2.249,3.649,5.33,3.674,6.206v0ZM55.213,41.33C52.577,37.48,49.3,32.689,49.3,29.954a8.626,8.626,0,1,1,17.251,0c0,2.735-3.281,7.526-5.916,11.377-1.113,1.625-2.025,2.97-2.709,4.109C57.237,44.3,56.325,42.955,55.213,41.33ZM68.462,67.121l-9.057-3.314V49.21c.024-.875,2.133-3.956,3.674-6.206,1.111-1.622,2.275-3.324,3.3-5.009l2.08.761V67.121Z"
                                              transform="translate(-1.88 0)" fill="#183a58"/>
                                        <circle id="Ellisse_36" data-name="Ellisse 36" cx="2.355" cy="2.355" r="2.355"
                                                transform="translate(35.665 20.444)" fill="#e0eeeb"/>
                                        <circle id="Ellisse_37" data-name="Ellisse 37" cx="2.355" cy="2.355" r="2.355"
                                                transform="translate(55.511 69.555)" fill="#e0eeeb"/>
                                        <circle id="Ellisse_38" data-name="Ellisse 38" cx="5.55" cy="5.55" r="5.55"
                                                transform="translate(16.66 21.369)" fill="#5ae9d1"/>
                                    </g>
                                </svg>
                            </div>
                            <div class="info-item-title"><?php echo $langs['come_raggiungerci']; ?></div>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            <div class="image_cat_item_evento <?php if ($tab == 'item' && $section == 'e') echo 'image_cat_item_evento_active'; ?>">
                <img src="cp/<?php echo $dati['img_evento']; ?>" class="cat-item-open">
            </div>
            <div>
        <?php }
    }
} ?>