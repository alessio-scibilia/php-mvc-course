<div class="container-fluid">
<div class="row">
    <form action="/backoffice/facilities/<?php echo $view_model->principal->related_id; ?>/edit<?php include 'Views/xdebug.querystring.first.php'; ?>"
          method="post" enctype="multipart/form-data">

        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <a href="/backoffice/facilities" id="gobacksearch" class="open-view-action-inside back-btn"><i
                        class="fa fa-angle-left"></i> <?php echo $view_model->translations->get('gestione_strutture'); ?>
                /</a>
            <h1><i class="fa fa-building"></i> <?php echo $view_model->translations->get('modifica_struttura'); ?></h1>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('dati_struttura'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-row">
                            <?php if ($view_model->user->level <= 2) { ?>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('hotel_associati'); ?></label>
                                    <select class="selectpicker" data-live-search="true" id="hotel_associati"
                                            data-name="related_hotels">
                                        <option disabled selected>Seleziona...</option>
                                        <?php foreach ($view_model->hotels as &$hotel) { ?>
                                            <option value="<?php echo $hotel->id; ?>"
                                                    data-tokens="<?php echo $hotel->nome . ' ' . $hotel->email . ' ' . $hotel->indirizzo; ?>"><?php echo $hotel->nome; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="relatedHotels" class="form-group col-md-6">
                                    <?php foreach ($view_model->related_hotels as $related_hotel) { ?>
                                        <a href="javascript:void()"
                                           class="tagit2 relHot isRelatedToShow-<?php echo $related_hotel->id_hotel; ?>"
                                           onclick="removeRelatedHotel(<?php echo $related_hotel->id_hotel; ?>)"
                                           id="<?php echo $related_hotel->id_hotel; ?>"><?php echo $related_hotel->nome; ?>
                                            <i class="fa fa-close"></i>
                                        </a>
                                        <input type="hidden" name="related_hotels[]" value="<?php echo $related_hotel->id_hotel; ?>" />
                                    <?php } ?>
                                </div>

                                <div class="form-group col-md-6">
                                    <label><?php echo $view_model->translations->get('categorie_associate'); ?></label>
                                    <select class="selectpicker1" data-live-search="true" id="hotel_associati"
                                            data-name="related_categories">
                                        <option disabled selected>Seleziona...</option>
                                        <?php foreach ($view_model->categories as &$category) { ?>
                                            <option value="<?php echo $category->id; ?>"
                                                    data-tokens="<?php echo $category->nome; ?>"><?php echo $category->nome; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="relatedCat" class="form-group col-md-6">
                                    <?php foreach ($view_model->related_categories as $related_category) { ?>
                                        <a href="javascript:void()"
                                           class="tagit2 relHot isRelatedToShow-<?php echo $related_category->related_id; ?>"
                                           onclick="removeRelatedHotel(<?php echo $related_category->related_id; ?>)"
                                           id="<?php echo $related_category->related_id; ?>"><?php echo $related_category->nome; ?>
                                            <i class="fa fa-close"></i>
                                        </a>
                                        <input type="hidden" name="related_categories[]" value="<?php echo $related_category->related_id; ?>" />
                                    <?php } ?>
                                </div>

                            <?php } ?>

                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('nome_struttura'); ?></label>
                                <input value="<?php echo $view_model->principal->nome_struttura; ?>"
                                       name="nome_struttura"
                                       type="text"
                                       class="form-control validate-1"
                                       placeholder="London Hotel">
                            </div>

                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('email'); ?></label>
                                <input value="<?php echo $view_model->principal->email; ?>"
                                       name="email"
                                       type="text"
                                       class="form-control validate-1"
                                       placeholder="mario@rossi.it">
                            </div>

                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('sito_web'); ?></label>
                                <input value="<?php echo $view_model->principal->sito_web; ?>"
                                       type="text"
                                       class="form-control validate-1"
                                       name="sito_web"
                                       placeholder="www.hotelsuperlondon.co.uk">
                            </div>

                            <div class="form-group col-md-6">
                                <label><?php echo $view_model->translations->get('telefono'); ?></label>
                                <input value="<?php echo $view_model->principal->telefono; ?>"
                                       type="text"
                                       class="form-control validate-1"
                                       name="telefono"
                                       placeholder="020483039">
                            </div>

                            <div class="form-group col-md-12">
                                <?php
                                $label = 'abilitato';
                                $field = 'abilitata';
                                $value = $view_model->principal->abilitata;
                                include 'Views/backoffice.checkbox.php';
                                ?>
                            </div>

                            <div class="form-group col-md-12">
                                <?php
                                $label = 'indicizza';
                                $field = 'indicizza';
                                $value = $view_model->principal->indicizza;
                                include 'Views/backoffice.checkbox.php';
                                ?>
                            </div>

                            <div class="form-group col-md-12">
                                <?php
                                $label = 'convenzionato';
                                $field = 'convenzionato';
                                $value = $view_model->principal->convenzionato;
                                include 'Views/backoffice.checkbox.php';
                                ?>
                            </div>

                            <?php $model = $view_model->principal;
                            include 'Views/backoffice.geolocator.php'; ?>

                            <div class="form-group col-md-4">
                                <label><?php echo $view_model->translations->get('tipo_viaggio'); ?></label>
                                <div class="route-container">
                                    <div class="route-div"><input
                                                type="radio" <?php if ($view_model->principal->tipo_viaggio == 1) echo 'checked="checked"'; ?>
                                                name="tipo_viaggio" class="tipo_viaggio" value="1">
                                        <img src="/images/walking.svg" class="svg-route"/>
                                        <span for="tipo_viaggio"
                                              class="route-span">A piedi</span>
                                    </div>
                                    <div class="route-div"><input
                                                type="radio" <?php if ($view_model->principal->tipo_viaggio == 2) echo 'checked="checked"'; ?>
                                                name="tipo_viaggio" class="tipo_viaggio" value="2">
                                        <img src="/images/car.svg" class="svg-route"/>
                                        <span for="tipo_viaggio"
                                              class="route-span">In auto</span>
                                    </div>
                                    <div class="route-div"><input
                                                type="radio" <?php if ($view_model->principal->tipo_viaggio == 3) echo 'checked="checked"'; ?>
                                                name="tipo_viaggio" class="tipo_viaggio" value="3">
                                        <img src="/images/mezzi.svg" class="svg-route"/>
                                        <span for="tipo_viaggio"
                                              class="route-span">Trasporti pubblici</span>
                                    </div>
                                </div>
                            </div>

                            <?php
                                $images = empty($view_model->principal->immagine_didascalia) ? array() : explode('|', $view_model->principal->immagine_didascalia);
                                $label = 'immagini_struttura';
                                $button_label = 'scegli_immagini';
                                $field_prefix = "img_struttura";
                                $urls = array_filter($images, function ($img) { return !empty($img); });
                                $tips = false;
                                $multiple = true;
                                include 'Views/backoffice.images.uploader.php';
                            ?>

                            <div class="form-group col-md-12">
                                <?php
                                    $label = 'descrizione';
                                    $field = 'descrizione';
                                    $field_prefix = 'descrizione';
                                    $items = $view_model->facilities;
                                    include 'Views/backoffice.multilanguage.textbox.php';
                                ?>
                            </div>

                            <?php if ($view_model->user->level > 2) { ?>
                                <div class="form-group col-md-12">
                                    <?php
                                        $label = 'descrizione_benefit';
                                        $field = 'descrizione_benefit';
                                        $field_prefix = 'descrizione_benefit';
                                        $items = $view_model->facilities;
                                        include 'Views/backoffice.multilanguage.textbox.php';
                                    ?>
                                </div>
                            <?php } ?>

                            <div class="form-group col-md-12">
                                <div class="form-group col-md-12">
                                    <?php
                                        $flag_field_prefix = "orario_continuato";
                                        $day_field_prefix = "giorno";
                                        $model = $view_model->principal;
                                        include 'Views/backoffice.timetable.php';
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('eccellenze'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <input type="hidden"
                               id="num_eccellenze"
                               value="<?php echo count($view_model->related_excellences); ?>">
                        <?php
                            foreach ($view_model->related_excellences as $r => $excellences) {
                                $excellence = $excellences[$view_model->language['shortcode_lingua']];
                            ?>
                            <div class="form-eccellenza-container fsc-<?php echo $r; ?>"
                                 id="fsc-eccellenza-<?php echo $r; ?>">
                                <div class="form-row">

                                    <div class="col-12">
                                        <h5><?php echo $view_model->translations->get('dati_eccellenza'); ?></h5>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php
                                            $type = 'input';
                                            $label = 'nome_servizio';
                                            $placeholder = 'Es: Piatti giapponesi';
                                            $field = 'titolo';
                                            $field_prefix = "nome_eccellenza[$r]";
                                            $items = $excellences;
                                            include 'Views/backoffice.multilanguage.textbox.php';
                                        ?>
                                    </div>

                                    <?php
                                        $label = 'immagine_servizio';
                                        $button_label = 'scegli_immagine';
                                        $field_prefix = "img_eccellenza[$r]";
                                        $urls = empty($excellence->immagine) ? array() : array($excellence->immagine);
                                        $multiple = false;
                                        include 'Views/backoffice.images.uploader.php';
                                    ?>

                                    <div class="form-group col-md-12">
                                        <?php
                                            $type = 'richtextbox';
                                            $label = 'descrizione';
                                            $field = 'testo';
                                            $field_prefix = "testo[$r]";
                                            $items = $excellences;
                                            include 'Views/backoffice.multilanguage.textbox.php';
                                        ?>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <?php
                                        $label = 'abilitato';
                                        $field = "abilitato[$r]";
                                        $value = $excellence->abilitato;
                                        include 'Views/backoffice.checkbox.php';
                                        ?>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <input type="button" class="btn btn-danger annulla-eccellenza"
                                               id="eccellenza-<?php echo $r; ?>" value="Elimina eccellenza">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <hr/>
                                        <input type="button" class="btn btn-success save-eccellenza"
                                               value="<?php echo $view_model->translations->get('aggiungi_eccellenza'); ?>">
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('sec_esplorato_per_voi'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">

                        <div class="form-didascalia-container dds-1" id="fsc-didascalia-1">
                            <div class="form-row">

                                <?php
                                    $label = 'immagini_didascalia';
                                    $button_label = 'scegli_immagini';
                                    $field_prefix = 'img_didascalia';
                                    $urls = empty($view_model->principal->real_immagini_didascalia) ? array() : explode('|', $view_model->principal->real_immagini_didascalia);
                                    $tips = $view_model->tips;
                                    $multiple = true;
                                    include 'Views/backoffice.images.uploader.php';
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                <div class="form-group col-md-12">
                    <div align="left">
                        <input type="submit"
                               class="btn btn-success validate-it"
                               data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                               data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                               value="<?php echo $view_model->translations->get('aggiorna_struttura'); ?>">
                    </div>
                    <br/><br/>
                </div>
            </div>
        </div>

    </form>
</div>
</div>
