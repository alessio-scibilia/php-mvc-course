<input type="hidden" id="id_struttura" value="<?php echo $id_struttura_query; ?>">
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn"
               data-action="<?php echo $langs['link_strutture']; ?>"
               data-title="<?php echo $langs['gestione_strutture']; ?>" data-params="false"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $langs['gestione_strutture']; ?> /</a>
            <h1><i class="fa fa-building"></i> <?php echo $langs['modifica_struttura']; ?></h1>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $langs['dati_struttura']; ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-row">
                            <?php if ($_SESSION['level'] <= 2) { ?>
                                <div class="form-group col-md-6">
                                    <label><?php echo $langs['hotel_associati']; ?></label>
                                    <select class="selectpicker" data-live-search="true" id="hotel_associati">
                                        <option disabled selected>Seleziona...</option>
                                        <?php
                                        $hotel_associati = getHotels($dbh);
                                        if ($hotel_associati != 'error') {
                                            for ($g = 0; $g < sizeof($hotel_associati); $g++) {
                                                echo '<option value="' . $hotel_associati[$g]['id'] . '" data-tokens="' . $hotel_associati[$g]['nome'] . ' ' . $hotel_associati[$g]['email'] . ' ' . $hotel_associati[$g]['indirizzo'] . '">' . $hotel_associati[$g]['nome'] . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <div id="relatedHotels" class="form-group col-md-6">
                                    <?php
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
                                    <label><?php echo $langs['categorie_associate']; ?></label>
                                    <select class="selectpicker1" data-live-search="true" id="hotel_associati">
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
                                <label><?php echo $langs['nome_struttura']; ?></label>
                                <input value="<?php echo $dati_struttura[0]['nome_struttura']; ?>" type="text"
                                       id="nome_struttura" class="form-control validate-1" placeholder="London Hotel">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $langs['email']; ?></label>
                                <input value="<?php echo $dati_struttura[0]['email']; ?>" type="text" id="email"
                                       class="form-control validate-1" placeholder="mario@rossi.it">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $langs['sito_web']; ?></label>
                                <input value="<?php echo $dati_struttura[0]['sito_web']; ?>" type="text"
                                       class="form-control validate-1" id="sito"
                                       placeholder="www.hotelsuperlondon.co.uk">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $langs['telefono']; ?></label>
                                <input value="<?php echo $dati_struttura[0]['telefono']; ?>" type="text"
                                       class="form-control validate-1" id="telefono" placeholder="020483039">
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $langs['abilitato']; ?></label>
                                <select class="form-control" id="abilitato-struttura">
                                    <option value="1" <?php if ($dati_struttura[0]['abilitata'] == 1) echo 'selected="selected"'; ?>><?php echo $langs['si']; ?></option>
                                    <option value="0" <?php if ($dati_struttura[0]['abilitata'] == 0) echo 'selected="selected"'; ?>><?php echo $langs['no']; ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label><?php echo $langs['indicizza']; ?></label>
                                <select class="form-control" id="indicizza">
                                    <option value="1" <?php if ($dati_struttura[0]['indicizza'] == 1) echo 'selected="selected"'; ?>><?php echo $langs['si']; ?></option>
                                    <option value="0" <?php if ($dati_struttura[0]['indicizza'] == 0) echo 'selected="selected"'; ?>><?php echo $langs['no']; ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label><?php echo $langs['convenzionato']; ?></label>
                                <select class="form-control" id="is_convenzionato">
                                    <option value="1" <?php if ($dati_struttura[0]['convenzionato'] == 1) echo 'selected="selected"'; ?>><?php echo $langs['si']; ?></option>
                                    <option value="0" <?php if ($dati_struttura[0]['convenzionato'] == 0) echo 'selected="selected"'; ?>><?php echo $langs['no']; ?></option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label><?php echo $langs['indirizzo']; ?></label>
                                <input type="text" class="form-control validate-1" id="indirizzo"
                                       value="<?php echo $dati_struttura[0]['indirizzo_struttura']; ?>"
                                       placeholder="Via 20 Settembre, Milano (MI)">
                                <div class="input-group-append">
                                    <button class="btn btn-primary mt5" id="calcGPS" type="button"><i
                                                class="fa fa-map-marker"></i> <?php echo $langs['calcola_coordinate']; ?>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div id="map" style="height: 260px;width: 100%;"></div>
                                <div id="hidden-maps"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label><?php echo $langs['latitudine']; ?></label>
                                <input type="text" value="<?php echo $dati_struttura[0]['latitudine']; ?>"
                                       id="latitudine" class="form-control" placeholder="33,430302">
                            </div>
                            <div class="form-group col-md-4">
                                <label><?php echo $langs['longitudine']; ?></label>
                                <input type="text" value="<?php echo $dati_struttura[0]['longitudine']; ?>"
                                       id="longitudine" class="form-control" placeholder="8,93393">
                            </div>
                            <div class="form-group col-md-4">
                                <label><?php echo $langs['tipo_viaggio']; ?></label>
                                <div class="route-container">
                                    <div class="route-div"><input
                                                type="radio" <?php if ($dati_struttura[0]['tipo_viaggio'] == 1) echo 'checked="checked"'; ?>
                                                name="tipo_viaggio" class="tipo_viaggio" value="1"><img
                                                src="../img/walking.svg" class="svg-route"/><span for="tipo_viaggio"
                                                                                                  class="route-span">A piedi</span>
                                    </div>
                                    <div class="route-div"><input
                                                type="radio" <?php if ($dati_struttura[0]['tipo_viaggio'] == 2) echo 'checked="checked"'; ?>
                                                name="tipo_viaggio" class="tipo_viaggio" value="2"><img
                                                src="../img/car.svg" class="svg-route"/><span for="tipo_viaggio"
                                                                                              class="route-span">In auto</span>
                                    </div>
                                    <div class="route-div"><input
                                                type="radio" <?php if ($dati_struttura[0]['tipo_viaggio'] == 3) echo 'checked="checked"'; ?>
                                                name="tipo_viaggio" class="tipo_viaggio" value="3"><img
                                                src="../img/mezzi.svg" class="svg-route"/><span for="tipo_viaggio"
                                                                                                class="route-span">Trasporti pubblici</span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><?php echo $langs['immagini_struttura']; ?></span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" multiple="multiple" class="custom-file-input"
                                           id="immagini_form_strutture">
                                    <label class="custom-file-label"><?php echo $langs['scegli_immagini']; ?></label>
                                </div>
                            </div>
                            <div class="input-group col-md-12" id="preview-img-container">
                                <div id="preview">
                                    <?php
                                    $immagini = explode("|", $dati_struttura[0]['immagine_didascalia']);
                                    for ($i = 0; $i < sizeof($immagini) - 1; $i++) {
                                        ?>
                                        <div class="img-form-preview" id="ifp-prw-<?php echo $i + 1; ?>"><span
                                                    class="delete-preview" id="prw-<?php echo $i + 1; ?>"
                                                    onclick="delPreview(<?php echo $i + 1; ?>)"><i
                                                        class="fa fa-close"></i></span><img
                                                    class="img-form-preview-item img-hotel"
                                                    src="<?php echo $immagini[$i]; ?>" height="200px">
                                            <div class="pt20"><input type="radio"
                                                                     class="default-image" <?php if ($dati_struttura[0]['immagine_principale'] - 1 == $i) echo 'checked="checked" ';

                                                ?>
                                                                     name="default-image" value="<?php echo $i + 1; ?>"><label>Immagine
                                                    principale</label><br></div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group col-md-12">

                                <label><?php echo $langs['descrizione']; ?><span> | <i class="fa fa-language"></i> Lingua</span></label>
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
                                    $descrizioni = getDescrizioniStruttura($dbh, $lingue[$i]['shortcode_lingua'], $dati_struttura[0]['id'], $params[1]);
                                    ?>
                                    <div class="descrizione_ospiti"
                                         id="descrizione_ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>>
                                        <div class="summernote"
                                             id="descrizione-ospiti-<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $descrizioni['descrizione']; ?></div>
                                    </div>
                                <?php } ?>


                            </div>
                            <?php if ($_SESSION['level'] > 2) { ?>
                                <div class="form-group col-md-12">

                                    <label><?php echo $langs['descrizione_benefit']; ?><span> | <i
                                                    class="fa fa-language"></i> Lingua</span></label>
                                    <select id="select-language-benefit">
                                        <?php
                                        $lingue = getLangsShortcode($dbh);
                                        for ($i = 0; $i < sizeof($lingue); $i++) {
                                            ?>
                                            <option value="<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $lingue[$i]['nome_lingua']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php
                                    for ($i = 0; $i < sizeof($lingue); $i++) {
                                        $descrizioni = getDescrizioniStruttura($dbh, $lingue[$i]['shortcode_lingua'], $params[1]);
                                        ?>
                                        <div class="descrizione_benefit"
                                             id="descrizione_benefit-<?php echo $lingue[$i]['shortcode_lingua']; ?>" <?php if ($i > 0) echo 'style="display:none;"'; ?>>
                                            <div class="summernote"
                                                 id="descrizione-benefit-<?php echo $lingue[$i]['shortcode_lingua']; ?>"><?php echo $descrizioni['descrizione_benefit']; ?></div>
                                        </div>
                                    <?php } ?>


                                </div>
                            <?php } ?>
                            <div class="form-group col-md-12">
                                <label><?php echo $langs['orari']; ?></label>
                                <br/>
                                <?php
                                $orari_lunedi = explode("|", $dati_struttura[0]['orari_lunedi']);
                                $orari_martedi = explode("|", $dati_struttura[0]['orari_martedi']);
                                $orari_mercoledi = explode("|", $dati_struttura[0]['orari_mercoledi']);
                                $orari_giovedi = explode("|", $dati_struttura[0]['orari_giovedi']);
                                $orari_venerdi = explode("|", $dati_struttura[0]['orari_venerdi']);
                                $orari_sabato = explode("|", $dati_struttura[0]['orari_sabato']);
                                $orari_domenica = explode("|", $dati_struttura[0]['orari_domenica']);
                                ?>
                                <div class="time-container" style="display: inline-block;">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $langs['lunedi']; ?><span> | <input
                                                        type="checkbox" <?php if ($orari_lunedi[0] == 1) echo 'checked="checked"'; ?> class="orario-continuato"
                                                        value="1" id="orario-continuato-1-1"> Orario continuato </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      value="<?php echo $orari_lunedi[1]; ?>"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-lun-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     value="<?php echo $orari_lunedi[2]; ?>"
                                                                                                     id="1-lun-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input <?php if ($orari_lunedi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                           value="<?php echo $orari_lunedi[3]; ?>"
                                                                                                                                                           class="validate-hotel"
                                                                                                                                                           id="2-lun-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input <?php if ($orari_lunedi[0] == 1) echo 'disabled'; ?>  value="<?php echo $orari_lunedi[4]; ?>"
                                                                                                                                                           type="time"
                                                                                                                                                           class="validate-hotel"
                                                                                                                                                           id="3-lun-1">
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-container" style="display: inline-block;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $langs['martedi']; ?><span> | <input
                                                        type="checkbox" <?php if ($orari_martedi[0] == 1) echo 'checked="checked"'; ?> class="orario-continuato"
                                                        value="1" id="orario-continuato-2-1"> Orario continuato </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      value="<?php echo $orari_martedi[1]; ?>"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-mar-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     value="<?php echo $orari_martedi[2]; ?>"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-mar-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input <?php if ($orari_martedi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                            value="<?php echo $orari_martedi[3]; ?>"
                                                                                                                                                            class="validate-hotel"
                                                                                                                                                            id="2-mar-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input <?php if ($orari_martedi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                           value="<?php echo $orari_martedi[4]; ?>"
                                                                                                                                                           class="validate-hotel"
                                                                                                                                                           id="3-mar-1">
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-container" style="display: inline-block;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $langs['mercoledi']; ?><span> | <input
                                                        type="checkbox" <?php if ($orari_mercoledi[0] == 1) echo 'checked="checked"'; ?> class="orario-continuato"
                                                        value="1" id="orario-continuato-3-1"> Orario continuato </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      value="<?php echo $orari_mercoledi[1]; ?>"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-mer-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     value="<?php echo $orari_mercoledi[2]; ?>"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-mer-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input <?php if ($orari_mercoledi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                              value="<?php echo $orari_mercoledi[3]; ?>"
                                                                                                                                                              class="validate-hotel"
                                                                                                                                                              id="2-mer-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input <?php if ($orari_mercoledi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                             value="<?php echo $orari_mercoledi[4]; ?>"
                                                                                                                                                             class="validate-hotel"
                                                                                                                                                             id="3-mer-1">
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
                                                                                                                           id="orario-continuato-4-1"> Orario continuato </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      value="<?php echo $orari_giovedi[1]; ?>"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-gio-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     value="<?php echo $orari_giovedi[2]; ?>"
                                                                                                     class="validate-hotel"
                                                                                                     id="1-gio-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input  <?php if ($orari_giovedi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                             value="<?php echo $orari_giovedi[3]; ?>"
                                                                                                                                                             class="validate-hotel"
                                                                                                                                                             id="2-gio-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input  <?php if ($orari_giovedi[0] == 1) echo 'disabled'; ?> value="<?php echo $orari_giovedi[4]; ?>"
                                                                                                                                                            type="time"
                                                                                                                                                            class="validate-hotel"
                                                                                                                                                            id="3-gio-1">
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
                                                                                                                           id="orario-continuato-5-1"> Orario continuato </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      value="<?php echo $orari_venerdi[1]; ?>"
                                                                                                      class="validate-hotel"
                                                                                                      id="0-ven-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     value="<?php echo $orari_venerdi[2]; ?>"
                                                                                                     id="1-ven-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input <?php if ($orari_venerdi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                            class="validate-hotel"
                                                                                                                                                            value="<?php echo $orari_venerdi[3]; ?>"
                                                                                                                                                            id="2-ven-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input <?php if ($orari_venerdi[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                           class="validate-hotel"
                                                                                                                                                           value="<?php echo $orari_venerdi[4]; ?>"
                                                                                                                                                           id="3-ven-1">
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-container" style="display: inline-block;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $langs['sabato']; ?><span> | <input
                                                        type="checkbox" <?php if ($orari_sabato[0] == 1) echo 'checked="checked"'; ?> class="orario-continuato"
                                                        value="1" id="orario-continuato-6-1"> Orario continuato </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      value="<?php echo $orari_sabato[1]; ?>"
                                                                                                      id="0-sab-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     value="<?php echo $orari_sabato[2]; ?>"
                                                                                                     id="1-sab-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input <?php if ($orari_sabato[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                           class="validate-hotel"
                                                                                                                                                           value="<?php echo $orari_sabato[3]; ?>"
                                                                                                                                                           id="2-sab-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input <?php if ($orari_sabato[0] == 1) echo 'disabled'; ?> type="time"
                                                                                                                                                          class="validate-hotel"
                                                                                                                                                          value="<?php echo $orari_sabato[4]; ?>"
                                                                                                                                                          id="3-sab-1">
                                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="time-container" style="display: inline-block;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="time-title"><?php echo $langs['domenica']; ?><span> | <input
                                                        type="checkbox" class="orario-continuato" value="1"
                                                        id="orario-continuato-7-1" <?php if ($orari_domenica[0] == 1) echo 'checked="checked"'; ?>> Orario continuato </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input type="time"
                                                                                                      class="validate-hotel"
                                                                                                      value="<?php echo $orari_domenica[1]; ?>"
                                                                                                      id="0-dom-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input type="time"
                                                                                                     class="validate-hotel"
                                                                                                     value="<?php echo $orari_domenica[2]; ?>"
                                                                                                     id="1-dom-1">
                                                            </span>
                                        </div>
                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle']; ?> <input
                                                                        type="time" <?php if ($orari_domenica[0] == 1) echo 'disabled'; ?> class="validate-hotel" <?php if ($orari_domenica[0] == 1) echo 'checked="checked"'; ?> value="<?php echo $orari_domenica[3]; ?>"
                                                                        id="2-dom-1">
                                                            </span>
                                            <span class="time-span">
                                                                <?php echo $langs['alle']; ?> <input
                                                        type="time" <?php if ($orari_domenica[0] == 1) echo 'disabled'; ?> class="validate-hotel"
                                                        value="<?php echo $orari_domenica[4]; ?>" id="3-dom-1">
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
                    <h4 class="card-title"><?php echo $langs['eccellenze']; ?></h4>
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
                                                   value="<?php echo $langs['aggiungi_eccellenza']; ?>">
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
                               data-success="<?php echo $langs['modifiche_salvate']; ?>"
                               data-failure="<?php echo $langs['errore_salvataggio']; ?>" id="updateStruttura"
                               value="<?php echo $langs['aggiorna_struttura']; ?>">
                    </div>
                    <br/><br/>
                </div>
            </div>
        </div>

    </div>
</div>