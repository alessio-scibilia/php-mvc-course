<div class="basic-form">
    <input type="hidden" id="num_utilities"
           value="<?php if (isset($view_model->utilities)) echo sizeof($view_model->utilities); else echo 1; ?>">
    <?php
    $r = 0;
    if (isset($view_model->utilities)) {
        foreach ($view_model->utilities as &$utility) {
            $r++;
            $c = $r - 1;
            //$group = array_values($service);
            $principal = $utility[$view_model->language['shortcode_lingua']];
            ?>
            <div style="display: block;" class="form-container fc-<?php echo $r; ?>">
                <input type="hidden" name="posizione_utility[<?php echo $r; ?>]" value="<?php echo $principal->posizione; ?>">
                <div class="form-row">
                    <div class="col-12">
                        <h5><?php echo $view_model->translations->get('numeri_utili'); ?></h5>
                    </div>

                    <div class="form-group col-md-4">
                        <?php
                        $type = 'input';
                        $label = 'nome_utility';
                        $placeholder = 'Reception';
                        $field = 'nome_utility';
                        $field_prefix = "nome_utility[$r]";
                        //$items = array_merge(...$group);
                        $items = array_values($utility);
                        include 'Views/backoffice.multilanguage.textbox.php';
                        ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telefono"><?php echo $view_model->translations->get('telefono'); ?></label>
                        <input type="text" name="telefono_utility" value="<?php echo $utility[$r]->telefono_utility; ?>"
                               id="telefono"
                               class="form-control" placeholder="118">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="telefono"><?php echo $view_model->translations->get('indirizzo'); ?></label>
                        <input type="text" name="indirizzo_utility" id="indirizzo"
                               value="<?php echo $utility[$r]->indirizzo_utility; ?>" class="form-control"
                               placeholder="Via Roma 108, Milano (MI)">
                    </div>

                    <?php
                    $label = 'immagine_utility';
                    $button_label = 'immagine_utility';
                    $field_prefix = "img_utility[$r]";
                    $urls = empty($principal->immagine) ? array() : array($principal->immagine);
                    $multiple = false;
                    include 'Views/backoffice.images.uploader.php';
                    ?>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="button"
                               class="btn btn-danger annulla-utility"
                               id="utility-<?php echo $r; ?>"
                               data-num="#num_utilities"
                               value="Elimina utility">
                    </div>
                    <div class="form-group col-md-12">
                        <hr/>
                        <input type="button"
                               class="btn btn-success save-utility"
                               data-num="#num_utilities"
                               value="Aggiungi un'altra utility">
                    </div>

                </div>
            </div>
        <?php }
    } else { ?>
        <div style="display: block;" class="form-container fc-1">
            <input type="hidden" name="posizione_utility[1]" value="1">
            <div class="form-row">
                <div class="col-12">
                    <h5><?php echo $view_model->translations->get('datu_utility'); ?></h5>
                </div>

                <div class="form-group col-md-4">
                    <?php
                    $type = 'input';
                    $label = 'nome_utility';
                    $placeholder = 'Es. Numero di emergenza, Reception';
                    $field = 'nome_utility';
                    $field_prefix = "nome_utility[1]";
                    //$items = array_merge(...$group);
                    $items = array();
                    include 'Views/backoffice.multilanguage.textbox.php';
                    ?>
                </div>

                <div class="form-group col-md-4">
                    <label for="telefono"><?php echo $view_model->translations->get('telefono'); ?></label>
                    <input type="text" name="telefono_utility" class="form-control" placeholder="118">
                </div>
                <div class="form-group col-md-4">
                    <label for="telefono"><?php echo $view_model->translations->get('indirizzo'); ?></label>
                    <input type="text" name="indirizzo_utility" class="form-control" placeholder="Via roma 24, Roma">
                </div>

                <?php
                $label = 'immagine_utility';
                $button_label = 'immagine_utility';
                $field_prefix = "immagine_utility[$r]";
                $urls = empty($principal->immagine) ? array() : array($principal->immagine);
                $multiple = false;
                include 'Views/backoffice.images.uploader.php';
                ?>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="button"
                           class="btn btn-danger annulla-utility"
                           id="utility-1"
                           data-num="#num_utilities"
                           value="Elimina utility">
                </div>
                <div class="form-group col-md-12">
                    <hr/>
                    <input type="button"
                           class="btn btn-success save-utility"
                           data-num="#num_utilities"
                           value="Aggiungi un'altra utility">
                </div>
            </div>
        </div>
    <?php } ?>
</div>

