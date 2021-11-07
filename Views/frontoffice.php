<?php
// Contiene menu di front office e un content che dipende dalla tab selezionata.

// La tab va codificata nell'url ad esempio: localhost/5#[proposte|suggerimenti|info] (tradotto in inglese)

// Qui vanno incluse tutte le altre tab e navigazioni varie (che poi vengono nascostae o mostrate con dei click)
?>
<!DOCTYPE html>
<html>
<?php
$tab = 'info'; //TODO gestione tab qui
if ($view_model->template_name == 'login')
    require_once 'Views/frontoffice.head.login.php';
else
    require_once 'Views/frontoffice.head.common.php';
?>
<!-- MINI MENU -->
<div class="container-menu">
    <div class="box box-1">
        <div align="center">
            <img src="img/logo-piccolo.png" alt="" title="" class="logo-menu">
        </div>
    </div>
    <div class="box box-2">
        <div align="center">
            <div for="" id="open-menu-glass">
                <input type="checkbox" id="check"/>
                <span class="spanm"></span>
                <span class="spanm"></span>
                <span class="spanm"></span>
            </div>
        </div>
    </div>
    <div class="box box-1"></div>
</div>

<!-- MENU MOBILE -->
<div class="menu-mobile">
    <img src="img/logo-wellcome-bianco.png" class="logo-menu-mobile" alt="" title=""/>
    <div for="" id="open-menu-mob">
        <input type="checkbox" id="check1"/>
        <span class="spanm1"></span>
        <span class="spanm1"></span>
        <span class="spanm1"></span>
    </div>
</div>

<div class="container-menu-expand out-side-now blue-menu"></div>
<nav class="container-menu-expand real-out out-side-now blue-menu">
    <ol>
        <li class="blue-menu-item" data-section="1">
            <span><?php echo $view_model->translations->get('info_hotel'); ?></span>
        </li>
        <li class="blue-menu-item" data-section="2">
            <span id="title-proposte"><?php echo $view_model->translations->get('proposte'); ?></span>
        </li>
        <li class="blue-menu-item" data-section="3">
            <span><?php echo $view_model->translations->get('suggerimenti'); ?></span>
        </li>
    </ol>
