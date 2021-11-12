<?php
    $label = $label ?? 'abilitato';
    $field = $field ?? $label;
    $value = $value ?? 0;
?>
<div class="form-group col-md-3">
    <div class="form-check">
        <input type="hidden"
               name="<?php echo $field; ?>"
               value="0">
        <input class="form-check-input"
               type="checkbox"
               name="<?php echo $field; ?>"
               value="1"
               id="<?php echo $field; ?>]"
            <?php if ($value == 1) echo 'checked'; ?>>
        <label class="form-check-label"
               for="<?php echo $field; ?>]"><?php echo $view_model->translations->get($label); ?></label>
    </div>
</div>

