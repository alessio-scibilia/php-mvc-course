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
                <form action="/backoffice/settings/update" method="post" enctype="multipart/form">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('nome'); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="nome" class="form-control validate-1" id="nome"
                                           placeholder="Mario"
                                           value="<?php echo $view_model->user->nome; ?>">
                                </div>
                            </div>
                            <?php if ($view_model->user->level <= 2) { ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('cognome'); ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="cognome" class="form-control validate-1" id="cognome"
                                               placeholder="Rossi"
                                               value="<?php echo $view_model->user->cognome; ?>">
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('email'); ?></label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control validate-1" name="email" id="email"
                                           placeholder="mario@rossi.it"
                                           value="<?php echo $view_model->user->email; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="submit"
                                           class="btn btn-success "
                                           id="validate-1"
                                           value="<?php echo $view_model->translations->get('salva'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('modifica_password'); ?></h4>
                </div>
                <form action="/backoffice/settings/password/update" method="post" enctype="multipart/form">
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('nuova_password'); ?></label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" autocomplete="off"
                                           class="form-control validate-2"
                                           id="password"
                                           placeholder="!()$(òsI!">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('conferma_nuova_password'); ?></label>
                                <div class="col-sm-9">
                                    <input autocomplete="off" type="password" class="form-control validate-2"
                                           id="password"
                                           placeholder="!()$(òsI!">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="submit" class="btn btn-success validate-it" id="validate-2"
                                           value="<?php echo $view_model->translations->get('salva'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>