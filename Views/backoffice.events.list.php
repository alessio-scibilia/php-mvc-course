<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1><i class="fa fa-calendar"></i> <?php echo $langs['gestione_eventi']; ?></h1>
            <a class="btn btn-primary open-view-action-inside mb10" data-toggle="tab" data-title="testasd"
               data-action="<?php echo $langs['link_eventi']; ?>" data-params="<?php echo $langs['nuovo_params']; ?>"
               href="#<?php echo $langs['link_eventi']; ?>">
                <i class="fa fa-plus"></i> <?php echo $langs['crea_evento']; ?>
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $langs['lista_eventi']; ?></h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 100%">
                            <thead>
                            <tr>
                                <?php if ($_SESSION['level'] == 0) { ?>
                                    <th>ID</th>
                                <?php } ?>
                                <th><?php echo $langs['nome_evento']; ?></th>
                                <th><?php echo $langs['nome_struttura_evento']; ?></th>
                                <th><?php echo $langs['struttura_collegata']; ?></th>
                                <th><?php echo $langs['indirizzo']; ?></th>
                                <th><?php echo $langs['data']; ?></th>
                                <th><?php echo $langs['abilita']; ?></th>
                                <th><?php echo $langs['azioni']; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($lista_eventi != 'error') {
                                for ($i = 0; $i < sizeof($lista_eventi); $i++) {
                                    if ($_SESSION['level'] == 0) {
                                        echo '<tr>';
                                        echo '<td>' . $lista_eventi[$i]['id'] . '</td>';
                                        echo '<td>' . $lista_eventi[$i]['nome'] . '</td>';
                                        echo '<td>' . $lista_eventi[$i]['nome'] . '</td>';
                                        if ($lista_eventi[$i]['nome_luogo'] != '')
                                            echo '<td>' . $lista_eventi[$i]['nome_luogo'] . '</td>';
                                        else echo '<td><b>Rec. da struttura</b></td>';

                                        $query = "SELECT * FROM strutture_eventi WHERE id_evento = ? AND shortcode_lingua = ?";
                                        $stmt = $dbh->prepare($query);
                                        $stmt->bindParam(1, $lista_eventi[$i]['id'], PDO::PARAM_INT);
                                        $stmt->bindParam(2, $_SESSION['lang'], PDO::PARAM_INT);
                                        $stmt->execute();
                                        echo '<td>';
                                        if ($stmt->rowCount() > 0) {
                                            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $struttura_collegata = explode("-", $dati['id_struttura']);
                                                $struttura_info = getStrutturaInfo($dbh, $struttura_collegata[0], $struttura_collegata[1]);
                                                echo '<div><a href="javascript:void()" class="tagit delStrutturaEvento" data-success="' . $langs['modifiche_salvate'] . '" data-id-evento="' . $lista_eventi[$i]['id'] . '" data-function="delRelatedStrutturaEvento" data-type="' . $struttura_collegata[0] . '" data-id="' . $struttura_collegata[1] . '">' . $struttura_info['nome'] . ' <i class="fa fa-close"></i></a></div>';
                                            }
                                        }
                                        echo '</td>';

                                        echo '<td>' . $lista_eventi[$i]['indirizzo'] . '</td>';
                                        echo '<td>' . $lista_eventi[$i]['data'] . '</td>';

                                        //print_r($struttura_collegata);


                                        if ($lista_eventi[$i]['abilitato'] == 1)
                                            echo '<td><input type="checkbox" checked="checked" id="" class="enable-evento enable" value="' . $lista_eventi[$i]['id'] . '"></td>';
                                        else
                                            echo '<td><input type="checkbox"  id="" class="enable-evento enable" value="' . $lista_eventi[$i]['id'] . '"></td>';
                                        echo '<td>
                                                           <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['link_eventi'] . '" data-title="' . $langs['modifica_evento'] . '" data-params="' . $lista_eventi[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                           <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delEvento" data-success="' . $langs['modifiche_salvate'] . '" data-failure="' . $langs['errore_salvataggio'] . '" data-params="' . $lista_eventi[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                        </td>';
                                    } else if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2 || $_SESSION['level'] == 3 || $_SESSION['level'] == 4) {
                                        echo '<tr>';
                                        echo '<td>' . $lista_eventi[$i]['nome'] . '</td>';

                                        if ($lista_eventi[$i]['nome_luogo'] != '')
                                            echo '<td>' . $lista_eventi[$i]['nome_luogo'] . '</td>';
                                        else echo '<td><b>Rec. da struttura</b></td>';
                                        $query = "SELECT * FROM strutture_eventi WHERE id_evento = ? AND shortcode_lingua = ?";
                                        $stmt = $dbh->prepare($query);
                                        $stmt->bindParam(1, $lista_eventi[$i]['id'], PDO::PARAM_INT);
                                        $stmt->bindParam(2, $_SESSION['lang'], PDO::PARAM_INT);
                                        $stmt->execute();
                                        echo '<td>';
                                        if ($stmt->rowCount() > 0) {
                                            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $struttura_collegata = explode("-", $dati['id_struttura']);
                                                $struttura_info = getStrutturaInfo($dbh, $struttura_collegata[0], $struttura_collegata[1]);
                                                if ($struttura_collegata[1] == $_SESSION['id_user'])
                                                    echo '<div><a href="javascript:void()" class="tagit">' . $struttura_info['nome'] . '</a></div>';
                                                else {
                                                    $strutture_hotel = getElencoStrutture($dbh);
                                                    $strutture_string = '';
                                                    for ($d = 0; $d < sizeof($strutture_hotel); $d++) {
                                                        $strutture_string .= $strutture_hotel[$d]['id'] . '|';
                                                    }
                                                    $search = explode("-", $dati['id_struttura']);
                                                    if ($search[0] == 2) {
                                                        $search = $search[1];
                                                        if (strpos($strutture_string, $search) !== false) {
                                                            echo '<div><a href="javascript:void()" class="tagit">' . $struttura_info['nome'] . '</a></div>';
                                                        }
                                                    }

                                                }
                                            }
                                        }
                                        echo '</td>';
                                        echo '<td>' . $lista_eventi[$i]['indirizzo'] . '</td>';
                                        echo '<td>' . $lista_eventi[$i]['data'] . '</td>';


                                        if ($lista_eventi[$i]['abilitato'] == 1 && $lista_eventi[$i]['created_by'] == $_SESSION['id_user'])
                                            echo '<td><input type="checkbox" checked="checked" id="" class="enable-evento enable" value="' . $lista_eventi[$i]['id'] . '"></td>';
                                        else if ($lista_eventi[$i]['created_by'] == $_SESSION['id_user'])
                                            echo '<td><input type="checkbox"  id="" class="enable-evento enable" value="' . $lista_eventi[$i]['id'] . '"></td>';
                                        else if ($lista_eventi[$i]['created_by'] == 0 && $_SESSION['level'] <= 2 && $lista_eventi[$i]['abilitato'] == 1)
                                            echo '<td><input type="checkbox"  id="" checked="checked" class="enable-evento enable" value="' . $lista_eventi[$i]['id'] . '"></td>';
                                        else if ($lista_eventi[$i]['created_by'] == 0 && $_SESSION['level'] <= 2)
                                            echo '<td><input type="checkbox"  id=""  class="enable-evento enable" value="' . $lista_eventi[$i]['id'] . '"></td>';
                                        else echo '<td></td>';
                                        echo '<td>
                                                               <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['link_eventi'] . '" data-title="' . $langs['gestione_eventi'] . '" data-params="' . $lista_eventi[$i]['id'] . '"><i class="fa fa-pencil"></i></a>';
                                        if ($lista_eventi[$i]['created_by'] == $_SESSION['id_user'] || $_SESSION['level'] <= 2)
                                            echo '<a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delEvento" data-params="' . $lista_eventi[$i]['id'] . '" data-success="' . $langs['modifiche_salvate'] . '"  data-failure="' . $langs['errore_salvataggio'] . '"><i class="fa fa-trash"></i></a>    
                                                        </td>';

                                    } else echo 'Errore';

                                }
                            } ?>


                            </tbody>
                            <tfoot>
                            <tr>
                                <?php if ($_SESSION['level'] == 0) { ?>
                                    <th>ID</th>
                                <?php } ?>
                                <th><?php echo $langs['nome_evento']; ?></th>
                                <th><?php echo $langs['nome_struttura_evento']; ?></th>
                                <th><?php echo $langs['struttura_collegata']; ?></th>
                                <th><?php echo $langs['indirizzo']; ?></th>
                                <th><?php echo $langs['data']; ?></th>
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