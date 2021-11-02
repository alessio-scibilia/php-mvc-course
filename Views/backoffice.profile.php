<?php if ($view_model->user->level == 0) echo '<div class="alert alert-warning"><b>MESSAGGIO VISIBILE SOLO AGLI SVILUPPATORI</b>: questa pagina (profilo hotel) non è modificabile quando loggato con un utente dev, nemmeno cambiando il livello utente dalla funzione speciale per i dev.</div>'; ?>
<input type="hidden" id="hotel_id" value="<?php echo $_SESSION['id_user']; ?>">
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <h1><i class="fa fa-building-o"></i> <?php echo $this_hotel['nome']; ?></h1>
        </div>
        <div class="col-xl-12 col-lg-12">
            <a href="https://wellcox.cluster031.hosting.ovh.net/index.php?strh=<?php echo $this_hotel['id']; ?>&on_test=true"
               class="btn btn-info" target="_blank"><i class="fa fa-eye"></i> Vedi come ospite</a><br/><br/>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i
                                class="fa fa-info-circle"></i> <?php echo $view_model->translations->get('dati_hotelk'); ?>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('nome_hotel'); ?></label>
                                <input type="text" value="<?php echo $this_hotel['nome']; ?>" id="nome"
                                       class="form-control validate-hotel" placeholder="London Hotel">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('email'); ?></label>
                                <input value="<?php echo $this_hotel['email']; ?>" type="text" id="email"
                                       class="form-control validate-hotel" placeholder="mario@rossi.it">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                <input value="<?php echo $this_hotel['sito_web']; ?>" type="text"
                                       class="form-control validate-hotel" id="sito"
                                       placeholder="www.hotelsuperlondon.co.uk">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                <input value="<?php echo $this_hotel['telefono']; ?>" type="text"
                                       class="form-control validate-hotel" id="telefono" placeholder="020483039">
                            </div>
                            <div class="form-group col-md-12">
                                <label><?php echo $view_model->translations->get('indirizzo'); ?></label>
                                <input value="<?php echo $this_hotel['indirizzo']; ?>" type="text"
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
                                <input type="text" value="<?php echo $this_hotel['latitudine']; ?>" id="latitudine"
                                       class="form-control" placeholder="33,40393">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('longitudine'); ?></label>
                                <input type="text" value="<?php echo $this_hotel['longitudine']; ?>" id="longitudine"
                                       class="form-control" placeholder="8.343445">
                            </div>
                            <div class="form-group col-md-12">

                                <label><?php echo $view_model->translations->get('descrizione_ospiti'); ?><span> | <i
                                                class="fa fa-language"></i> Lingua</span></label>
                                <select id="select-language">
                                    <?php
                                    $lingue = getLangsShortcode($dbh);
                                    for ($i = 0; $i < sizeof($lingue); $i++) {
                                        ?>
                                        <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php
                                for ($i = 0; $i < sizeof($lingue); $i++) {

                                    $hotelLang = getDatiHotelLang($dbh, $this_hotel['email'], $lingue[$i]['shortcode_lingua']);

                                    ?>
                                    <div class="descrizione_ospiti"
                                         id="descrizione_ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>>

                                        <div class="summernote summ-<?php echo $i; ?>"
                                             id="descrizione-ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>">
                                            <?php
                                            $hotelLangNew = getHotelLang($dbh, $this_hotel['email'], $lingue[$i]['shortcode_lingua']); ?>
                                            <?php echo $hotelLangNew['descrizione_ospiti']; ?>
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
                                    <input type="file" multiple="multiple" class="custom-file-input" id="immagini_form">
                                    <label class="custom-file-label"><?php echo $view_model->translations->get('scegli_immagini'); ?></label>
                                </div>
                            </div>
                            <div class="input-group col-md-12" id="preview-img-container">
                                <div id="preview">
                                    <?php
                                    $immagini = explode("|", $this_hotel['immagini_secondarie']);


                                    for ($i = 0; $i < sizeof($immagini) - 1; $i++) { ?>
                                        <div class="img-form-preview" id="ifp-prw-<?php echo $i + 1; ?>"><span
                                                    class="delete-preview" id="prw-<?php echo $i + 1; ?>"
                                                    onclick="delPreview(<?php echo $i + 1; ?>)"><i
                                                        class="fa fa-close"></i></span><img
                                                    class="img-form-preview-item img-hotel"
                                                    src="<?php echo $immagini[$i]; ?>" height="200px">
                                            <div class="default-image-cont">
                                                <div class="pt20"><input type="radio"
                                                                         id="default-image" <?php if ($this_hotel['immagine_principale'] == $immagini[$i]) echo 'checked="checked" ';

                                                    ?>
                                                                         name="default-image"
                                                                         class="default-image" <?php if ($this_hotel['immagine_principale'] == $i + 1) echo 'checked="checked" '; ?>
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
                                <input type="hidden" id="num_services"
                                       value="<?php if (isset($params[1])) echo getNumServices($dbh, $params[1]); else echo getNumServices($dbh, $_SESSION['id_user']); ?>">
                                <a href="javascript:void()" class="open-create-service btn btn-primary"><i
                                            class="fa fa-plus"></i> <?php echo $view_model->translations->get('aggiungi_servizio'); ?>
                                </a>
                            </div>
                        </div>
                        <?php
                        for ($r = 1; $r <= getNumServices($dbh, $_SESSION['id_user']); $r++) {
                            $c = $r - 1;
                            ?>

                            <div style="display: block;" class="form-service-container fsc-<?php echo $r; ?>"
                                 id="fsc-servizio-<?php echo $r; ?>">
                                <div class="form-row">
                                    <div class="col-12">
                                        <h5><?php echo $view_model->translations->get('dati_servizio'); ?></h5></div>
                                    <div class="form-group col-md-4">
                                        <label><?php echo $langs['nome_servizio']; ?>:<span> | <i
                                                        class="fa fa-language"></i> Lingua</span></label>
                                        <select id="select-nome-servizi" data-form-index="<?php echo $r; ?>">
                                            <?php
                                            $lingue = getLangsShortcode($dbh);
                                            for ($i = 0; $i < sizeof($lingue); $i++) {
                                                ?>
                                                <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php
                                        $lingue = getLangsShortcode($dbh);
                                        for ($i = 0; $i < sizeof($lingue); $i++) {
                                            $hotelLang = getDatiServizi($dbh, $this_hotel['id'], $lingue[$i]['shortcode_lingua']);
                                            ?>
                                            <input type="text" value="<?php echo $hotelLang[$c]['titolo']; ?>"
                                                   class="form-control nome_hotel validate-hotel nome_servizi nome-servizi-<?php echo $r; ?>"
                                                   id="nome_servizio-<?php echo $lingue[$i]['shortcode_lingua']; ?>-<?php echo $r; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>
                                                   placeholder="Es: Check in">
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label><?php echo $langs['descrizione']; ?><span> | <i
                                                        class="fa fa-language"></i> Lingua</span></label>
                                        <select id="select-language-servizi" data-form-index="<?php echo $r; ?>">
                                            <?php
                                            $lingue = getLangsShortcode($dbh);
                                            for ($i = 0; $i < sizeof($lingue); $i++) {
                                                ?>
                                                <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php
                                        $lingue = getLangsShortcode($dbh);
                                        for ($i = 0; $i < sizeof($lingue); $i++) {
                                            $hotelLang = getDatiServizi($dbh, $this_hotel['id'], $lingue[$i]['shortcode_lingua']);

                                            ?>
                                            <textarea
                                                    id="descrizione-<?php echo $lingue[$i]['shortcode_lingua']; ?>-<?php echo $r; ?>"
                                                    class="form-control descrizione_servizi descrizione_servizi-<?php echo $r; ?> validate-hotel" <?php if ($i > 0) echo 'style="display:none;"'; ?>><?php echo $hotelLang[$c]['descrizione']; ?></textarea>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label><?php echo $langs['immagine_servizio']; ?></label>
                                        <input type="file" class="form-control immagine_servizio validate-hotel"
                                               id="immagine_servizio-<?php echo $r; ?>">
                                        <div class="input-group col-md-12" id="preview-img-container">

                                            <div id="preview-immagine_servizio-<?php echo $r; ?>">
                                                <div class="img-form-preview"
                                                     id="ifps-prws-immagine_servizio-<?php echo $r; ?>"><span
                                                            class="delete-preview"
                                                            id="prws-immagine_servizio-<?php echo $r; ?>"
                                                            onclick="delPreviewServizi('immagine_servizio-<?php echo $r; ?>')"><i
                                                                class="fa fa-close"></i></span><img
                                                            class="img-form-preview-item"
                                                            src="<?php echo $hotelLang[$r - 1]['immagine']; ?>"
                                                            height="200px">
                                                    <div class="default-image-cont"></div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><?php echo $langs['orari']; ?></label>
                                        <br/>
                                        <?php
                                        $orari_lunedi = explode("|", $hotelLang[$r - 1]['lunedi']);
                                        $orari_martedi = explode("|", $hotelLang[$r - 1]['martedi']);
                                        $orari_mercoledi = explode("|", $hotelLang[$r - 1]['mercoledi']);
                                        $orari_giovedi = explode("|", $hotelLang[$r - 1]['giovedi']);
                                        $orari_venerdi = explode("|", $hotelLang[$r - 1]['venerdi']);
                                        $orari_sabato = explode("|", $hotelLang[$r - 1]['sabato']);
                                        $orari_domenica = explode("|", $hotelLang[$r - 1]['domenica']);


                                        ?>
                                        <div class="time-container" style="display: inline-block;">

                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['lunedi']; ?><span> | <input
                                                                type="checkbox"
                                                                class="orario-continuato" <?php if ($orari_lunedi[0] == 1) echo 'checked="checked"'; ?>  value="1"
                                                                id="orario-continuato-1-<?php echo $r; ?>"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      value="<?php echo $orari_lunedi[1]; ?>"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-lun-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     value="<?php echo $orari_lunedi[2]; ?>"
                                                                                                     id="1-lun-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input <?php if ($orari_lunedi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                           value="<?php echo $orari_lunedi[3]; ?>"
                                                                                                                                                           class="validate-hotel"
                                                                                                                                                           id="2-lun-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input <?php if ($orari_lunedi[0] == 1) echo 'disabled'; ?>  value="<?php echo $orari_lunedi[4]; ?>"
                                                                                                                                                           type="time"
                                                                                                                                                           class="validate-hotel"
                                                                                                                                                           id="3-lun-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['martedi']; ?>
                                                    <span> | <input <?php if ($orari_martedi[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                   class="orario-continuato"
                                                                                                                                   value="1"
                                                                                                                                   id="orario-continuato-2-<?php echo $r; ?>"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      value="<?php echo $orari_martedi[1]; ?>"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-mar-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     value="<?php echo $orari_martedi[2]; ?>"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-mar-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input
                                                                        type="time" <?php if ($orari_martedi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_martedi[3]; ?>"
                                                                        class="validate-hotel"
                                                                        id="2-mar-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input
                                                                type="time" <?php if ($orari_martedi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_martedi[4]; ?>"
                                                                class="validate-hotel" id="3-mar-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['mercoledi']; ?>
                                                    <span> | <input <?php if ($orari_mercoledi[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                     class="orario-continuato"
                                                                                                                                     value="1"
                                                                                                                                     id="orario-continuato-3-<?php echo $r; ?>"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      value="<?php echo $orari_mercoledi[1]; ?>"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-mer-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     value="<?php echo $orari_mercoledi[2]; ?>"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-mer-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input
                                                                        type="time" <?php if ($orari_mercoledi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_mercoledi[3]; ?>"
                                                                        class="validate-hotel"
                                                                        id="2-mer-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input
                                                                type="time" <?php if ($orari_mercoledi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_mercoledi[4]; ?>"
                                                                class="validate-hotel" id="3-mer-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['giovedi']; ?>
                                                    <span> | <input <?php if ($orari_giovedi[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                   class="orario-continuato"
                                                                                                                                   value="1"
                                                                                                                                   id="orario-continuato-4-<?php echo $r; ?>"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      value="<?php echo $orari_giovedi[1]; ?>"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-gio-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     value="<?php echo $orari_giovedi[2]; ?>"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-gio-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input <?php if ($orari_giovedi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                            value="<?php echo $orari_giovedi[3]; ?>"
                                                                                                                                                            class="validate-hotel"
                                                                                                                                                            id="2-gio-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input <?php if ($orari_giovedi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_giovedi[4]; ?>"
                                                                                                                                                           type="time"
                                                                                                                                                           class="validate-hotel"
                                                                                                                                                           id="3-gio-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['venerdi']; ?>
                                                    <span> | <input <?php if ($orari_venerdi[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                   class="orario-continuato"
                                                                                                                                   value="1"
                                                                                                                                   id="orario-continuato-5-<?php echo $r; ?>"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      value="<?php echo $orari_venerdi[1]; ?>"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-ven-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     value="<?php echo $orari_venerdi[2]; ?>"
                                                                                                     id="1-ven-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input <?php if ($orari_venerdi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                            class="validate-hotel"
                                                                                                                                                            value="<?php echo $orari_venerdi[3]; ?>"
                                                                                                                                                            id="2-ven-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input <?php if ($orari_venerdi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                           class="validate-hotel"
                                                                                                                                                           value="<?php echo $orari_venerdi[4]; ?>"
                                                                                                                                                           id="3-ven-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['sabato']; ?>
                                                    <span> | <input <?php if ($orari_sabato[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                  class="orario-continuato"
                                                                                                                                  value="1"
                                                                                                                                  id="orario-continuato-6-<?php echo $r; ?>"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      value="<?php echo $orari_sabato[1]; ?>"
                                                                                                      id="0-sab-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     value="<?php echo $orari_sabato[2]; ?>"
                                                                                                     id="1-sab-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input <?php if ($orari_sabato[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                           class="validate-hotel"
                                                                                                                                                           value="<?php echo $orari_sabato[3]; ?>"
                                                                                                                                                           id="2-sab-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input <?php if ($orari_sabato[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                          class="validate-hotel"
                                                                                                                                                          value="<?php echo $orari_sabato[4]; ?>"
                                                                                                                                                          id="3-sab-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['domenica']; ?>
                                                    <span> | <input <?php if ($orari_domenica[0] == 1) echo 'checked="checked"'; ?> type="checkbox"
                                                                                                                                    class="orario-continuato"
                                                                                                                                    value="1"
                                                                                                                                    id="orario-continuato-7-<?php echo $r; ?>"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      value="<?php echo $orari_domenica[1]; ?>"
                                                                                                      id="0-dom-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     value="<?php echo $orari_domenica[2]; ?>"
                                                                                                     id="1-dom-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input <?php if ($orari_domenica[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                             class="validate-hotel"
                                                                                                                                                             value="<?php echo $orari_domenica[3]; ?>"
                                                                                                                                                             id="2-dom-<?php echo $r; ?>">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input <?php if ($orari_domenica[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                            class="validate-hotel"
                                                                                                                                                            value="<?php echo $orari_domenica[4]; ?>"
                                                                                                                                                            id="3-dom-<?php echo $r; ?>">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label><?php echo $langs['abilitato']; ?></label>
                                        <select class="form-control is-abilitato" id="abilitato-<?php echo $r; ?>">
                                            <option value="1"><?php echo $langs['si']; ?></option>
                                            <option value="0"><?php echo $langs['no']; ?></option>
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
                        <?php } ?>
                        <?php if ($r == 1) {
                            ?>
                            <div class="form-service-container fsc-1" id="fsc-servizio-1">
                                <div class="form-row">
                                    <div class="col-12">
                                        <h5><?php echo $langs['dati_servizio']; ?></h5></div>
                                    <div class="form-group col-md-4">
                                        <label><?php echo $langs['nome_servizio']; ?>:<span> | <i
                                                        class="fa fa-language"></i> Lingua</span></label>
                                        <select id="select-nome-servizi" data-form-index="1">
                                            <?php
                                            $lingue = getLangsShortcode($dbh);
                                            for ($i = 0; $i < sizeof($lingue); $i++) {
                                                ?>
                                                <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php
                                        $lingue = getLangsShortcode($dbh);
                                        for ($i = 0; $i < sizeof($lingue); $i++) {
                                            ?>
                                            <input type="text"
                                                   class="form-control nome_hotel validate-hotel nome_servizi"
                                                   id="nome_servizio-<?php echo $lingue[$i]['shortcode_lingua']; ?>-1" <?php if ($i > 0) echo 'style="display:none;"'; ?>
                                                   placeholder="Es: Check in">
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label><?php echo $langs['descrizione']; ?><span> | <i
                                                        class="fa fa-language"></i> Lingua</span></label>
                                        <select id="select-language-servizi" data-form-index="1">
                                            <?php
                                            $lingue = getLangsShortcode($dbh);
                                            for ($i = 0; $i < sizeof($lingue); $i++) {
                                                ?>
                                                <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php
                                        for ($i = 0; $i < sizeof($lingue); $i++) {
                                            ?>
                                            <textarea id="descrizione-<?php echo $lingue[$i]['shortcode_lingua']; ?>-1"
                                                      class="form-control descrizione_servizi validate-hotel" <?php if ($i > 0) echo 'style="display:none;"'; ?>></textarea>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label><?php echo $langs['immagine_servizio']; ?></label>
                                        <input type="file" class="form-control immagine_servizio validate-hotel"
                                               id="immagine_servizio-1">
                                        <div class="input-group col-md-12" id="preview-img-container">
                                            <div id="preview-immagine_servizio-1"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label><?php echo $langs['orari']; ?></label>
                                        <br/>
                                        <div class="time-container" style="display: inline-block;">

                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['lunedi']; ?><span> | <input
                                                                type="checkbox" class="orario-continuato" value="1"
                                                                id="orario-continuato-1-1"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-lun-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-lun-1">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="2-lun-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="3-lun-1">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['martedi']; ?><span> | <input
                                                                type="checkbox" class="orario-continuato" value="1"
                                                                id="orario-continuato-2-1"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-mar-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-mar-1">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="2-mar-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="3-mar-1">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['mercoledi']; ?>
                                                    <span> | <input type="checkbox" class="orario-continuato" value="1"
                                                                    id="orario-continuato-3-1"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-mer-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-mer-1">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="2-mer-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="3-mer-1">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['giovedi']; ?><span> | <input
                                                                type="checkbox" class="orario-continuato" value="1"
                                                                id="orario-continuato-4-1"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-gio-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-gio-1">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="2-gio-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="3-gio-1">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['venerdi']; ?><span> | <input
                                                                type="checkbox" class="orario-continuato" value="1"
                                                                id="orario-continuato-5-1"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-ven-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-ven-1">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="2-ven-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="3-ven-1">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['sabato']; ?><span> | <input
                                                                type="checkbox" class="orario-continuato" value="1"
                                                                id="orario-continuato-6-1"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-sab-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-sab-1">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="2-sab-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="3-sab-1">
                                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-container" style="display: inline-block;">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="time-title"><?php echo $langs['domenica']; ?><span> | <input
                                                                type="checkbox" class="orario-continuato" value="1"
                                                                id="orario-continuato-7-1"> Orario continuato </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-dom-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-dom-1">
                                                            </span>
                                                </div>
                                                <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      id="2-dom-1">
                                                            </span>
                                                    <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
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
                                        <label><?php echo $langs['abilitato']; ?></label>
                                        <select class="form-control is-abilitato" id="abilitato-1">
                                            <option value="1"><?php echo $langs['si']; ?></option>
                                            <option value="0"><?php echo $langs['no']; ?></option>
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
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="form-group col-md-12">
                <div align="left">
                    <input type="button" class="btn btn-success"
                           data-success="<?php echo $langs['modifiche_salvate']; ?>"
                           data-failure="<?php echo $langs['errore_salvataggio']; ?>" id="updateHotel"
                           value="<?php echo $langs['salva']; ?>">
                </div>
                <hr/>
                <br/><br/>
            </div>
        </div>
    </div>
</div>