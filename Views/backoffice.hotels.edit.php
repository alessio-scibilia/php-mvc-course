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

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('password'); ?></label>
                                    <input type="password"
                                           name="password"
                                           value="<?php echo $view_model->profile->longitudine; ?>"
                                           id="password"
                                           class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('conferma_password'); ?></label>
                                    <input type="password"
                                           value="<?php echo $view_model->profile->longitudine; ?>"
                                           id="conferma_password-type-2"
                                           class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <?php
                                        $label = 'abilitato';
                                        $field = 'abiliato';
                                        include 'Views/backoffice.checkbox.php';
                                    ?>
                                </div>

                                <div class="form-group col-md-12">
                                    <?php
                                        $label = 'hotel_pro';
                                        $field = 'level';
                                        include 'Views/backoffice.checkbox.php';
                                    ?>
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
                        <?php include 'Views/backoffice.services.php'; ?>
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