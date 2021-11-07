<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1><i class="fa fa-language"></i> <?php echo $view_model->translations->get('gestione_lingue'); ?></h1>
            <a class="btn btn-primary open-view-action-inside mb10" data-toggle="tab" data-title="testasd"
               data-action="<?php echo $view_model->translations->get('gestione_lingue'); ?>"
               data-params="<?php echo $view_model->translations->get('params_nuova_lingua'); ?>"
               href="#<?php echo $view_model->translations->get('link_traduzioni'); ?>">
                <i class="fa fa-plus"></i> <?php echo $view_model->translations->get('gestione_lingue'); ?>
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><?php echo $view_model->translations->get('lista_traduzioni'); ?>
                        <select class="form-control lang-selector" id="lang-selector"
                                data-action="<?php echo $view_model->translations->get('link_traduzioni'); ?>"
                                data-title="tepds">
                            <?php
                            $lingua_selezionata = $view_model->languages->get_selected();
                            $lingueAll = $view_model->languages->list_all();
                            for ($i = 0; $i < sizeof($lingueAll); $i++) {
                                if ($lingua_selezionata->id == $lingueAll[$i]['shortcode_lingua'])
                                    echo '<option value="' . $lingueAll[$i]['abbreviazione'] . '" selected="selected">' . $lingueAll[$i]['nome_lingua'] . '</option>';
                                else
                                    echo '<option value="' . $lingueAll[$i]['abbreviazione'] . '">' . $lingueAll[$i]['nome_lingua'] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 100%">
                            <thead>
                            <tr>
                                <th>Shortcode</th>
                                <th><?php echo $view_model->translations->get('traduzione'); ?></th>
                                <th><?php echo $view_model->translations->get('azioni'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php /*
                            if ($lista_traduzioni != 'error') {
                                foreach ($lista_traduzioni as $key => $value) {
                                    if (strpos($key, 'param_') !== false || strpos($key, 'link_') !== false || strpos($key, 'nuovo_params') !== false || strpos($key, 'abbreviazione') !== false || strpos($key, 'shortcode_lingua') !== false || strpos($key, 'id_lingua') !== false || strpos($key, 'id') !== false || strpos($key, 'lingua_abilitata') !== false)
                                        echo '<tr style="background-color:#ff6e6e !important;color:#fff;border-radius:3px;">';
                                    else
                                        echo '<tr>';
                                    echo '<td><div class="key-translation-' . $key . '">' . $key . '</div></td>';
                                    echo '<td><div class="value-translation-' . $key . '">' . htmlspecialchars($value) . '</div></td>';
                                    echo '<td>
                                                           <a href="javascript:void()" class="btn btn-primary shadow btn-xs sharp mr-1 open-edit-translation" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '" id="translation-' . $key . '"><i class="fa fa-pencil"></i></a>
                                                        </td>';
                                }
                            }
    */
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Shortcode</th>
                                <th><?php echo $view_model->translations->get('traduzione'); ?></th>
                                <th><?php echo $view_model->translations->get('azioni'); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>