<div class="basic-form">
    <input type="hidden" id="num_services"
           value="<?php if (isset($view_model->services)) echo sizeof($view_model->services); else echo 1; ?>">
    <?php
    if (isset($view_model->services)) {
        $r = 0;
        foreach ($view_model->services as &$service) {
            //$group = array_values($service);
            $principal = $service[$view_model->language['shortcode_lingua']];
            ?>
            <div style="display: block;" class="form-container fc-<?php echo $r; ?> atc atc-<?php echo $r;?>"  id="dragsatc-<?php echo $r;?>" ondrop="dropatc(event)" ondragover="allowDropatc(event)">
                <div class="form-draggableatc" id="draggableatc-<?php echo $r;?>" draggable="true" ondragstart="dragatc(event)">
                <input type="hidden" name="posizione_servizio[<?php echo $r; ?>]" value="<?php echo $principal->posizione; ?>">
                <div class="form-row">
                    <div class="col-11">
                        <h5><?php echo $view_model->translations->get('dati_servizio'); ?></h5>
                    </div>
                    <div class="col-1 text-right">
                        <a href="javascript:void();" class="open-close-atc" id="open-atc-<?php echo $r;?>"><i class="lni lni-frame-expand"></i></a>
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
                    <div class="stopsee">
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

                </div>

                <div class="form-row stopsee">

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
            </div>
        <?php
            $r++;
        }
    } else { ?>
        <div style="display: block;" class="form-container fc-0 atc atc-0" id="dragsatc-0" ondrop="dropatc(event)" ondragover="allowDropatc(event)">
            <div class="form-draggableatc" id="draggableatc-0" draggable="true" ondragstart="dragatc(event)">
            <input type="hidden" name="posizione_servizio[0]" value="0">
            <div class="form-row">
                <div class="col-11">
                    <h5><?php echo $view_model->translations->get('dati_servizio'); ?></h5>
                </div>
                <div class="col-1 text-right">
                    <a href="javascript:void();" class="open-close-atc" id="open-atc-0"><i class="lni lni-frame-expand"></i></a>
                </div>
                <div class="form-group col-md-6">
                    <?php
                        $type = 'input';
                        $label = 'nome_servizio';
                        $placeholder = 'Es. Check in';
                        $field = 'titolo';
                        $field_prefix = "nome_servizio[0]";
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
                        $field_prefix = "descrizione[0]";
                        //$items = array_merge(...$group);
                        $items = array();
                        include 'Views/backoffice.multilanguage.textbox.php';
                    ?>
                </div>
                <div class=stopsee">
                <?php
                    $label = 'immagine_servizio';
                    $button_label = 'immagine_servizio';
                    $field_prefix = "img_servizio[0]";
                    $urls = array();
                    $multiple = false;
                    include 'Views/backoffice.images.uploader.php';
                ?>

                <div class="form-group col-md-12">
                    <?php
                        $flag_field_prefix ="orario_continuato[0]";
                        $day_field_prefix = "giorno[0]";
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

            </div>
            <div class="form-row stopsee">

                <div class="form-group col-md-3">
                    <?php
                        $label = 'abilitato';
                        $field = "servizio_abilitato[0]";
                        $value = 0;
                        include 'Views/backoffice.checkbox.php';
                    ?>
                </div>

                <div class="form-group col-md-12">
                    <input type="button"
                           class="btn btn-danger annulla-servizio"
                           id="servizio-0"
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
        </div>
    <?php } ?>
</div>

