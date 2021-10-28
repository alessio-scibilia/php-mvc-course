<div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-start mb15">
                    <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn" data-action="<?php echo $langs['link_strutture'];?>" data-title="<?php echo $langs['gestione_strutture'];?>" data-params="false" data-search="<?php if(isset($search_val)) echo $search_val;?>"><i class="fa fa-angle-left"></i> <?php echo $langs['gestione_strutture'];?> /</a>
                        <h1><i class="fa fa-building"></i> <?php echo $langs['crea_nuova_struttura'];?></h1>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $langs['dati_struttura'];?></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['nome_struttura'];?></label>
                                                <input type="text" id="nome_struttura" class="form-control validate-1" placeholder="London Hotel">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['email'];?></label>
                                                <input type="text" id="email" class="form-control validate-1" placeholder="mario@rossi.it">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['sito_web'];?></label>
                                                <input type="text" class="form-control validate-1" id="sito" placeholder="www.hotelsuperlondon.co.uk">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['telefono'];?></label>
                                                <input type="text" class="form-control validate-1" id="telefono" placeholder="020483039">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><?php echo $langs['abilitato'];?></label>
                                                <select class="form-control" id="abilitato-1">
                                                    <option value="1"><?php echo $langs['si'];?></option>
                                                    <option value="0"><?php echo $langs['no'];?></option>
                                                </select>
                                            </div>
                                            <input type="hidden" id="indicizza" value="0">
                                            <div class="form-group col-md-12">
                                                <label><?php echo $langs['indirizzo'];?></label>
                                                <input type="text" class="form-control validate-1" id="indirizzo" placeholder="Via 20 Settembre, Milano (MI)">
                                                <div class="input-group-append">
                                                <button class="btn btn-primary mt5" id="calcGPS" type="button"><i class="fa fa-map-marker"></i> <?php echo $langs['calcola_coordinate'];?> </button>
                                            </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div id="map" style="height: 260px;width: 100%;"></div>
                                                <div id="hidden-maps"></div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label><?php echo $langs['latitudine'];?></label>
                                                <input type="text" id="latitudine" class="form-control" placeholder="33,430302">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label><?php echo $langs['longitudine'];?></label>
                                                <input type="text" id="longitudine" class="form-control" placeholder="8,93393">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label><?php echo $langs['tipo_viaggio'];?></label>
                                                <div class="route-container">
                                                    <div class="route-div"><input type="radio" name="tipo_viaggio" class="tipo_viaggio" value="1"><img src="../img/walking.svg" class="svg-route" /><span for="tipo_viaggio"  class="route-span">A piedi</span></div>
                                                    <div class="route-div"><input type="radio" name="tipo_viaggio" class="tipo_viaggio" value="2"><img src="../img/car.svg" class="svg-route" /><span for="tipo_viaggio" class="route-span">In auto</span></div>
                                                    <div class="route-div"><input type="radio" name="tipo_viaggio" class="tipo_viaggio" value="3"><img src="../img/mezzi.svg" class="svg-route" /><span for="tipo_viaggio" class="route-span">Trasporti pubblici</span></div>
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><?php echo $langs['immagini_struttura'];?></span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" multiple="multiple" class="custom-file-input" id="immagini_form_strutture">
                                                    <label class="custom-file-label"><?php echo $langs['scegli_immagini'];?></label>
                                                </div>
                                            </div>
                                            <div class="input-group col-md-12" id="preview-img-container">
                                                <div id="preview"></div>
                                            </div>
                                            <div class="form-group col-md-12">

                                                <label><?php echo $langs['descrizione'];?><span> | <i class="fa fa-language"></i> Lingua</span></label>
                                                <select id="select-language">
                                                    <?php
                                                    $lingue = getLangsShortcode($dbh);
                                                        for($i=0;$i<sizeof($lingue);$i++) {
                                                    ?>
                                                    <option value="<?php echo $lingue[$i]['shortcode_lingua'];?>"><?php echo $lingue[$i]['nome_lingua'];?></option>
                                                    <?php } ?>
                                                </select>
                                                    <?php
                                                    for($i=0;$i<sizeof($lingue);$i++) {
                                                    ?>
                                                    <div class="descrizione_ospiti" id="descrizione_ospiti-<?php echo $lingue[$i]['shortcode_lingua'];?>" <?php if($i>0) echo 'style="display:none;"';?>>
                                                        <div class="summernote" id="descrizione-ospiti-<?php echo $lingue[$i]['shortcode_lingua'];?>"></div>
                                                    </div>
                                                    <?php } ?>


                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><?php echo $langs['convenzionato'];?></label>
                                                <select class="form-control" id="is_convenzionato">
                                                    <option value="1"><?php echo $langs['si'];?></option>
                                                    <option value="0"><?php echo $langs['no'];?></option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">

                                                <label><?php echo $langs['descrizione_benefit'];?><span> | <i class="fa fa-language"></i> Lingua</span></label>
                                                <select id="select-language-benefit">
                                                    <?php
                                                    $lingue = getLangsShortcode($dbh);
                                                        for($i=0;$i<sizeof($lingue);$i++) {
                                                    ?>
                                                    <option value="<?php echo $lingue[$i]['shortcode_lingua'];?>"><?php echo $lingue[$i]['nome_lingua'];?></option>
                                                    <?php } ?>
                                                </select>
                                                    <?php
                                                    for($i=0;$i<sizeof($lingue);$i++) {
                                                    ?>
                                                    <div class="descrizione_benefit" id="descrizione_benefit-<?php echo $lingue[$i]['shortcode_lingua'];?>" <?php if($i>0) echo 'style="display:none;"';?>>
                                                        <div class="summernote" id="descrizione-benefit-<?php echo $lingue[$i]['shortcode_lingua'];?>"></div>
                                                    </div>
                                                    <?php } ?>


                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><?php echo $langs['orari'];?></label>
                                                <br/>
                                                <?php

                                                ?>
                                                <div class="time-container" style="display: inline-block;">

                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $langs['lunedi'];?><span> | <input type="checkbox" class="orario-continuato"   value="1" id="orario-continuato-1-1"> Orario continuato </span></div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time" value="<?php echo $orari_lunedi[1];?>"  class="validate-hotel" id="0-lun-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time" class="validate-hotel"  value="<?php echo $orari_lunedi[2];?>" id="1-lun-1">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time"  value="<?php echo $orari_lunedi[3];?>" class="validate-hotel" id="2-lun-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input  value="<?php echo $orari_lunedi[4];?>" type="time" class="validate-hotel" id="3-lun-1">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $langs['martedi'];?><span> | <input type="checkbox" class="orario-continuato" value="1" id="orario-continuato-2-1"> Orario continuato </span></div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time"  value="<?php echo $orari_martedi[1];?>"   class="validate-hotel" id="0-mar-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time"  value="<?php echo $orari_martedi[2];?>" class="validate-hotel" id="1-mar-1">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time" value="<?php echo $orari_martedi[3];?>"  class="validate-hotel" id="2-mar-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time" value="<?php echo $orari_martedi[4];?>"  class="validate-hotel" id="3-mar-1">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $langs['mercoledi'];?><span> | <input type="checkbox" class="orario-continuato" value="1" id="orario-continuato-3-1"> Orario continuato </span></div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time"  value="<?php echo $orari_mercoledi[1];?>"  class="validate-hotel" id="0-mer-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time" value="<?php echo $orari_mercoledi[2];?>"  class="validate-hotel" id="1-mer-1">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time" value="<?php echo $orari_mercoledi[3];?>"  class="validate-hotel" id="2-mer-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time" value="<?php echo $orari_mercoledi[4];?>"  class="validate-hotel" id="3-mer-1">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $langs['giovedi'];?><span> | <input type="checkbox" class="orario-continuato" value="1" id="orario-continuato-4-1"> Orario continuato </span></div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time" value="<?php echo $orari_giovedi[1];?>" class="validate-hotel" id="0-gio-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time" value="<?php echo $orari_giovedi[2];?>"  class="validate-hotel" id="1-gio-1">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time" value="<?php echo $orari_giovedi[3];?>"  class="validate-hotel" id="2-gio-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input value="<?php echo $orari_giovedi[4];?>"  type="time" class="validate-hotel" id="3-gio-1">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $langs['venerdi'];?><span> | <input type="checkbox" class="orario-continuato" value="1" id="orario-continuato-5-1"> Orario continuato </span></div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time" value="<?php echo $orari_venerdi[1];?>"  class="validate-hotel" id="0-ven-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time" class="validate-hotel" value="<?php echo $orari_venerdi[2];?>"  id="1-ven-1">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time" class="validate-hotel" value="<?php echo $orari_venerdi[3];?>"  id="2-ven-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time" class="validate-hotel" value="<?php echo $orari_venerdi[4];?>"  id="3-ven-1">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $langs['sabato'];?><span> | <input type="checkbox" class="orario-continuato" value="1" id="orario-continuato-6-1"> Orario continuato </span></div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time" class="validate-hotel" value="<?php echo $orari_sabato[1];?>"  id="0-sab-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time" class="validate-hotel"  value="<?php echo $orari_sabato[2];?>"id="1-sab-1">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time"  class="validate-hotel" value="<?php echo $orari_sabato[3];?>" id="2-sab-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time"  class="validate-hotel" value="<?php echo $orari_sabato[4];?>" id="3-sab-1">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="time-container" style="display: inline-block;">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="time-title"><?php echo $langs['domenica'];?><span> | <input  type="checkbox" class="orario-continuato" value="1" id="orario-continuato-7-1"> Orario continuato </span></div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time" class="validate-hotel" value="<?php echo $orari_domenica[1];?>" id="0-dom-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time" class="validate-hotel" value="<?php echo $orari_domenica[2];?>"  id="1-dom-1">
                                                            </span>
                                                        </div>
                                                        <div class="input-time-container">
                                                            <span class="time-span">
                                                                <?php echo $langs['dalle'];?> <input type="time" class="validate-hotel" value="<?php echo $orari_domenica[3];?>"  id="2-dom-1">
                                                            </span>
                                                            <span class="time-span">
                                                                <?php echo $langs['alle'];?> <input type="time" class="validate-hotel"  value="<?php echo $orari_domenica[4];?>" id="3-dom-1">
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
                                <h4 class="card-title"><?php echo $langs['eccellenze'];?></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                <input type="hidden" id="num_eccellenze" value="0">
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                <a href="javascript:void()" class="open-create-eccellenza btn btn-primary"><i class="fa fa-plus"></i> <?php echo $langs['aggiungi_eccellenza'];?></a>
                                            </div>
                                        </div>
                                        <div class="form-eccellenza-container fsc-1" id="fsc-eccellenza-1" style="display: none;">
                                        <div class="form-row">
                                            <div class="col-12">
                                            <h5><?php echo $langs['dati_eccellenza'];?></h5></div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['nome_servizio'];?>:<span> | <i class="fa fa-language"></i> Lingua</span></label>
                                                <select id="select-nome-eccellenze" data-form-index="1">
                                                    <?php
                                                    $lingue = getLangsShortcode($dbh);
                                                        for($i=0;$i<sizeof($lingue);$i++) {
                                                    ?>
                                                    <option value="<?php echo $lingue[$i]['shortcode_lingua'];?>"><?php echo $lingue[$i]['nome_lingua'];?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php
                                                $lingue = getLangsShortcode($dbh);
                                                    for($i=0;$i<sizeof($lingue);$i++) {
                                                ?>
                                                <input type="text" class="form-control validate-eccellenza nome-eccellenza nome_eccellenze-1" id="nome-eccellenza-<?php echo $lingue[$i]['shortcode_lingua'];?>-1" <?php if($i>0) echo 'style="display:none;"';?> placeholder="">
                                            <?php } ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['immagine_servizio'];?></label>
                                                <input type="file" class="form-control immagine_eccellenza validate-hotel" id="immagine_eccellenza-1">
                                                <div class="input-group col-md-12" id="preview-img-container">
                                                <div id="preview-immagine_eccellenza-1"></div>
                                            </div>
                                            </div>
                                                <?php
                                                    for($i=0;$i<sizeof($lingue);$i++) {
                                                    ?>
                                            <div class="form-group col-md-12">
                                                    <label><?php echo $langs['descrizione'].' '.$lingue[$i]['abbreviazione'];?></label>
                                                <div class="summernote" id="descrizione-eccellenza-<?php echo $lingue[$i]['shortcode_lingua'];?>-1" class="form-control descrizione_eccellenza validate-eccellenza" <?php if($i>0) echo 'style="display:none !important;"';?>></div>
                                            </div>
                                            <?php } ?>

                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label><?php echo $langs['abilitato'];?></label>
                                                <select class="form-control" id="abilitato-1">
                                                    <option value="1"><?php echo $langs['si'];?></option>
                                                    <option value="0"><?php echo $langs['no'];?></option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <input type="button" class="btn btn-danger annulla-eccellenza" id="eccellenza-1" value="Elimina eccellenza">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <hr/>
                                                <input type="button" class="btn btn-success save-eccellenza" value="<?php echo $langs['aggiungi_eccellenza'];?>">
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
                                    <input type="button" class="btn btn-success" data-success="<?php echo $langs['modifiche_salvate'];?>" data-failure="<?php echo $langs['errore_salvataggio'];?>"  id="createStruttura" value="<?php echo $langs['crea_struttura'];?>">
                                </div>
                                <br/><br/>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
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
<?php }

