<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="/backoffice/guests" id="gobacksearch" class="open-view-action-inside back-btn"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('gestione_ospiti'); ?>/</a>
            <h1><i class="fa fa-users"></i> <?php echo $view_model->translations->get('modifica_ospiti'); ?></h1>
        </div>
        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('dati_ospiti'); ?></h4>
                </div>
                <form action="/backoffice/guest/<?php echo $view_model->ospite['id']; ?>" method="POST"
                      enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="basic-form">
                            <div>
                                Link di accesso per l'ospite: <a target="_blank"
                                                                 href="https://wellcox.cluster031.hosting.ovh.net/index.php?strh=<?php echo $view_model->ospite['hotel_associato']; ?>">https://wellcox.cluster031.hosting.ovh.net/index.php?strh=<?php echo $view_model->ospite['hotel_associato']; ?></a>
                            </div>
                            <br/>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('nome'); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control validate-1"
                                           value="<?php echo $view_model->ospite['nome']; ?>" id="nome"
                                           placeholder="Mario">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('cognome'); ?></label>
                                <div class="col-sm-9">
                                    <input value="<?php echo $view_model->ospite['cognome']; ?>" type="text"
                                           class="form-control validate-1" id="cognome" placeholder="Rossi">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('data_checkin'); ?></label>
                                <div class="col-sm-9">
                                    <input type="date"
                                           value="<?php echo date('Y-m-d', strtotime($view_model->ospite['data_checkin'])); ?>"
                                           class="form-control validate-1" id="data_checkin" placeholder="Data checkin">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('data_checkout'); ?></label>
                                <div class="col-sm-9">
                                    <input type="date"
                                           value="<?php echo date('Y-m-d', strtotime($view_model->ospite['data_checkout'])); ?>"
                                           class="form-control validate-1" id="data_checkout"
                                           placeholder="Data checkout">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('numero_ospiti'); ?></label>
                                <div class="col-sm-9">
                                    <input type="number" value="<?php echo $view_model->ospite['numero_ospiti']; ?>"
                                           class="form-control validate-1" id="numero_ospiti" placeholder="3" min="1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('email'); ?></label>
                                <div class="col-sm-9">
                                    <input type="email" value="<?php echo $view_model->ospite['email']; ?>"
                                           class="form-control validate-1" id="email" placeholder="mario@rossi.it">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('telefono'); ?></label>
                                <div class="col-sm-9">
                                    <input value="<?php echo $view_model->ospite['telefono']; ?>" type="text"
                                           class="form-control validate-1" id="telefono" placeholder="+39333333333">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('password'); ?></label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control validate-1" id="password-type-2"
                                           placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('password'); ?></label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control validate-1" id="conferma_password-type-2"
                                           placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('abilitato'); ?></label>
                                <div class="col-sm-9">
                                    <select class="form-control validate-1" id="abilitato">
                                        <option <?php if ($view_model->ospite['abilitato'] == 1) echo 'selected="selected"'; ?>
                                                value="1"><?php echo $view_model->translations->get('si'); ?></option>
                                        <option value="0" <?php if ($view_model->ospite['abilitato'] == 0) echo 'selected="selected"'; ?>><?php echo $view_model->translations->get('no'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('numero_stanza'); ?></label>
                                <div class="col-sm-9">
                                    <input type="text" value="<?php echo $view_model->ospite['numero_stanza']; ?>"
                                           class="form-control validate-1" id="numero_stanza" placeholder="3" min="1"
                                    >
                                </div>
                            </div>
                            <input type="hidden" id="id-ospiti" class="validate-1"
                            >
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-success validate-it" id="validate-1"
                                            data-params="false"
                                            data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                            data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                            data-function="updateGuest"><?php echo $view_model->translations->get('salva'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>