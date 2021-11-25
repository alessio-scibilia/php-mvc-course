<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="/backoffice/facilities/categories" id="gobacksearch" class="open-view-action-inside back-btn"
               data-action="<?php echo $view_model->translations->get('link_strutture'); ?>"
               data-title="<?php echo $view_model->translations->get('gestione_strutture'); ?>"
               data-params="<?php echo $view_model->translations->get('categorie'); ?>"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('lista_categorie'); ?> /</a>
            <h1><i class="fa fa-list"></i> <?php echo $view_model->translations->get('crea_nuova_categoria'); ?></h1>
        </div>

        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('dati_categoria'); ?></h4>
                </div>
                <form action="/backoffice/facilities/categories/add" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="basic-form">
                            <?php
                            $lingue = $view_model->languages->list_all();
                            for ($i = 0; $i < sizeof($lingue); $i++) {
                                ?>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('nome') . ' ' . $lingue[$i]['nome_lingua']; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="nome_cat form-control validate-1 nome_categoria"
                                               id="nome_<?php echo $lingue[$i]['shortcode_lingua']; ?>"
                                               placeholder="Sport"
                                               name="nome[<?php echo $lingue[$i]['abbreviazione']; ?>]">
                                    </div>
                                </div>
                            <?php }

                            $label = 'immagine';
                            $button_label = 'immagine';
                            $field_prefix = "immagine";
                            $urls = array();
                            $multiple = false;
                            include 'Views/backoffice.images.uploader.php';
                            ?>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary validate-it" id="validate-1"
                                    ><?php echo $view_model->translations->get('crea_categoria'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>