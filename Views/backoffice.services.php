<div class="basic-form">
    <input type="hidden" id="num_services"
           value="<?php if (isset($view_model->services)) echo sizeof($view_model->services); else echo 1; ?>">
    <?php
    $r = 0;
    if (isset($view_model->services)) {
        foreach ($view_model->services as &$service) {
            $r++;
            $c = $r - 1;
            //$group = array_values($service);
            $principal = $service[$view_model->language['shortcode_lingua']];
            ?>
            <div style="display: block;" class="form-service-container fsc-<?php echo $r; ?>"
                 id="fsc-servizio-<?php echo $r; ?>">
                <input type="hidden" name="posizione[<?php echo $r; ?>]" value="<?php echo $principal->posizione; ?>">
                <div class="form-row">
                    <div class="col-12">
                        <h5><?php echo $view_model->translations->get('dati_servizio'); ?></h5>
                    </div>

                    <div class="form-group col-md-6">
                        <?php
                            $type = 'input';
                            $label = 'nome_servizio';
                            $placeholder = 'Es. Check in';
                            $field = 'titolo';
                            $field_prefix = "nome_servizio[$r]";
                            //$items = array_merge(...$group);
                            $items = array_values($service);
                            include 'Views/backoffice.multilanguage.textbox.php';
                        ?>
                    </div>

                    <div class="form-group col-md-6">
                        <?php
                            $type = 'textarea';
                            $label = 'descrizione';
                            $placeholder = '';
                            $field = 'descrizione';
                            $field_prefix = "descrizione[$r]";
                            //$items = array_merge(...$group);
                            $items = array_values($service);
                            include 'Views/backoffice.multilanguage.textbox.php';
                        ?>
                    </div>

                    <?php
                        $label = 'immagine_servizio';
                        $button_label = 'immagine_servizio';
                        $field_prefix = "img_servizio[$r]";
                        $urls = empty($principal->immagine) ? array() : array($principal->immagine);
                        $multiple = false;
                        include 'Views/backoffice.images.uploader.php';
                    ?>

                    <div class="form-group col-md-12">
                        <?php
                            $flag_field_prefix ="orario_continuato[$r]";
                            $day_field_prefix = "giorno[$r]";
                            $model = $principal;
                            include 'Views/backoffice.timetable.php';
                        ?>
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-3">
                        <?php
                            $label = 'abilitato';
                            $field = "servizio_abilitato[$r]";
                            $value = $principal->abilitato;
                            include 'Views/backoffice.checkbox.php';
                        ?>
                    </div>

                    <div class="form-group col-md-12">
                        <input type="button"
                               class="btn btn-danger annulla-servizio"
                               id="servizio-<?php echo $r; ?>"
                               value="Elimina servizio"
                               data-num="#num_services"
                               <?php if (count($view_model->services) == 1) echo 'disabled'; ?>>
                    </div>

                    <div class="form-group col-md-12">
                        <hr/>
                        <input type="button"
                               class="btn btn-success save-servizio"
                               data-num="#num_services"
                               value="Aggiungi un altro servizio">
                    </div>

                </div>
            </div>
        <?php }
    } else { ?>
        <div style="display: block;" class="form-service-container fsc-1"
             id="fsc-servizio-1">
            <input type="hidden" name="posizione[1]" value="1">
            <div class="form-row">
                <div class="col-12">
                    <h5><?php echo $view_model->translations->get('dati_servizio'); ?></h5>
                </div>

                <div class="form-group col-md-6">
                    <?php
                        $type = 'input';
                        $label = 'nome_servizio';
                        $placeholder = 'Es. Check in';
                        $field = 'titolo';
                        $field_prefix = "nome_servizio[1]";
                        //$items = array_merge(...$group);
                        $items = array();
                        include 'Views/backoffice.multilanguage.textbox.php';
                    ?>
                </div>

                <div class="form-group col-md-6">
                    <?php
                        $type = 'textarea';
                        $label = 'descrizione';
                        $placeholder = '';
                        $field = 'descrizione';
                        $field_prefix = "descrizione[1]";
                        //$items = array_merge(...$group);
                        $items = array();
                        include 'Views/backoffice.multilanguage.textbox.php';
                    ?>
                </div>

                <?php
                    $label = 'immagine_servizio';
                    $button_label = 'immagine_servizio';
                    $field_prefix = "img_servizio[1]";
                    $urls = array();
                    $multiple = false;
                    include 'Views/backoffice.images.uploader.php';
                ?>

                <div class="form-group col-md-12">
                    <?php
                        $flag_field_prefix ="orario_continuato[1]";
                        $day_field_prefix = "giorno[1]";
                        $model = new stdClass();
                        $model->lunedi = '0|||||';
                        $model->martedi = '0|||||';
                        $model->mercoledi = '0|||||';
                        $model->giovedi = '0|||||';
                        $model->venerdi = '0|||||';
                        $model->sabato = '0|||||';
                        $model->domenica = '0|||||';
                        include 'Views/backoffice.timetable.php';
                    ?>
                </div>

            </div>
            <div class="form-row">

                <div class="form-group col-md-3">
                    <?php
                        $label = 'abilitato';
                        $field = "servizio_abilitato[1]";
                        $value = 0;
                        include 'Views/backoffice.checkbox.php';
                    ?>
                </div>

                <div class="form-group col-md-12">
                    <input type="button"
                           class="btn btn-danger annulla-servizio"
                           id="servizio-1"
                           data-num="#num_services"
                           value="Elimina servizio" disabled>
                </div>

                <div class="form-group col-md-12">
                    <hr/>
                    <input type="button"
                           class="btn btn-success save-servizio"
                           data-num="#num_services"
                           value="Aggiungi un altro servizio">
                </div>

            </div>
        </div>
    <?php } ?>
</div>

