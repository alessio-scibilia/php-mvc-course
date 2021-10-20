<div class="footer <?php if($view_model->template_name == 'backoffice.login') echo 'login-footer';?>">
    <div class="lang-select">
        <?php
        $lingue = getLangsNa($dbh);
        for($i = 0;$i<sizeof($lingue);$i++) {
            echo '<a href="process/set_lang?lang='.$lingue[$i]['abbreviazione'].'"';
            if($_SESSION['lang'] == $lingue[$i]['shortcode_lingua']) echo 'class="active-lang"';
            echo '>'.$lingue[$i]['abbreviazione'].'</a>';
        }
        ?>
    </div>
    <?php if($currentPage != 'login') { ?>
        <div class="copyright">
            <p>Copyright © 2021</p>
        </div>
    <?php } ?>
</div>

<script src="js/bootstrap.js"></script>
<script src="js/popper.js"></script>	<script src="js/jquery.min.js"></script>

<script src="js/main.js"></script>
<?php
//un link ad una pagina js, dove sono disponibili gli script utili esclusivamente alla pagina corrente.
//echo '<script src="js/pages/'.$currentPage.'.js"></script>';

//TO DO: FILTRARE IN BASE ALLA PAGINA
if($currentPage != 'login') echo '
	<script src="vendor/global/global.min.js"></script>
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="./js/custom.min.js"></script>
	<script src="./js/deznav-init.js"></script>
	<!-- Apex Chart -->
	<script src="./vendor/apexchart/apexchart.js"></script>
	
    <!-- Vectormap -->
	<!-- Chart piety plugin files -->
    <script src="./vendor/peity/jquery.peity.min.js"></script>
	
    <!-- Chartist -->
    <script src="./vendor/chartist/js/chartist.min.js"></script>
	
	<!-- Dashboard 1 -->
	<script src="./js/dashboard/dashboard-1.js"></script>
	<!-- Svganimation scripts -->
	<script src="./vendor/svganimation/vivus.min.js"></script>
    <script src="./vendor/svganimation/svg.animation.js"></script>
    <script src="js/bootstrap-select.js"></script>

      ';
?>


<?php
include($GLOBALS['where_path'] . 'functions/footer.php');
?>

