<?php
    $model = $model ?? (object)array
    (
        'indirizzo' => '',
        'latitudine' => '',
        'longitudine' => '',
    );
?>
<div class="form-group col-md-12">
    <label><?php echo $view_model->translations->get('indirizzo'); ?></label>
    <input type="text"
           name="indirizzo"
           class="form-control"
           id="indirizzo"
           placeholder="Via 20 Settembre, Milano (MI)"
           value="<?php echo $model->indirizzo; ?>">
    <div class="input-group-append">
        <button class="btn btn-primary mt5 calcGPS" type="button"><i
                class="fa fa-map-marker"></i> <?php echo $view_model->translations->get('calcola_coordinate'); ?>
        </button>
    </div>
</div>
<div class="form-group col-md-12">
    <div id="map" style="height: 260px;width: 100%;"></div>
    <div id="hidden-maps"></div>
</div>
<div class="form-group col-md-6">
    <label><?php echo $view_model->translations->get('latitudine'); ?></label>
    <input type="text"
           name="latitudine"
           id="latitudine"
           class="form-control"
           placeholder="44.998939"
           value="<?php echo $model->latitudine; ?>">
</div>
<div class="form-group col-md-6">
    <label><?php echo $view_model->translations->get('longitudine'); ?></label>
    <input type="text"
           name="longitudine"
           class="form-control"
           id="longitudine"
           placeholder="8.49304"
           value="<?php echo $model->longitudine; ?>">
</div>