</nav>
<!-- EXPAND MENU -->
<div class="container-menu-expand hidden-mob"></div>
<nav class="container-menu-expand real hidden-mob" id="glass-menu">
    <ol>
        <li class="box-menu box-flex bflex-first menu-in-one <?php if ($tab == 'info') echo 'bg-white'; ?>" data-id="1">
            <div align="center">
                <svg xmlns="http://www.w3.org/2000/svg" width="42.977" height="94.309" viewBox="0 0 42.977 94.309"
                     class="menu-icon">
                    <g id="Raggruppa_114" data-name="Raggruppa 114" transform="translate(-973.109 -636.86)">
                        <g id="Raggruppa_10" data-name="Raggruppa 10" transform="translate(973.109 636.86)">
                            <g id="Raggruppa_9" data-name="Raggruppa 9">
                                <path id="Tracciato_35" data-name="Tracciato 35"
                                      d="M1012.636,657.417a.971.971,0,0,0-.011.182V727.73H976.161V688.886c0-9.426,7.568-12.745,15.585-16.247,7.216-3.16,14.667-6.415,14.667-14.656a12.806,12.806,0,0,0-12.788-12.8,12.6,12.6,0,0,0-9.063,3.853,12.99,12.99,0,0,0-3.736,9.127,2.347,2.347,0,0,1-2.37,2.562,1.937,1.937,0,0,1-1.964-1.1,3.64,3.64,0,0,1-.352-1.484,18.255,18.255,0,0,1,36.5-.726Z"
                                      transform="translate(-972.904 -636.656)" fill="#95e8d1"/>
                                <path id="Tracciato_36" data-name="Tracciato 36"
                                      d="M1016.085,658.348a2.448,2.448,0,0,1-.021.288v70.921a1.613,1.613,0,0,1-1.622,1.612h-39.7a1.61,1.61,0,0,1-1.612-1.612V689.09c0-11.55,9.308-15.617,17.527-19.214,6.832-2.989,12.724-5.572,12.724-11.688a9.574,9.574,0,0,0-9.554-9.564,9.673,9.673,0,0,0-9.564,9.756,6.491,6.491,0,0,1-1.7,4.28,5.8,5.8,0,0,1-7.792,0,6.412,6.412,0,0,1-1.665-4.323,21.488,21.488,0,0,1,42.975.011Zm-3.256-.544a.982.982,0,0,1,.011-.181,18.255,18.255,0,0,0-36.5.726,3.642,3.642,0,0,0,.352,1.484,1.938,1.938,0,0,0,1.964,1.1,2.347,2.347,0,0,0,2.37-2.562,12.99,12.99,0,0,1,3.736-9.127,12.594,12.594,0,0,1,9.063-3.853,12.806,12.806,0,0,1,12.788,12.8c0,8.241-7.451,11.5-14.667,14.656-8.016,3.5-15.585,6.821-15.585,16.246v38.844h36.464Z"
                                      transform="translate(-973.109 -636.86)" fill="#2a3d58"/>
                            </g>
                        </g>
                        <g id="Tracciato_37" data-name="Tracciato 37" transform="translate(0.544 3.136)" fill="#eaa981"
                           stroke-miterlimit="10">
                            <path d="M 1001.045715332031 706.4800415039062 L 995.090087890625 703.3489990234375 C 994.7733764648438 703.1813354492188 994.4129638671875 703.091796875 994.0509643554688 703.091796875 C 993.68896484375 703.091796875 993.3284912109375 703.181396484375 993.0086059570312 703.3507690429688 L 987.056396484375 706.47998046875 L 988.1934814453125 699.8483276367188 C 988.3173217773438 699.1234741210938 988.0774536132812 698.3848876953125 987.5519409179688 697.8717651367188 L 982.7333984375 693.1746826171875 L 989.391357421875 692.2074584960938 C 990.1210327148438 692.1004028320312 990.749267578125 691.6434936523438 991.0737915039062 690.9850463867188 L 994.0514526367188 684.9514770507812 L 997.028564453125 690.985595703125 C 997.3555297851562 691.6448974609375 997.983154296875 692.1007080078125 998.7086791992188 692.2072143554688 L 1005.369384765625 693.1748046875 L 1000.550842285156 697.870849609375 C 1000.024597167969 698.3849487304688 999.7847290039062 699.1234130859375 999.9082641601562 699.8472900390625 L 1001.045715332031 706.4800415039062 Z"
                                  stroke="none"/>
                            <path d="M 994.0513305664062 687.7763061523438 L 992.1950073242188 691.5375366210938 C 991.6888427734375 692.5648193359375 990.709228515625 693.2774658203125 989.571044921875 693.4444580078125 L 985.419677734375 694.0475463867188 L 988.4253540039062 696.9774169921875 C 989.2445678710938 697.7775268554688 989.6185913085938 698.9290771484375 989.425537109375 700.0595703125 L 988.7164306640625 704.1950073242188 L 992.4275512695312 702.2440185546875 C 992.926025390625 701.9808959960938 993.4873046875 701.841796875 994.0509643554688 701.841796875 C 994.6140747070312 701.841796875 995.1748046875 701.9805908203125 995.6728515625 702.2431640625 L 999.3856201171875 704.195068359375 L 998.676025390625 700.0575561523438 C 998.4835205078125 698.928955078125 998.8574829101562 697.777587890625 999.6784057617188 696.9756469726562 L 1002.682800292969 694.047607421875 L 998.5271606445312 693.4439697265625 C 997.3961791992188 693.2779541015625 996.417724609375 692.5673828125 995.9097900390625 691.5431518554688 L 995.9075317382812 691.5386352539062 L 994.0513305664062 687.7763061523438 M 994.051513671875 683.3660278320312 C 994.4022216796875 683.3660278320312 994.7528686523438 683.548583984375 994.9332885742188 683.9136352539062 L 998.1495361328125 690.4324951171875 C 998.2935180664062 690.7228393554688 998.5699462890625 690.9234619140625 998.8901977539062 690.970458984375 L 1006.083740234375 692.0154418945312 C 1006.890747070312 692.1328735351562 1007.212097167969 693.1234741210938 1006.629211425781 693.6924438476562 L 1001.423278808594 698.7660522460938 C 1001.191650390625 698.9923095703125 1001.085998535156 699.3179321289062 1001.140441894531 699.6370849609375 L 1002.369140625 706.8016967773438 C 1002.506774902344 707.6044311523438 1001.664367675781 708.2171630859375 1000.94287109375 707.8381958007812 L 994.5084228515625 704.4554443359375 C 994.2222900390625 704.303955078125 993.8795776367188 704.303955078125 993.5935668945312 704.4554443359375 L 987.1590576171875 707.8381958007812 C 986.4383544921875 708.21728515625 985.5953369140625 707.6043701171875 985.7329711914062 706.8016967773438 L 986.9614868164062 699.6370849609375 C 987.0159912109375 699.3179321289062 986.9103393554688 698.9923095703125 986.6786499023438 698.7660522460938 L 981.4738159179688 693.6924438476562 C 980.8900146484375 693.1234741210938 981.2122802734375 692.1328735351562 982.0182495117188 692.0154418945312 L 989.211669921875 690.970458984375 C 989.531982421875 690.9234619140625 989.8094482421875 690.7228393554688 989.9525146484375 690.4324951171875 L 993.1697387695312 683.9136352539062 C 993.3501586914062 683.548583984375 993.7008666992188 683.3660278320312 994.051513671875 683.3660278320312 Z"
                                  stroke="none" fill="#2a3d58"/>
                        </g>
                    </g>
                </svg>
            </div>
            <span <?php if ($tab == 'info') echo 'class="fc-black"'; ?>><?php echo $view_model->translations->get('info_hotel'); ?></span>
        </li>
        <div class="border-menu-in"></div>
        <li class="box-menu box-flex bflex-middle menu-in-two <?php if ($tab == 'prop') echo 'bg-white'; ?>">
            <div align="center">
                <svg id="Raggruppa_4" data-name="Raggruppa 4" xmlns="http://www.w3.org/2000/svg" width="76.539"
                     height="73.681" viewBox="0 0 76.539 73.681" class="menu-icon">
                    <g id="Raggruppa_3" data-name="Raggruppa 3">
                        <path id="Tracciato_15" data-name="Tracciato 15"
                              d="M998.783,423.758c1.982.684,3.262,2.087,3.262,3.569a3.256,3.256,0,0,1-1.122,2.324,7.037,7.037,0,0,1-4.77,1.692c-2.587,0-4.91-1.193-5.656-2.9a2.793,2.793,0,0,1-.237-1.114c0-2.166,2.692-4.007,5.892-4.007A7.923,7.923,0,0,1,998.783,423.758Z"
                              transform="translate(-945.883 -370.499)" fill="#eaa981"/>
                        <path id="Tracciato_16" data-name="Tracciato 16"
                              d="M960.384,395.79l-1.21,28.953-14.854,7.523L951.5,395.79Z"
                              transform="translate(-940.225 -367.109)" fill="#e2ecea"/>
                        <path id="Tracciato_17" data-name="Tracciato 17"
                              d="M1013.245,442.5H963.66l.474-11.224H985.2a9.027,9.027,0,0,0,7.672,3.7,10.01,10.01,0,0,0,5.778-1.745Z"
                              transform="translate(-942.607 -371.48)" fill="#e2ecea"/>
                        <path id="Tracciato_18" data-name="Tracciato 18"
                              d="M1013.171,398.77l7.541,38.274-15.38-9.768a5.625,5.625,0,0,0,.886-2.972,6.4,6.4,0,0,0-3.648-5.463Z"
                              transform="translate(-947.399 -367.476)" fill="#e2ecea"/>
                        <path id="Tracciato_19" data-name="Tracciato 19" d="M958.89,432.28l-.43,10.347H943.01l.5-2.552Z"
                              transform="translate(-940.063 -371.603)" fill="#95e8d1"/>
                        <path id="Tracciato_20" data-name="Tracciato 20"
                              d="M1006.838,395.79l-11.487,21.746a10.829,10.829,0,0,0-2.394-.263c-4.717,0-8.549,2.99-8.549,6.664,0,.105,0,.21.009.316h-20.1L965.5,395.79h6.085c3.665,8.637,8.3,17.563,8.628,18.177a1.327,1.327,0,0,0,2.35,0c.324-.614,4.963-9.54,8.628-18.177Z"
                              transform="translate(-942.688 -367.109)" fill="#95e8d1"/>
                        <path id="Tracciato_21" data-name="Tracciato 21"
                              d="M982.158,366.11a11.627,11.627,0,0,1,11.618,11.618c0,5.059-7.532,21-11.618,29.058-4.077-8.058-11.618-24-11.618-29.058A11.627,11.627,0,0,1,982.158,366.11Zm6.8,11.478a6.8,6.8,0,1,0-6.8,6.8A6.807,6.807,0,0,0,988.954,377.588Z"
                              transform="translate(-943.454 -363.453)" fill="#eaa981"/>
                        <path id="Tracciato_22" data-name="Tracciato 22"
                              d="M982.835,371.45a6.8,6.8,0,1,1-6.8,6.8A6.807,6.807,0,0,1,982.835,371.45Zm4.139,6.8a4.134,4.134,0,1,0-4.139,4.139A4.146,4.146,0,0,0,986.974,378.245Z"
                              transform="translate(-944.131 -364.111)" fill="#2a3d58"/>
                        <path id="Tracciato_23" data-name="Tracciato 23"
                              d="M977.179,409.938c-.324-.614-4.963-9.54-8.628-18.177h-6.085l-1.184,28.462h20.1c-.009-.105-.009-.21-.009-.316,0-3.674,3.832-6.664,8.549-6.664a10.829,10.829,0,0,1,2.394.263l11.487-21.746H988.156c-3.665,8.637-8.3,17.563-8.628,18.177a1.327,1.327,0,0,1-2.35,0Zm38.984,25.235a1.319,1.319,0,0,1-1.307,1.587H940.974a1.333,1.333,0,0,1-1.026-.482,1.317,1.317,0,0,1-.272-1.1l8.856-45a1.326,1.326,0,0,1,1.306-1.07h17.607c-1.929-4.805-3.367-9.242-3.367-11.75a14.279,14.279,0,0,1,28.559,0c0,2.508-1.447,6.945-3.376,11.75H1006a1.326,1.326,0,0,1,1.307,1.07Zm-3.2-2.525-7.541-38.274-10.6,20.071a6.4,6.4,0,0,1,3.648,5.463,5.625,5.625,0,0,1-.886,2.972ZM960.7,434.1h49.585L995.7,424.836a10.01,10.01,0,0,1-5.778,1.745,9.027,9.027,0,0,1-7.672-3.7h-21.07Zm35.109-14.2c0-1.482-1.28-2.885-3.262-3.569a7.923,7.923,0,0,0-2.63-.438c-3.2,0-5.892,1.841-5.892,4.007a2.793,2.793,0,0,0,.237,1.114c.745,1.71,3.069,2.9,5.656,2.9a7.037,7.037,0,0,0,4.77-1.692A3.256,3.256,0,0,0,995.811,419.908Zm-5.84-42.553a11.618,11.618,0,1,0-23.236,0c0,5.059,7.541,21,11.618,29.058C982.44,398.355,989.972,382.414,989.972,377.355ZM958.6,420.714l1.21-28.953h-8.882l-7.181,36.476Zm-.552,13.389.43-10.347-15.38,7.8-.5,2.552Z"
                              transform="translate(-939.649 -363.08)" fill="#2a3d58"/>
                    </g>
                </svg>

            </div>
            <span <?php if ($tab == 'prop') echo 'class="fc-black"'; ?>><?php echo $view_model->translations->get('proposte'); ?></span>
        </li>
        <div class="border-menu-in"></div>
        <li class="box-menu box-flex bflex-last menu-in-three <?php if ($tab == 'sugg' || $tab == 'suggestions' || $tab == 'cat' || $tab == 'item') echo 'bg-white'; ?>"
            data-id="3">
            <div align="center">
                <svg xmlns="http://www.w3.org/2000/svg" width="76.539" height="76.539" viewBox="0 0 76.539 76.539"
                     class="svg-icon">
                    <g id="Raggruppa_113" data-name="Raggruppa 113" transform="translate(-953.1 -511.17)">
                        <g id="Raggruppa_7" data-name="Raggruppa 7" transform="translate(953.1 511.17)">
                            <g id="Raggruppa_6" data-name="Raggruppa 6">
                                <path id="Tracciato_24" data-name="Tracciato 24"
                                      d="M971.427,563.169a1.313,1.313,0,0,0,.731-.227l19.51-12.813a1.285,1.285,0,0,0,.391-.391l12.813-19.51a1.32,1.32,0,0,0-.177-1.677,1.3,1.3,0,0,0-.946-.4l2.018-2.5a27.034,27.034,0,1,1-38.187,38.187l3.1-.9A1.324,1.324,0,0,0,971.427,563.169Z"
                                      transform="translate(-949.319 -507.389)" fill="#e2ecea"/>
                                <path id="Tracciato_25" data-name="Tracciato 25"
                                      d="M971.761,562.545a1.32,1.32,0,0,0,.177,1.677,1.347,1.347,0,0,0,.2.177l-3.1.9a27.033,27.033,0,0,1,38.187-38.187l-2.018,2.5a1.314,1.314,0,0,0-.731.227l-19.51,12.813a1.284,1.284,0,0,0-.391.391Z"
                                      transform="translate(-950.776 -508.846)" fill="#e2ecea"/>
                                <path id="Tracciato_26" data-name="Tracciato 26"
                                      d="M983.438,541.521l13.885-9.131-9.118,13.9-13.885,9.118Zm4.654,2.384a2.264,2.264,0,1,0-2.27,2.257A2.277,2.277,0,0,0,988.092,543.9Z"
                                      transform="translate(-947.558 -505.629)" fill="#eaa981"/>
                                <path id="Tracciato_27" data-name="Tracciato 27"
                                      d="M983.44,571.233a29.751,29.751,0,0,0,29.725-29.713h.845a1.338,1.338,0,0,0,1.337,1.337H1019a35.61,35.61,0,0,1-34.215,34.215v-3.657a1.34,1.34,0,0,0-1.349-1.337Z"
                                      transform="translate(-945.177 -503.244)" fill="#95e8d1"/>
                                <path id="Tracciato_28" data-name="Tracciato 28"
                                      d="M961.089,541.52A29.748,29.748,0,0,0,990.8,571.233v.845a1.337,1.337,0,0,0-1.337,1.337v3.657a35.6,35.6,0,0,1-34.215-34.215h3.657a1.338,1.338,0,0,0,1.337-1.337Z"
                                      transform="translate(-952.539 -503.244)" fill="#95e8d1"/>
                                <path id="Tracciato_29" data-name="Tracciato 29"
                                      d="M990.8,519.159a29.751,29.751,0,0,0-29.713,29.725h-.845a1.34,1.34,0,0,0-1.337-1.349H955.25a35.61,35.61,0,0,1,34.215-34.215v3.657a1.338,1.338,0,0,0,1.337,1.337Z"
                                      transform="translate(-952.539 -510.608)" fill="#95e8d1"/>
                                <path id="Tracciato_30" data-name="Tracciato 30"
                                      d="M1013.165,548.884a29.753,29.753,0,0,0-29.725-29.725v-.845a1.34,1.34,0,0,0,1.349-1.337V513.32A35.62,35.62,0,0,1,1019,547.535h-3.657a1.34,1.34,0,0,0-1.337,1.349Z"
                                      transform="translate(-945.177 -510.608)" fill="#95e8d1"/>
                                <path id="Tracciato_31" data-name="Tracciato 31"
                                      d="M986.177,541.99a2.264,2.264,0,1,1-2.27-2.27A2.266,2.266,0,0,1,986.177,541.99Z"
                                      transform="translate(-945.644 -503.714)" fill="#2a3d58"/>
                                <path id="Tracciato_32" data-name="Tracciato 32"
                                      d="M969.786,560.571l12.813-19.51a1.284,1.284,0,0,1,.391-.391l19.51-12.813a1.314,1.314,0,0,1,.731-.227,1.3,1.3,0,0,1,.946.4,1.32,1.32,0,0,1,.177,1.677l-12.813,19.51a1.286,1.286,0,0,1-.391.391l-19.51,12.813a1.312,1.312,0,0,1-1.476,0,1.347,1.347,0,0,1-.2-.177A1.32,1.32,0,0,1,969.786,560.571Zm28.779-26.938-13.885,9.131-9.118,13.885,13.885-9.118Z"
                                      transform="translate(-948.8 -506.872)" fill="#2a3d58"/>
                                <path id="Tracciato_33" data-name="Tracciato 33"
                                      d="M959.88,547.675a29.719,29.719,0,1,1,29.713,29.713A29.751,29.751,0,0,1,959.88,547.675Zm2.674,0a27.033,27.033,0,1,0,27.039-27.052A26.907,26.907,0,0,0,962.554,547.675Z"
                                      transform="translate(-951.329 -509.399)" fill="#2a3d58"/>
                                <path id="Tracciato_34" data-name="Tracciato 34"
                                      d="M955.811,550.783A35.6,35.6,0,0,0,990.026,585V581.34a1.343,1.343,0,0,1,2.686,0V585a35.611,35.611,0,0,0,34.215-34.215h-3.658a1.343,1.343,0,0,1,0-2.686h3.658a35.62,35.62,0,0,0-34.215-34.215v3.657a1.343,1.343,0,0,1-2.686,0v-3.657A35.61,35.61,0,0,0,955.811,548.1h3.657a1.343,1.343,0,0,1,0,2.686Zm8.5-28.4A38.256,38.256,0,1,1,953.1,549.446,38.017,38.017,0,0,1,964.312,522.382Z"
                                      transform="translate(-953.1 -511.17)" fill="#2a3d58"/>
                            </g>
                        </g>
                    </g>
                </svg>

            </div>
            <span <?php if ($tab == 'sugg' || $tab == 'suggestions' || $tab == 'cat' || $tab == 'item') echo 'class="fc-black"'; ?>><?php echo $view_model->translations->get('suggerimenti'); ?></span>
        </li>
    </ol>
