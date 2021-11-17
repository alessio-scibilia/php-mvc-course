<form action="/backoffice/hotels/add?XDEBUG_SESSION_START"
      method="POST"
      enctype="multipart/form-data">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-start mb15">
                <a href="/backoffice/hotels" id="gobacksearch" class="open-view-action-inside back-btn"><i
                            class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('gestione_hotels'); ?>
                    /</a>
                <h1><i class="fa fa-building-o"></i> <?php echo $view_model->translations->get('crea_nuovo_hotel'); ?>
                </h1>
            </div>
            <div class="col-xl-12 col-lg-12">
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
                                           id="nome"
                                           class="form-control validate-hotel" placeholder="London Hotel">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('email'); ?></label>
                                    <input name="email"
                                           type="text"
                                           id="email"
                                           class="form-control validate-hotel" placeholder="mario@rossi.it">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                    <input type="text"
                                           name="sito_web"
                                           class="form-control validate-hotel"
                                           id="sito"
                                           placeholder="www.hotelsuperlondon.co.uk">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                    <input type="text"
                                           name="telefono"
                                           class="form-control validate-hotel"
                                           id="telefono"
                                           placeholder="020483039">
                                </div>

                                <?php include 'Views/backoffice.geolocator.php'; ?>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('password'); ?></label>
                                    <input type="password"
                                           name="password"
                                           autocomplete="new-password"
                                           id="password"
                                           class="form-control">
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('conferma_password'); ?></label>
                                    <input type="password"
                                           autocomplete="new-password"
                                           id="conferma_password"
                                           class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                    <?php
                                    $label = 'abilitato';
                                    $field = 'abilitato';
                                    include 'Views/backoffice.checkbox.php';
                                    ?>
                                </div>

                                <div class="form-group col-md-12">
                                    <?php
                                    $label = 'hotel_pro';
                                    $field = 'level';
                                    $field_prefix = 'level';
                                    include 'Views/backoffice.checkbox.php';
                                    ?>
                                </div>

                                <div class="form-group col-md-12">
                                    <?php
                                    $label = 'descrizione_ospiti';
                                    $field = 'descrizione_ospiti';
                                    $field_prefix = 'descrizione_ospiti';
                                    $items = array();
                                    include 'Views/backoffice.multilanguage.textbox.php';
                                    ?>
                                </div>

                                <?php
                                $label = 'immagini_hotel';
                                $button_label = 'scegli_immagini';
                                $field_prefix = "img_hotel";
                                $urls = array();
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i
                                    class="fa fa-wrench"></i> <?php echo $view_model->translations->get('utility'); ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php include 'Views/backoffice.utilities.php'; ?>
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