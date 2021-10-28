<?php
$user_info = getUserInfo($dbh, $params[1]);
if ($user_info == 'error') { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-12">
                <div class="alert alert-danger">Impossibile trovare l'utente selezionato</div>
            </div>
        </div>
    </div>
<?php } else { ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-start mb15">
                <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn"
                   data-action="<?php echo $langs['link_amministratori']; ?>"
                   data-title="<?php echo $langs['gestione_amministratori']; ?>" data-params="false"
                   data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                            class="fa fa-angle-left"></i> <?php echo $langs['indietro']; ?> /</a>
                <h1><i class="fa fa-user"></i> <?php echo $langs['modifica_utente']; ?></h1>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $langs['dati_utente']; ?></h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $langs['nome']; ?></label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $user_info['nome']; ?>"
                                           class="form-control validate-1" id="nome" placeholder="Mario">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $langs['cognome']; ?></label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $user_info['cognome']; ?>"
                                           class="form-control validate-1" id="cognome" placeholder="Rossi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $langs['email']; ?></label>
                                <div class="col-sm-9">
                                    <input type="email" value="<?php echo $user_info['email']; ?>"
                                           class="form-control validate-1" id="email" placeholder="mario@rossi.it">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $langs['livello']; ?></label>
                                <div class="col-sm-9">
                                    <select name="livello" value="<?php echo $user_info['livello']; ?>" id="livello"
                                            class="form-control validate-1">
                                        <?php if ($_SESSION['level'] == 0) { ?>
                                            <option value="0" <?php if ($user_info['livello'] == 0) echo 'selected="selected"'; ?>>
                                                Dev
                                            </option>
                                        <?php } ?>
                                        <?php if ($_SESSION['level'] <= 1) { ?>
                                            <option value="1" <?php if ($user_info['livello'] == 1) echo 'selected="selected"'; ?>>
                                                Superadmin
                                            </option>
                                        <?php } ?>
                                        <option value="2" <?php if ($user_info['livello'] == 2) echo 'selected="selected"'; ?>>
                                            Admin
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id" class="validate-1" value="<?php echo $user_info['id']; ?>">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-success validate-it" id="validate-1"
                                            data-success="<?php echo $langs['modifiche_salvate']; ?>"
                                            data-failure="<?php echo $langs['errore_salvataggio']; ?>"
                                            data-function="updateAdmin"><?php echo $langs['salva']; ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php } ?>