</nav>

<nav class="menu-mob-in-container">
    <ul class="ul-menu-mob">
        <li class="one <?php if ($tab == 'info') echo 'one-hover'; ?>"><a class="a-menu-mob menu-in-one"
                                                                          data-id="1"><?php echo $view_model->translations->get('info_hotel'); ?></a>
        </li><!--
     -->
        <li class="two <?php if ($tab == 'prop') echo 'two-hover'; ?>"><a
                    class="a-menu-mob menu-in-two"><?php echo $view_model->translations->get('proposte'); ?></a></li><!--
     -->
        <li class="three <?php if ($tab == 'sugg' || $tab == 'suggestions' || $tab == 'cat' || $tab == 'item') echo 'three-hover'; ?>">
            <a class="a-menu-mob menu-in-three"
               data-id="3"><?php echo $view_model->translations->get('suggerimenti'); ?></a></li><!--
    -->
        <hr class="hr-menu-mob"/>
    </ul>
</nav>

<div class="menu-content-container" <?php if ($tab == 'info' || $tab == 'prop' || $tab == 'sugg' || $tab == 'suggestions') echo 'style="display:block;"'; ?>>
    <?php include 'Views/frontoffice.info.php'; ?>
    <?php include 'Views/frontoffice.proposals.php'; ?>
    <?php include 'Views/frontoffice.suggestions.php'; ?>
</div>

<?php include 'Views/frontoffice.proposals.event.php'; ?>
<?php include 'Views/frontoffice.proposals.facility.php'; ?>

<?php include 'Views/frontoffice.suggestions.category.php'; ?>
<?php include 'Views/frontoffice.suggestions.category.facility.php'; ?>

<?php include 'Views/frontoffice.reservations.php'; ?>
<?php include 'Views/frontoffice.thanks.php'; ?>


<?php require_once 'Views/frontoffice.footer.php'; ?>

</body>
</html>