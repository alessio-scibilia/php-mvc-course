<?php
$type = $type ?? 'richtextbox';
$label = $label ?? 'descrizione';
$placeholder = $placeholder ?? '';
$field = $field ?? $label;
$field_prefix = $field_prefix ?? $field;
$class_name = str_replace('[', '-', str_replace(']', '', $field_prefix));
$items = $items ?? array(); // i.e.: $view_model->all_languages_facility_events
?>

<label><?php echo $view_model->translations->get($label); ?>
    <span> | <i class="fa fa-language"></i> Lingua</span>
    <?php foreach ($view_model->languages->list_all() as &$language) { ?>
        | <span>
            <a href="javascript:void()"
               class="multilanguage-textbox-button"
               data-target="<?php echo $class_name; ?>"
               data-code="<?php echo $language['abbreviazione']; ?>">
                <?php echo $language['nome_lingua']; ?>
            </a>
        </span>
    <?php } ?>
</label>

<?php
foreach ($view_model->languages->list_all() as &$language) { ?>
    <?php $filter = function ($item) use ($language) {
        return $item->shortcode_lingua == $language['shortcode_lingua'];
    }; ?>
    <?php $results = array_filter($items, $filter); ?>
    <?php $model = array_pop($results); ?>
    <?php $is_selected = ($model->shortcode_lingua ?? $language['shortcode_lingua']) == $view_model->language['shortcode_lingua']; ?>
    <div class="multilanguage-textbox multilanguage-textbox-<?php echo $class_name; ?> multilanguage-textbox-<?php echo $language['abbreviazione'] ?>"
        <?php if (!$is_selected) echo 'style="display:none;"'; ?>>
        <?php
        switch ($type) {
            case 'richtextbox': ?>
                <textarea class="summernote"
                          name="<?php echo $field_prefix; ?>[<?php echo $language['abbreviazione']; ?>]"><?php echo $model->{$field} ?? ''; ?></textarea>
                <?php break;

            case 'input': ?>
                <input type="text"
                       value="<?php echo $model->{$field} ?? ''; ?>"
                       class="form-control validate-input"
                       name="<?php echo $field_prefix; ?>[<?php echo $language['abbreviazione']; ?>]"
                       placeholder="<?php echo $placeholder; ?>"/>
                <?php break;

            case 'textarea': ?>
                <textarea
                        class="form-control validate-input"
                        name="<?php echo $field_prefix; ?>[<?php echo $language['abbreviazione']; ?>]"
                        placeholder="<?php echo $placeholder; ?>"><?php echo $model->{$field} ?? ''; ?></textarea>
                <?php break;

            default:
                echo $model->{$field} ?? '';
                break;
        }
        ?>
    </div>
<?php } ?>
