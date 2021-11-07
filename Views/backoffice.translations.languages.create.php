<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="/backoffice/translations/languages" id="gobacksearch" class="open-view-action-inside back-btn"
               data-action="<?php echo $view_model->translations->get('descrizione_ospiti'); ?>" data-title="roror"
               data-params="<?php echo $view_model->translations->get('params_lingue'); ?>"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('lingue_create'); ?>
                /</a>
            <h1><i class="fa fa-globe"></i> <?php echo $view_model->translations->get('crea_nuova_lingua'); ?></h1>
        </div>
        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('form_nome_lingua'); ?>
                                :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control validate-1" id="nome_lingua"
                                       placeholder="English">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('form_abbreviazione_lingua'); ?>
                                :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control validate-1" id="abbreviazione_lingua"
                                       placeholder="EN">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-primary validate-it" id="validate-1"
                                        data-function="addLanguage"><?php echo $view_model->translations->get('salva'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>