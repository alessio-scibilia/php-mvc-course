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

        </script> <?php } else if ($params[1] == $langs['nuovo_params']) {
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 d-flex align-items-center justify-content-start mb15">
                    <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn"
                       data-action="<?php echo $langs['link_amministratori']; ?>"
                       data-title="<?php echo $langs['gestione_amministratori']; ?>" data-params="false"
                       data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                                class="fa fa-angle-left"></i> <?php echo $langs['gestione_amministratori']; ?> /</a>
                    <h1><i class="fa fa-user"></i> <?php echo $langs['crea_nuovo_amministratore']; ?></h1>
                </div>

                <div class="col-xl-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo $langs['dati_utente']; ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><?php echo $langs['nome']; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control validate-1" id="nome"
                                               placeholder="Mario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><?php echo $langs['cognome']; ?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control validate-1" id="cognome"
                                               placeholder="Rossi">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><?php echo $langs['email']; ?></label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control validate-1" id="email"
                                               placeholder="mario@rossi.it">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><?php echo $langs['livello']; ?></label>
                                    <div class="col-sm-9">
                                        <select name="livello" id="livello" class="form-control validate-1">
                                            <?php if ($_SESSION['level'] == 0) { ?>
                                                <option value="0">Dev</option>
                                            <?php } ?>
                                            <?php if ($_SESSION['level'] <= 1) { ?>
                                                <option value="1">Superadmin</option>
                                            <?php } ?>
                                            <option value="2">Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"><?php echo $langs['password']; ?></label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control validate-1" id="password"
                                               placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-success validate-it" id="validate-1"
                                                data-params="false"
                                                data-callback="<?php echo strtolower($langs['amministratori']); ?>"
                                                data-success="<?php echo $langs['utente_creato_successo']; ?>"
                                                data-failure="<?php echo $langs['errore_salvataggio']; ?>"
                                                data-function="addAdmin"><?php echo $langs['crea_utente']; ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    <?php } else {
        $user_info = getUserInfo($dbh, $params[1]);
        if ($user_info == 'error') { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="alert alert-danger">Impossibile trovare l'utente selezionato</div>
                    </div>
                </div>
            </div>
        <?php } else { ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-start mb15">
                        <a href="javascript:void()" id="gobacksearch" class="open-view-action-inside back-btn"
                           data-action="<?php echo $langs['link_amministratori']; ?>"
                           data-title="<?php echo $langs['gestione_amministratori']; ?>" data-params="false"
                           data-search="<?php if (isset($search_val)) echo $search_val; ?>"><i
                                    class="fa fa-angle-left"></i> <?php echo $langs['indietro']; ?> /</a>
                        <h1><i class="fa fa-user"></i> <?php echo $langs['modifica_utente']; ?></h1>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $langs['dati_utente']; ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><?php echo $langs['nome']; ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" value="<?php echo $user_info['nome']; ?>"
                                                   class="form-control validate-1" id="nome" placeholder="Mario">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><?php echo $langs['cognome']; ?></label>
                                        <div class="col-sm-9">
                                            <input type="text" value="<?php echo $user_info['cognome']; ?>"
                                                   class="form-control validate-1" id="cognome" placeholder="Rossi">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><?php echo $langs['email']; ?></label>
                                        <div class="col-sm-9">
                                            <input type="email" value="<?php echo $user_info['email']; ?>"
                                                   class="form-control validate-1" id="email"
                                                   placeholder="mario@rossi.it">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"><?php echo $langs['livello']; ?></label>
                                        <div class="col-sm-9">
                                            <select name="livello" value="<?php echo $user_info['livello']; ?>"
                                                    id="livello" class="form-control validate-1">
                                                <?php if ($_SESSION['level'] == 0) { ?>
                                                    <option value="0" <?php if ($user_info['livello'] == 0) echo 'selected="selected"'; ?>>
                                                        Dev
                                                    </option>
                                                <?php } ?>
                                                <?php if ($_SESSION['level'] <= 1) { ?>
                                                    <option value="1" <?php if ($user_info['livello'] == 1) echo 'selected="selected"'; ?>>
                                                        Superadmin
                                                    </option>
                                                <?php } ?>
                                                <option value="2" <?php if ($user_info['livello'] == 2) echo 'selected="selected"'; ?>>
                                                    Admin
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" class="validate-1"
                                           value="<?php echo $user_info['id']; ?>">
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="button" class="btn btn-success validate-it" id="validate-1"
                                                    data-success="<?php echo $langs['modifiche_salvate']; ?>"
                                                    data-failure="<?php echo $langs['errore_salvataggio']; ?>"
                                                    data-function="updateAdmin"><?php echo $langs['salva']; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php }
    }
} else echo '<div class="nm-error pt15 pb15 pl10 pr10">Access denied</div>';
include($GLOBALS['where_path'] . 'includes/script.php');
?>