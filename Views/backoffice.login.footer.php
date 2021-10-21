<div class="footer login-footer">
    <div class="lang-select">
        <?php $currentLanguage = $view_model->languages->get_selected(); ?>
        <?php foreach ($view_model->languages->list_all() as $language) { ?>
            <a href="language?return_url=<?php echo urlencode($view_model->current_url); ?>&lang=<?php echo $language['abbreviazione'];?>" class="<?php echo ($language['id'] == $currentLanguage['id'] ? 'active-lang': '') ?>">
                <?php echo $language['abbreviazione'];?>
            </a>
        <?php } ?>
    </div>
</div>

<script src="js/bootstrap.js"></script>
<script src="js/popper.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/main.js"></script>
<?php
//un link ad una pagina js, dove sono disponibili gli script utili esclusivamente alla pagina corrente.
//echo '<script src="js/pages/'.$currentPage.'.js"></script>';

//TO DO: FILTRARE IN BASE ALLA PAGINA
?>
<?php require_once 'Views/backoffice.login.footer.js.php'; ?>

