<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn"
               data-action="<?php echo $view_model->translations->get('link_hotels'); ?>"
               data-title="<?php echo $view_model->translations->get('gestione_hotels'); ?> | Wellcome"
               data-params="false"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('gestione_hotels'); ?>/</a>
            <h1><i class="fa fa-building-o"></i> <?php echo $view_model->translations->get('crea_nuovo_hotel'); ?></h1>
        </div>
        <div class="col-xl-12 col-lg-12">
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
                                <input type="text" id="nome" class="form-control validate-hotel"
                                       placeholder="London Hotel">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('email'); ?></label>
                                <input type="text" id="email" class="form-control validate-hotel"
                                       placeholder="mario@rossi.it">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                <input type="text" class="form-control validate-hotel" id="sito"
                                       placeholder="www.hotelsuperlondon.co.uk">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                <input type="text" class="form-control validate-hotel" id="telefono"
                                       placeholder="020483039">
                            </div>
                            <div class="form-group col-md-12">
                                <label><?php echo $view_model->translations->get('indirizzo'); ?></label>
                                <input type="text" class="form-control validate-hotel" id="indirizzo"
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
                                <input type="text" id="latitudine" class="form-control" placeholder="33.40393">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('longitudine'); ?></label>
                                <input type="text" id="longitudine" class="form-control" placeholder="8.343445">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('password'); ?></label>
                                <input type="password" class="form-control" id="password" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('conferma_nuova_password'); ?></label>
                                <input type="password" class="form-control validate-hotel" id="conferma_password"
                                       placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('abilitato'); ?></label>
                                <select id="utente_abilitato" class="form-control">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Utente pro</label>
                                <select class="form-control" id="utente-pro">
                                    <option value="3">Si</option>
                                    <option value="4">No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">

                                <label><?php echo $view_model->translations->get('descrizione_ospiti'); ?><span> | <i
                                                class="fa fa-language"></i> Lingua</span></label>
                                <select id="select-language">
                                    <?php
                                    $lingue = $view_model->languages->list_all();
                                    for ($i = 0; $i < sizeof($lingue); $i++) {
                                        ?>
                                        <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php
                                for ($i = 0; $i < sizeof($lingue); $i++) {
                                    ?>
                                    <div class="descrizione_ospiti"
                                         id="descrizione_ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>>
                                        <div class="summernote"
                                             id="descrizione-ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>"></div>
                                    </div>
                                <?php } ?>


                            </div>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><?php echo $view_model->translations->get('immagini_hotel'); ?></span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" multiple="multiple" class="custom-file-input" id="immagini_form">
                                    <label class="custom-file-label"><?php echo $view_model->translations->get('scegli_immagini'); ?></label>
                                </div>
                            </div>
                            <div class="input-group col-md-12" id="preview-img-container">
                                <div id="preview"></div>
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
                                class="fa fa-wrench"></i> <?php echo $view_model->translations->get('servizi'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="hidden" id="num_services" value="0">
                                <a href="javascript:void()" class="open-create-service btn btn-primary"><i
                                            class="fa fa-plus"></i> <?php echo $view_model->translations->get('aggiungi_servizio'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="form-service-container fsc-1" id="fsc-servizio-1">
                            <div class="form-row">
                                <div class="col-12">
                                    <h5><?php echo $view_model->translations->get('dati_servizio'); ?></h5></div>
                                <div class="form-group col-md-4">
                                    <label><?php echo $view_model->translations->get('nome_servizio'); ?>:<span> | <i
                                                    class="fa fa-language"></i> Lingua</span></label>
                                    <select id="select-nome-servizi" data-form-index="1">
                                        <?php
                                        for ($i = 0; $i < sizeof($lingue); $i++) {
                                            ?>
                                            <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php
                                    for ($i = 0; $i < sizeof($lingue); $i++) {
                                        ?>
                                        <input type="text"
                                               class="form-control nome_hotel validate-hotel nome_servizi nome-servizi-1"
                                               id="nome_servizio-<?php echo $lingue[$i]['shortcode_lingua']; ?>-1" <?php if ($i > 0) echo 'style="display:none;"'; ?>
                                               placeholder="Es: Check in">
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-5">
                                    <label><?php echo $view_model->translations->get('descrizione'); ?><span> | <i
                                                    class="fa fa-language"></i> Lingua</span></label>
                                    <select id="select-language-servizi" data-form-index="1">
                                        <?php
                                        for ($i = 0; $i < sizeof($lingue); $i++) {
                                            ?>
                                            <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php
                                    for ($i = 0; $i < sizeof($lingue); $i++) {
                                        ?>
                                        <textarea id="descrizione-<?php echo $lingue[$i]['shortcode_lingua']; ?>-1"
                                                  class="form-control descrizione_servizi validate-hotel descrizione_servizi-1" <?php if ($i > 0) echo 'style="display:none;"'; ?>></textarea>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-3">
                                    <label><?php echo $view_model->translations->get('immagine_servizio'); ?></label>
                                    <input type="file" class="form-control immagine_servizio validate-hotel"
                                           id="immagine_servizio-1">
                                    <div class="input-group col-md-12" id="preview-img-container">
                                        <div id="preview-immagine_servizio-1"></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label><?php echo $view_model->translations->get('orari'); ?></label>
                                    <br/>
                                    <div class="time-container" style="display: inline-block;">

                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="time-title"><?php echo $view_model->translations->get('lunedi'); ?>
                                                <span> | <input
                                                            type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-1-1"> Orario continuato </span></div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="0-lun-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="1-lun-1">
                                                            </span>
                                            </div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="2-lun-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="3-lun-1">
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="time-container" style="display: inline-block;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="time-title"><?php echo $view_model->translations->get('martedi'); ?>
                                                <span> | <input
                                                            type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-2-1"> Orario continuato </span></div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="0-mar-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="1-mar-1">
                                                            </span>
                                            </div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="2-mar-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="3-mar-1">
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="time-container" style="display: inline-block;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="time-title"><?php echo $view_model->translations->get('mercoledi'); ?>
                                                <span> | <input
                                                            type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-3-1"> Orario continuato </span></div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="0-mer-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="1-mer-1">
                                                            </span>
                                            </div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="2-mer-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="3-mer-1">
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="time-container" style="display: inline-block;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="time-title"><?php echo $view_model->translations->get('giovedi'); ?>
                                                <span> | <input
                                                            type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-4-1"> Orario continuato </span></div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="0-gio-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="1-gio-1">
                                                            </span>
                                            </div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="2-gio-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="3-gio-1">
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="time-container" style="display: inline-block;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="time-title"><?php echo $view_model->translations->get('venerdi'); ?>
                                                <span> | <input
                                                            type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-5-1"> Orario continuato </span></div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="0-ven-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="1-ven-1">
                                                            </span>
                                            </div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="2-ven-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="3-ven-1">
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="time-container" style="display: inline-block;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="time-title"><?php echo $view_model->translations->get('sabato'); ?>
                                                <span> | <input
                                                            type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-6-1"> Orario continuato </span></div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="0-sab-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="1-sab-1">
                                                            </span>
                                            </div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="2-sab-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="3-sab-1">
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="time-container" style="display: inline-block;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="time-title"><?php echo $view_model->translations->get('domenica'); ?>
                                                <span> | <input
                                                            type="checkbox" class="orario-continuato" value="1"
                                                            id="orario-continuato-7-1"> Orario continuato </span></div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="0-dom-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="1-dom-1">
                                                            </span>
                                            </div>
                                            <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        id="2-dom-1">
                                                            </span>
                                                <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                            type="time"
                                                            class="validate-hotel"
                                                            id="3-dom-1">
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                    <input type="button" class="btn btn-danger annulla-servizio" id="servizio-1"
                                           value="Elimina servizio">
                                </div>
                                <div class="form-group col-md-12">
                                    <hr/>
                                    <input type="button" class="btn btn-success save-servizio"
                                           value="Aggiungi un altro servizio">
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
                           data-success="<?php echo $view_model->translations->get('hotel_creato_successo'); ?>"
                           data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                           data-callback="<?php echo $view_model->translations->get('link_hotels'); ?>" id="saveHotel"
                           value="<?php echo $view_model->translations->get('crea_hotel'); ?>">
                </div>
                <hr/>
                <br/><br/>
            </div>
        </div>
    </div>
</div>