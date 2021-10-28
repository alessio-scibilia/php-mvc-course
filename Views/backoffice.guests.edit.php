<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn"
               data-action="<?php echo $langs['param_ospiti']; ?>" data-title="roror" data-params="false"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $langs['gestione_ospiti']; ?> /</a>
            <h1><i class="fa fa-users"></i> <?php echo $langs['modifica_ospiti']; ?></h1>
        </div>

        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $langs['dati_ospiti']; ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div>
                            Link di accesso per l'ospite: <a target="_blank"
                                                             href="https://wellcox.cluster031.hosting.ovh.net/index.php?strh=<?php echo $guests_data['hotel_associato']; ?>">https://wellcox.cluster031.hosting.ovh.net/index.php?strh=<?php echo $guests_data['hotel_associato']; ?></a>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['nome']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control validate-1"
                                       value="<?php echo $guests_data['nome']; ?>" id="nome" placeholder="Mario">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['cognome']; ?></label>
                            <div class="col-sm-9">
                                <input value="<?php echo $guests_data['cognome']; ?>" type="text"
                                       class="form-control validate-1" id="cognome" placeholder="Rossi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['data_checkin']; ?></label>
                            <div class="col-sm-9">
                                <input type="date"
                                       value="<?php echo date('Y-m-d', strtotime($guests_data['data_checkin'])); ?>"
                                       class="form-control validate-1" id="data_checkin" placeholder="Data checkin">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['data_checkout']; ?></label>
                            <div class="col-sm-9">
                                <input type="date"
                                       value="<?php echo date('Y-m-d', strtotime($guests_data['data_checkout'])); ?>"
                                       class="form-control validate-1" id="data_checkout" placeholder="Data checkout">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['numero_ospiti']; ?></label>
                            <div class="col-sm-9">
                                <input type="number" value="<?php echo $guests_data['numero_ospiti']; ?>"
                                       class="form-control validate-1" id="numero_ospiti" placeholder="3" min="1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['email']; ?></label>
                            <div class="col-sm-9">
                                <input type="email" value="<?php echo $guests_data['email']; ?>"
                                       class="form-control validate-1" id="email" placeholder="mario@rossi.it">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['telefono']; ?></label>
                            <div class="col-sm-9">
                                <input value="<?php echo $guests_data['telefono']; ?>" type="text"
                                       class="form-control validate-1" id="telefono" placeholder="+39333333333">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['password']; ?></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control validate-1" id="password-type-2"
                                       placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['password']; ?></label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control validate-1" id="conferma_password-type-2"
                                       placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['abilitato']; ?></label>
                            <div class="col-sm-9">
                                <select class="form-control validate-1" id="abilitato">
                                    <option <?php if ($guests_data['abilitato'] == 1) echo 'selected="selected"'; ?>
                                            value="1"><?php echo $langs['si']; ?></option>
                                    <option value="0" <?php if ($guests_data['abilitato'] == 0) echo 'selected="selected"'; ?>><?php echo $langs['no']; ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $langs['numero_stanza']; ?></label>
                            <div class="col-sm-9">
                                <input type="text" value="<?php echo $guests_data['numero_stanza']; ?>"
                                       class="form-control validate-1" id="numero_stanza" placeholder="3" min="1"
                                       value="<?php echo $guests_data['numero_stanza']; ?>">
                            </div>
                        </div>
                        <input type="hidden" id="id-ospiti" class="validate-1"
                               value="<?php echo $guests_data['id']; ?>">

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-success validate-it" id="validate-1"
                                        data-params="false" data-success="<?php echo $langs['modifiche_salvate']; ?>"
                                        data-failure="<?php echo $langs['errore_salvataggio']; ?>"
                                        data-function="updateGuest"><?php echo $langs['salva']; ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>