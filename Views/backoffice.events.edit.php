<div class="container-fluid">
    <div class="row">
        <?php
        foreach ($view_model->event as $event) { ?>
            <form action="/backoffice/events/<?php echo $event->id; ?>" method="POST"
                  enctype="multipart/form-data">
                <div class="col-12 d-flex align-items-center justify-content-start mb15">
                    <a href="/backoffice/events" id="gobacksearch" class="open-view-action-inside back-btn"><i
                                class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('indietro'); ?>
                        /</a>
                    <h1><i class="fa fa-calendar"></i> <?php echo $view_model->translations->get('modifica_evento'); ?>
                    </h1>
                </div>
                <div class="col-xl-12 col-lg-12">
                    <div class="card">


                        <div class="card-body">
                            <?php if ($event->created_by == $view_model->user->id || $view_model->user->level <= 2) {
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
                                            <select class="selectpicker3" data-live-search="true"
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
                                            <?php
                                            //TODO
                                            /*
                                            $query = "SELECT * FROM strutture_eventi WHERE id_evento = ? AND shortcode_lingua = ?";
                                            $stmt = $dbh->prepare($query);
                                            $stmt->bindParam(1, $eventInfo['id'], PDO::PARAM_INT);
                                            $stmt->bindParam(2, $_SESSION['lang'], PDO::PARAM_INT);
                                            $stmt->execute();
                                            if ($stmt->rowCount() > 0) {
                                                while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $struttura_collegata = explode("-", $dati['id_struttura']);
                                                    $struttura_info = getStrutturaInfo($dbh, $struttura_collegata[0], $struttura_collegata[1]);
                                                    echo '<a href="javascript:void()" class="tagit2 relCat relatedCat-' . $struttura_collegata[0] . '-' . $struttura_collegata[1] . '" id="' . $struttura_collegata[0] . '-' . $struttura_collegata[1] . '" onclick="removeRelatedCat(\'' . $struttura_collegata[0] . '-' . $struttura_collegata[1] . '\')">' . $struttura_info['nome'] . '<i class="fa fa-close"></i></a>';
                                                }
                                            } */
                                            ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="checkbox" name="recupera_struttura" id="recupera"
                                                   value="1" <?php if ($event->recupera_struttura == 1) echo 'checked="checked"'; ?>> <?php echo $view_model->translations->get('recupera_da_struttura'); ?>
                                        </div>
                                        <div class="row"
                                             id="dati_struttura_evento" <?php if ($event->recupera_struttura == 1) echo 'style="display:none;"'; ?>>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $view_model->translations->get('nome_struttura'); ?></label>
                                                <input type="text" id="nome_struttura" name="nome_struttura"
                                                       class="form-control validate-1"
                                                       placeholder="London Pub"
                                                       value="<?php echo $event->nome_struttura; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $view_model->translations->get('email'); ?></label>
                                                <input type="text" id="email" name="email"
                                                       class="form-control validate-1"
                                                       placeholder="mario@rossi.it"
                                                       value="<?php echo $event->email; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                                <input type="text" name="sito" class="form-control validate-1" id="sito"
                                                       placeholder="www.hotelsuperlondon.co.uk"
                                                       value="<?php echo $event->sito_web; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                                <input type="text" name="telefono" class="form-control validate-1"
                                                       id="telefono"
                                                       placeholder="+393386854971"
                                                       value="<?php echo $event->telefono; ?>">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><?php echo $view_model->translations->get('indirizzo'); ?></label>
                                                <input type="text" name="indirizzo" class="form-control validate-1"
                                                       id="indirizzo"
                                                       placeholder="Via 20 Settembre, Milano (MI)"
                                                       value="<?php echo $event->indirizzo; ?>">
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
                                                <input type="text" name="latitudine" id="latitudine"
                                                       class="form-control"
                                                       placeholder="44.998939"
                                                       value="<?php echo $event->latitudine; ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $view_model->translations->get('longitudine'); ?></label>
                                                <input type="text" name="longitudine" class="form-control"
                                                       id="longitudine"
                                                       placeholder="8.49304"
                                                       value="<?php echo $event->longitudine; ?>">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <h4><?php echo $view_model->translations->get('dati_evento'); ?></h4>
                                            <hr/>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="input-group col-md-12">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><?php echo $view_model->translations->get('immagine_evento'); ?></span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="immagini_evento">
                                                <label class="custom-file-label"><?php echo $view_model->translations->get('scegli_immagini'); ?></label>
                                            </div>
                                        </div>
                                        <div class="input-group col-md-12" id="preview-img-container">
                                            <div id="preview">
                                                <div class="img-form-preview" id="ifp-prw-1">
                                                            <span class="delete-preview" id="prw-1"
                                                                  onclick="delPreview(1)">
                                                                <i class="fa fa-close"></i>
                                                            </span>
                                                    <img class="img-form-preview-item img-hotel"
                                                         src="<?php echo $event->img_evento; ?>"
                                                         height="200px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label><?php echo $view_model->translations->get('nome_evento'); ?></label>
                                            <input type="text" name="nome_evento" id="nome_evento"
                                                   class="form-control validate-1"
                                                   placeholder="London Festival"
                                                   value="<?php echo $event->nome_evento; ?>">
                                        </div>


                                        <div class="mt20 col-md-12">
                                            <h4><?php echo $view_model->translations->get('descrizione_evento'); ?></h4>
                                            <hr/>
                                        </div>

                                        <div class="form-group col-md-12">

                                            <label><?php echo $view_model->translations->get('descrizione_evento'); ?>
                                                <span> | <i
                                                            class="fa fa-language"></i> Lingua</span></label>
                                            <select id="select-language-desc-evento">
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
                                                <div name="descrizione_evento[]" class="descrizione_evento"
                                                     id="descrizione_evento-<?php echo $lingue[$i]['shortcode_lingua']; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>>
                                                    <div class="summernote summ-<?php echo $i; ?>"
                                                         id="descrizione-evento-<?php echo $lingue[$i]['shortcode_lingua']; ?>">

                                                        TODO DESCRIZIONE EVENTO
                                                    </div>
                                                </div>
                                                <?php
                                            } ?>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label><?php echo $view_model->translations->get('data_inizio_evento'); ?></label>
                                            <input type="date" name="data_inizio_evento" class="form-control validate-1"
                                                   id="data_inizio"
                                                   placeholder="11/08/2021"
                                                   value="<?php echo $event->data_inizio_evento; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $view_model->translations->get('ora_inizio_evento'); ?></label>
                                            <input type="time" name="ora_inizio_evento" class="form-control validate-1"
                                                   id="ora_inizio"
                                                   value="<?php echo $event->ora_inizio_evento; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $view_model->translations->get('data_fine_evento'); ?></label>
                                            <input type="date" name="data_fine_evento" class="form-control validate-1"
                                                   id="data_fine"
                                                   placeholder="11/08/2021"
                                                   value="<?php echo $event->data_fine_evento; ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $view_model->translations->get('ora_fine_evento'); ?></label>
                                            <input type="time" class="form-control validate-1" name="data_fine_evento"
                                                   id="ora_fine"
                                                   value="<?php echo $event->ora_fine_evento; ?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="mt20 col-md-12">
                                            <h4><?php echo $view_model->translations->get('convenzione'); ?></h4>
                                            <hr/>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="checkbox" <?php if ($event->recupera_convenzione == 1) echo 'checked="checked"'; ?>
                                                   class=""
                                                   id="recupera_convenzione"
                                                   name="recupera_convenzione"> <?php echo $view_model->translations->get('recupera_convenzione'); ?>
                                        </div>

                                        <div id="rec-conv" class="form-group col-md-12">

                                            <label><?php echo $view_model->translations->get('descrizione_ospiti'); ?>
                                                <span> | <i
                                                            class="fa fa-language"></i> Lingua</span></label>
                                            <select id="select-language">
                                                <?php
                                                for ($i = 0; $i < sizeof($lingue); $i++) {
                                                    ?>
                                                    <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                            for ($i = 0; $i < sizeof($lingue); $i++) {
                                                ?>
                                                <div name="descrizione_ospiti[]" class="descrizione_ospiti"
                                                     id="descrizione_ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>>

                                                    <div class="summernote summ-<?php echo $i; ?>"
                                                         id="descrizione-ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>">
                                                        <div></div>
                                                    </div>
                                                </div>
                                            <?php } ?>
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

                                            <label><?php echo $view_model->translations->get('descrizione_ospiti'); ?>
                                                <span> | <i
                                                            class="fa fa-language"></i> Lingua</span></label>
                                            <select id="select-language">
                                                <?php
                                                for ($i = 0; $i < sizeof($lingue); $i++) {
                                                    ?>
                                                    <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                            for ($i = 0; $i < sizeof($lingue); $i++) {
                                                ?>
                                                <div name="descrizione_ospiti[]" class="descrizione_ospiti"
                                                     id="descrizione_ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>>

                                                    <div class="summernote summ-<?php echo $i; ?>"
                                                         id="descrizione-ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>">
                                                        <div></div>
                                                    </div>
                                                </div>
                                            <?php } ?>
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
                            <?php
                            //TODO gli utenti hotel che hanno solo la convenzione con l'evento ma non lo hanno creato devono poter salvare solo la convenzione
                            //$eventInfo = getEventInfo($dbh, $params[1], $lingue[$i]['shortcode_lingua']); ?>
                            <input type="submit" class="btn btn-success validate-it"
                                   value="<?php echo $view_model->translations->get('aggiorna_evento'); ?>">

                        </div>
                        <br/><br/>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>