<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn"
               data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('lista_categorie'); ?> /</a>
            <h1><i class="fa fa-list"></i> <?php echo $view_model->translations->get('modifica_categoria'); ?></h1>
        </div>

        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('dati_categoria'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">

                        <?php
                        $lingue = $view_model->languages->list_all();
                        for ($x = 0; $x < sizeof($lingue); $x++) {
                            //$cat_trad = getCategoria($dbh,$params[2],$lingue[$x]['shortcode_lingua']);
                            ?>
                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('nome'); ?><?php echo $lingue[$x]['abbreviazione']; ?></label>
                                <div class="col-sm-9">


                                    <input value="<?php //echo $cat_trad['nome'];?>" type="text"
                                           class="nome_cat form-control validate-1"
                                           id="nome_<?php //echo $lingue[$x]['shortcode_lingua'];?>"
                                           placeholder="Sport">
                                </div>
                            </div>
                        <?php } ?>
                        <input type="hidden" name="image_path" value="<?php //echo //$cat_trad['immagine'];?>"
                               id="img_path" class="validate-1">
                        <input type="hidden" id="id_cat" value="<?php //echo $cat_trad['related_id'];?>"
                               class="validate-1">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $view_model->translations->get('immagine_categoria'); ?></label>
                            <div class="col-sm-9 custom-file">
                                <input type="file" data-function="addCategory" class="custom-file-input"
                                       id="immagini_cat">
                                <label class="custom-file-label"><?php echo $view_model->translations->get('scegli_immagine'); ?></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group col-md-12" id="preview-img-container">
                                    <div id="preview">
                                        <div class="img-form-preview ">
                                            <img class="img-form-preview-item"
                                                 src="<?php //echo $cat_trad['immagine'];?>" height="200px">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary validate-it" id="validate-1"
                                        data-params="false"
                                        data-function="updateCategory"><?php echo $view_model->translations->get('salva'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>