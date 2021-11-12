<?php
    $label = $label ?? 'immagine';
    $button_label = $button_label ?? 'scegli_immagini';
    $urls = $urls ?? array();
    $main_url_position = $main_url_position ?? 1;
?>
<div class="input-group col-md-12">
    <div class="input-group-prepend">
        <span class="input-group-text"><?php echo $view_model->translations->get($label); ?></span>
    </div>
    <div class="custom-file">
        <input type="file" multiple="multiple" class="custom-file-input"
               id="immagini_form">
        <label class="custom-file-label"><?php echo $view_model->translations->get($button_label); ?></label>
    </div>
</div>
<div class="input-group col-md-12">
    <div id="preview">
        <?php for ($i = 0; $i < sizeof($urls) - 1; $i++) { ?>
            <div class="img-form-preview" id="ifp-prw-<?php echo $i + 1; ?>"><span
                    class="delete-preview" id="prw-<?php echo $i + 1; ?>"
                    onclick="delPreview()"><i
                        class="fa fa-close"></i></span><img
                    class="img-form-preview-item img-hotel"
                    src="<?php echo $url[$i]; ?>" height="200px">
                <div class="default-image-cont">
                    <div class="pt20">
                        <input type="radio"
                               id="default-image"
                            <?php if ($main_url_position == $i + 1) echo 'checked="checked" '; ?>
                               name="default_image"
                               class="default-image"
                               value="<?php echo $i + 1; ?>">
                        <label>Immagine principale</label>
                        <br>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
