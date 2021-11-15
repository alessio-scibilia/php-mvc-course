<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="/backoffice/facilities/categories" id="gobacksearch" class="open-view-action-inside back-btn"
               data-action="<?php echo $view_model->translations->get('link_strutture'); ?>"
               data-title="<?php echo $view_model->translations->get('gestione_strutture'); ?>"
               data-params="<?php echo $view_model->translations->get('categorie'); ?>"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('lista_categorie'); ?> /</a>
            <h1><i class="fa fa-list"></i> <?php echo $view_model->translations->get('modifica_categoria'); ?></h1>
        </div>

        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('dati_categoria'); ?></h4>
                </div>
                <form action="/backoffice/facilities/category/update"
                      method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="basic-form">
                            <?php
                            $lingue = $view_model->languages->list_all();
                            $i = 1;
                            for ($k = 0; $k < sizeof($lingue); $k++) {
                                foreach ($view_model->category_all_languages as $category) {
                                    if ($i == 1)
                                        echo '<input type="hidden" name="id_cat" value="' . $category[$i]->related_id . '">';

                                    ?>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('nome') . ' ' . $lingue[$k]['nome_lingua']; ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="nome_cat form-control validate-1 nome_categoria"
                                                   id="nome_<?php echo $lingue[$k]['shortcode_lingua']; ?>"
                                                   placeholder="Sport"
                                                   value="<?php echo $category[$i]->nome; ?>"
                                                   name="nome[<?php echo $lingue[$k]['abbreviazione']; ?>]">
                                        </div>
                                    </div>
                                    <?php
                                    $img[0] = $category[$i]->immagine;
                                    $i++;
                                }
                            }

                            $label = 'immagine';
                            $button_label = 'immagine';
                            $field_prefix = "immagine";
                            $urls = $img;
                            $multiple = false;
                            include 'Views/backoffice.images.uploader.php';
                            ?>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary validate-it" id="validate-1"
                                    ><?php echo $view_model->translations->get('salva'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>