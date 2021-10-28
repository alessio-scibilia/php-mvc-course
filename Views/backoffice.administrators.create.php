<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn"
               data-action="<?php echo $langs['link_amministratori']; ?>"
               data-title="<?php echo $langs['gestione_amministratori']; ?>" data-params="false"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $langs['gestione_amministratori']; ?> /</a>
            <h1><i class="fa fa-user"></i> <?php echo $langs['crea_nuovo_amministratore']; ?></h1>
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
                                <input type="text" class="form-control validate-1" id="nome" placeholder="Mario">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['cognome']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control validate-1" id="cognome" placeholder="Rossi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['email']; ?></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control validate-1" id="email"
                                       placeholder="mario@rossi.it">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['livello']; ?></label>
                            <div class="col-sm-9">
                                <select name="livello" id="livello" class="form-control validate-1">
                                    <?php if ($_SESSION['level'] == 0) { ?>
                                        <option value="0">Dev</option>
                                    <?php } ?>
                                    <?php if ($_SESSION['level'] <= 1) { ?>
                                        <option value="1">Superadmin</option>
                                    <?php } ?>
                                    <option value="2">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['password']; ?></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control validate-1" id="password"
                                       placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-success validate-it" id="validate-1"
                                        data-params="false"
                                        data-callback="<?php echo strtolower($langs['amministratori']); ?>"
                                        data-success="<?php echo $langs['utente_creato_successo']; ?>"
                                        data-failure="<?php echo $langs['errore_salvataggio']; ?>"
                                        data-function="addAdmin"><?php echo $langs['crea_utente']; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>