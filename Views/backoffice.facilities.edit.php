<form action="/backoffice/facilities/<?php  echo $view_model->principal->related_id; ?>/edit" method="post" enctype="multipart/form-data">
<input ass="container-fluid">
    <div class="row">

        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="/backoffice/facilities" id="gobacksearch" class="open-view-action-inside back-btn"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('gestione_strutture'); ?> /</a>
            <h1><i class="fa fa-building"></i> <?php echo $view_model->translations->get('modifica_struttura'); ?></h1>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo echo $view_model->translations->get('dati_struttura'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-row">
                            <?php if ($view_model->user->level <= 2) { ?>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('hotel_associati'); ?></label>
                                    <select class="selectpicker" data-live-search="true" id="hotel_associati" data-name="related_hotels">
                                        <option disabled selected>Seleziona...</option>
                                        <?php
                                        $hotel_associati = array();
                                        if ($hotel_associati != 'error') {
                                            for ($g = 0; $g < sizeof($hotel_associati); $g++) {
                                                echo '<option value="' . $hotel_associati[$g]['id'] . '" data-tokens="' . $hotel_associati[$g]['nome'] . ' ' . $hotel_associati[$g]['email'] . ' ' . $hotel_associati[$g]['indirizzo'] . '">' . $hotel_associati[$g]['nome'] . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <div id="relatedHotels" class="form-group col-md-6">
                                    <?php
                                    $hotel_associati_struttura = array();
                                    if ($hotel_associati_struttura != 'error') {
                                        for ($i = 0; $i < sizeof($hotel_associati_struttura); $i++) {
                                            $query_bis = "SELECT * FROM hotel WHERE id = ?";
                                            $stmt_bis = $dbh->prepare($query_bis);
                                            $stmt_bis->bindParam(1, $hotel_associati_struttura[$i]['id'], PDO::PARAM_INT);
                                            $stmt_bis->execute();
                                            if ($stmt_bis->rowCount() > 0) {
                                                $dati = $stmt_bis->fetch(PDO::FETCH_ASSOC);

                                            } ?>
                                            <a href="javascript:void()"
                                               class="tagit2 relHot isRelatedToShow-<?php echo $hotel_associati_struttura[$i]['id']; ?>"
                                               onclick="removeRelatedHotel(<?php echo $hotel_associati_struttura[$i]['id']; ?>)"
                                               id="<?php echo $hotel_associati_struttura[$i]['id']; ?>"><?php echo $dati['nome']; ?>
                                                <i class="fa fa-close"></i></a>
                                        <?php }
                                    } ?>
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('categorie_associate'); ?></label>
                                    <select class="selectpicker1" data-live-search="true" id="hotel_associati" data-name="related_categories">
                                        <option disabled selected>Seleziona...</option>
                                        <?php
                                        $categorie = getCategorie($dbh, $_SESSION['lang']);
                                        if ($categorie != 'error') {
                                            for ($g = 0; $g < sizeof($categorie); $g++) {
                                                echo '<option value="' . $categorie[$g]['id'] . '" data-tokens="' . $categorie[$g]['nome'] . '">' . $categorie[$g]['nome'] . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <div id="relatedCat" class="form-group col-md-6">
                                    <?php
                                    if ($cat_struttura != 'error') {
                                        for ($i = 0; $i < sizeof($cat_struttura); $i++) {
                                            $current_id = $cat_struttura[$i]['id_categoria'];
                                            $id_current_lang = $current_id + $_SESSION['lang'] - 1;
                                            $query_bis = "SELECT * FROM categorie_strutture WHERE id = ?";
                                            $stmt_bis = $dbh->prepare($query_bis);
                                            $stmt_bis->bindParam(1, $id_current_lang, PDO::PARAM_INT);
                                            $stmt_bis->execute();
                                            if ($stmt_bis->rowCount() > 0) {
                                                $dati = $stmt_bis->fetch(PDO::FETCH_ASSOC);

                                            } ?>
                                            <a href="javascript:void()"
                                               class="tagit2 relCat relatedCat-<?php echo $cat_struttura[$i]['id_categoria']; ?>"
                                               onclick="removeRelatedCat(<?php echo $cat_struttura[$i]['id_categoria']; ?>)"
                                               id="<?php echo $cat_struttura[$i]['id_categoria']; ?>"><?php echo $dati['nome']; ?>
                                                <i class="fa fa-close"></i></a>
                                        <?php }
                                    } ?>
                                </div>

                            <?php } ?>

                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('nome_struttura'); ?></label>
                                <input value="<?php echo $view_model->principal->nome_struttura; ?>"
                                       name="nome_struttura"
                                       type="text"
                                       class="form-control validate-1"
                                       placeholder="London Hotel">
                            </div>

                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('email'); ?></label>
                                <input value="<?php echo $view_model->principal->email; ?>"
                                       name="email"
                                       type="text"
                                       class="form-control validate-1"
                                       placeholder="mario@rossi.it">
                            </div>

                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                <input value="<?php echo $view_model->principal->sito_web; ?>"
                                       type="text"
                                       class="form-control validate-1"
                                       name="sito_web"
                                       placeholder="www.hotelsuperlondon.co.uk">
                            </div>

                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                <input value="<?php echo $view_model->principal->telefono; ?>"
                                       type="text"
                                       class="form-control validate-1"
                                       name="telefono"
                                       placeholder="020483039">
                            </div>

                            <div class="form-group col-md-12">
                                <?php
                                $label = 'abilitato';
                                $field = 'abilitata';
                                $value = $view_model->principal->abilitata;
                                include 'Views/backoffice.checkbox.php';
                                ?>
                            </div>

                            <div class="form-group col-md-12">
                                <?php
                                $label = 'indicizza';
                                $field = 'indicizza';
                                $value = $view_model->principal->indicizza;
                                include 'Views/backoffice.checkbox.php';
                                ?>
                            </div>

                            <div class="form-group col-md-12">
                                <?php
                                $label = 'convenzionato';
                                $field = 'convenzionato';
                                $value = $view_model->principal->indicizza;
                                include 'Views/backoffice.checkbox.php';
                                ?>
                            </div>

                            <?php $model = $view_model->principal; include 'Views/backoffice.geolocator.php'; ?>

                            <div class="form-group col-md-4">
                                <label><?php echo $view_model->translations->get('tipo_viaggio'); ?></label>
                                <div class="route-container">
                                    <div class="route-div"><input
                                                type="radio" <?php if ($view_model->principal->tipo_viaggio == 1) echo 'checked="checked"'; ?>
                                                name="tipo_viaggio" class="tipo_viaggio" value="1"><img
                                                src="../img/walking.svg" class="svg-route"/><span for="tipo_viaggio"
                                                                                                  class="route-span">A piedi</span>
                                    </div>
                                    <div class="route-div"><input
                                                type="radio" <?php if ($view_model->principal->tipo_viaggio == 2) echo 'checked="checked"'; ?>
                                                name="tipo_viaggio" class="tipo_viaggio" value="2"><img
                                                src="../img/car.svg" class="svg-route"/><span for="tipo_viaggio"
                                                                                              class="route-span">In auto</span>
                                    </div>
                                    <div class="route-div"><input
                                                type="radio" <?php if ($view_model->principal->tipo_viaggio == 3) echo 'checked="checked"'; ?>
                                                name="tipo_viaggio" class="tipo_viaggio" value="3"><img
                                                src="../img/mezzi.svg" class="svg-route"/><span for="tipo_viaggio"
                                                                                                class="route-span">Trasporti pubblici</span>
                                    </div>
                                </div>
                            </div>

                            <?php
                                $tips_source = empty($view_model->principal->real_path_immagini_didascalia) ? array() : explode('|', $view_model->principal->real_path_immagini_didascalia);

                                $label = 'immagini_struttura';
                                $button_label = 'scegli_immagini';
                                $field_prefix = "img_struttura";
                                $urls = empty($view_model->principal->immagine_didascalia) ? array() : array($view_model->principal->immagine_didascalia);
                                $tips = $tips_source;
                                $multiple = false;
                                include 'Views/backoffice.images.uploader.php';
                            ?>


                            <div class="form-group col-md-12">
                                <?php
                                    $label = 'descrizione';
                                    $field = 'descrizione';
                                    $field_prefix = 'descrizione';
                                    $items = $view_model->facilities;
                                    include 'Views/backoffice.multilanguage.textbox.php';
                                ?>
                            </div>

                            <?php if ($view_model->user->level > 2) { ?>
                                <div class="form-group col-md-12">
                                    <?php
                                        $label = 'descrizione_benefit';
                                        $field = 'descrizione_benefit';
                                        $field_prefix = 'descrizione_benefit';
                                        $items = $view_model->facilities;
                                        include 'Views/backoffice.multilanguage.textbox.php';
                                    ?>
                                </div>
                            <?php } ?>

                            <div class="form-group col-md-12">
                                <div class="form-group col-md-12">
                                    <?php
                                    $flag_field_prefix ="orario_continuato";
                                    $day_field_prefix = "giorno";
                                    $model = $view_model->principal;
                                    include 'Views/backoffice.timetable.php';
                                    ?>
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
                        <input type="hidden" id="num_eccellenze"
                               value="<?php if (getNumEccellenze($dbh, $id_struttura_query) >= 1) echo getNumEccellenze($dbh, $id_struttura_query); else echo '0'; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <a href="javascript:void()" class="open-create-eccellenza btn btn-primary"><i
                                            class="fa fa-plus"></i> <?php echo $langs['aggiungi_eccellenza']; ?></a>
                            </div>
                        </div>
                        <?php
                        if (getNumEccellenze($dbh, $id_struttura_query) >= 1) {
                            for ($r = 1; $r <= getNumEccellenze($dbh, $id_struttura_query); $r++) {
                                $c = $r - 1; ?>
                                <div class="form-eccellenza-container fsc-<?php echo $r; ?>"
                                     id="fsc-eccellenza-<?php echo $r; ?>">
                                    <div class="form-row">

                                        <div class="col-12">
                                            <h5><?php echo $langs['dati_eccellenza']; ?></h5></div>
                                        <div class="form-group col-md-6">
                                            <label><?php echo $langs['nome_servizio']; ?>:<span> | <i
                                                            class="fa fa-language"></i> Lingua</span></label>
                                            <select id="select-nome-eccellenze" data-form-index="1">
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

                                                $strutturaLang = getDatiEccellenze($dbh, $id_struttura_query, $lingue[$i]['shortcode_lingua']);
                                                ?>
                                                <input type="text"
                                                       value="<?php echo $strutturaLang[$r - 1]['titolo']; ?>"
                                                       class="form-control validate-eccellenza nome-eccellenza nome_eccellenze-<?php echo $r; ?>"
                                                       id="nome-eccellenza-<?php echo $lingue[$i]['shortcode_lingua']; ?>-<?php echo $r; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>
                                                       placeholder="Es: Piatti giapponesi">
                                            <?php } ?>
                                        </div>


                                        <div class="form-group col-md-6">
                                            <label><?php echo $langs['immagine_servizio']; ?></label>
                                            <input type="file" class="form-control immagine_eccellenza validate-hotel"
                                                   id="immagine_eccellenza-<?php echo $r; ?>">
                                            <div class="input-group col-md-12" id="preview-img-container">
                                                <div id="preview-immagine_eccellenza-<?php echo $r; ?>">
                                                    <div class="img-form-preview"
                                                         id="ifps-prws-immagine_eccellenza-<?php echo $r; ?>"><span
                                                                class="delete-preview"
                                                                id="prws-immagine_eccellenza-<?php echo $r; ?>"
                                                                onclick="delPreviewEccellenza('immagine_eccellenza-<?php echo $r; ?>')"><i
                                                                    class="fa fa-close"></i></span><img
                                                                class="img-form-preview-item"
                                                                src="<?php echo $strutturaLang[$r - 1]['immagine']; ?>"
                                                                height="200px">
                                                        <div class="default-image-cont"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">

                                            <?php
                                            $lingue = getLangsShortcode($dbh);
                                            for ($i = 0; $i < sizeof($lingue); $i++) {

                                                $strutturaLang = getDatiEccellenze($dbh, $id_struttura_query, $lingue[$i]['shortcode_lingua']);
                                                ?>
                                                <label><?php echo $langs['descrizione'] . ' ' . $lingue[$i]['abbreviazione']; ?></label>
                                                <div class="summernote"
                                                     id="descrizione-eccellenza-<?php echo $lingue[$i]['shortcode_lingua']; ?>-<?php echo $r; ?>"
                                                     class="form-control descrizione_eccellenza validate-eccellenza" <?php if ($i > 0) echo 'style="display:none !important;"'; ?>><?php echo $strutturaLang[$r - 1]['testo']; ?></div>
                                            <?php } ?>
                                        </div>

                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label><?php echo $langs['abilitato']; ?></label>
                                            <select id="abilitato-<?php echo $r; ?>" class="form-control">
                                                <option value="1" <?php if ($strutturaLang[$r - 1]['abilitato'] == 1) echo 'selected="selected"'; ?>>
                                                    Si
                                                </option>
                                                <option value="0" <?php if ($strutturaLang[$r - 1]['abilitato'] == 0) echo 'selected="selected"'; ?>>
                                                    No
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <input type="button" class="btn btn-danger annulla-eccellenza"
                                                   id="eccellenza-<?php echo $r; ?>" value="Elimina eccellenza">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <hr/>
                                            <input type="button" class="btn btn-success save-eccellenza"
                                                   value="<?php echo $view_model->translations->get('aggiungi_eccellenza'); ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else { ?>

                            <div class="form-eccellenza-container fsc-1" id="fsc-eccellenza-1" style="display: none;">
                                <div class="form-row">
                                    <div class="col-12">
                                        <h5><?php echo $langs['dati_eccellenza']; ?></h5></div>
                                    <div class="form-group col-md-6">
                                        <label><?php echo $langs['nome_servizio']; ?>:<span> | <i
                                                        class="fa fa-language"></i> Lingua</span></label>
                                        <select id="select-nome-eccellenze" data-form-index="1">
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
                                                   class="form-control validate-eccellenza nome-eccellenza nome_eccellenze-1"
                                                   id="nome-eccellenza-<?php echo $lingue[$i]['shortcode_lingua']; ?>-1" <?php if ($i > 0) echo 'style="display:none;"'; ?>
                                                   placeholder="">
                                        <?php } ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><?php echo $langs['immagine_servizio']; ?></label>
                                        <input type="file" class="form-control immagine_eccellenza validate-hotel"
                                               id="immagine_eccellenza-1">
                                        <div class="input-group col-md-12" id="preview-img-container">
                                            <div id="preview-immagine_eccellenza-1"></div>
                                        </div>
                                    </div>
                                    <?php
                                    for ($i = 0; $i < sizeof($lingue); $i++) {
                                        ?>
                                        <div class="form-group col-md-12">
                                            <label><?php echo $langs['descrizione'] . ' ' . $lingue[$i]['abbreviazione']; ?></label>
                                            <div class="summernote"
                                                 id="descrizione-eccellenza-<?php echo $lingue[$i]['shortcode_lingua']; ?>-1"
                                                 class="form-control descrizione_eccellenza validate-eccellenza" <?php if ($i > 0) echo 'style="display:none !important;"'; ?>></div>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label><?php echo $langs['abilitato']; ?></label>
                                        <select class="form-control" id="abilitato-1">
                                            <option value="1"><?php echo $langs['si']; ?></option>
                                            <option value="0"><?php echo $langs['no']; ?></option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <input type="button" class="btn btn-danger annulla-eccellenza" id="eccellenza-1"
                                               value="Elimina eccellenza">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <hr/>
                                        <input type="button" class="btn btn-success save-eccellenza"
                                               value="<?php echo $langs['aggiungi_eccellenza']; ?>">
                                    </div>
                                </div>
                            </div>

                        <?php }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $langs['sec_esplorato_per_voi']; ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">

                        <div class="form-didascalia-container dds-1" id="fsc-didascalia-1">
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><?php echo $langs['immagini_didascalia']; ?></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" multiple="multiple" class="custom-file-input"
                                                   id="immagini_form_didascalie">
                                            <label class="custom-file-label"><?php echo $langs['scegli_immagini']; ?></label>
                                        </div>
                                    </div>
                                    <div class="input-group col-md-12" id="preview-img-container">
                                        <div id="preview-didascalie">
                                            <?php
                                            $immagini_didascalia = explode("|", $dati_struttura[0]['real_immagini_didascalia']);
                                            $testi = explode("&&", $dati_struttura[0]['real_path_immagini_didascalia']);
                                            for ($i = 0; $i < sizeof($immagini_didascalia) - 1; $i++) {
                                                ?>
                                                <div class="img-form-preview" id="ifp-prw-<?php echo $i; ?>">
                                                    <span class="delete-preview" id="prw-<?php echo $i; ?>"
                                                          onclick="delPreview(<?php echo $i; ?>)"><i
                                                                class="fa fa-close"></i></span><img
                                                            class="img-form-preview-item-d img-didascalia"
                                                            src="<?php echo $immagini_didascalia[$i]; ?>"
                                                            height="200px">
                                                    <div class="default-image-cont">
                                                        <div class="pt20 apt-<?php echo $i; ?>">
                                                            <?php
                                                            $lingue = getLangsShortcode($dbh);
                                                            for ($u = 0; $u < sizeof($lingue); $u++) {
                                                                $testo = $testi[$i];
                                                                $testo = explode("||", $testo);
                                                                $testo = $testo[$u];
                                                                ?>
                                                                <textarea
                                                                        id="testo-didascalia-<?php echo $lingue[$u]['shortcode_lingua']; ?>-<?php echo $i; ?>"
                                                                        placeholder="Didascalia <?php echo $lingue[$u]['abbreviazione']; ?>"><?php echo $testo; ?></textarea>
                                                            <?php } ?>
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
            </div>
            <div class="col-xl-12 col-lg-12">
                <div class="form-group col-md-12">
                    <div align="left">
                        <input type="button" class="btn btn-success"
                               data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                               data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>" id="updateStruttura"
                               value="<?php echo $view_model->translations->get('aggiorna_struttura'); ?>">
                    </div>
                    <br/><br/>
                </div>
            </div>
        </div>

    </div>
</div>
</form>