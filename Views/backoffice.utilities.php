<div class="basic-form">
    <input type="hidden" id="num_utilities"
           value="<?php if (isset($view_model->utilities)) echo sizeof($view_model->utilities); else echo 1; ?>">
    <?php
    if (isset($view_model->utilities))
    {
        $shortcode_lingua = $view_model->language['shortcode_lingua'];
        $r = 0;
        foreach ($view_model->utilities as &$utility)
        {
            //$group = array_values($service);
            $principal = $utility[$shortcode_lingua];
            ?>
            <div style="display: block;" class="form-container fc-<?php echo $r; ?>">
                <input type="hidden" name="posizione_utility[<?php echo $r; ?>]"
                       value="<?php echo $r; ?>">
                <div class="form-row">
                    <div class="col-12">
                        <h5><?php echo $view_model->translations->get('numeri_utili'); ?></h5>
                    </div>

                    <div class="form-group col-md-6">
                        <?php
                            $type = 'input';
                            $label = 'nome_utility';
                            $field = 'nome_utility';
                            $field_prefix = "nome_utility[$r]";
                            $placeholder = 'Reception';
                            //$items = array_merge(...$group);
                            $items = array_values($utility);
                            include 'Views/backoffice.multilanguage.textbox.php';
                        ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telefono-<?php echo $r; ?>"><?php echo $view_model->translations->get('telefono'); ?></label>
                        <input type="text"
                               name="telefono_utility[<?php echo $r; ?>]"
                               value="<?php echo $principal->telefono_utility; ?>"
                               id="telefono-<?php echo $r; ?>"
                               class="form-control"
                               placeholder="118">
                    </div>

                    <?php
                        $model = (object)array
                        (
                            'indirizzo' => $principal->indirizzo_utility,
                            'latitudine' => '44.363',
                            'longitudine' => '8.044',
                        );
                        $field_suffix = "_utility[$r]";
                        include 'Views/backoffice.geolocator.php';
                    ?>

                    <?php
                        $label = 'immagine_utility';
                        $button_label = 'immagine_utility';
                        $field_prefix = "img_utility[$r]";
                        $urls = empty($principal->immagine_utility) ? array() : array($principal->immagine_utility);
                        $multiple = false;
                        include 'Views/backoffice.images.uploader.php';
                    ?>

                    <div class="form-group col-md-12">
                        <?php
                            $label = 'descrizione_utility';
                            $field = 'descrizione_utility';
                            $field_prefix = "descrizione_utility[$r]";
                            $placeholder = $view_model->translations->get('descrizione_utility');;
                            $items = array_values($utility);
                            include 'Views/backoffice.multilanguage.textbox.php';
                        ?>
                    </div>

                </div>

                <div class="form-row">
                    <div class="my-2 mr-4">
                        <input type="button"
                               class="btn btn-danger annulla-utility"
                               id="utility-del<?php echo $r; ?>"
                               data-num="#num_utilities"
                               value="Elimina utility">
                    </div>
                    <div class="my-2">
                        <input type="button"
                               class="btn btn-success save-utility"
                               id="utility-add<?php echo $r; ?>"
                               data-num="#num_utilities"
                               value="Aggiungi un'altra utility">
                    </div>
                    <hr/>
                </div>
            </div>
        <?php
            $r++;
        }
    } else { ?>
        <div style="display: block;" class="form-container fc-1">
            <input type="hidden" name="posizione_utility[0]" value="0">
            <div class="form-row">
                <div class="col-12">
                    <h5><?php echo $view_model->translations->get('dati_utility'); ?></h5>
                </div>

                <div class="form-group col-md-6">
                    <?php
                        $type = 'input';
                        $label = 'nome_utility';
                        $field = 'nome_utility';
                        $field_prefix = "nome_utility[0]";
                        $placeholder = 'Es. Numero di emergenza, Reception';
                        //$items = array_merge(...$group);
                        $items = array();
                        include 'Views/backoffice.multilanguage.textbox.php';
                    ?>
                </div>

                <div class="form-group col-md-6">
                    <label for="telefono-0"><?php echo $view_model->translations->get('telefono'); ?></label>
                    <input type="text"
                           name="telefono_utility[0]"
                           class="form-control"
                           placeholder="118"
                           id="telefono-0">
                </div>

                <?php
                    $model = (object)array
                    (
                        'indirizzo' => '',
                        'latitudine' => '44.363',
                        'longitudine' => '8.044',
                    );
                    $field_suffix = "_utility[0]";
                    include 'Views/backoffice.geolocator.php';
                ?>


                <?php
                    $label = 'immagine_utility';
                    $button_label = 'immagine_utility';
                    $field_prefix = "immagine_utility[0]";
                    $urls = array();
                    $multiple = false;
                    include 'Views/backoffice.images.uploader.php';
                ?>

                <div class="form-group col-md-12">
                    <?php
                        $label = 'descrizione_utility';
                        $field = 'descrizione_utility';
                        $field_prefix = "descrizione_utility[0]";
                        $items = array();
                        include 'Views/backoffice.multilanguage.textbox.php';
                    ?>
                </div>
            </div>
            <div class="form-row">
                <div class="my-2 mr-4">
                    <input type="button"
                           class="btn btn-danger annulla-utility"
                           id="utility-del-0"
                           data-num="#num_utilities"
                           value="Elimina utility">
                </div>
                <div class="my-2">
                    <input type="button"
                           class="btn btn-success save-utility"
                           id="utility-add-0"
                           data-num="#num_utilities"
                           value="Aggiungi un'altra utility">
                </div>
                <hr/>
            </div>
        </div>
    <?php } ?>
</div>

