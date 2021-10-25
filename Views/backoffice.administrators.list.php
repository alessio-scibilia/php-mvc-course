<?php


if ($view_model->user->level <= 2) {

    $lista_utenti = array();

    $params = json_decode(stripslashes($_POST['parameters']));
    $search_val = '';

    if (!isset($params[1])) { ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between mb15">
                    <h1>
                        <i class="fa fa-users"></i> <?php echo $view_model->translations->get('gestione_amministratori'); ?>
                    </h1>

                    <a class="btn btn-primary open-view-action-inside mb10" data-toggle="tab"
                       data-title="<?php echo $view_model->translations->get('gestione_amministratori'); ?>"
                       data-action="<?php echo $view_model->translations->get('link_amministratori'); ?>"
                       data-params="<?php echo $view_model->translations->get('nuovo_params'); ?>" href="#apps">
                        <i class="fa fa-plus"></i> <?php echo $view_model->translations->get('crea_nuovo_amministratore'); ?>
                    </a>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo $view_model->translations->get('lista_utenti_amministratori'); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 100%">
                                    <thead>
                                    <tr>
                                        <?php if ($view_model->user->level == 0) { ?>
                                            <th>ID</th>
                                        <?php } ?>
                                        <th><?php echo $view_model->translations->get('nome'); ?></th>
                                        <th><?php echo $view_model->translations->get('email'); ?></th>
                                        <th><?php echo $view_model->translations->get('livello'); ?></th>
                                        <th><?php echo $view_model->translations->get('abilita'); ?></th>
                                        <th><?php echo $view_model->translations->get('azioni'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    for ($i = 0; $i < sizeof($lista_utenti); $i++) {
                                        if ($view_model->user->level == 0) {
                                            echo '<tr>';
                                            echo '<td>' . $lista_utenti[$i]['id'] . '</td>';
                                            echo '<td>' . $lista_utenti[$i]['nome'] . '</td>';
                                            echo '<td>' . $lista_utenti[$i]['email'] . '</td>';
                                            echo '<td>' . $lista_utenti[$i]['livello'] . ' | ' . getLevelText($lista_utenti[$i]['livello']) . '</td>';


                                            if ($lista_utenti[$i]['abilitato'] == 1)
                                                echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $view_model->translations->get('modifiche_salvate') . '" data-fail="' . $view_model->translations->get('errore_salvataggio') . '" checked="checked" value="' . $lista_utenti[$i]['id'] . '"></td>';
                                            else
                                                echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $view_model->translations->get('modifiche_salvate') . '" data-fail="' . $view_model->translations->get('errore_salvataggio') . '"  value="' . $lista_utenti[$i]['id'] . '"></td>';


                                            echo '<td>
                                                       <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $view_model->translations->get('link_amministratori') . '" data-title="teo" data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                       <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delAdmin" data-success="' . $view_model->translations->get('modifiche_salvate') . '" data-failure="' . $view_model->translations->get('errore_salvataggio') . '"  data-stay="true" data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                    </td>';
                                        } else if ($view_model->user->level == 1) {
                                            if ($lista_utenti[$i]['livello'] != 0) {
                                                echo '<tr>';
                                                echo '<td>' . $lista_utenti[$i]['nome'] . '</td>';
                                                echo '<td>' . $lista_utenti[$i]['email'] . '</td>';
                                                echo '<td>' . $lista_utenti[$i]['livello'] . ' | ' . getLevelText($lista_utenti[$i]['livello']) . '</td>';
                                                if ($lista_utenti[$i]['abilitato'] == 1)
                                                    echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $view_model->translations->get('modifiche_salvate') . '" data-fail="' . $view_model->translations->get('errore_salvataggio') . '" checked="checked" value="' . $lista_utenti[$i]['id'] . '"></td>';
                                                else
                                                    echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $view_model->translations->get('modifiche_salvate') . '" data-fail="' . $view_model->translations->get('errore_salvataggio') . '"  value="' . $lista_utenti[$i]['id'] . '"></td>';
                                                echo '<td>
                                                           <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $view_model->translations->get('link_amministratori') . '" data-title="teo" data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                           <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delAdmin" data-success="' . $view_model->translations->get('modifiche_salvate') . '" data-failure="' . $view_model->translations->get('errore_salvataggio') . '"   data-stay="true" data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                    </td>';
                                            }

                                        } else if ($view_model->user->level == 2) {
                                            if ($lista_utenti[$i]['livello'] != 0 && $lista_utenti[$i]['livello'] != 1) {
                                                echo '<tr>';
                                                echo '<td>' . $lista_utenti[$i]['nome'] . '</td>';
                                                echo '<td>' . $lista_utenti[$i]['email'] . '</td>';
                                                echo '<td>' . $lista_utenti[$i]['livello'] . ' | ' . getLevelText($lista_utenti[$i]['livello']) . '</td>';
                                                if ($lista_utenti[$i]['abilitato'] == 1)
                                                    echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $view_model->translations->get('modifiche_salvate') . '" data-fail="' . $view_model->translations->get('errore_salvataggio') . '" checked="checked" value="' . $lista_utenti[$i]['id'] . '"></td>';
                                                else
                                                    echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $view_model->translations->get('modifiche_salvate') . '" data-fail="' . $view_model->translations->get('errore_salvataggio') . '"  value="' . $lista_utenti[$i]['id'] . '"></td>';
                                                echo '<td>
                                                           <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $view_model->translations->get('link_amministratori') . '" data-title="teo" data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                           <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delAdmin" data-success="' . $view_model->translations->get('modifiche_salvate') . '" data-failure="' . $view_model->translations->get('errore_salvataggio') . '"   data-stay="true"  data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                    </td>';
                                            }
                                        } else echo 'Errore';

                                    } ?>


                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <?php if ($view_model->user->level == 0) { ?>
                                            <th>ID</th>
                                        <?php } ?>
                                        <th><?php echo $view_model->translations->get('nome'); ?></th>
                                        <th><?php echo $view_model->translations->get('email'); ?></th>
                                        <th><?php echo $view_model->translations->get('livello'); ?></th>
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
        <script src="./js/custom.min.js"></script>
        <!-- Datatable -->
        <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script>
            (function ($) {
                "use strict"
                //example 1
                var table = $('#example').DataTable({
                    "language": {
                        "lengthMenu": "Display _MENU_ records per page",
                        "paginate": {
                            "first": "Primo",
                            "last": "Ulimo",
                            "next": "<?php echo $view_model->translations->get('successiva');?>",
                            "previous": "<?php echo $view_model->translations->get('precedente');?>"
                        },
                        "zeroRecords": "Nessun risultato",
                        "info": "<?php echo $view_model->translations->get('pagina');?> _PAGE_ <?php echo $view_model->translations->get('di');?> _PAGES_",
                        "infoEmpty": "",
                        "emptyTable": "",
                        "thousands": ",",
                        "lengthMenu": "<?php echo $view_model->translations->get('mostra');?> _MENU_ <?php echo $view_model->translations->get('risultati_per_volta');?>",
                        "loadingRecords": "Caricamento...",
                        "processing": "Caricamento...",
                        "search": "<?php echo $view_model->translations->get('cerca');?>: ",
                        "zeroRecords": "Nessuna dato trovato",
                        "aria": {
                            "sortAscending": ": In ordine crescente",
                            "sortDescending": ": In ordine decrescente"
                        }
                    },
                    createdRow: function (row, data, index) {
                        $(row).addClass('selected')
                    }
                });
                table.on('click', 'tbody tr', function () {
                    var $row = table.row(this).nodes().to$();
                    var hasClass = $row.hasClass('selected');
                    if (hasClass) {
                        $row.removeClass('selected')
                    } else {
                        $row.addClass('selected')
                    }
                })

                table.rows().every(function () {
                    this.nodes().to$().removeClass('selected')
                });


            })(jQuery);

        </script>
    <?php }

} else echo '<div class="nm-error pt15 pb15 pl10 pr10">Access denied</div>';
include 'Views/backoffice.ajax.js.php';
?>