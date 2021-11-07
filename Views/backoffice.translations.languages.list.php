<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1><i class="fa fa-language"></i> <?php echo $view_model->translations->get('gestione_lingue'); ?></h1>
            <a class="btn btn-primary open-view-action-inside mb10"
               data-action="<?php echo $view_model->translations->get('link_traduzioni'); ?>"
               data-params="<?php echo $view_model->translations->get('params_nuova_lingua'); ?>"
               href="/backoffice/translations/languages/new">
                <i class="fa fa-plus"></i> <?php echo $view_model->translations->get('crea_nuova_lingua'); ?>
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('lingue_create'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 100%">
                            <thead>
                            <?php if ($view_model->user->level == 0) { ?>
                                <th>ID</th>
                            <?php } ?>
                            <th><?php echo $view_model->translations->get('form_nome_lingua'); ?></th>
                            <th><?php echo $view_model->translations->get('form_abbreviazione_lingua'); ?></th>
                            <th>Shortcode</th>
                            <th><?php echo $view_model->translations->get('abilita'); ?></th>
                            <th><?php echo $view_model->translations->get('azioni'); ?></th>
                            </thead>
                            <tbody>
                            <?php
                            $lista_lingue = $view_model->languages->list_all();
                            for ($i = 0; $i < sizeof($lista_lingue); $i++) {
                                if ($view_model->user->level == 0) {
                                    echo '<tr>';
                                    echo '<td>' . $lista_lingue[$i]['id'] . '</td>';
                                    echo '<td>' . $lista_lingue[$i]['nome_lingua'] . '</td>';
                                    echo '<td>' . $lista_lingue[$i]['abbreviazione'] . '</td>';
                                    echo '<td>' . $lista_lingue[$i]['shortcode_lingua'] . '</td>';
                                    if ($lista_lingue[$i]['abilitata'] == 1)
                                        echo '<td><input type="checkbox"  id="" class="enable-language enable" checked="checked" "></td>';
                                    else
                                        echo '<td><input type="checkbox" class="enable-language enable"></td>';
                                    echo '<td>
                                                   <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside"><i class="fa fa-pencil"></i></a>
                                                       <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delLang"><i class="fa fa-trash"></i></a>    
                                                    </td>';
                                } else if ($_SESSION['level'] == 1) {
                                    echo '<tr>';
                                    echo '<td>' . $lista_lingue[$i]['nome_lingua'] . '</td>';
                                    echo '<td>' . $lista_lingue[$i]['abbreviazione'] . '</td>';
                                    echo '<td>' . $lista_lingue[$i]['shortcode_lingua'] . '</td>';
                                    if ($lista_lingue[$i]['abilitata'] == 1)
                                        echo '<td><input type="checkbox"  class="enable-language enable" checked="checked" value="' . $lista_lingue[$i]['shortcode_lingua'] . '"></td>';
                                    else
                                        echo '<td><input type="checkbox" class="enable-language enable" value="' . $lista_lingue[$i]['shortcode_lingua'] . '"></td>';
                                    echo '<td>
                                                       <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" ><i class="fa fa-pencil"></i></a>
                                                       <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delLang"  ><i class="fa fa-trash"></i></a>    
                                                    </td>';

                                } else echo 'Errore';

                            } ?>


                            </tbody>
                            <tfoot>
                            <tr>
                                <?php if ($view_model->user->level == 0) { ?>
                                    <th>ID</th>
                                <?php } ?>
                                <th><?php echo $view_model->translations->get('form_nome_lingua'); ?></th>
                                <th><?php echo $view_model->translations->get('form_abbreviazione_lingua'); ?></th>
                                <th>Shortcode</th>
                                <th><?php echo $view_model->translations->get('abilita'); ?></th>
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