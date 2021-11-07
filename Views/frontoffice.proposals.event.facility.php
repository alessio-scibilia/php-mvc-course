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

$id_struttura = $_POST['id'];
$type = $_POST['type'];

if ($type == 2) {
    $dati_struttura = getDatiStruttura($dbh, $id_struttura);
    $nome = $dati_struttura[0]['nome_struttura'];
} else {
    $dati_struttura = getHotel($dbh, $id_struttura);
    $nome = $dati_struttura['nome'];
}
?>
<div class="mob-p20">
    <div class="d-flex d-flex-special">
        <svg xmlns="http://www.w3.org/2000/svg" width="39.195" height="38.203" viewBox="0 0 39.195 38.203"
             class="arrow-back-struttura">
            <path id="Icon_awesome-arrow-left" data-name="Icon awesome-arrow-left"
                  d="M22.527,38.291l-1.942,1.942a2.091,2.091,0,0,1-2.966,0l-17.006-17a2.091,2.091,0,0,1,0-2.966L17.619,3.264a2.091,2.091,0,0,1,2.966,0l1.942,1.942a2.1,2.1,0,0,1-.035,3L11.951,18.249H37.092a2.094,2.094,0,0,1,2.1,2.1v2.8a2.094,2.094,0,0,1-2.1,2.1H11.951L22.492,35.29A2.087,2.087,0,0,1,22.527,38.291Z"
                  transform="translate(0.004 -2.647)" fill="#183a58"/>
        </svg>
        <div class="title-in-blue title-section pb0 pl40lg">
            <h3 class="title-in-blue-small" id="title-struttura">Ristoranti</h3>
            <h2 class="title-in-blue title-section title-less-mobile"><?php echo $nome; ?></h2>
        </div>
    </div>
    <div class="link-cat-item-container <?php if ($tab != 'item') echo 'dnmob'; ?>">
        <a href="#" class="link-cat-item link-cat-item-bis" data-section="1">
            <svg xmlns="http://www.w3.org/2000/svg" width="45.944" height="34" viewBox="0 0 45.944 34"
                 class="arrow-back3">
                <g id="Raggruppa_22" data-name="Raggruppa 22" transform="translate(-10.04 -18.301)">
                    <g id="Raggruppa_23" data-name="Raggruppa 23" transform="translate(10.04 18.301)">
                        <rect id="Rettangolo_20" data-name="Rettangolo 20" width="22.019" height="7.863"
                              transform="matrix(0.985, -0.17, 0.17, 0.985, 15.563, 8.453)" fill="#5ae9d1"/>
                        <rect id="Rettangolo_21" data-name="Rettangolo 21" width="8.59" height="4.424"
                              transform="translate(5.236 12.929) rotate(-8.416)" fill="#5ae9d1"/>
                        <path id="Tracciato_47" data-name="Tracciato 47"
                              d="M53.495,19.142a1.018,1.018,0,0,0-1.179-.826l-4.011.706a1.017,1.017,0,0,0-.825,1.18l.176,1L24.6,25.27a1.017,1.017,0,0,0-.825,1.18l.176,1L15.75,28.9a3.054,3.054,0,0,0-3.2-1.5,3.032,3.032,0,0,0-2.46,3.514l1.067,6.055a3.035,3.035,0,0,0,2.983,2.507,3.19,3.19,0,0,0,.544-.048l.035-.007a3,3,0,0,0,2.451-2.5l8.2-1.446.177,1a1.015,1.015,0,0,0,1,.841.946.946,0,0,0,.177-.015l9.293-1.638L28.431,50.827a1.018,1.018,0,1,0,1.821.91L37.485,37.27l7.234,14.467a1.018,1.018,0,1,0,1.821-.91L38.719,35.185l11.059-1.949.176,1a1.018,1.018,0,0,0,1,.841,1.029,1.029,0,0,0,.176-.015l4.011-.708a1.017,1.017,0,0,0,.825-1.18ZM15,37a1,1,0,0,1-.642.41l-.042.007a1,1,0,0,1-1.155-.809l-1.068-6.056a1,1,0,0,1,.165-.744,1.017,1.017,0,0,1,.685-.417A1,1,0,0,1,14.1,30.2l0,.017v0l.578,3.284.485,2.751A.987.987,0,0,1,15,37ZM51.667,20.5l2.121,12.031-2.005.353-1.061-6.015-.884-5.013h0l-.177-1ZM48.01,23.211l.708,4.01.706,4.01L27.369,35.119l-.708-4.01-.53-3.008h0l-.177-1Zm-23,10.257L16.99,34.882l-.313-1.773-.394-2.238,8.02-1.414.314,1.774Z"
                              transform="translate(-10.04 -18.301)" fill="#183a58"/>
                    </g>
                </g>
            </svg>

            <span><?php echo $langs['esplora']; ?></span>
        </a>
        <a href="#" class="link-cat-item link-cat-item-bis" data-section="2">
            <svg xmlns="http://www.w3.org/2000/svg" width="35.38" height="40" viewBox="0 0 35.38 40"
                 class="arrow-back3">
                <g id="Raggruppa_25" data-name="Raggruppa 25" transform="translate(-22.05 -17.85)">
                    <path id="Tracciato_48" data-name="Tracciato 48"
                          d="M58.333,53.311,56.462,62.5c-.056.324-.224,1.322-2.27,1.322H36.84v-9.73L39.4,51.5l.062-.069a12.015,12.015,0,0,0,2.931-7.719V40.46h.723a2.126,2.126,0,0,1,2.126,2.126V48.7a1.278,1.278,0,0,0,1.247,1.247H55.34a3.118,3.118,0,0,1,2.993,2.295A2.058,2.058,0,0,1,58.333,53.311Z"
                          transform="translate(-5.568 -8.512)" fill="#5ae9d1"/>
                    <rect id="Rettangolo_22" data-name="Rettangolo 22" width="5.731" height="13.771"
                          transform="translate(24.128 40.218)" fill="#5ae9d1"/>
                    <g id="Raggruppa_24" data-name="Raggruppa 24" transform="translate(22.05 17.85)">
                        <path id="Tracciato_49" data-name="Tracciato 49"
                              d="M62.816,47.308a5.668,5.668,0,0,0-5.443-4.122H49.841V38.373a4.69,4.69,0,0,0-4.683-4.683H43.175a1.278,1.278,0,0,0-1.247,1.278V39.5a9.445,9.445,0,0,1-2.307,6L36.84,48.287,38.661,50.1l2.768-2.812.062-.069A12.015,12.015,0,0,0,44.422,39.5V36.246h.723a2.126,2.126,0,0,1,2.126,2.126v6.111a1.278,1.278,0,0,0,1.247,1.247h8.854a3.118,3.118,0,0,1,2.993,2.295,2.058,2.058,0,0,1,0,1.072L58.5,58.288c-.056.324-.224,1.322-2.27,1.322H37.563v2.55H56.269c2.669,0,4.415-1.247,4.782-3.411l1.821-9.116a4.53,4.53,0,0,0-.056-2.332Z"
                              transform="translate(-27.618 -23.813)" fill="#183a58"/>
                        <path id="Tracciato_50" data-name="Tracciato 50"
                              d="M32.058,50.21H23.328a1.278,1.278,0,0,0-1.278,1.247V68.785A1.248,1.248,0,0,0,23.3,70.033h8.761A1.247,1.247,0,0,0,33.3,68.785v-17.3a1.247,1.247,0,0,0-1.247-1.247ZM30.779,67.494H24.606V52.766h6.173Z"
                              transform="translate(-22.05 -30.033)" fill="#183a58"/>
                        <path id="Tracciato_51" data-name="Tracciato 51"
                              d="M50.657,17.85A1.278,1.278,0,0,0,49.41,19.1v5.325a1.275,1.275,0,0,0,2.55,0V19.128a1.247,1.247,0,0,0-1.247-1.247Z"
                              transform="translate(-32.35 -17.85)" fill="#183a58"/>
                        <path id="Tracciato_52" data-name="Tracciato 52"
                              d="M35.912,25.921l-4.6-3.317a1.277,1.277,0,0,0-1.5,2.07h0l4.6,3.317a1.277,1.277,0,1,0,1.5-2.07Z"
                              transform="translate(-24.776 -19.548)" fill="#183a58"/>
                        <path id="Tracciato_53" data-name="Tracciato 53"
                              d="M68.26,22.885a1.284,1.284,0,0,0-1.783-.281l-4.558,3.323a1.247,1.247,0,0,0,.754,2.307,1.309,1.309,0,0,0,.754-.243l4.552-3.323a1.247,1.247,0,0,0,.315-1.735Z"
                              transform="translate(-36.835 -19.549)" fill="#183a58"/>
                    </g>
                </g>
            </svg>

            <span><?php echo $langs['da_provare']; ?></span>
        </a>
        <a href="#" class="link-cat-item link-cat-item-bis" data-section="3">
            <svg xmlns="http://www.w3.org/2000/svg" width="36.072" height="35.236" viewBox="0 0 36.072 35.236"
                 class="arrow-back3">
                <g id="Raggruppa_27" data-name="Raggruppa 27" transform="translate(-2.5 -3.6)">
                    <g id="Livello_2" data-name="Livello 2" transform="translate(4.308 7.707)">
                        <circle id="Ellisse_25" data-name="Ellisse 25" cx="7.134" cy="7.134" r="7.134"
                                transform="translate(18.34 15.335)" fill="#5ae9d1"/>
                        <rect id="Rettangolo_23" data-name="Rettangolo 23" width="23.971" height="6.017"
                              transform="translate(0 0)" fill="#5ae9d1"/>
                    </g>
                    <g id="Livello_1" data-name="Livello 1" transform="translate(2.5 3.6)">
                        <g id="Raggruppa_26" data-name="Raggruppa 26" transform="translate(0 0)">
                            <path id="Tracciato_54" data-name="Tracciato 54"
                                  d="M29.981,19.374V9.188a3.269,3.269,0,0,0-3.269-3.269H22.645V4.778a1.178,1.178,0,1,0-2.357,0v1.1h-8.1v-1.1a1.178,1.178,0,1,0-2.357,0v1.1H5.769A3.269,3.269,0,0,0,2.5,9.15V26.938a3.269,3.269,0,0,0,3.269,3.269H19.111A9.764,9.764,0,1,0,29.981,19.374ZM5.769,8.237H9.836v1.1a1.178,1.178,0,1,0,2.357,0v-1.1h8.1v1.1a1.178,1.178,0,0,0,2.357,0v-1.1h4.067a.941.941,0,0,1,.95.95v3.991H4.857V9.188A.933.933,0,0,1,5.769,8.237ZM4.857,26.976V15.5H27.663v3.877a9.767,9.767,0,0,0-8.514,8.514H5.769A.925.925,0,0,1,4.857,26.976Zm23.985,9.541a7.431,7.431,0,1,1,7.45-7.412A7.462,7.462,0,0,1,28.841,36.517Z"
                                  transform="translate(-2.5 -3.6)" fill="#183a58"/>
                            <path id="Tracciato_55" data-name="Tracciato 55"
                                  d="M73.047,60.991H70.957V58.178a1.178,1.178,0,1,0-2.357,0v3.991a1.184,1.184,0,0,0,1.178,1.178h3.269a1.178,1.178,0,0,0,0-2.357Z"
                                  transform="translate(-43.475 -36.702)" fill="#183a58"/>
                        </g>
                    </g>
                </g>
            </svg>

            <span><?php echo $langs['prenota']; ?></span>
        </a>
    </div>
    <div class="padded">


        <div class="hidden-mob">
            <div class="p-desc-service">
                <?php if ($type == 2) echo $dati_struttura[0]['descrizione']; else echo $dati_struttura['descrizione_ospiti']; ?>
            </div>
            <div class="banner-promo">
                <svg version="1.1" id="Livello_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
