<div class="lang-select">
    <?php $currentLanguage = $view_model->languages->get_selected(); ?>
    <?php foreach ($view_model->languages->list_all() as $language) { ?>
        <a href="/language?lang=<?php echo $language['abbreviazione']; ?>"
           onclick="window.location.assign($(this).attr('href') + '&return_url=' + window.location.pathname); return false;"
           alt=""
           title=""
           class="round-lang">
            <?php echo $language['abbreviazione']; ?>
        </a>
    <?php } ?>
</div>