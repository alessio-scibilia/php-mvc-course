$eventInfo = getEventInfo($dbh,$params[1],$_SESSION['lang']);
    if($eventInfo == 'error') { ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <div class="alert alert-danger">Impossibile trovare l'evento selezionato</div>
                </div>
            </div>
        </div>
    <?php } else { ?>
    
    <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-start mb15">
                    <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn" data-action="<?php echo $langs['link_eventi'];?>" data-title="roror" data-params="false" data-search="<?php if(isset($search_val)) echo $search_val;?>"><i class="fa fa-angle-left"></i> <?php echo $langs['indietro'];?> /</a>
                        <h1><i class="fa fa-calendar"></i> <?php echo $langs['modifica_evento'];?></h1>
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <?php if($eventInfo['created_by'] == $_SESSION['id_user'] || $_SESSION['level'] <= 2) { 
                                ?>
                                <div class="basic-form">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <h4><?php echo $langs['recapiti_struttura'];?></h4>
                                            <hr/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="hidden" value="<?php echo $params[1];?>" id="id_evento">
                                                <label><?php echo $langs['associa_struttura'];?>:</label>
                                                <select class="selectpicker3" data-live-search="true" id="strutture_associate">
                                                     <option disabled selected>Seleziona...</option>
                                                    <optgroup label="<?php echo $langs['hotel'];?>">
                                                    <?php
                                                    $elenco_strutture_hotel = getStruttureHotel($dbh);

                                                    if($elenco_strutture_hotel != 'error') {
                                                        for($g=0;$g<sizeof($elenco_strutture_hotel);$g++) {
                                                            echo '<option value="1-'.$elenco_strutture_hotel[$g]['id'].'" data-tokens ="'.$elenco_strutture_hotel[$g]['nome'].' '.$elenco_strutture_hotel[$g]['email'].' '.$elenco_strutture_hotel[$g]['indirizzo'].'">'.$elenco_strutture_hotel[$g]['nome'].'</option>';
                                                        }
                                                    } ?>
                                                </optgroup>
                                                <optgroup label="<?php echo $langs['strutture'];?>">
                                                <?php
                                                    $elenco_strutture = getElencoStrutture($dbh);
                                                    if($elenco_strutture != 'error') {
                                                        for($g=0;$g<sizeof($elenco_strutture);$g++) {
                                                            echo '<option value="2-'.$elenco_strutture[$g]['id'].'" data-tokens ="'.$elenco_strutture[$g]['nome'].' '.$elenco_strutture[$g]['email'].' '.$elenco_strutture[$g]['indirizzo'].'">'.$elenco_strutture[$g]['nome'].'</option>';
                                                        }
                                                    } else echo '<option>Nessuna struttura registrata<option>';?>
                                                </optgroup>
                                                </select>
                                            </div>
                                            <div id="relatedCat" class="form-group col-md-12">
                                                <?php
                                            $query = "SELECT * FROM strutture_eventi WHERE id_evento = ? AND shortcode_lingua = ?";
                                            $stmt = $dbh->prepare($query);
                                            $stmt->bindParam(1,$eventInfo['id'],PDO::PARAM_INT);
                                            $stmt->bindParam(2,$_SESSION['lang'],PDO::PARAM_INT);
                                            $stmt->execute();
                                            if($stmt->rowCount() > 0) {
                                                while($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $struttura_collegata = explode("-",$dati['id_struttura']);
                                                    $struttura_info = getStrutturaInfo($dbh,$struttura_collegata[0],$struttura_collegata[1]);
                                                    echo '<a href="javascript:void()" class="tagit2 relCat relatedCat-'.$struttura_collegata[0].'-'.$struttura_collegata[1].'" id="'.$struttura_collegata[0].'-'.$struttura_collegata[1].'" onclick="removeRelatedCat(\''.$struttura_collegata[0].'-'.$struttura_collegata[1].'\')">'.$struttura_info['nome'].'<i class="fa fa-close"></i></a>';
                                                }
                                            }
                                            ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="checkbox" id="recupera" value="1" <?php if($eventInfo['recupera_struttura'] == 1) echo 'checked="checked"';?>> <?php echo $langs['recupera_da_struttura'];?>
                                            </div>
                                            <div class="row" id="dati_struttura_evento" <?php if($eventInfo['recupera_struttura'] == 1) echo 'style="display:none;"';?>>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['nome_struttura'];?></label>
                                                <input type="text" id="nome_struttura" class="form-control validate-1" placeholder="London Pub" value="<?php echo $eventInfo['nome_struttura'];?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['email'];?></label>
                                                <input type="text" id="email" class="form-control validate-1" placeholder="mario@rossi.it" value="<?php echo $eventInfo['email'];?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['sito_web'];?></label>
                                                <input type="text" class="form-control validate-1" id="sito" placeholder="www.hotelsuperlondon.co.uk" value="<?php echo $eventInfo['sito_web'];?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['telefono'];?></label>
                                                <input type="text" class="form-control validate-1" id="telefono" placeholder="+393386854971" value="<?php echo $eventInfo['telefono'];?>">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><?php echo $langs['indirizzo'];?></label>
                                                <input type="text" class="form-control validate-1" id="indirizzo" placeholder="Via 20 Settembre, Milano (MI)" value="<?php echo $eventInfo['indirizzo'];?>">
                                                <div class="input-group-append">
                                                <button class="btn btn-primary mt5" id="calcGPS" type="button"><i class="fa fa-map-marker"></i> <?php echo $langs['calcola_coordinate'];?> </button>
                                            </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <div id="map" style="height: 260px;width: 100%;"></div>
                                                <div id="hidden-maps" ></div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['latitudine'];?></label>
                                                <input type="text" id="latitudine" class="form-control" placeholder="44.998939" value="<?php echo $eventInfo['latitudine'];?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['longitudine'];?></label>
                                                <input type="text" class="form-control" id="longitudine" placeholder="8.49304" value="<?php echo $eventInfo['longitudine'];?>">
                                            </div>
                                            
                                        </div>
                                        
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <h4><?php echo $langs['dati_evento'];?></h4>
                                                <hr/>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="input-group col-md-12">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><?php echo $langs['immagine_evento'];?></span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="immagini_evento">
                                                    <label class="custom-file-label"><?php echo $langs['scegli_immagini'];?></label>
                                                </div>
                                            </div>
                                            <div class="input-group col-md-12" id="preview-img-container">
                                                <div id="preview">
                                                    <div class="img-form-preview" id="ifp-prw-1">
                                                        <span class="delete-preview" id="prw-1" onclick="delPreview(1)">
                                                            <i class="fa fa-close"></i>
                                                        </span>
                                                        <img class="img-form-preview-item img-hotel" src="<?php echo $eventInfo['img_evento'];?>" height="200px">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label><?php echo $langs['nome_evento'];?></label>
                                                <input type="text" id="nome_evento" class="form-control validate-1" placeholder="London Festival" value="<?php echo $eventInfo['nome_evento'];?>">
                                            </div>



                                            <div class="mt20 col-md-12">
                                                <h4><?php echo $langs['descrizione_evento'];?></h4>
                                                <hr/>
                                            </div>

                                            <div class="form-group col-md-12" >

                                                <label><?php echo $langs['descrizione_evento'];?><span> | <i class="fa fa-language"></i> Lingua</span></label>
                                                <select id="select-language-desc-evento">
                                                    <?php
                                                    $lingue = getLangsShortcode($dbh);
                                                        for($i=0;$i<sizeof($lingue);$i++) {
                                                    ?>
                                                    <option value="<?php echo $lingue[$i]['shortcode_lingua'];?>"><?php echo $lingue[$i]['nome_lingua'];?></option>
                                                    <?php } ?>
                                                </select>
                                                    <?php
                                                    for($i=0;$i<sizeof($lingue);$i++) {
                                                        $eventInfo = getEventInfo($dbh,$params[1],$lingue[$i]['shortcode_lingua']);
                                                    ?>
                                                    <div class="descrizione_evento" id="descrizione_evento-<?php echo $lingue[$i]['shortcode_lingua'];?>" <?php if($i>0) echo 'style="display:none;"';?>>
                                                        <div class="summernote summ-<?php echo $i;?>" id="descrizione-evento-<?php echo $lingue[$i]['shortcode_lingua'];?>">
                                                            <?php
                                                            $query = "SELECT descrizione_evento FROM strutture_eventi WHERE id_evento = ? AND shortcode_lingua = ? LIMIT 1";
                                                            $stmt = $dbh->prepare($query);
                                                            $stmt->bindParam(1,$params[1],PDO::PARAM_INT);
                                                            $stmt->bindParam(2,$lingue[$i]['shortcode_lingua'],PDO::PARAM_INT);
                                                            $stmt->execute();
                                                            if($stmt->rowCount() > 0) {
                                                                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                echo $dati['descrizione_evento'];
                                                            } ?>
                                                            
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                
                                            </div>






                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['data_inizio_evento'];?></label>
                                                    <input type="date" class="form-control validate-1" id="data_inizio" placeholder="11/08/2021" value="<?php echo $eventInfo['data'];?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['ora_inizio_evento'];?></label>
                                                    <input type="time" class="form-control validate-1" id="ora_inizio"  value="<?php echo $eventInfo['ora'];?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['data_fine_evento'];?></label>
                                                    <input type="date" class="form-control validate-1" id="data_fine" placeholder="11/08/2021" value="<?php echo $eventInfo['data_fine_evento'];?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $langs['ora_fine_evento'];?></label>
                                                    <input type="time" class="form-control validate-1" id="ora_fine"  value="<?php echo $eventInfo['ora_fine_evento'];?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="mt20 col-md-12">
                                                <h4><?php echo $langs['convenzione'];?></h4>
                                                <hr/>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="checkbox" <?php if($eventInfo['recupera_convenzione'] == 1) echo 'checked="checked"';?> class="" id="recupera_convenzione"> <?php echo $langs['recupera_convenzione'];?>
                                            </div>

                                            <div id="rec-conv" class="form-group col-md-12" <?php if($eventInfo['recupera_convenzione'] == 1) echo 'style="display:none;"';?>>

                                                <label><?php echo $langs['descrizione_ospiti'];?><span> | <i class="fa fa-language"></i> Lingua</span></label>
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
                                                        $eventInfo = getEventInfo($dbh,$params[1],$lingue[$i]['shortcode_lingua']);
                                                    ?>
                                                    <div class="descrizione_ospiti" id="descrizione_ospiti-<?php echo $lingue[$i]['shortcode_lingua'];?>" <?php if($i>0) echo 'style="display:none;"';?>>
                                                        
                                                        <div class="summernote summ-<?php echo $i;?>" id="descrizione-ospiti-<?php echo $lingue[$i]['shortcode_lingua'];?>">
                                                            <?php
                                                            $query = "SELECT testo_convenzione FROM strutture_eventi WHERE id_evento = ? AND shortcode_lingua = ? LIMIT 1";
                                                            $stmt = $dbh->prepare($query);
                                                            $stmt->bindParam(1,$params[1],PDO::PARAM_INT);
                                                            $stmt->bindParam(2,$lingue[$i]['shortcode_lingua'],PDO::PARAM_INT);
                                                            $stmt->execute();
                                                            if($stmt->rowCount() > 0) {
                                                                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                echo $dati['testo_convenzione'];
                                                            } ?>
                                                            
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    
                                                
                                            </div>



                                        </div>
                                </div>
                                <?php } else {?>
                                    <div class="basic-form">
                                        <div class="form-row">
                                            <div class="mt20 col-md-12">
                                                <h4><?php echo $langs['convenzione'];?></h4>
                                                <hr/>
                                            </div>

                                            <div id="rec-conv" class="form-group col-md-12">
                                                <input type="hidden" value="<?php echo $params[1];?>" id="id_evento">

                                                <label><?php echo $langs['descrizione_ospiti'];?><span> | <i class="fa fa-language"></i> Lingua</span></label>
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
                                                        $eventInfo = getEventInfo($dbh,$params[1],$lingue[$i]['shortcode_lingua']);
                                                    ?>
                                                    <div class="descrizione_ospiti" id="descrizione_ospiti-<?php echo $lingue[$i]['shortcode_lingua'];?>" <?php if($i>0) echo 'style="display:none;"';?>>
                                                        
                                                        <div class="summernote summ-<?php echo $i;?>" id="descrizione-ospiti-<?php echo $lingue[$i]['shortcode_lingua'];?>">
                                                             <?php
                                                            $query = "SELECT testo_convenzione FROM strutture_eventi WHERE id_evento = ? AND shortcode_lingua = ? AND id_struttura = ? LIMIT 1";
                                                            $stmt = $dbh->prepare($query);
                                                            $stmt->bindParam(1,$params[1],PDO::PARAM_INT);
                                                            $stmt->bindParam(2,$lingue[$i]['shortcode_lingua'],PDO::PARAM_INT);
                                                            $id_struttura = '1-'.$_SESSION['id_user'];
                                                            $stmt->bindParam(3,$id_struttura,PDO::PARAM_INT);
                                                            $stmt->execute();
                                                            if($stmt->rowCount() > 0) {
                                                                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                    echo $dati['testo_convenzione'];
                                                                
                                                            } else {
                                                                $query = "SELECT testo_convenzione FROM strutture_eventi WHERE id_evento = ? AND shortcode_lingua = ? LIMIT 1";
                                                                $stmt = $dbh->prepare($query);
                                                                $stmt->bindParam(1,$params[1],PDO::PARAM_INT);
                                                                $stmt->bindParam(2,$lingue[$i]['shortcode_lingua'],PDO::PARAM_INT);
                                                                $stmt->execute();
                                                                if($stmt->rowCount() > 0) {
                                                                    $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                        echo $dati['testo_convenzione'];
                                                                    
                                                                }
                                                            }?>
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
                                <?php $eventInfo = getEventInfo($dbh,$params[1],$lingue[$i]['shortcode_lingua']); ?>
                                <?php if($eventInfo['created_by'] == $_SESSION['id_user'] || $_SESSION['level'] <= 2) { ?>
                                <input type="button" class="btn btn-success"  data-success="<?php echo $langs['modifiche_salvate'];?>" data-failure="<?php echo $langs['errore_salvataggio'];?>"  id="updateEvento" value="<?php echo $langs['aggiorna_evento'];?>">
                                <?php } else { 
                                    if($eventInfo['created_by'] == $_SESSION['id_user'] ) { ?>
                                <input type="button" class="btn btn-success"  data-success="<?php echo $langs['modifiche_salvate'];?>" data-failure="<?php echo $langs['errore_salvataggio'];?>"  id="updateEvento" value="<?php echo $langs['aggiorna_evento'];?>">
                                <?php } else { ?>
                                    <input type="button" class="btn btn-success"  data-success="<?php echo $langs['modifiche_salvate'];?>" data-failure="<?php echo $langs['errore_salvataggio'];?>"  id="updateEventoSmall" value="<?php echo $langs['aggiorna_evento'];?>">
                                <?php } 
                                }?>
                            </div>
                            <br/><br/>
                        </div>
                    </div>
                </div>
            </div>