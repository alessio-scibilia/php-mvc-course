<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="/backoffice/facilities" id="gobacksearch" class="open-view-action-inside back-btn"
               data-action="<?php echo $view_model->translations->get('link_struttura'); ?>"
               data-title="<?php echo $view_model->translations->get('gestione_strutture'); ?>" data-params="false"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('gestione_strutture'); ?>
                /</a>
            <h1><i class="fa fa-building"></i> <?php echo $view_model->translations->get('crea_nuova_struttura'); ?>
            </h1>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('dati_struttura'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('hotel_associati'); ?></label>
                                <select class="selectpicker" data-live-search="true" id="hotel_associati">
                                    <option disabled selected>Seleziona...</option>
                                    <?php foreach ($view_model->related_hotels as &$hotel) {
                                        echo '<option value="' . $hotel->id . '" data-tokens ="' . $hotel->nome . ' ' . $hotel->email . ' ' . $hotel->indirizzo . '">' . $hotel->nome . '</option>';
                                    } ?>
                                </select>
                            </div>

                            <div id="relatedHotels" class="form-group col-md-6">
                            </div>

                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('categorie_associate'); ?></label>
                                <select class="selectpicker1" data-live-search="true" id="categorie_associate">
                                    <option disabled selected>Seleziona...</option>
                                    <?php foreach ($view_model->categories as &$category) {
                                        echo '<option value="' . $category->id . '" data-tokens ="' . $category->nome . '">' . $category->nome . '</option>';

                                    } ?>
                                </select>
                            </div>

                            <div id="relatedCat" class="form-group col-md-6">
                            </div>

                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('nome_struttura'); ?></label>
                                <input type="text" id="nome_struttura" class="form-control validate-1"
                                       placeholder="London Hotel">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('email'); ?></label>
                                <input type="text" id="email" class="form-control validate-1"
                                       placeholder="mario@rossi.it">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                <input type="text" class="form-control validate-1" id="sito"
                                       placeholder="www.hotelsuperlondon.co.uk">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                <input type="text" class="form-control validate-1" id="telefono"
                                       placeholder="020483039">
                            </div>
                            <div class="form-group col-md-12">
                                <label><?php echo $view_model->translations->get('abilitato'); ?></label>
                                <select class="form-control" id="abilitato-1">
                                    <option value="1"><?php echo $view_model->translations->get('si'); ?></option>
                                    <option value="0"><?php echo $view_model->translations->get('no'); ?></option>
                                </select>
                            </div>
                            <input type="hidden" id="indicizza" value="0">
                            <div class="form-group col-md-12">
                                <label><?php echo $view_model->translations->get('indirizzo'); ?></label>
                                <input type="text" class="form-control validate-1" id="indirizzo"
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
                            <div class="form-group col-md-4">
                                <label><?php echo $view_model->translations->get('latitudine'); ?></label>
                                <input type="text" id="latitudine" class="form-control" placeholder="33,430302">
                            </div>
                            <div class="form-group col-md-4">
                                <label><?php echo $view_model->translations->get('longitudine'); ?></label>
                                <input type="text" id="longitudine" class="form-control" placeholder="8,93393">
                            </div>
                            <div class="form-group col-md-4">
                                <label><?php echo $view_model->translations->get('tipo_viaggio'); ?></label>
                                <div class="route-container">
                                    <?php
                                    //TODO sistemare link immagini
                                    ?>
                                    <div class="route-div"><input type="radio" name="tipo_viaggio" class="tipo_viaggio"
                                                                  value="1"><img src="/images/walking.svg"
                                                                                 class="svg-route"/><span
                                                for="tipo_viaggio" class="route-span">A piedi</span></div>
                                    <div class="route-div"><input type="radio" name="tipo_viaggio"
                                                                  class="tipo_viaggio"
                                                                  value="2"><img src="/images/car.svg"
                                                                                 class="svg-route"/><span
                                                for="tipo_viaggio" class="route-span">In auto</span></div>
                                    <div class="route-div"><input type="radio" name="tipo_viaggio" class="tipo_viaggio"
                                                                  value="3"><img src="/images/mezzi.svg"
                                                                                 class="svg-route"/><span
                                                for="tipo_viaggio" class="route-span">Trasporti pubblici</span></div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><?php echo $view_model->translations->get('immagini_struttura'); ?></span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" multiple="multiple" class="custom-file-input"
                                           id="immagini_form_strutture">
                                    <label class="custom-file-label"><?php echo $view_model->translations->get('scegli_immagini'); ?></label>
                                </div>
                            </div>
                            <div class="input-group col-md-12" id="preview-img-container">
                                <div id="preview"></div>
                            </div>
                            <div class="form-group col-md-12">

                                <label><?php echo $view_model->translations->get('descrizione'); ?><span> | <i
                                                class="fa fa-language"></i> Lingua</span></label>
                                <select id="select-language">
                                    <?php
                                    $lingue = $view_model->languages->list_all();
                                    for ($i = 0;
                                         $i < sizeof($lingue);
                                         $i++) {
                                        ?>
                                        <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php
                                for ($i = 0;
                                     $i < sizeof($lingue);
                                     $i++) {
                                    ?>
                                    <div class="descrizione_ospiti"
                                         id="descrizione_ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>>
                                        <div class="summernote"
                                             id="descrizione-ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>"></div>
                                    </div>
                                <?php } ?>


                            </div>
                            <div class="form-group col-md-12">
                                <label><?php echo $view_model->translations->get('convenzionato'); ?></label>
                                <select class="form-control" id="is_convenzionato">
                                    <option value="1"><?php echo $view_model->translations->get('si'); ?></option>
                                    <option value="0"><?php echo $view_model->translations->get('no'); ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">

                                <label><?php echo $view_model->translations->get('descrizione_benefit'); ?><span> | <i
                                                class="fa fa-language"></i> Lingua</span></label>
                                <select id="select-language-benefit">
                                    <?php
                                    for ($i = 0;
                                         $i < sizeof($lingue);
                                         $i++) { ?>
                                        <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php
                                for ($i = 0;
                                     $i < sizeof($lingue);
                                     $i++) {
                                    ?>
                                    <div class="descrizione_benefit"
                                         id="descrizione_benefit-<?php echo $lingue[$i]['shortcode_lingua']; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>>
                                        <div class="summernote"
                                             id="descrizione-benefit-<?php echo $lingue[$i]['shortcode_lingua']; ?>"></div>
                                    </div>
                                <?php } ?>


                            </div>
                            <div class="form-group col-md-12">
                                <label><?php echo $view_model->translations->get('orari'); ?></label>
                                <br/>
                                <?php

                                ?>
                                <div class="time-container" style="display: inline-block;">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $view_model->translations->get('lunedi'); ?>
                                            <span> | <input type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-1-1"> Orario continuato </span></div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel" id="0-lun-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time" class="validate-hotel" id="1-lun-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel" id="2-lun-1">
                                                            </span>
                                            <span class="time-span">
                                                               <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time"
                                                        class="validate-hotel" id="3-lun-1">
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-container" style="display: inline-block;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $view_model->translations->get('martedi'); ?>
                                            <span> | <input type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-2-1"> Orario continuato </span></div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel" id="0-mar-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        class="validate-hotel" type="time" id="1-mar-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel" id="2-mar-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time"
                                                        class="validate-hotel" id="3-mar-1">
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-container" style="display: inline-block;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $view_model->translations->get('mercoledi'); ?>
                                            <span> | <input type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-3-1"> Orario continuato </span></div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel" id="0-mer-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time"
                                                        class="validate-hotel" id="1-mer-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel" id="2-mer-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time"
                                                        class="validate-hotel" id="3-mer-1">
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-container" style="display: inline-block;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $view_model->translations->get('giovedi'); ?>
                                            <span> | <input type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-4-1"> Orario continuato </span></div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel" id="0-gio-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time"
                                                        class="validate-hotel" id="1-gio-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel" id="2-gio-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time"
                                                        class="validate-hotel" id="3-gio-1">
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-container" style="display: inline-block;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $view_model->translations->get('venerdi'); ?>
                                            <span> | <input type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-5-1"> Orario continuato </span></div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel" id="0-ven-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time" class="validate-hotel" id="1-ven-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time" class="validate-hotel"
                                                                        id="2-ven-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time" class="validate-hotel" id="3-ven-1">
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-container" style="display: inline-block;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $view_model->translations->get('sabato'); ?>
                                            <span> | <input type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-6-1"> Orario continuato </span></div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time" class="validate-hotel"
                                                                        id="0-sab-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time" class="validate-hotel" id="1-sab-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time" class="validate-hotel"
                                                                        id="2-sab-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time" class="validate-hotel" id="3-sab-1">
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-container" style="display: inline-block;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $view_model->translations->get('domenica'); ?>
                                            <span> | <input type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-7-1"> Orario continuato </span></div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time" class="validate-hotel"
                                                                        id="0-dom-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time" class="validate-hotel" id="1-dom-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time" class="validate-hotel"
                                                                        id="2-dom-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                        type="time" class="validate-hotel" id="3-dom-1">
                                                            </span>
                                        </div>
                                    </div>
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
                    <h4 class="card-title"><?php echo $view_model->translations->get('eccellenze'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <input type="hidden" id="num_eccellenze" value="0">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <a href="javascript:void()" class="open-create-eccellenza btn btn-primary"><i
                                            class="fa fa-plus"></i> <?php echo $view_model->translations->get('aggiungi_eccellenza'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="form-eccellenza-container fsc-1" id="fsc-eccellenza-1" style="display: none;">
                            <div class="form-row">
                                <div class="col-12">
                                    <h5><?php echo $view_model->translations->get('dati_eccellenza'); ?></h5></div>
                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('nome_servizio'); ?>:<span> | <i
                                                    class="fa fa-language"></i> Lingua</span></label>
                                    <select id="select-nome-eccellenze" data-form-index="1">
                                        <?php
                                        for ($i = 0;
                                             $i < sizeof($lingue);
                                             $i++) {
                                            ?>
                                            <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php
                                    for ($i = 0;
                                         $i < sizeof($lingue);
                                         $i++) {
                                        ?>
                                        <input type="text"
                                               class="form-control validate-eccellenza nome-eccellenza nome_eccellenze-1"
                                               id="nome-eccellenza-<?php echo $lingue[$i]['shortcode_lingua']; ?>-1" <?php if ($i > 0) echo 'style="display:none;"'; ?>
                                               placeholder="">
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('immagine_servizio'); ?></label>
                                    <input type="file" class="form-control immagine_eccellenza validate-hotel"
                                           id="immagine_eccellenza-1">
                                    <div class="input-group col-md-12" id="preview-img-container">
                                        <div id="preview-immagine_eccellenza-1"></div>
                                    </div>
                                </div>
                                <?php
                                for ($i = 0;
                                     $i < sizeof($lingue);
                                     $i++) {
                                    ?>
                                    <div class="form-group col-md-12">
                                        <label><?php echo $view_model->translations->get('descrizione') . ' ' . $lingue[$i]['abbreviazione']; ?></label>
                                        <div class="summernote"
                                             id="descrizione-eccellenza-<?php echo $lingue[$i]['shortcode_lingua']; ?>-1"
                                             class="form-control descrizione_eccellenza validate-eccellenza" <?php if ($i > 0) echo 'style="display:none !important;"'; ?>></div>
                                    </div>
                                <?php } ?>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label><?php echo $view_model->translations->get('abilitato'); ?></label>
                                    <select class="form-control" id="abilitato-1">
                                        <option value="1"><?php echo $view_model->translations->get('si'); ?></option>
                                        <option value="0"><?php echo $view_model->translations->get('no'); ?></option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <input type="button" class="btn btn-danger annulla-eccellenza" id="eccellenza-1"
                                           value="Elimina eccellenza">
                                </div>
                                <div class="form-group col-md-12">
                                    <hr/>
                                    <input type="button" class="btn btn-success save-eccellenza"
                                           value="<?php echo $view_model->translations->get('aggiungi_eccellenza'); ?>">
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
                    <h4 class="card-title"><?php echo $view_model->translations->get('sec_esplorato_per_voi'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">

                        <div class="form-didascalia-container dds-1" id="fsc-didascalia-1">
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><?php echo $view_model->translations->get('immagini_didascalia'); ?></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" multiple="multiple" class="custom-file-input"
                                                   id="immagini_form_didascalie">
                                            <label class="custom-file-label"><?php echo $view_model->translations->get('scegli_immagini'); ?></label>
                                        </div>
                                    </div>
                                    <div class="input-group col-md-12" id="preview-img-container">
                                        <div id="preview-didascalie"></div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12">
                <div class="form-group col-md-12">
                    <div align="left">
                        <input type="button" class="btn btn-success"
                               data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                               data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                               id="createStruttura"
                               value="<?php echo $view_model->translations->get('crea_struttura'); ?>">
                    </div>
                    <br/><br/>
                </div>
            </div>

        </div>

    </div>
</div>


<?php /*
            <script
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6DoJBgy3wuk3dCVUlQL3YbJUDtebSvhc&callback=initMap"
              async
            ></script>

            <!-- Summernote -->
    <script src="./vendor/summernote/js/summernote.min.js"></script>
    <!-- Summernote init -->
    <script src="./js/plugins-init/summernote-init.js"></script>

            <script type="text/javascript">
                    $('.selectpicker').selectpicker();
                    $('.selectpicker1').selectpicker();


            </script>
<?php } */ ?>