else if(isset($params[1]) && $params[1] == 'cat') {

    ?>

    <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-start mb15">
                        <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn" data-action="<?php echo $langs['link_strutture'];?>" data-title="<?php echo $langs['gestione_strutture'];?>" data-params="<?php echo $langs['categorie'];?>" data-search="<?php if(isset($search_val)) echo $search_val;?>"><i class="fa fa-angle-left"></i> <?php echo $langs['lista_categorie'];?> /</a>
                        <h1><i class="fa fa-list"></i> <?php echo $langs['modifica_categoria'];?></h1>
                    </div>

                    <div class="col-xl-8 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $langs['dati_categoria'];?></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">

                                    <?php
                                    $lingue = getLangsShortcode($dbh);
                                    for($x=0;$x < sizeof($lingue);$x++) {
                                        $cat_trad = getCategoria($dbh,$params[2],$lingue[$x]['shortcode_lingua']);
                                    ?>
                                        <div class="form-group row">

                                            <label class="col-sm-3 col-form-label"><?php echo $langs['nome'];?> <?php echo $lingue[$x]['abbreviazione'];?></label>
                                            <div class="col-sm-9">


                                            <input value="<?php echo $cat_trad['nome'];?>" type="text" class="nome_cat form-control validate-1" id="nome_<?php echo $lingue[$x]['shortcode_lingua'];?>"  placeholder="Sport">
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <input type="hidden" name="image_path" value="<?php echo $cat_trad['immagine'];?>" id="img_path" class="validate-1">
                                    <input type="hidden" id="id_cat" value="<?php echo $cat_trad['related_id'];?>" class="validate-1">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label"><?php echo $langs['immagine_categoria'];?></label>
                                            <div class="col-sm-9 custom-file">
                                                <input type="file" data-function="addCategory" class="custom-file-input" id="immagini_cat">
                                                <label class="custom-file-label"><?php echo $langs['scegli_immagini'];?></label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="input-group col-md-12" id="preview-img-container">
                                                <div id="preview">
                                                    <div class="img-form-preview ">
                                                        <img class="img-form-preview-item" src="<?php echo $cat_trad['immagine'];?>" height="200px">
                                                    </div>
                                                </div>
                                            </div>
                                                <button type="button" class="btn btn-primary validate-it" id="validate-1" data-params="false"  data-success="<?php echo $langs['modifiche_salvate'];?>" data-failure="<?php echo $langs['errore_salvataggio'];?>"" data-function="updateCategory"><?php echo $langs['salva'];?></button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
<?php }
if(!isset($params[1])) { ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-between mb15">
                    <h1><i class="fa fa-building"></i> <?php echo $langs['gestione_strutture'];?></h1>
                    <?php if($_SESSION['level'] <= 3) { ?>
                    <a class="btn btn-primary open-view-action-inside mb10" data-toggle="tab" data-title="<?php echo $langs['gestione_strutture'];?>" data-action="<?php echo $langs['link_strutture'];?>" data-params="<?php echo $langs['nuovo_params'];?>" href="#<?php echo $langs['link_strutture'];?>">
                    <i class="fa fa-plus"></i> <?php echo $langs['crea_nuova_struttura'];?>
                    </a>
                    <?php } ?>
                </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $langs['lista_strutture'];?></h4>
                            </div>
                            <div class="card-body">

                                    <div class="table-responsive">
                                        <table id="example" class="display" style="min-width: 100%">
                                            <thead>
                                                <tr>
                                                <?php if($_SESSION['level'] == 0) { ?>
                                                    <th>ID</th>
                                                <?php } ?>
                                                    <th><?php echo $langs['nome'];?></th>
                                                    <th><?php echo $langs['email'];?></th>
                                                    <th><?php echo $langs['telefono'];?></th>
                                                    <th><?php echo $langs['indirizzo'];?></th>
                                                    <?php if($_SESSION['level'] < 3) { ?>
                                                    <th><?php echo $langs['hotel_associati'];?></th><?php } ?>
                                                    <th><?php echo $langs['abilita'];?></th>
                                                    <th><?php echo $langs['azioni'];?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if($lista_strutture != 'error') {
                                                for($i=0;$i<sizeof($lista_strutture);$i++) {


                                                    if($_SESSION['level'] < 3) {
                                                        echo '<tr>';
                                                        if($_SESSION['level'] == 0)
                                                        echo '<td>'.$lista_strutture[$i]['id'].'</td>';
                                                        echo '<td>'.$lista_strutture[$i]['nome'].'</td>';
                                                        echo '<td>'.$lista_strutture[$i]['email'].'</td>';
                                                        echo '<td>'.$lista_strutture[$i]['telefono'].'</td>';
                                                        echo '<td>'.$lista_strutture[$i]['indirizzo'].'</td><td>';

                                                        $query = "SELECT * FROM strutture WHERE id = ?";
                                                        $stmt = $dbh->prepare($query);
                                                        $stmt->bindParam(1,$lista_strutture[$i]['id'],PDO::PARAM_INT);
                                                        $stmt->execute();
                                                        if($stmt->rowCount() > 0) {
                                                            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                                                            $email = $dati['email'];
                                                            $nome_struttura = $dati['nome_struttura'];
                                                            $email = $dati['email'];
                                                            $latitudine = $dati['latitudine'];
                                                            $longitudine = $dati['longitudine'];
                                                            $created_by = $dati['created_by'];
                                                            $lingue = getLangsShortcode($dbh);

                                                            $query = "SELECT * FROM strutture WHERE email = ? AND nome_struttura = ? AND  latitudine = ? AND longitudine = ? AND created_by = ? AND shortcode_lingua = ?";
                                                            $stmt = $dbh->prepare($query);
                                                            $stmt->bindParam(1,$email,PDO::PARAM_STR);
                                                            $stmt->bindParam(2,$nome_struttura,PDO::PARAM_STR);
                                                            $stmt->bindParam(3,$latitudine,PDO::PARAM_STR);
                                                            $stmt->bindParam(4,$longitudine,PDO::PARAM_STR);
                                                            $stmt->bindParam(5,$created_by,PDO::PARAM_INT);
                                                            $stmt->bindParam(6,$lingue[0]['shortcode_lingua'],PDO::PARAM_INT);
                                                            $stmt->execute();
                                                            if($stmt->rowCount() > 0) {
                                                                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                $id_struttura_query = $dati['id'];
                                                            }
                                                        }
                                                        $hotel_associati = getHotelAssociati($dbh,$id_struttura_query);
                                                        if($hotel_associati != 'error') {
                                                        for($t=0;$t<sizeof($hotel_associati);$t++) {
                                                            ?>
                                                            <a href="javascript:void()" class="tagit delHot" data-sucess="<?php echo $langs['modifiche_salvate'];?>" data-function="delRelatedHotel" data-params="<?php echo $lista_strutture[$i]['id'];?>,<?php echo $hotel_associati[$t]['id_hotel'];?>"><?php echo $hotel_associati[$t]['nome'];?> <i class="fa fa-close"></i></a>
                                                        <?php } }

                                                        echo '</td>';
                                                        if($lista_strutture[$i]['abilitata'] == 1)
                                                        echo '<td><input type="checkbox" checked="checked" id="" data-success="'.$langs['modifiche_salvate'].'" class="enable-struttura enable" value="'.$lista_strutture[$i]['id'].'"></td>';
                                                        else
                                                            echo '<td><input type="checkbox"  id="" data-success="'.$langs['modifiche_salvate'].'" class="enable-struttura enable" value="'.$lista_strutture[$i]['id'].'"></td>';
                                                        echo '<td>
                                                           <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="'.$langs['link_strutture'].'" data-title="'.$langs['gestione_strutture'].'" data-params="'.$lista_strutture[$i]['id'].'"><i class="fa fa-pencil"></i></a>
                                                           <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-success="'.$langs['modifiche_salvate'].'" data-failure="'.$langs['errore_salvataggio'].'"  data-function="delStruttura" data-params="'.$lista_strutture[$i]['id'].'"><i class="fa fa-trash"></i></a>    
                                                        </td>';
                                                    } else if($_SESSION['level'] > 2) {
                                                        $query_conv = "SELECT * FROM strutture_hotel WHERE id_struttura = ? AND id_hotel = ? ";
                                                        $stmt_conv = $dbh->prepare($query_conv);
                                                        $stmt_conv->bindParam(1,$lista_strutture[$i]['id'],PDO::PARAM_INT);
                                                        $stmt_conv->bindParam(2,$_SESSION['id_user'],PDO::PARAM_INT);
                                                        $stmt_conv->execute();
                                                        if($stmt_conv->rowCount() > 0) {
                                                            echo '<tr>';
                                                            echo '<td>'.$lista_strutture[$i]['nome'].'</td>';
                                                            echo '<td>'.$lista_strutture[$i]['email'].'</td>';
                                                            echo '<td>'.$lista_strutture[$i]['telefono'].'</td>';
                                                            echo '<td>'.$lista_strutture[$i]['indirizzo'].'</td>';
                                                            if($lista_strutture[$i]['abilitata'] == 1 && $lista_strutture[$i]['created_by'] != 0)
                                                        echo '<td><input type="checkbox" checked="checked" id="" data-success="'.$langs['modifiche_salvate'].'" class="enable-struttura enable" value="'.$lista_strutture[$i]['id'].'"></td>';
                                                        else if($lista_strutture[$i]['created_by'] != 0)
                                                            echo '<td><input type="checkbox"  id="" data-success="'.$langs['modifiche_salvate'].'" class="enable-struttura enable" value="'.$lista_strutture[$i]['id'].'"></td>';
                                                        else
                                                            echo '<td></td>';
                                                            if($lista_strutture[$i]['created_by'] != 0)
                                                                echo '<td>
                                                                   <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="'.$langs['link_strutture'].'" data-title="'.$langs['gestione_strutture'].'" data-params="'.$lista_strutture[$i]['id'].'"><i class="fa fa-pencil"></i></a>
                                                                   <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delStruttura" data-success="'.$langs['modifiche_salvate'].'" data-failure="'.$langs['errore_salvataggio'].'"  data-params="'.$lista_strutture[$i]['id'].'"><i class="fa fa-trash"></i></a>    
                                                            </td>';
                                                            else
                                                                 echo '<td>
                                                                   <a href="javascript:void()"  class="btn btn-primary shadow btn-xs mr-1 open-view-action-inside" data-action="'.$langs['link_convenzioni'].'" data-title="'.$langs['convenzioni'].'" data-params="'.$lista_strutture[$i]['id'].'">'.$langs['gestisci_convenzione'].'</a>

                                                            </td>';
                                                        }
                                                    } else echo 'Errore';

                                                } }?>


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <?php if($_SESSION['level'] == 0) { ?>
                                                    <th>ID</th>
                                                <?php } ?>
                                                    <th><?php echo $langs['nome'];?></th>
                                                    <th><?php echo $langs['email'];?></th>
                                                    <th><?php echo $langs['telefono'];?></th>
                                                    <th><?php echo $langs['indirizzo'];?></th>
                                                    <?php if($_SESSION['level'] < 3) { ?>
                                                    <th><?php echo $langs['hotel_associati'];?></th><?php } ?>
                                                    <th><?php echo $langs['abilita'];?></th>
                                                    <th><?php echo $langs['azioni'];?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>