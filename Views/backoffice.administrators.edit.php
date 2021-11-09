<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="/backoffice/administrators" id="gobacksearch" class="open-view-action-inside back-btn"
               data-action="<?php echo $view_model->translations->get('link_amministratori'); ?>"
               data-title="<?php echo $view_model->translations->get('gestione_amministratori'); ?>" data-params="false"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('indietro'); ?> /</a>
            <h1><i class="fa fa-user"></i> <?php echo $view_model->translations->get('modifica_utente'); ?></h1>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('dati_utente'); ?></h4>
                </div>
                <div class="card-body">
                    <form action="/backoffice/administrator/<?php echo $view_model->admin['id']; ?>/update"
                          method="POST"
                          enctype="multipart/form-data">
                        <div class="basic-form">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('nome'); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="nome" value="<?php echo $view_model->admin['nome']; ?>"
                                           class="form-control validate-1" id="nome" placeholder="Mario">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('cognome'); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="cognome"
                                           value="<?php echo $view_model->admin['cognome']; ?>"
                                           class="form-control validate-1" id="cognome" placeholder="Rossi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('email'); ?></label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" value="<?php echo $view_model->admin['email']; ?>"
                                           class="form-control validate-1" id="email" placeholder="mario@rossi.it">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('livello'); ?></label>
                                <div class="col-sm-9">
                                    <select name="level" value="<?php echo $view_model->admin['level']; ?>"
                                            id="livello"
                                            class="form-control validate-1">
                                        <?php if ($view_model->user->level == 0) { ?>
                                            <option value="0" <?php if ($view_model->admin['level'] == 0) echo 'selected="selected"'; ?>>
                                                Dev
                                            </option>
                                        <?php } ?>
                                        <?php if ($view_model->user->level <= 1) { ?>
                                            <option value="1" <?php if ($view_model->admin['level'] == 1) echo 'selected="selected"'; ?>>
                                                Superadmin
                                            </option>
                                        <?php } ?>
                                        <option value="2" <?php if ($view_model->admin['level'] == 2) echo 'selected="selected"'; ?>>
                                            Admin
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id" class="validate-1"
                                   value="<?php echo $view_model->admin['id']; ?>">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="submit" class="btn btn-success" id="validate-1"
                                           data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                           data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                           value="<?php echo $view_model->translations->get('salva'); ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
