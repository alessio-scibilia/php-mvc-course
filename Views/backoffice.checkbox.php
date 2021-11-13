<?php
    $label = $label ?? 'abilitato';
    $field = $field ?? $label;
    $value = $value ?? 0;
    $id = str_replace('[', '-', str_replace(']', '', $field));
?>
<div class="form-check">
    <input type="hidden"
           name="<?php echo $field; ?>"
           value="0">
    <input class="form-check-input"
           type="checkbox"
           name="<?php echo $field; ?>"
           value="1"
           id="<?php echo $id; ?>"
        <?php if ($value == 1) echo 'checked'; ?>>
    <label class="form-check-label"
           for="<?php echo $id; ?>"><?php echo $view_model->translations->get($label); ?></label>
</div>