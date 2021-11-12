<div class="basic-form">
    <div class="form-row">
        <div class="form-group col-md-6">
            <input type="hidden" id="num_services"
                   value="<?php echo sizeof($view_model->services); ?>">
            <a href="javascript:void()" class="open-create-service save-servizio btn btn-primary"><i
                    class="fa fa-plus"></i> <?php echo $view_model->translations->get('aggiungi_servizio'); ?>
            </a>
        </div>
    </div>
    <?php
    $r = 0;
    foreach ($view_model->services as &$service) {
        $r++;
        $c = $r - 1;
        //$group = array_values($service);
        $principal = $service[$view_model->language['shortcode_lingua']];
        ?>
        <div style="display: block;" class="form-service-container fsc-<?php echo $r; ?>" id="fsc-servizio-<?php echo $r; ?>">
            <input type="hidden" name="posizione[<?php echo $r; ?>]" value="<?php echo $principal->posizione; ?>">
            <div class="form-row">
                <div class="col-12">
                    <h5><?php echo $view_model->translations->get('dati_servizio'); ?></h5>
                </div>

                <div class="form-group col-md-4">
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

                <div class="form-group col-md-5">
                    <?php
                    $label = 'descrizione';
                    $placeholder = '';
                    $field = 'descrizione';
                    $field_prefix = "descrizione[$r]";
                    //$items = array_merge(...$group);
                    $items = array_values($service);
                    include 'Views/backoffice.multilanguage.textbox.php';
                    ?>
                </div>

                <div class="form-group col-md-3">
                    <label><?php echo $view_model->translations->get('immagine_servizio'); ?></label>
                    <input type="file"
                           class="form-control immagine_servizio validate-hotel"
                           id="immagine_servizio-<?php echo $r; ?>">

                    <div class="input-group col-md-12" id="preview-img-container">

                        <div id="preview-immagine_servizio-<?php echo $r; ?>">
                            <div class="img-form-preview"
                                 id="ifps-prws-immagine_servizio-<?php echo $r; ?>">
                                <div class="preview_servizio">
                                                        <span
                                                            class="delete-preview"
                                                            id="prws-immagine_servizio-<?php echo $r; ?>"
                                                            onclick="delPreviewServizi()"><i
                                                                class="fa fa-close"></i></span><img
                                        class="img-form-preview-item img-servizio"
                                        src="<?php echo $principal->immagine; ?>"
                                        data-numero-servizio="<?php echo $r; ?>"
                                        height="200px">
                                    <div class="default-image-cont"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label><?php echo $view_model->translations->get('orari'); ?></label>
                    <br/>
                    <?php

                    $orari['lunedi'] = explode("|", $principal->lunedi);
                    $orari['martedi'] = explode("|", $principal->martedi);
                    $orari['mercoledi'] = explode("|", $principal->mercoledi);
                    $orari['giovedi'] = explode("|", $principal->giovedi);
                    $orari['venerdi'] = explode("|", $principal->venerdi);
                    $orari['sabato'] = explode("|", $principal->sabato);
                    $orari['domenica'] = explode("|", $principal->domenica);

                    ?>

                    <?php $weekdays = array('lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi', 'sabato', 'domenica'); ?>
                    <?php $intervals = array('dalle', 'alle', 'dalle', 'alle'); ?>
                    <?php foreach ($weekdays as $weekday) { ?>
                        <div class="time-container" style="display: inline-block;">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="time-title"><?php echo $view_model->translations->get($weekday); ?>
                                    <span> | <input type="hidden" name="orario_continuato[<?php echo $r; ?>][<?php echo $weekday; ?>]" value="0" /><input
                                            type="checkbox"
                                            name="orario_continuato[<?php echo $r; ?>][<?php echo $weekday; ?>]"
                                            class="orario-continuato" <?php if ($orari[$weekday][0] == 1) echo 'checked="checked"'; ?>
                                                                        value="1"> Orario continuato </span>
                                </div>
                                <div class="input-time-container">
                                    <?php for ($i = 0; $i < 2; $i++) { ?>
                                        <span class="time-span">
                                                            <?php echo $view_model->translations->get($intervals[$i]); ?> <input
                                                type="time"
                                                name="giorno[<?php echo $r; ?>][<?php echo $weekday; ?>][<?php echo $i; ?>]"
                                                value="<?php echo $orari[$weekday][$i + 1]; ?>"
                                                class="validate-hotel">
                                                        </span>
                                    <?php } ?>
                                </div>
                                <div class="input-time-container">
                                    <?php for ($i = 2; $i < 4; $i++) { ?>
                                        <span class="time-span">
                                                            <?php echo $view_model->translations->get($intervals[$i]); ?> <input
                                                                <?php if ($orari[$weekday][0] == 1) echo 'disabled'; ?>
                                                                type="time"
                                                                name="giorno[<?php echo $r; ?>][<?php echo $weekday; ?>][<?php echo $i; ?>]"
                                                                class="validate-hotel"
                                                                value="<?php echo $orari[$weekday][$i + 1]; ?>">
                                                        </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-3">
                    <div class="form-check">
                        <input type="hidden"
                               name="servizio_abilitato[<?php echo $r; ?>]"
                               value="0">
                        <input class="form-check-input"
                               type="checkbox"
                               name="servizio_abilitato[<?php echo $r; ?>]"
                               value="1"
                               id="servizio_abilitato[<?php echo $r; ?>]"
                            <?php if ($principal->abilitato == 1) echo 'checked'; ?>>
                        <label class="form-check-label"
                               for="servizio_abilitato[<?php echo $r; ?>]">
                            <?php echo $view_model->translations->get('abilitato'); ?>
                        </label>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <input type="button" class="btn btn-danger annulla-servizio"
                           id="servizio-<?php echo $r; ?>" value="Elimina servizio">
                </div>
                <div class="form-group col-md-12">
                    <hr/>
                    <input type="button" class="btn btn-success save-servizio"
                           value="Aggiungi un altro servizio">
                </div>
            </div>
        </div>
    <?php } ?>
</div>