<style type="text/css">
    .st0 {
        fill: #FFFFFF;
    }

    .st1 {
        fill: #F1956D;
    }

    .st2 {
        opacity: 0.8;
    }
</style>
                    <circle class="st0" cx="45.6" cy="5" r="2.8"/>
                    <circle class="st1" cx="17.6" cy="36.1" r="7.4"/>
                    <circle class="st1" cx="30.1" cy="39.9" r="7.4"/>
                    <circle class="st1" cx="30.1" cy="27.9" r="11"/>
                    <path class="st0" d="M9.5,33.3c0,2.8,2.1,5,5,5"/>
                    <g class="st2">
                        <path d="M2.4,46.5c-0.6-0.3-1.1-0.7-1-1.4c0-0.7,0.6-1.3,1.3-1.3c0.4,0,0.8,0.1,1.1-0.1C4,43.4,3.9,43,4,42.6
		c0.3-1.1,0.5-2.1,0.8-3.2c0.2-0.8,0.7-1.2,1.5-1.2c1.4,0,2.8,0,4.2,0c0.2,0,0.3,0,0.5,0c0-0.7,0-1.4,0-2.1c-1,0-2,0-2.9,0
		c-0.4,0-0.7,0-1.1,0c-0.8,0-1.4-0.5-1.5-1.2c-0.1-0.8,0.4-1.4,1.2-1.5c0,0,0.1,0,0.1,0c-0.5-8.5,6.4-16.5,15.2-17.2
		c0-0.7,0-1.4,0-2.1c-0.7,0-1.4,0-2.1,0c-0.7,0-1.3-0.5-1.3-1.2c-0.1-0.7,0.4-1.4,1-1.5c0.1,0,0.3,0,0.4,0c2.3,0,4.5,0,6.8,0
		c0.8,0,1.5,0.6,1.5,1.4c0,0.8-0.6,1.4-1.4,1.4c-0.6,0-1.3,0-2,0c0,0.7,0,1.4,0,2.1c4.4,0.5,8.1,2.3,11,5.6
		c2.9,3.3,4.3,7.2,4.2,11.6c0.1,0,0.2,0,0.3,0.1c0.7,0.2,1.1,0.8,1,1.5c-0.1,0.7-0.7,1.2-1.4,1.2c-1.2,0-2.4,0-3.6,0
		c-0.2,0-0.3,0-0.5,0c0,0.7,0,1.4,0,2.1c0.4,0,0.7,0,1.1,0c1.2,0,2.4,0,3.5,0c0.9,0,1.4,0.4,1.6,1.2c0.3,1.2,0.7,2.5,0.9,3.7
		c0.1,0.5,0.3,0.7,0.8,0.6c0.2,0,0.5,0,0.8,0.1c0.5,0.1,0.7,0.5,1,1c0,0.2,0,0.5,0,0.7c-0.2,0.5-0.5,0.8-1,1
		C30.5,46.5,16.5,46.5,2.4,46.5z M37.3,33.3c0-5.7-2.3-10.1-7.3-12.8c-5.1-2.7-10.2-2.3-14.9,1.1c-3.9,2.9-5.6,6.9-5.5,11.7
		C18.9,33.3,28.1,33.3,37.3,33.3z M40.4,43.7c-0.2-0.8-0.4-1.5-0.5-2.3c-0.1-0.4-0.3-0.5-0.7-0.5c-10.5,0-20.9,0-31.4,0
		c-0.1,0-0.2,0-0.3,0c-0.1,0-0.2,0.1-0.2,0.2C7,42,6.8,42.8,6.6,43.7C17.9,43.7,29.1,43.7,40.4,43.7z M33.2,36.1
		c-6.5,0-12.9,0-19.3,0c0,0.7,0,1.4,0,2c6.5,0,12.9,0,19.3,0C33.2,37.5,33.2,36.8,33.2,36.1z"/>
                        <path d="M45.6,24.7c-0.3,0.8-0.9,1.1-1.8,1c-0.8,0-1.5,0-2.3,0c-0.8,0-1.4-0.6-1.4-1.4c0-0.8,0.6-1.3,1.4-1.4c0.8,0,1.6,0,2.3,0
		c0.9-0.1,1.4,0.3,1.8,1C45.6,24.3,45.6,24.5,45.6,24.7z"/>
                        <path d="M44.6,46.5c0.5-0.2,0.8-0.5,1-1c0,0.3,0,0.7,0,1C45.3,46.5,44.9,46.5,44.6,46.5z"/>
                        <path d="M24.9,5c0,0.5,0,0.9,0,1.4c0,0.8-0.6,1.4-1.4,1.3c-0.7,0-1.3-0.6-1.4-1.3c0-0.9,0-1.9,0-2.8c0-0.8,0.6-1.3,1.4-1.3
		c0.7,0,1.3,0.6,1.4,1.3C24.9,4.1,24.9,4.5,24.9,5z"/>
                        <path d="M4.1,25.7c-0.5,0-0.9,0-1.4,0c-0.8,0-1.4-0.6-1.4-1.4C1.4,23.6,2,23,2.8,23c0.9,0,1.8,0,2.8,0c0.8,0,1.4,0.6,1.4,1.4
		c0,0.8-0.6,1.3-1.4,1.4C5.1,25.8,4.6,25.7,4.1,25.7z"/>
                        <path d="M12.2,11.5c0,0.7-0.3,1.2-0.8,1.4c-0.5,0.3-1.1,0.2-1.5-0.2c-0.7-0.7-1.4-1.4-2.1-2.1c-0.5-0.5-0.4-1.3,0.1-1.8
		c0.5-0.5,1.3-0.6,1.9-0.1c0.7,0.7,1.4,1.4,2.1,2.1C12,11,12.1,11.3,12.2,11.5z"/>
                        <path d="M36.4,13.1c-0.7,0-1.1-0.3-1.4-0.8c-0.3-0.5-0.2-1.1,0.2-1.5c0.7-0.7,1.4-1.4,2.1-2.1c0.5-0.5,1.3-0.4,1.8,0.1
		c0.5,0.5,0.6,1.3,0.1,1.8c-0.7,0.8-1.4,1.5-2.2,2.2C36.8,12.9,36.5,13,36.4,13.1z"/>
                    </g>
