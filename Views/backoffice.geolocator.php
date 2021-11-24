<?php
    $model = $model ?? (object)array
    (
        'indirizzo' => '',
        'latitudine' => '',
        'longitudine' => '',
    );
    $field_suffix = $field_suffix ?? '';
    $class_suffix = str_replace('[', '-', str_replace(']', '', $field_suffix));
    $map_container_class = $map_container_class ?? 'col-md-12';
    $map_width = $map_width ?? '100%';
    $map_height = $map_height ?? '260px';
?>
<div class="form-group <?php echo $map_container_class ?>">
    <label><?php echo $view_model->translations->get('indirizzo'); ?></label>
    <input type="text"
           name="indirizzo<?php echo $field_suffix; ?>"
           class="form-control"
           placeholder="Via 20 Settembre, Milano (MI)"
           value="<?php echo $model->indirizzo; ?>">
    <div class="input-group-append">
        <button class="btn btn-primary mt5 calcGPS"
                data-indirizzo="indirizzo<?php echo $field_suffix; ?>"
                data-longitudine="longitudine<?php echo $field_suffix; ?>"
                data-latitudine="latitudine<?php echo $field_suffix; ?>"
                data-hidden_maps="hidden_maps<?php echo $class_suffix; ?>"
                type="button"><i
                    class="fa fa-map-marker"></i> <?php echo $view_model->translations->get('calcola_coordinate'); ?>
        </button>
    </div>
</div>
<div class="form-group <?php echo $map_container_class; ?>">
    <div class="map"
         data-indirizzo="indirizzo<?php echo $field_suffix; ?>"
         data-longitudine="longitudine<?php echo $field_suffix; ?>"
         data-latitudine="latitudine<?php echo $field_suffix; ?>"
         data-hidden_maps="hidden_maps<?php echo $class_suffix; ?>"
         style="height: <?php echo $map_height; ?>; width: <?php echo $map_width; ?>;"></div>
    <div class="hidden_maps<?php echo $class_suffix; ?>"></div>
</div>
<div class="form-group col-md-6">
    <label><?php echo $view_model->translations->get('latitudine'); ?></label>
    <input type="text"
           name="latitudine<?php echo $field_suffix; ?>"
           class="form-control"
           placeholder="44.998939"
           value="<?php echo $model->latitudine; ?>">
</div>
<div class="form-group col-md-6">
    <label><?php echo $view_model->translations->get('longitudine'); ?></label>
    <input type="text"
           name="longitudine<?php echo $field_suffix; ?>"
           class="form-control"
           placeholder="8.49304"
           value="<?php echo $model->longitudine; ?>">
</div>

