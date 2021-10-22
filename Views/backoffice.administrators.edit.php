<?php


if ($view_model->user->level <= 2) {

    $lista_utenti = array();

    $params = json_decode(stripslashes($_POST['parameters']));
    $search_val = '';

    if (!isset($params[1])) { ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-between mb15">
                    <h1><i class="fa fa-users"></i> <?php echo $langs['gestione_amministratori']; ?></h1>

                    <a class="btn btn-primary open-view-action-inside mb10" data-toggle="tab"
                       data-title="<?php echo $langs['gestione_amministratori']; ?>"
                       data-action="<?php echo $langs['link_amministratori']; ?>"
                       data-params="<?php echo $langs['nuovo_params']; ?>" href="#apps">
                        <i class="fa fa-plus"></i> <?php echo $langs['crea_nuovo_amministratore']; ?>
                    </a>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo $langs['lista_utenti_amministratori']; ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 100%">
                                    <thead>
                                    <tr>
                                        <?php if ($_SESSION['level'] == 0) { ?>
                                            <th>ID</th>
                                        <?php } ?>
                                        <th><?php echo $langs['nome']; ?></th>
                                        <th><?php echo $langs['email']; ?></th>
                                        <th><?php echo $langs['livello']; ?></th>
                                        <th><?php echo $langs['abilita']; ?></th>
                                        <th><?php echo $langs['azioni']; ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    for ($i = 0; $i < sizeof($lista_utenti); $i++) {
                                        if ($_SESSION['level'] == 0) {
                                            echo '<tr>';
                                            echo '<td>' . $lista_utenti[$i]['id'] . '</td>';
                                            echo '<td>' . $lista_utenti[$i]['nome'] . '</td>';
                                            echo '<td>' . $lista_utenti[$i]['email'] . '</td>';
                                            echo '<td>' . $lista_utenti[$i]['livello'] . ' | ' . getLevelText($lista_utenti[$i]['livello']) . '</td>';


                                            if ($lista_utenti[$i]['abilitato'] == 1)
                                                echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '" checked="checked" value="' . $lista_utenti[$i]['id'] . '"></td>';
                                            else
                                                echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '"  value="' . $lista_utenti[$i]['id'] . '"></td>';


                                            echo '<td>
                                                       <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['link_amministratori'] . '" data-title="teo" data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                       <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delAdmin" data-success="' . $langs['modifiche_salvate'] . '" data-failure="' . $langs['errore_salvataggio'] . '"  data-stay="true" data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                    </td>';
                                        } else if ($_SESSION['level'] == 1) {
                                            if ($lista_utenti[$i]['livello'] != 0) {
                                                echo '<tr>';
                                                echo '<td>' . $lista_utenti[$i]['nome'] . '</td>';
                                                echo '<td>' . $lista_utenti[$i]['email'] . '</td>';
                                                echo '<td>' . $lista_utenti[$i]['livello'] . ' | ' . getLevelText($lista_utenti[$i]['livello']) . '</td>';
                                                if ($lista_utenti[$i]['abilitato'] == 1)
                                                    echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '" checked="checked" value="' . $lista_utenti[$i]['id'] . '"></td>';
                                                else
                                                    echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '"  value="' . $lista_utenti[$i]['id'] . '"></td>';
                                                echo '<td>
                                                           <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['link_amministratori'] . '" data-title="teo" data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                           <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delAdmin" data-success="' . $langs['modifiche_salvate'] . '" data-failure="' . $langs['errore_salvataggio'] . '"   data-stay="true" data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                    </td>';
                                            }

                                        } else if ($_SESSION['level'] == 2) {
                                            if ($lista_utenti[$i]['livello'] != 0 && $lista_utenti[$i]['livello'] != 1) {
                                                echo '<tr>';
                                                echo '<td>' . $lista_utenti[$i]['nome'] . '</td>';
                                                echo '<td>' . $lista_utenti[$i]['email'] . '</td>';
                                                echo '<td>' . $lista_utenti[$i]['livello'] . ' | ' . getLevelText($lista_utenti[$i]['livello']) . '</td>';
                                                if ($lista_utenti[$i]['abilitato'] == 1)
                                                    echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '" checked="checked" value="' . $lista_utenti[$i]['id'] . '"></td>';
                                                else
                                                    echo '<td><input type="checkbox" id="" class="enable-admin enable" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '"  value="' . $lista_utenti[$i]['id'] . '"></td>';
                                                echo '<td>
                                                           <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['link_amministratori'] . '" data-title="teo" data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                           <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delAdmin" data-success="' . $langs['modifiche_salvate'] . '" data-failure="' . $langs['errore_salvataggio'] . '"   data-stay="true"  data-params="' . $lista_utenti[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                    </td>';
                                            }
                                        } else echo 'Errore';

                                    } ?>


                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <?php if ($_SESSION['level'] == 0) { ?>
                                            <th>ID</th>
                                        <?php } ?>
                                        <th><?php echo $langs['nome']; ?></th>
                                        <th><?php echo $langs['email']; ?></th>
                                        <th><?php echo $langs['livello']; ?></th>
                                        <th><?php echo $langs['abilita']; ?></th>
                                        <th><?php echo $langs['azioni']; ?></th>
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
                            "next": "<?php echo $langs['successiva'];?>",
                            "previous": "<?php echo $langs['precedente'];?>"
                        },
                        "zeroRecords": "Nessun risultato",
                        "info": "<?php echo $langs['pagina'];?> _PAGE_ <?php echo $langs['di'];?> _PAGES_",
                        "infoEmpty": "",
                        "emptyTable": "",
                        "thousands": ",",
                        "lengthMenu": "<?php echo $langs['mostra'];?> _MENU_ <?php echo $langs['risultati_per_volta'];?>",
                        "loadingRecords": "Caricamento...",
                        "processing": "Caricamento...",
                        "search": "<?php echo $langs['cerca'];?>: ",
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

        </script> <?php }
}
} else
echo '<div class="nm-error pt15 pb15 pl10 pr10">Access denied</div>';
include($GLOBALS['where_path'] . 'includes/script.php');
?>