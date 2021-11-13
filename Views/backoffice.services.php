<div class="basic-form">
    <div class="form-row">
        <div class="form-group col-md-6">
            <input type="hidden" id="num_services"
                   value="<?php if (isset($view_model->services)) echo sizeof($view_model->services); else echo 1; ?>">
            <a href="javascript:void()" class="open-create-service save-servizio btn btn-primary"><i
                        class="fa fa-plus"></i> <?php echo $view_model->translations->get('aggiungi_servizio'); ?>
            </a>
        </div>
    </div>
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
                               value="Elimina servizio">
                    </div>

                    <div class="form-group col-md-12">
                        <hr/>
                        <input type="button"
                               class="btn btn-success save-servizio"
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
                    <label><?php echo $view_model->translations->get('orari'); ?></label>
                    <br/>
                    <?php
                    $default_orari = '0|||||';
                    $orari['lunedi'] = explode("|", $default_orari);
                    $orari['martedi'] = explode("|", $default_orari);
                    $orari['mercoledi'] = explode("|", $default_orari);
                    $orari['giovedi'] = explode("|", $default_orari);
                    $orari['venerdi'] = explode("|", $default_orari);
                    $orari['sabato'] = explode("|", $default_orari);
                    $orari['domenica'] = explode("|", $default_orari);

                    ?>

                    <?php $weekdays = array('lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi', 'sabato', 'domenica'); ?>
                    <?php $intervals = array('dalle', 'alle', 'dalle', 'alle'); ?>
                    <?php foreach ($weekdays as $weekday) { ?>
                        <div class="time-container" style="display: inline-block;">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="time-title"><?php echo $view_model->translations->get($weekday); ?>
                                    <span> | <input type="hidden"
                                                    name="orario_continuato[1][<?php echo $weekday; ?>]"
                                                    value="0"/><input
                                                type="checkbox"
                                                name="orario_continuato[1][<?php echo $weekday; ?>]"
                                                class="orario-continuato" <?php if ($orari[$weekday][0] == 1) echo 'checked="checked"'; ?>
                                                                            value="1"> Orario continuato </span>
                                </div>
                                <div class="input-time-container">
                                    <?php for ($i = 0; $i < 2; $i++) { ?>
                                        <span class="time-span">
                                                <?php echo $view_model->translations->get($intervals[$i]); ?> <input
                                                    type="time"
                                                    name="giorno[1][<?php echo $weekday; ?>][<?php echo $i; ?>]"
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
                                                    name="giorno[1][<?php echo $weekday; ?>][<?php echo $i; ?>]"
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
                           value="Elimina servizio">
                </div>

                <div class="form-group col-md-12">
                    <hr/>
                    <input type="button"
                           class="btn btn-success save-servizio"
                           value="Aggiungi un altro servizio">
                </div>

            </div>
        </div>
    <?php } ?>
</div>

