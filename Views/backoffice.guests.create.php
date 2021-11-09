<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="/backoffice/guests" id="gobacksearch" class="open-view-action-inside back-btn"
               data-action="<?php echo $view_model->translations->get('param_ospiti'); ?>" data-title="roror"
               data-params="false"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('gestione_ospiti'); ?> /</a>
            <h1><i class="fa fa-users"></i> <?php echo $view_model->translations->get('aggiungi_ospiti'); ?></h1>
        </div>

        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('dati_ospiti'); ?></h4>
                </div>
                <div class="card-body">
                    <form action="/backoffice/guests/add" method="post" enctype="multipart/form-data">
                        <div class="basic-form">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('nome'); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="nome" class="form-control validate-1" id="nome"
                                           placeholder="Mario">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('cognome'); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="cognome" class="form-control validate-1" id="cognome"
                                           placeholder="Rossi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('data_checkin'); ?></label>
                                <div class="col-sm-9">
                                    <input type="date" name="data_checkin" class="form-control validate-1"
                                           id="data_checkin"
                                           placeholder="Data checkin">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('data_checkout'); ?></label>
                                <div class="col-sm-9">
                                    <input type="date" name="data_checkout" class="form-control validate-1"
                                           id="data_checkout"
                                           placeholder="Data checkout">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('numero_ospiti'); ?></label>
                                <div class="col-sm-9">
                                    <input type="number" name="numero_ospiti" class="form-control validate-1"
                                           id="numero_ospiti" placeholder="3"
                                           min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('email'); ?></label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control validate-1" id="email"
                                           placeholder="mario@rossi.it">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('telefono'); ?></label>
                                <div class="col-sm-9">
                                    <input type="telefono" name="telefono" class="form-control validate-1" id="telefono"
                                           placeholder="+39333333333">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('password'); ?></label>
                                <div class="col-sm-9">
                                    <?php
                                    $pwd = mt_rand(100000, 999999); ?>
                                    <input type="password" value="<?php echo $pwd; ?>" class="form-control validate-1"
                                           id="password" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('conferma_password'); ?></label>
                                <div class="col-sm-9">
                                    <input type="password" value="<?php echo $pwd; ?>" class="form-control validate-1"
                                           id="conferma_password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('abilitato'); ?></label>
                                <div class="col-sm-9">
                                    <select class="form-control validate-1" name="abilitato" id="abilitato">
                                        <option value="1"><?php echo $view_model->translations->get('si'); ?></option>
                                        <option value="0"><?php echo $view_model->translations->get('no'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('numero_stanza'); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="numero_stanza" class="form-control validate-1"
                                           id="numero–stanza" placeholder="3"
                                           min="1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="submit" class="btn btn-success" id="validate-1"
                                           data-params="false"
                                           data-callback="<?php echo $view_model->translations->get('param_ospiti'); ?>"
                                           data-success="<?php echo $view_model->translations->get('ospite_aggiunto'); ?>"
                                           data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                           data-function="addGuest"
                                           value="<?php echo $view_model->translations->get('aggiungi_ospiti'); ?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>