</svg>
                <p><?php if ($type == 2) echo $dati_struttura[0]['descrizione_benefit']; else echo $dati_struttura['descrizione_ospiti']; ?></p>

            </div>
        </div>
        <div class="hidden-lg">
            <div class="owl-theme owl-carousel owl-item-cat-small">
                <img src="https://loremflickr.com/235/330" class="cat-item-open cat-item-open-small">
                <img src="https://loremflickr.com/235/330" class="cat-item-open cat-item-open-small">
                <img src="https://loremflickr.com/235/330" class="cat-item-open cat-item-open-small">
                <img src="https://loremflickr.com/235/330" class="cat-item-open cat-item-open-small">
            </div>
            <div class="p-desc-service">
                <?php if ($type == 2) echo $dati_struttura[0]['descrizione']; else echo $dati_struttura['descrizione_ospiti']; ?>
            </div>
            <div class="banner-promo">
                <svg version="1.1" id="Livello_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
<style type="text/css">
    .st0 {
        fill: #FFFFFF;
    }

    .st1 {
        fill: #F1956D;
    }

    .st2 {
        opacity: 0.8;
    }
</style>
                    <circle class="st0" cx="45.6" cy="5" r="2.8"/>
                    <circle class="st1" cx="17.6" cy="36.1" r="7.4"/>
                    <circle class="st1" cx="30.1" cy="39.9" r="7.4"/>
                    <circle class="st1" cx="30.1" cy="27.9" r="11"/>
                    <path class="st0" d="M9.5,33.3c0,2.8,2.1,5,5,5"/>
                    <g class="st2">
                        <path d="M2.4,46.5c-0.6-0.3-1.1-0.7-1-1.4c0-0.7,0.6-1.3,1.3-1.3c0.4,0,0.8,0.1,1.1-0.1C4,43.4,3.9,43,4,42.6
		c0.3-1.1,0.5-2.1,0.8-3.2c0.2-0.8,0.7-1.2,1.5-1.2c1.4,0,2.8,0,4.2,0c0.2,0,0.3,0,0.5,0c0-0.7,0-1.4,0-2.1c-1,0-2,0-2.9,0
		c-0.4,0-0.7,0-1.1,0c-0.8,0-1.4-0.5-1.5-1.2c-0.1-0.8,0.4-1.4,1.2-1.5c0,0,0.1,0,0.1,0c-0.5-8.5,6.4-16.5,15.2-17.2
		c0-0.7,0-1.4,0-2.1c-0.7,0-1.4,0-2.1,0c-0.7,0-1.3-0.5-1.3-1.2c-0.1-0.7,0.4-1.4,1-1.5c0.1,0,0.3,0,0.4,0c2.3,0,4.5,0,6.8,0
		c0.8,0,1.5,0.6,1.5,1.4c0,0.8-0.6,1.4-1.4,1.4c-0.6,0-1.3,0-2,0c0,0.7,0,1.4,0,2.1c4.4,0.5,8.1,2.3,11,5.6
		c2.9,3.3,4.3,7.2,4.2,11.6c0.1,0,0.2,0,0.3,0.1c0.7,0.2,1.1,0.8,1,1.5c-0.1,0.7-0.7,1.2-1.4,1.2c-1.2,0-2.4,0-3.6,0
		c-0.2,0-0.3,0-0.5,0c0,0.7,0,1.4,0,2.1c0.4,0,0.7,0,1.1,0c1.2,0,2.4,0,3.5,0c0.9,0,1.4,0.4,1.6,1.2c0.3,1.2,0.7,2.5,0.9,3.7
		c0.1,0.5,0.3,0.7,0.8,0.6c0.2,0,0.5,0,0.8,0.1c0.5,0.1,0.7,0.5,1,1c0,0.2,0,0.5,0,0.7c-0.2,0.5-0.5,0.8-1,1
		C30.5,46.5,16.5,46.5,2.4,46.5z M37.3,33.3c0-5.7-2.3-10.1-7.3-12.8c-5.1-2.7-10.2-2.3-14.9,1.1c-3.9,2.9-5.6,6.9-5.5,11.7
		C18.9,33.3,28.1,33.3,37.3,33.3z M40.4,43.7c-0.2-0.8-0.4-1.5-0.5-2.3c-0.1-0.4-0.3-0.5-0.7-0.5c-10.5,0-20.9,0-31.4,0
		c-0.1,0-0.2,0-0.3,0c-0.1,0-0.2,0.1-0.2,0.2C7,42,6.8,42.8,6.6,43.7C17.9,43.7,29.1,43.7,40.4,43.7z M33.2,36.1
		c-6.5,0-12.9,0-19.3,0c0,0.7,0,1.4,0,2c6.5,0,12.9,0,19.3,0C33.2,37.5,33.2,36.8,33.2,36.1z"/>
                        <path d="M45.6,24.7c-0.3,0.8-0.9,1.1-1.8,1c-0.8,0-1.5,0-2.3,0c-0.8,0-1.4-0.6-1.4-1.4c0-0.8,0.6-1.3,1.4-1.4c0.8,0,1.6,0,2.3,0
		c0.9-0.1,1.4,0.3,1.8,1C45.6,24.3,45.6,24.5,45.6,24.7z"/>
                        <path d="M44.6,46.5c0.5-0.2,0.8-0.5,1-1c0,0.3,0,0.7,0,1C45.3,46.5,44.9,46.5,44.6,46.5z"/>
                        <path d="M24.9,5c0,0.5,0,0.9,0,1.4c0,0.8-0.6,1.4-1.4,1.3c-0.7,0-1.3-0.6-1.4-1.3c0-0.9,0-1.9,0-2.8c0-0.8,0.6-1.3,1.4-1.3
		c0.7,0,1.3,0.6,1.4,1.3C24.9,4.1,24.9,4.5,24.9,5z"/>
                        <path d="M4.1,25.7c-0.5,0-0.9,0-1.4,0c-0.8,0-1.4-0.6-1.4-1.4C1.4,23.6,2,23,2.8,23c0.9,0,1.8,0,2.8,0c0.8,0,1.4,0.6,1.4,1.4
		c0,0.8-0.6,1.3-1.4,1.4C5.1,25.8,4.6,25.7,4.1,25.7z"/>
                        <path d="M12.2,11.5c0,0.7-0.3,1.2-0.8,1.4c-0.5,0.3-1.1,0.2-1.5-0.2c-0.7-0.7-1.4-1.4-2.1-2.1c-0.5-0.5-0.4-1.3,0.1-1.8
		c0.5-0.5,1.3-0.6,1.9-0.1c0.7,0.7,1.4,1.4,2.1,2.1C12,11,12.1,11.3,12.2,11.5z"/>
                        <path d="M36.4,13.1c-0.7,0-1.1-0.3-1.4-0.8c-0.3-0.5-0.2-1.1,0.2-1.5c0.7-0.7,1.4-1.4,2.1-2.1c0.5-0.5,1.3-0.4,1.8,0.1
		c0.5,0.5,0.6,1.3,0.1,1.8c-0.7,0.8-1.4,1.5-2.2,2.2C36.8,12.9,36.5,13,36.4,13.1z"/>
                    </g>
