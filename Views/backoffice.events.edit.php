<div class="container-fluid">
    <div class="row">
        <form action="/backoffice/events/<?php echo $view_model->event->id; include 'Views/xdebug.querystring.first.php'; ?>" method="POST" enctype="multipart/form-data">

            <div class="col-12 d-flex align-items-center justify-content-start mb15">
                <a href="/backoffice/events" id="gobacksearch" class="open-view-action-inside back-btn"><i
                            class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('indietro'); ?>
                    /</a>
                <h1><i class="fa fa-calendar"></i> <?php echo $view_model->translations->get('modifica_evento'); ?>
                </h1>
            </div>

            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <?php if ($view_model->event->created_by != $view_model->user->id && $view_model->user->level > 2) { ?>
                        <div class="card-header">
                            <?php echo $view_model->event->nome_evento; ?>
                        </div>
                    <?php } ?>
                    <div class="card-body">
                        <?php if ($view_model->event->created_by == $view_model->user->id || $view_model->user->level <= 2) {
                            ?>
                            <div class="basic-form">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h4><?php echo $view_model->translations->get('recapiti_struttura'); ?></h4>
                                        <hr/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label><?php echo $view_model->translations->get('associa_struttura'); ?>
                                            :</label>
                                        <select class="selectpicker3" data-live-search="true" data-name="related_item"
                                                id="strutture_associate">
                                            <option selected disabled>Seleziona...</option>
                                            <optgroup
                                                    label="<?php echo $view_model->translations->get('hotels'); ?>">
                                                <?php
                                                $elenco_hotel = $view_model->related_hotels;
                                                if (sizeof($elenco_hotel) > 0) {
                                                    foreach ($elenco_hotel as $hotel) {
                                                        echo '<option value="1-' . $hotel->related_id . '" data-tokens ="' . $hotel->nome . ' ' . $hotel->email . ' ' . $hotel->indirizzo . '">' . $hotel->nome . '</option>';
                                                    }
                                                } ?>
                                            </optgroup>
                                            <optgroup
                                                    label="<?php echo $view_model->translations->get('struttura'); ?>">
                                                <?php
                                                $elenco_strutture_hotel = $view_model->related_facilities;

                                                if (sizeof($elenco_strutture_hotel) > 0) {
                                                    foreach ($elenco_strutture_hotel as $struttura) {
                                                        echo '<option value="2-' . $struttura->id . '" data-tokens ="' . $struttura->nome_struttura . ' ' . $struttura->email . ' ' . $struttura->indirizzo_struttura . '">' . $struttura->nome_struttura . '</option>';
                                                    }
                                                } else echo '<option>Nessuna struttura registrata<option>'; ?>
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div id="relatedCat" class="form-group col-md-12">
                                        <?php foreach ($view_model->facility_events as &$facility_event) { ?>
                                        <?php $id = isset($facility_event->id_struttura) ? '2-'.$facility_event->id_struttura : '1-'.$facility_event->id_hotel; ?>
                                            <a href="javascript:void()"
                                               class="tagit2 relCat relatedCat-<?php echo $id; ?>"
                                               id="<?php echo $id; ?>"
                                               onclick="removeRelatedCat('<?php echo $id; ?>')"><?php echo $facility_event->nome; ?> <i class="fa fa-close"></i></a>
                                            <input type="hidden" name="related_item[]" value="<?php echo $id; ?>" class="cat-<?php echo $id; ?>">
                                        <?php } ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <input type="checkbox" name="recupera_struttura" id="recupera"
                                               value="1" <?php if ($view_model->event->recupera_struttura == 1) echo 'checked="checked"'; ?>> <?php echo $view_model->translations->get('recupera_da_struttura'); ?>
                                    </div>

                                    <div class="row" id="dati_struttura_evento" <?php if ($view_model->event->recupera_struttura == 1) echo 'style="display:none;"'; ?>>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $view_model->translations->get('nome_struttura'); ?></label>
                                            <input type="text" id="nome_struttura" name="nome_struttura"
                                                   class="form-control validate-1"
                                                   placeholder="London Pub"
                                                   value="<?php echo $view_model->event->nome_struttura; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $view_model->translations->get('email'); ?></label>
                                            <input type="text" id="email" name="email"
                                                   class="form-control validate-1"
                                                   placeholder="mario@rossi.it"
                                                   value="<?php echo $view_model->event->email; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                            <input type="text" name="sito_web" class="form-control validate-1"
                                                   id="sito"
                                                   placeholder="www.hotelsuperlondon.co.uk"
                                                   value="<?php echo $view_model->event->sito_web; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                            <input type="text" name="telefono" class="form-control validate-1"
                                                   id="telefono"
                                                   placeholder="+393386854971"
                                                   value="<?php echo $view_model->event->telefono; ?>">
                                        </div>

                                        <?php $model = $view_model->event; include 'Views/backoffice.geolocator.php'; ?>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h4><?php echo $view_model->translations->get('dati_evento'); ?></h4>
                                        <hr/>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <?php
                                        $label = 'immagine_evento';
                                        $button_label = 'scegli_immagini';
                                        $field_prefix = "img_evento";
                                        $urls = empty($view_model->event->img_evento) ? array() : array($view_model->event->img_evento);
                                        $multiple = false;
                                        include 'Views/backoffice.images.uploader.php';
                                    ?>



                                    <div class="form-group col-md-12">
                                        <label><?php echo $view_model->translations->get('nome_evento'); ?></label>
                                        <input type="text" name="nome_evento" id="nome_evento"
                                               class="form-control validate-1"
                                               placeholder="London Festival"
                                               value="<?php echo $view_model->event->nome_evento; ?>">
                                    </div>


                                    <div class="mt20 col-md-12">
                                        <h4><?php echo $view_model->translations->get('descrizione_evento'); ?></h4>
                                        <hr/>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php
                                            $label = 'descrizione_evento';
                                            $field_prefix = 'descrizione_evento';
                                            $items = $view_model->all_languages_facility_events;
                                            include 'Views/backoffice.multilanguage.textbox.php';
                                        ?>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label><?php echo $view_model->translations->get('data_inizio_evento'); ?></label>
                                        <input type="date" name="data_inizio_evento" class="form-control validate-1"
                                               id="data_inizio"
                                               placeholder="11/08/2021"
                                               value="<?php echo $view_model->event->data_inizio_evento; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?php echo $view_model->translations->get('ora_inizio_evento'); ?></label>
                                        <input type="time" name="ora_inizio_evento" class="form-control validate-1"
                                               id="ora_inizio"
                                               value="<?php echo $view_model->event->ora_inizio_evento; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?php echo $view_model->translations->get('data_fine_evento'); ?></label>
                                        <input type="date" name="data_fine_evento" class="form-control validate-1"
                                               id="data_fine"
                                               placeholder="11/08/2021"
                                               value="<?php echo $view_model->event->data_fine_evento; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?php echo $view_model->translations->get('ora_fine_evento'); ?></label>
                                        <input type="time" class="form-control validate-1" name="ora_fine_evento"
                                               id="ora_fine"
                                               value="<?php echo $view_model->event->ora_fine_evento; ?>">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="mt20 col-md-12">
                                        <h4><?php echo $view_model->translations->get('convenzione'); ?></h4>
                                        <hr/>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="checkbox" <?php if ($view_model->event->recupera_convenzione == 1) echo 'checked="checked"'; ?>
                                               class=""
                                               id="recupera_convenzione"
                                               name="recupera_convenzione"> <?php echo $view_model->translations->get('recupera_convenzione'); ?>
                                    </div>

                                    <div id="rec-conv" class="form-group col-md-12">
                                        <?php
                                            $label = 'descrizione_ospiti';
                                            $field = 'testo_convenzione';
                                            $field_prefix = 'testo_convenzione';
                                            $items = $view_model->all_languages_facility_events;
                                            include 'Views/backoffice.multilanguage.textbox.php';
                                        ?>
                                    </div>
                                </div>

                            </div>

                        <?php } else { ?>
                            <div class="basic-form">
                                <div class="form-row">
                                    <div class="mt20 col-md-12">
                                        <h4><?php echo $view_model->translations->get('convenzione'); ?></h4>
                                        <hr/>
                                    </div>

                                    <div id="rec-conv" class="form-group col-md-12">
                                        <?php
                                        $label = 'descrizione_ospiti';
                                        $field = 'testo_convenzione';
                                        $field_prefix = 'testo_convenzione';
                                        $items = $view_model->all_languages_facility_events;
                                        include 'Views/backoffice.multilanguage.textbox.php';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                <div class="form-group col-md-12">
                    <div align="left">
                        <input type="submit" class="btn btn-success validate-it"
                               value="<?php echo $view_model->translations->get('aggiorna_evento'); ?>">

                    </div>
                    <br/><br/>
                </div>
            </div>
        </form>
    </div>
</div>