<?php
    $label = $label ?? 'immagine';
    $button_label = $button_label ?? 'scegli_immagini';
    $field_prefix = $field_prefix ?? 'img_url';
    $urls = $urls ?? array();
    $tips = $tips ?? array();
    $main_url_position = $main_url_position ?? 1;
    $multiple = $multiple ?? true;
    $disabled = !$multiple && count($urls) > 0;
    $post_url = "/backoffice/upload/images";
    $languages = $view_model->languages->list_all() ?? array();
    $abbreviations = array_map(function($l) { return $l['abbreviazione']; }, $languages);
?>
<div class="input-group col-md-12">
    <div class="input-group-prepend">
        <span class="input-group-text"><?php echo $view_model->translations->get($label); ?></span>
    </div>
    <div class="custom-file">
        <input type="file" <?php if ($multiple) echo 'multiple="multiple"'; ?>
               data-name="<?php echo $field_prefix ?>"
               data-post-url="<?php echo $post_url; include 'Views/xdebug.querystring.first.php'; ?>"
               data-tips="<?php !empty($tips) ?>"
               data-languages="<?php echo join('|', $abbreviations) ?>"
               class="custom-file-input" <?php if ($disabled) echo 'disabled'; ?>>
        <label class="custom-file-label"><?php echo $view_model->translations->get($button_label); ?></label>
    </div>
</div>
<div class="input-group col-md-12 mb-3">
    <div class="preview">
        <?php for ($i = 0; $i < sizeof($urls); $i++) { ?>
            <div class="img-form-preview">
                <span
                    class="delete-preview"
                    onclick="delPreview(this)"><i class="fa fa-close"></i></span><img
                    class="img-form-preview-item"
                    data-name="<?php echo $field_prefix ?>[<?php echo $i + 1; ?>]"
                    src="<?php echo $urls[$i]; ?>" height="200px">
                <div class="default-image-cont">
                    <div class="pt20">
                        <?php if (!empty($tips)) { ?>
                            <?php foreach ($abbreviations as $abbreviation) { ?>
                            <textarea
                                    name="didascalia_<?php echo $field_prefix ?>[<?php echo $i + 1; ?>][<?php $abbreviation; ?>]"
                                    placeholder="<?php echo $abbreviation; ?>"><?php echo $tips[$i] ?? ''; ?></textarea>
                            <?php } ?>
                        <?php } else if ($multiple) { ?>
                            <input type="radio"
                                   id="default-image"
                                <?php if ($main_url_position == $i + 1) echo 'checked="checked" '; ?>
                                   name="default_image"
                                   class="default-image"
                                   value="<?php echo $i + 1; ?>">
                            <label>Immagine principale</label>
                            <br>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
