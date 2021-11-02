<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1><i class="fa fa-gear"></i> <?php echo $view_model->translations->get('impostazioni'); ?></h1>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('modifica_tuoi_dati'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('nome'); ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control validate-1" id="nome" placeholder="Mario"
                                       value="<?php echo $view_model->user->nome; ?>">
                            </div>
                        </div>
                        <?php if ($view_model->user->level <= 2) { ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('cognome'); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control validate-1" id="cognome" placeholder="Rossi"
                                           value="<?php echo $view_model->user->cognome; ?>">
                                </div>
                            </div>
                        <?php } ?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('email'); ?></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control validate-1" id="email"
                                       placeholder="mario@rossi.it"
                                       value="<?php echo $view_model->translations->get('email'); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="button"
                                        data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                        data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                        class="btn btn-success validate-it" id="validate-1"
                                        data-function="updateCurrentUserInfo"><?php echo $view_model->translations->get('salva'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('modifica_password'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('nuova_password'); ?></label>
                            <div class="col-sm-9">
                                <input type="password" autocomplete="off" class="form-control validate-2" id="password"
                                       placeholder="!()$(òsI!">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('conferma_nuova_password'); ?></label>
                            <div class="col-sm-9">
                                <input autocomplete="off" type="password" class="form-control validate-2" id="password"
                                       placeholder="!()$(òsI!">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-success validate-it" id="validate-2"
                                        data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                        data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                        data-function="updateCurrentUserPassword"><?php echo $view_model->translations->get('salva'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>