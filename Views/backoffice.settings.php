<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1><i class="fa fa-gear"></i> <?php echo $langs['impostazioni']; ?></h1>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $langs['modifica_tuoi_dati']; ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['nome']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control validate-1" id="nome" placeholder="Mario"
                                       value="<?php echo $_SESSION['name']; ?>">
                            </div>
                        </div>
                        <?php if ($_SESSION['level'] <= 2) { ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $langs['cognome']; ?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control validate-1" id="cognome" placeholder="Rossi"
                                           value="<?php echo $_SESSION['surname']; ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['email']; ?></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control validate-1" id="email"
                                       placeholder="mario@rossi.it" value="<?php echo $_SESSION['email']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="button" data-success="<?php echo $langs['modifiche_salvate']; ?>"
                                        data-failure="<?php echo $langs['errore_salvataggio']; ?>"
                                        class="btn btn-success validate-it" id="validate-1"
                                        data-function="updateCurrentUserInfo"><?php echo $langs['salva']; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $langs['modifica_password']; ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['nuova_password']; ?></label>
                            <div class="col-sm-9">
                                <input type="password" autocomplete="off" class="form-control validate-2" id="password"
                                       placeholder="!()$(òsI!">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['conferma_nuova_password']; ?></label>
                            <div class="col-sm-9">
                                <input autocomplete="off" type="password" class="form-control validate-2" id="password"
                                       placeholder="!()$(òsI!">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-success validate-it" id="validate-2"
                                        data-success="<?php echo $langs['modifiche_salvate']; ?>"
                                        data-failure="<?php echo $langs['errore_salvataggio']; ?>"
                                        data-function="updateCurrentUserPassword"><?php echo $langs['salva']; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>