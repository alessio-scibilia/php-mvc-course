<?php if ($view_model->user->level == 0) echo '<div class="alert alert-warning"><b>MESSAGGIO VISIBILE SOLO AGLI SVILUPPATORI</b>: questa pagina (profilo hotel) non è modificabile quando loggato con un utente dev, nemmeno cambiando il livello utente dalla funzione speciale per i dev.</div>'; ?>
<input type="hidden" id="hotel_id" value="<?php echo $view_model->user->id; ?>">
<div class="container-fluid">
    <div class="row">
        <?php
        if ($view_model->profile != false) {
            foreach ($view_model->profile as $hotel) {
                ?>
                <div class="col-12 d-flex align-items-center justify-content-start mb15">
                    <h1><i class="fa fa-building-o"></i> <?php echo $hotel->nome; ?></h1>
                </div>
                <div class="col-xl-12 col-lg-12">
                    <a href="https://wellcox.cluster031.hosting.ovh.net/index.php?strh=<?php echo $hotel->id; ?>&on_test=true"
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
                                               value="<?php if ($hotel != false) echo $hotel->nome; ?>"
                                               id="nome"
                                               class="form-control validate-hotel" placeholder="London Hotel">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?php echo $view_model->translations->get('email'); ?></label>
                                        <input value="<?php if ($hotel != false) echo $hotel->email;; ?>"
                                               type="text" id="email"
                                               class="form-control validate-hotel" placeholder="mario@rossi.it">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                        <input value="<?php if ($hotel != false) echo $hotel->sito_web; ?>"
                                               type="text"
                                               class="form-control validate-hotel" id="sito"
                                               placeholder="www.hotelsuperlondon.co.uk">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                        <input value="<?php if ($hotel != false) echo $hotel->telefono; ?>"
                                               type="text"
                                               class="form-control validate-hotel" id="telefono"
                                               placeholder="020483039">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><?php echo $view_model->translations->get('indirizzo'); ?></label>
                                        <input value="<?php if ($hotel != false) echo $hotel->indirizzo; ?>"
                                               type="text"
                                               class="form-control validate-hotel" id="indirizzo"
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
                                               value="<?php if ($hotel != false) echo $hotel->latitudine; ?>"
                                               id="latitudine"
                                               class="form-control" placeholder="33,40393">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?php echo $view_model->translations->get('longitudine'); ?></label>
                                        <input type="text"
                                               value="<?php if ($hotel != false) echo $hotel->longitudine; ?>"
                                               id="longitudine"
                                               class="form-control" placeholder="8.343445">
                                    </div>
                                    <div class="form-group col-md-12">

                                        <label><?php echo $view_model->translations->get('descrizione_ospiti'); ?>
                                            <span> | <i
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

                                            //$hotelLang = getDatiHotelLang($dbh, $this_hotel['email'], $lingue[$i]['shortcode_lingua']);

                                            ?>
                                            <div class="descrizione_ospiti"
                                                 id="descrizione_ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>>

                                                <div class="summernote summ-<?php echo $i; ?>"
                                                     id="descrizione-ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>">
                                                    <?php
                                                    // $hotelLangNew = getHotelLang($dbh, $this_hotel['email'], $lingue[$i]['shortcode_lingua']); ?>
                                                    <?php //echo $hotelLangNew['descrizione_ospiti']; ?>
                                                    <div></div>
                                                </div>
                                            </div>
                                        <?php } ?>


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
                                            $immagini = array();
                                            if ($view_model->user->level > 2)
                                                $immagini = explode("|", $hotel->immagini_secondarie);


                                            for ($i = 0; $i < sizeof($immagini) - 1; $i++) { ?>
                                                <div class="img-form-preview" id="ifp-prw-<?php echo $i + 1; ?>"><span
                                                            class="delete-preview" id="prw-<?php echo $i + 1; ?>"
                                                            onclick="delPreview(<?php echo $i + 1; ?>)"><i
                                                                class="fa fa-close"></i></span><img
                                                            class="img-form-preview-item img-hotel"
                                                            src="<?php echo $immagini[$i]; ?>" height="200px">
                                                    <div class="default-image-cont">
                                                        <div class="pt20"><input type="radio"
                                                                                 id="default-image" <?php if ($hotel->immagine_principale == $immagini[$i]) echo 'checked="checked" ';

                                                            ?>
                                                                                 name="default-image"
                                                                                 class="default-image" <?php if ($hotel->immagine_principale == $i + 1) echo 'checked="checked" '; ?>
                                                                                 value="<?php echo $i + 1; ?>"><label>Immagine
                                                                principale</label><br></div>
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
            <?php }
        } ?>

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i
                                class="fa fa-wrench"></i> <?php echo $view_model->translations->get('servizi'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <input type="hidden" id="num_services" value="<?php echo sizeof($view_model->services[0]); ?>">
                        <?php
                        $r = 1;
                        $c = 0;
                        if ($view_model->services != false) {
                            $hotelLang = $view_model->services[0][0];

                            for ($r = 1;
                                 $r <= sizeof($view_model->services[0]);
                                 $r++) {
                                $c = $r - 1;
                                ?>
                                <div style="display: block;" class="form-service-container fsc-<?php echo $r; ?>"
                                     id="fsc-servizio-<?php echo $r; ?>">
                                    <div class="form-row">
                                        <div class="col-12">
                                            <h5><?php echo $view_model->translations->get('dati_servizio'); ?></h5>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label><?php echo $view_model->translations->get('nome_servizio'); ?>
                                                :<span> | <i
                                                            class="fa fa-language"></i> Lingua</span></label>
                                            <select id="select-nome-servizi-<?php echo $r; ?>">
                                                <?php
                                                $lingue = $view_model->languages->list_all();
                                                for ($i = 0; $i < sizeof($lingue); $i++) {
                                                    ?>
                                                    <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                            for ($i = 0;
                                                 $i < sizeof($lingue);
                                                 $i++) {
                                                //$hotelLang = getDatiServizi($dbh, $this_hotel['id'], $lingue[$i]['shortcode_lingua']);
                                                $k = 0;
                                                foreach ($view_model->services[$i] as $servizio) {
                                                    if ($k == $c) {
                                                        ?>
                                                        <input type="text"
                                                               value="<?php echo $servizio->titolo; ?>"
                                                               class="form-control nome_hotel validate-hotel nome_servizi nome-servizi-<?php echo $r; ?>"
                                                               id="nome_servizio-<?php echo $lingue[$i]['shortcode_lingua']; ?>-<?php echo $r; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>
                                                               placeholder="Es: Check in">
                                                        <?php
                                                    }
                                                    $k++;
                                                }
                                            } ?>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label><?php echo $view_model->translations->get('descrizione'); ?><span> | <i
                                                            class="fa fa-language"></i> Lingua</span></label>
                                            <select id="select-language-servizi" data-form-index="<?php echo $r; ?>">
                                                <?php
                                                for ($i = 0; $i < sizeof($lingue); $i++) {
                                                    ?>
                                                    <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                            for ($i = 0;
                                                 $i < sizeof($lingue);
                                                 $i++) {
                                                //$hotelLang = getDatiServizi($dbh, $this_hotel['id'], $lingue[$i]['shortcode_lingua']);
                                                $k = 0;
                                                foreach ($view_model->services[$i] as $servizio) {
                                                    if ($k == $c) {
                                                        ?>
                                                        <textarea
                                                                id="descrizione-<?php echo $lingue[$i]['shortcode_lingua']; ?>-<?php echo $r; ?>"
                                                                class="form-control descrizione_servizi descrizione_servizi-<?php echo $r; ?> validate-hotel" <?php if ($i > 0) echo 'style="display:none;"'; ?>><?php echo $servizio->descrizione; ?></textarea>
                                                        <?php
                                                    }
                                                    $k++;
                                                }
                                            } ?>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label><?php echo $view_model->translations->get('immagine_servizio'); ?></label>
                                            <input type="file" class="form-control immagine_servizio validate-hotel"
                                                   id="immagine_servizio-<?php echo $r; ?>">
                                            <div class="input-group col-md-12" id="preview-img-container">

                                                <div id="preview-immagine_servizio-<?php echo $r; ?>">
                                                    <div class="img-form-preview"
                                                         id="ifps-prws-immagine_servizio-<?php echo $r; ?>"><span
                                                                class="delete-preview"
                                                                id="prws-immagine_servizio-<?php echo $r; ?>"
                                                                onclick="delPreviewServizi()"><i
                                                                    class="fa fa-close"></i></span><img
                                                                class="img-form-preview-item"
                                                                src="<?php echo $hotelLang->immagine; ?>"
                                                                height="200px">
                                                        <div class="default-image-cont"></div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <?php
                                        if ($view_model->user->level > 2) { ?>
                                            <div class="form-group col-md-12">
                                                <label><?php echo $view_model->translations->get('orari'); ?></label>
                                                <br/>
                                                <?php

                                                $orari_lunedi = explode("|", $hotelLang->lunedi);
                                                $orari_martedi = explode("|", $hotelLang->martedi);
                                                $orari_mercoledi = explode("|", $hotelLang->mercoledi);
                                                $orari_giovedi = explode("|", $hotelLang->giovedi);
                                                $orari_venerdi = explode("|", $hotelLang->venerdi);
                                                $orari_sabato = explode("|", $hotelLang->sabato);
                                                $orari_domenica = explode("|", $hotelLang->domenica);

                                                ?>

                                                <div class="time-container" style="display: inline-block;">

                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $view_model->translations->get('lunedi'); ?>
                                                            <span> | <input
                                                                        type="checkbox"
                                                                        class="orario-continuato" <?php if ($orari_lunedi[0] == 1) echo 'checked="checked"'; ?>  value="1"
                                                                        id="orario-continuato-1-<?php echo $r; ?>"> Orario continuato </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        value="<?php echo $orari_lunedi[1]; ?>"
                                                                        class="validate-hotel"
                                                                        id="0-lun-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        value="<?php echo $orari_lunedi[2]; ?>"
                                                                        id="1-lun-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input <?php if ($orari_lunedi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                                                   value="<?php echo $orari_lunedi[3]; ?>"
                                                                                                                                                                                   class="validate-hotel"
                                                                                                                                                                                   id="2-lun-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input <?php if ($orari_lunedi[0] == 1) echo 'disabled'; ?>  value="<?php echo $orari_lunedi[4]; ?>"
                                                                                                                                                                                   type="time"
                                                                                                                                                                                   class="validate-hotel"
                                                                                                                                                                                   id="3-lun-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $view_model->translations->get('martedi'); ?>
                                                            <span> | <input <?php if ($orari_martedi[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                           class="orario-continuato"
                                                                                                                                           value="1"
                                                                                                                                           id="orario-continuato-2-<?php echo $r; ?>"> Orario continuato </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        value="<?php echo $orari_martedi[1]; ?>"
                                                                        class="validate-hotel"
                                                                        id="0-mar-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                                        type="time"
                                                                        value="<?php echo $orari_martedi[2]; ?>"
                                                                        class="validate-hotel"
                                                                        id="1-mar-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time" <?php if ($orari_martedi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_martedi[3]; ?>"
                                                                        class="validate-hotel"
                                                                        id="2-mar-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                                        type="time" <?php if ($orari_martedi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_martedi[4]; ?>"
                                                                        class="validate-hotel"
                                                                        id="3-mar-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $view_model->translations->get('mercoledi'); ?>
                                                            <span> | <input <?php if ($orari_mercoledi[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                             class="orario-continuato"
                                                                                                                                             value="1"
                                                                                                                                             id="orario-continuato-3-<?php echo $r; ?>"> Orario continuato </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        value="<?php echo $orari_mercoledi[1]; ?>"
                                                                        class="validate-hotel"
                                                                        id="0-mer-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                                        type="time"
                                                                        value="<?php echo $orari_mercoledi[2]; ?>"
                                                                        class="validate-hotel"
                                                                        id="1-mer-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time" <?php if ($orari_mercoledi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_mercoledi[3]; ?>"
                                                                        class="validate-hotel"
                                                                        id="2-mer-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                                        type="time" <?php if ($orari_mercoledi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_mercoledi[4]; ?>"
                                                                        class="validate-hotel"
                                                                        id="3-mer-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $view_model->translations->get('giovedi'); ?>
                                                            <span> | <input <?php if ($orari_giovedi[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                           class="orario-continuato"
                                                                                                                                           value="1"
                                                                                                                                           id="orario-continuato-4-<?php echo $r; ?>"> Orario continuato </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        value="<?php echo $orari_giovedi[1]; ?>"
                                                                        class="validate-hotel"
                                                                        id="0-gio-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                                        type="time"
                                                                        value="<?php echo $orari_giovedi[2]; ?>"
                                                                        class="validate-hotel"
                                                                        id="1-gio-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input <?php if ($orari_giovedi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                                                    value="<?php echo $orari_giovedi[3]; ?>"
                                                                                                                                                                                    class="validate-hotel"
                                                                                                                                                                                    id="2-gio-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input <?php if ($orari_giovedi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_giovedi[4]; ?>"
                                                                                                                                                                                   type="time"
                                                                                                                                                                                   class="validate-hotel"
                                                                                                                                                                                   id="3-gio-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $view_model->translations->get('venerdi'); ?>
                                                            <span> | <input <?php if ($orari_venerdi[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                           class="orario-continuato"
                                                                                                                                           value="1"
                                                                                                                                           id="orario-continuato-5-<?php echo $r; ?>"> Orario continuato </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        value="<?php echo $orari_venerdi[1]; ?>"
                                                                        class="validate-hotel"
                                                                        id="0-ven-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        value="<?php echo $orari_venerdi[2]; ?>"
                                                                        id="1-ven-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input <?php if ($orari_venerdi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                                                    class="validate-hotel"
                                                                                                                                                                                    value="<?php echo $orari_venerdi[3]; ?>"
                                                                                                                                                                                    id="2-ven-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input <?php if ($orari_venerdi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                                                   class="validate-hotel"
                                                                                                                                                                                   value="<?php echo $orari_venerdi[4]; ?>"
                                                                                                                                                                                   id="3-ven-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $view_model->translations->get('sabato'); ?>
                                                            <span> | <input <?php if ($orari_sabato[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                          class="orario-continuato"
                                                                                                                                          value="1"
                                                                                                                                          id="orario-continuato-6-<?php echo $r; ?>"> Orario continuato </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        value="<?php echo $orari_sabato[1]; ?>"
                                                                        id="0-sab-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        value="<?php echo $orari_sabato[2]; ?>"
                                                                        id="1-sab-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input <?php if ($orari_sabato[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                                                   class="validate-hotel"
                                                                                                                                                                                   value="<?php echo $orari_sabato[3]; ?>"
                                                                                                                                                                                   id="2-sab-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input <?php if ($orari_sabato[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                                                  class="validate-hotel"
                                                                                                                                                                                  value="<?php echo $orari_sabato[4]; ?>"
                                                                                                                                                                                  id="3-sab-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $view_model->translations->get('domenica'); ?>
                                                            <span> | <input <?php if ($orari_domenica[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                            class="orario-continuato"
                                                                                                                                            value="1"
                                                                                                                                            id="orario-continuato-7-<?php echo $r; ?>"> Orario continuato </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        value="<?php echo $orari_domenica[1]; ?>"
                                                                        id="0-dom-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input
                                                                        type="time"
                                                                        class="validate-hotel"
                                                                        value="<?php echo $orari_domenica[2]; ?>"
                                                                        id="1-dom-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('dalle'); ?> <input <?php if ($orari_domenica[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                                                     class="validate-hotel"
                                                                                                                                                                                     value="<?php echo $orari_domenica[3]; ?>"
                                                                                                                                                                                     id="2-dom-<?php echo $r; ?>">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $view_model->translations->get('alle'); ?> <input <?php if ($orari_domenica[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                                                    class="validate-hotel"
                                                                                                                                                                                    value="<?php echo $orari_domenica[4]; ?>"
                                                                                                                                                                                    id="3-dom-<?php echo $r; ?>">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label><?php echo $view_model->translations->get('abilitato'); ?></label>
                                            <select class="form-control is-abilitato" id="abilitato-<?php echo $r; ?>">
                                                <option value="1"><?php echo $view_model->translations->get('si'); ?></option>
                                                <option value="0"><?php echo $view_model->translations->get('no'); ?></option>
                                            </select>
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
                            <?php }
                        } ?>

                        <?php if ($r == 1) {
                            ?>
                            <div class="form-service-container fsc-1" id="fsc-servizio-1">
                                <div class="form-row">
                                    <div class="col-12">
                                        <h5><?php echo $view_model->translations->get('dati_servizio'); ?></h5></div>
                                    <div class="form-group col-md-4">
                                        <label><?php echo $view_model->translations->get('nome_servizio'); ?>
                                            :<span> | <i
                                                        class="fa fa-language"></i> Lingua</span></label>
                                        <select id="select-nome-servizi" data-form-index="1">
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
                                            <input type="text"
                                                   class="form-control nome_hotel validate-hotel nome_servizi"
                                                   id="nome_servizio-<?php echo $lingue[$i]['shortcode_lingua']; ?>-1" <?php if ($i > 0) echo 'style="display:none;"'; ?>
                                                   placeholder="Es: Check in">
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label><?php echo $view_model->translations->get('descrizione'); ?><span> | <i
                                                        class="fa fa-language"></i> Lingua</span></label>
                                        <select id="select-language-servizi" data-form-index="1">
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
                                            <textarea id="descrizione-<?php echo $lingue[$i]['shortcode_lingua']; ?>-1"
                                                      class="form-control descrizione_servizi validate-hotel" <?php if ($i > 0) echo 'style="display:none;"'; ?>></textarea>
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
                                                                id="orario-continuato-1-1"> Orario continuato </span>
                                                </div>
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
                                                                id="orario-continuato-2-1"> Orario continuato </span>
                                                </div>
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
                                                    <span> | <input type="checkbox" class="orario-continuato" value="1"
                                                                    id="orario-continuato-3-1"> Orario continuato </span>
                                                </div>
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
                                                                id="orario-continuato-4-1"> Orario continuato </span>
                                                </div>
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
                                                                id="orario-continuato-5-1"> Orario continuato </span>
                                                </div>
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
                                                                id="orario-continuato-6-1"> Orario continuato </span>
                                                </div>
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
                                                                id="orario-continuato-7-1"> Orario continuato </span>
                                                </div>
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
                                        <select class="form-control is-abilitato" id="abilitato-1">
                                            <option value="1"><?php echo $view_model->translations->get('si'); ?></option>
                                            <option value="0"><?php echo $view_model->translations->get('no'); ?></option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <input type="button" class="btn btn-danger annulla-servizio" id="servizio-1"
                                               data-num="#num_services"
                                               value="Elimina servizio">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <hr/>
                                        <input type="button" class="btn btn-success save-servizio"
                                               data-num="#num_services"
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
                    <input type="button" class="btn btn-success"
                           value="<?php echo $view_model->translations->get('salva'); ?>">
                </div>
                <hr/>
                <br/><br/>
            </div>
        </div>
    </div>
</div>