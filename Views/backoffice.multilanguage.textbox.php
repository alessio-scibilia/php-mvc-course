<?php
    $label = $label ?? 'descrizione';
    $field = $field ?? $label;
    $field_prefix = $field_prefix ?? $field;
    $items = $items ?? array(); // i.e.: $view_model->all_languages_facility_events
?>

<label><?php echo $view_model->translations->get($label); ?>
    <span> | <i class="fa fa-language"></i> Lingua</span>
    <?php foreach ($view_model->languages->list_all() as &$language) { ?>
        | <span>
            <a href="javascript:void()"
               class="ml-textbox-button"
               data-target="<?php echo $field_prefix; ?>"
               data-code="<?php echo $language['abbreviazione']; ?>">
                <?php echo $language['nome_lingua']; ?>
            </a>
        </span>
    <?php } ?>
</label>

<?php foreach ($view_model->languages->list_all() as &$language) { ?>
    <?php $filter = function ($item) use ($language) { return $item->shortcode_lingua == $language['shortcode_lingua']; }; ?>
    <?php $results = array_filter($items, $filter); ?>
    <?php $model = array_pop($results); ?>
    <?php $is_selected = ($model->shortcode_lingua ?? '') == $view_model->language['shortcode_lingua']; ?>
    <div class="ml-textbox ml-textbox-<?php echo $field_prefix; ?> ml-textbox-<?php echo $language['abbreviazione'] ?>"
         <?php if (!$is_selected) echo 'style="display:none;"'; ?>>
        <textarea class="summernote"
                  name="<?php echo $field_prefix; ?>[<?php echo $language['abbreviazione']; ?>]">
            <?php echo $model->{$field} ?? ''; ?>
        </textarea>
    </div>
<?php } ?>