</svg>
                <div><?php if ($type == 2) echo $dati_struttura[0]['descrizione_benefit']; else echo $dati_struttura['descrizione_ospiti']; ?>    </div>

            </div>
        </div>
        <?php
        if ($dati_struttura[0]['real_immagini_didascalia'] != '') { ?>
            <div class="excellence-container">
                <h2 class="title-in-blue title-in-page mb60 pb30"
                    id="ex-cont"><?php echo $langs['esplorato_per_voi']; ?></h2>

                <?php
                $immagini_didascalia = explode("|", $dati_struttura[0]['real_immagini_didascalia']);

                $testi_didascalia = explode("&&", $dati_struttura[0]['real_path_immagini_didascalia']);

                for ($i = 0; $i < sizeof($immagini_didascalia) - 1; $i++) {
                    ?>
                    <div class="item-excellence">
                        <img src="cp/<?php echo $immagini_didascalia[$i]; ?>" class="img-excellence" alt="" title=""/>
                        <?php
                        $testi_lang = explode("||", $testi_didascalia[$i]); ?>
                        <p class="p-excellence"><?php echo $testi_lang[$_SESSION['lang'] - 1]; ?></p>
                    </div>
                <?php } ?>


            </div>
        <?php } ?>


        <?php
        $eccellenze = getDatiEccellenze($dbh, $dati_struttura[0]['id'], $_SESSION['lang']);
        if (sizeof($eccellenze) > 0) { ?>
            <h2 class="title-in-blue mb60 title-in-page"
                id="da-provare-bis"><?php echo $langs['da_non_perdere']; ?></h2>
            <div class="da-non-perdere">
                <?php
                for ($i = 0; $i < sizeof($eccellenze); $i++) {
                    ?>


                    <div class="item-cat-container-inside">
                        <img src="cp/<?php echo $eccellenze[$i]['immagine']; ?>"
                             class="img-cat-item-in img-cat-item-in-real" alt="" title=""/>
                        <div class="info-cat-item info-cat-item-real" href="#" onclick="openCatItem();">
                            <h2><?php echo $eccellenze[$i]['titolo']; ?></h2>
                            <p><?php echo $eccellenze[$i]['testo']; ?></p>
                        </div>
                    </div>

                <?php } ?>
            </div>
        <?php } ?>
        <div class="data-container">
            <div class="orari-data-container">
                <?php
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
                $orari_oggi = $dati_struttura[0]['orari_' . $giorno];
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
                } ?>
                <!--<span class="hour-service"><?php echo $orari; ?><a href="javascript:void();" onclick="openOrariFull(<?php echo $dati_struttura[0]['id']; ?>)">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="caretOrari" viewBox="0 0 16 16">
							  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" class="pathcaretorari"/>
							</svg>
						</a></span>-->
                <?php
                if ($dati_struttura[0]['orari_lunedi'] != '0|||||' && $dati_struttura[0]['orari_martedi'] != '0|||||' && $dati_struttura[0]['orari_mercoledi'] != '0|||||' && $dati_struttura[0]['orari_giovedi'] != '0|||||' && $dati_struttura[0]['orari_venerdi'] != '0|||||' && $dati_struttura[0]['orari_sabato'] != '0|||||' && $dati_struttura[0]['orari_domenica'] != '0|||||') { ?>
                    <div class="orariContainer">
                        <h3 class="mini-orari"><?php echo $langs['orari']; ?></h3>
                        <?php
                        $giorno_real = $giorno;
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
                            $orari_oggi = $dati_struttura[0]['orari_' . $giorno];
                            $orari_expanded = explode("|", $orari_oggi);
                            if ($orari_expanded[1] == "" && $orari_expanded[2] == "" && $orari_expanded[3] == "" && $orari_expanded[4] == "")
                                $orari = '<span>' . substr($langs[$giorno], 0, 3) . ':</span> ' . '-- --';
                            else {
                                if ($orari_expanded[0] == 1) {
                                    if ($orari_expanded[1] == "" && $orari_expanded[2] == "" && $orari_expanded[3] == "" && $orari_expanded[4] == "")
                                        $orari = substr($langs[$giorno], 0, 3) . ': ' . '-- --';
                                    else
                                        $orari = substr($langs[$giorno], 0, 3) . ': ' . $orari_expanded[1] . '-' . $orari_expanded[2];
                                } else {
                                    if ($orari_expanded[1] == "" && $orari_expanded[2] == "" && $orari_expanded[3] == "" && $orari_expanded[4] == "")
                                        $orari = substr($langs[$giorno], 0, 3) . ': ' . '-- --';
                                    else
                                        $orari = substr($langs[$giorno], 0, 3) . ': ' . $orari_expanded[1] . '-' . $orari_expanded[2] . ' | ' . $orari_expanded[3] . '-' . $orari_expanded[4];

                                }
                            }
                            echo '<div class="orariFull">';
                            if ($nowClass == true) echo '<span style="font-family: Main bold;">' . $orari . '</b>';
                            else echo $orari;
                            echo '</div>';
                        } ?>
                    </div>
                <?php } ?>
            </div>
            <div class="travel-data-container">
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
                        <?php echo $time_travel; ?><img src="img/walking.svg" alt="" title=""> dall'Hotel
                    <?php } else if ($dati_struttura[0]['tipo_viaggio'] == 2 || $dati_struttura[0]['tipo_viaggio'] == 0) { ?>
                        <?php echo $time_travel; ?> <img src="img/car.svg" alt="" title="">  dall'Hotel
                    <?php } else if ($dati_struttura[0]['tipo_viaggio'] == 3) { ?>
                        <?php echo $time_travel; ?> <img src="img/mezzi.svg" alt="" title=""> dall'Hotel
                    <?php } ?>
                </div>
            </div>
        </div>
        <h2 class="title-in-blue title-in-page mb60" id="prenota-bis"><?php echo $langs['info_e_prenotazioni']; ?></h2>
        <div class="info-item-container">
            <a class="info-item">
                <div class="info-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto" viewBox="0 0 68.624 68.544"
                         class="info-img-item">
                        <g id="Raggruppa_36" data-name="Raggruppa 36" transform="translate(0)">
                            <g id="Livello_2" data-name="Livello 2" transform="translate(3.186 9.917)">
                                <circle id="Ellisse_30" data-name="Ellisse 30" cx="12.573" cy="12.573" r="12.573"
                                        transform="translate(32.325 24.348)" fill="#e0eeeb"/>
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
                                <circle id="Ellisse_31" data-name="Ellisse 31" cx="6.443" cy="6.443" r="6.443"
                                        transform="translate(9.172 55.659)" fill="#5ae9d1"/>
                                <circle id="Ellisse_32" data-name="Ellisse 32" cx="3.221" cy="3.221" r="3.221"
                                        transform="translate(51.762 8.173)" fill="#5ae9d1"/>
                                <path id="Tracciato_58" data-name="Tracciato 58"
                                      d="M5.851,0A5.851,5.851,0,1,1,0,5.851,5.851,5.851,0,0,1,5.851,0Z"
                                      transform="translate(56.922 14.616)" fill="#e0eeeb"/>
                            </g>
                        </g>
                    </svg>
                </div>

                <div onclick="openPrenota('item');"
                     class="info-item-title"><?php echo $langs['scegli_data_esteso']; ?></div>
            </a>
            <?php if ($dati_struttura[0]['telefono'] != '') { ?>
            <a class="info-item" href="tel:<?php echo $dati_struttura[0]['telefono']; ?>">
                <div class="info-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto" viewBox="0 0 64.445 52.308"
                         class="info-img-item">
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
                <div class="info-item-title"><?php echo $langs['filo_diretto']; ?></div>
                </a><?php } ?>
            <a class="info-item"
               href="http://maps.google.com/?q=1200 Pennsylvania Ave SE, Washington, District of Columbia, 20003"
               target="_blank">
                <div class="info-svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="auto" viewBox="0 0 52.887 55.9"
                         class="info-img-item">
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
<div class="image_struttura <?php if ($tab == 'item' && $section == 'str') echo 'image_struttura_active'; ?>">
    <div class="owl-theme owl-carousel owl-item-cat">
        <?php
        $immagini = explode("|", $dati_struttura[0]['immagine_didascalia']);
        for ($i = 0; $i < sizeof($immagini) - 1; $i++) {
            echo '<img src="cp/' . $immagini[$i] . '" class="cat-item-open">';
        } ?>
    </div>
</div>
</div