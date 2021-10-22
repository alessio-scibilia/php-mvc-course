<div class="lang-select">
    <?php $currentLanguage = $view_model->languages->get_selected(); ?>
    <?php foreach ($view_model->languages->list_all() as $language) { ?>
        <a href="/language?return_url=<?php echo urlencode($view_model->current_url); ?>&lang=<?php echo $language['abbreviazione']; ?>"
           class="<?php echo($language['id'] == $currentLanguage['id'] ? 'active-lang' : '') ?>">
            <?php echo $language['abbreviazione']; ?>
        </a>
    <?php } ?>
</div>
