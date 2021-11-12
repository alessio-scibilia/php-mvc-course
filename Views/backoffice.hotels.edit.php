<form action="/backoffice/hotels/<?php echo $view_model->profile->id; ?>/edit"
      method="POST"
      enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-start mb15">
                <a href="/backoffice/hotels" id="gobacksearch" class="open-view-action-inside back-btn"
                   data-action="<?php echo $view_model->translations->get('link_hotels'); ?>"
                   data-title="<?php echo $view_model->translations->get('gestione_hotels'); ?> | Wellcome"
                   data-params="false"
                   data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                            class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('gestione_hotels'); ?>
                    /</a>
                <h1><i class="fa fa-building-o"></i> <?php echo $view_model->profile->nome; ?></h1>
            </div>
            <div class="col-xl-12 col-lg-12">
                <a href="/<?php echo $view_model->profile->id; ?>"
                   class="btn btn-info" target="_blank"><i class="fa fa-eye"></i> Vedi come ospite</a><br/><br/>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i
                                    class="fa fa-info-circle"></i> <?php echo $view_model->translations->get('dati_hotel'); ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('nome_hotel'); ?></label>
                                    <input type="text"
                                           name="nome"
                                           value="<?php echo $view_model->profile->nome; ?>"
                                           id="nome"
                                           class="form-control validate-hotel" placeholder="London Hotel">
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('email'); ?></label>
                                    <input value="<?php echo $view_model->profile->email; ?>"
                                           name="email"
                                           type="text"
                                           id="email"
                                           class="form-control validate-hotel" placeholder="mario@rossi.it">
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                    <input value="<?php echo $view_model->profile->sito_web; ?>"
                                           type="text"
                                           name="sito_web"
                                           class="form-control validate-hotel"
                                           id="sito"
                                           placeholder="www.hotelsuperlondon.co.uk">
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                    <input value="<?php echo $view_model->profile->telefono; ?>"
                                           type="text"
                                           name="telefono"
                                           class="form-control validate-hotel"
                                           id="telefono"
                                           placeholder="020483039">
                                </div>
                                <div class="form-group col-md-12">
                                    <label><?php echo $view_model->translations->get('indirizzo'); ?></label>
                                    <input value="<?php echo $view_model->profile->indirizzo; ?>"
                                           type="text"
                                           name="indirizzo"
                                           class="form-control validate-hotel"
                                           id="indirizzo"
                                           placeholder="Via 20 Settembre, Milano (MI)">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary mt5" id="calcGPS" type="button"><i
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
                                           value="<?php echo $view_model->profile->latitudine; ?>"
                                           id="latitudine"
                                           class="form-control" placeholder="33.40393">
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('longitudine'); ?></label>
                                    <input type="text"
                                           name="longitudine"
                                           value="<?php echo $view_model->profile->longitudine; ?>"
                                           id="longitudine"
                                           class="form-control" placeholder="8.343445">
                                </div>

                                <div class="form-group col-md-12">
                                    <?php
                                        $label = 'descrizione_ospiti';
                                        $items = $view_model->hotel_translations;
                                        include 'Views/backoffice.multilanguage.textbox.php';
                                    ?>
                                </div>

                                <div class="input-group col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><?php echo $view_model->translations->get('immagini_hotel'); ?></span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" multiple="multiple" class="custom-file-input"
                                               id="immagini_form">
                                        <label class="custom-file-label"><?php echo $view_model->translations->get('scegli_immagini'); ?></label>
                                    </div>
                                </div>
                                <div class="input-group col-md-12" id="preview-img-container">
                                    <div id="preview">
                                        <?php
                                        $immagini = explode("|", $view_model->profile->immagini_secondarie);

                                        for ($i = 0; $i < sizeof($immagini) - 1; $i++) { ?>
                                            <div class="img-form-preview" id="ifp-prw-<?php echo $i + 1; ?>"><span
                                                        class="delete-preview" id="prw-<?php echo $i + 1; ?>"
                                                        onclick="delPreview(<?php echo $i + 1; ?>)"><i
                                                            class="fa fa-close"></i></span><img
                                                        class="img-form-preview-item img-hotel"
                                                        src="<?php echo $immagini[$i]; ?>" height="200px">
                                                <div class="default-image-cont">
                                                    <div class="pt20">
                                                        <input type="radio"
                                                               id="default-image"
                                                            <?php if ($view_model->profile->immagine_principale == $i + 1) echo 'checked="checked" '; ?>
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i
                                    class="fa fa-wrench"></i> <?php echo $view_model->translations->get('servizi'); ?>
                        </h4>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                <div class="form-group col-md-12">
                    <div align="left">
                        <input type="submit" class="btn btn-success validate-it"
                               value="<?php echo $view_model->translations->get('salva'); ?>">
                    </div>
                    <hr/>
                    <br/><br/>
                </div>
            </div>
        </div>
    </div>
</form>