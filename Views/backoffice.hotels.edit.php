<form action="/backoffice/hotels/<?php echo $view_model->profile->id; ?>/edit"
      method="POST"
      enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-start mb15">
                <a href="/backoffice/hotels" id="gobacksearch" class="open-view-action-inside back-btn"><i
                            class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('gestione_hotels'); ?>
                    /</a>
                <h1><i class="fa fa-building-o"></i> <?php echo $view_model->profile->nome; ?></h1>
            </div>
            <div class="col-xl-12 col-lg-12">
                <a href="/<?php echo $view_model->profile->id; ?>"
                   class="btn btn-info" target="_blank"><i class="fa fa-eye"></i> Vedi come ospite</a><br/><br/>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i
                                    class="fa fa-info-circle"></i> <?php echo $view_model->translations->get('dati_hotel'); ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('nome_hotel'); ?></label>
                                    <input type="text"
                                           name="nome"
                                           value="<?php echo $view_model->profile->nome; ?>"
                                           id="nome"
                                           class="form-control validate-hotel" placeholder="London Hotel">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('email'); ?></label>
                                    <input value="<?php echo $view_model->profile->email; ?>"
                                           name="email"
                                           type="text"
                                           id="email"
                                           class="form-control validate-hotel" placeholder="mario@rossi.it">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                    <input value="<?php echo $view_model->profile->sito_web; ?>"
                                           type="text"
                                           name="sito_web"
                                           class="form-control validate-hotel"
                                           id="sito"
                                           placeholder="www.hotelsuperlondon.co.uk">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                    <input value="<?php echo $view_model->profile->telefono; ?>"
                                           type="text"
                                           name="telefono"
                                           class="form-control validate-hotel"
                                           id="telefono"
                                           placeholder="020483039">
                                </div>

                                <?php $model = $view_model->profile;
                                include 'Views/backoffice.geolocator.php'; ?>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('password'); ?></label>
                                    <input type="password"
                                           name="password"
                                           value=""
                                           id="password"
                                           class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('conferma_password'); ?></label>
                                    <input type="password"
                                           value=""
                                           id="conferma_password-type-2"
                                           class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <?php
                                        $label = 'abilitato';
                                        $field = 'abilitato';
                                        $field_prefix = 'abilitato';
                                        $value = $view_model->profile->abilitato;
                                        include 'Views/backoffice.checkbox.php';
                                    ?>
                                </div>

                                <div class="form-group col-md-12">
                                    <?php
                                        $label = 'hotel_pro';
                                        $field = 'level';
                                        $field_prefix = 'level';
                                        $value = $view_model->profile->level == 3;
                                        include 'Views/backoffice.checkbox.php';
                                    ?>
                                </div>

                                <div class="form-group col-md-12">
                                    <?php
                                        $label = 'descrizione_ospiti';
                                        $field = 'descrizione_ospiti';
                                        $field_prefix = 'descrizione_ospiti';
                                        $items = $view_model->hotel_translations;
                                        include 'Views/backoffice.multilanguage.textbox.php';
                                    ?>
                                </div>

                                <?php
                                    $immagini = explode("|", $view_model->profile->immagini_secondarie);

                                    $label = 'immagini_hotel';
                                    $button_label = 'scegli_immagini';
                                    $field_prefix = "img_hotel";
                                    $urls = array_filter($immagini, function ($img) {
                                        return !empty($img);
                                    });
                                    $multiple = true;
                                    include 'Views/backoffice.images.uploader.php';
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i
                                    class="fa fa-wrench"></i> <?php echo $view_model->translations->get('servizi'); ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php include 'Views/backoffice.services.php'; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                <div class="form-group col-md-12">
                    <div align="left">
                        <input type="submit" class="btn btn-success validate-it"
                               value="<?php echo $view_model->translations->get('salva'); ?>">
                    </div>
                    <hr/>
                    <br/><br/>
                </div>
            </div>
        </div>
    </div>
</form>