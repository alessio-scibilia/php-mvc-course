<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1><i class="fa fa-building"></i> <?php echo $langs['gestione_strutture']; ?></h1>
            <?php if ($_SESSION['level'] <= 3) { ?>
                <a class="btn btn-primary open-view-action-inside mb10" data-toggle="tab"
                   data-title="<?php echo $langs['gestione_strutture']; ?>"
                   data-action="<?php echo $langs['link_strutture']; ?>"
                   data-params="<?php echo $langs['nuovo_params']; ?>" href="#<?php echo $langs['link_strutture']; ?>">
                    <i class="fa fa-plus"></i> <?php echo $langs['crea_nuova_struttura']; ?>
                </a>
            <?php } ?>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $langs['lista_strutture']; ?></h4>
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
                                <th><?php echo $langs['telefono']; ?></th>
                                <th><?php echo $langs['indirizzo']; ?></th>
                                <?php if ($_SESSION['level'] < 3) { ?>
                                    <th><?php echo $langs['hotel_associati']; ?></th><?php } ?>
                                <th><?php echo $langs['abilita']; ?></th>
                                <th><?php echo $langs['azioni']; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($lista_strutture != 'error') {
                                for ($i = 0; $i < sizeof($lista_strutture); $i++) {


                                    if ($_SESSION['level'] < 3) {
                                        echo '<tr>';
                                        if ($_SESSION['level'] == 0)
                                            echo '<td>' . $lista_strutture[$i]['id'] . '</td>';
                                        echo '<td>' . $lista_strutture[$i]['nome'] . '</td>';
                                        echo '<td>' . $lista_strutture[$i]['email'] . '</td>';
                                        echo '<td>' . $lista_strutture[$i]['telefono'] . '</td>';
                                        echo '<td>' . $lista_strutture[$i]['indirizzo'] . '</td><td>';

                                        $query = "SELECT * FROM strutture WHERE id = ?";
                                        $stmt = $dbh->prepare($query);
                                        $stmt->bindParam(1, $lista_strutture[$i]['id'], PDO::PARAM_INT);
                                        $stmt->execute();
                                        if ($stmt->rowCount() > 0) {
                                            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $email = $dati['email'];
                                            $nome_struttura = $dati['nome_struttura'];
                                            $email = $dati['email'];
                                            $latitudine = $dati['latitudine'];
                                            $longitudine = $dati['longitudine'];
                                            $created_by = $dati['created_by'];
                                            $lingue = getLangsShortcode($dbh);

                                            $query = "SELECT * FROM strutture WHERE email = ? AND nome_struttura = ? AND  latitudine = ? AND longitudine = ? AND created_by = ? AND shortcode_lingua = ?";
                                            $stmt = $dbh->prepare($query);
                                            $stmt->bindParam(1, $email, PDO::PARAM_STR);
                                            $stmt->bindParam(2, $nome_struttura, PDO::PARAM_STR);
                                            $stmt->bindParam(3, $latitudine, PDO::PARAM_STR);
                                            $stmt->bindParam(4, $longitudine, PDO::PARAM_STR);
                                            $stmt->bindParam(5, $created_by, PDO::PARAM_INT);
                                            $stmt->bindParam(6, $lingue[0]['shortcode_lingua'], PDO::PARAM_INT);
                                            $stmt->execute();
                                            if ($stmt->rowCount() > 0) {
                                                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $id_struttura_query = $dati['id'];
                                            }
                                        }
                                        $hotel_associati = getHotelAssociati($dbh, $id_struttura_query);
                                        if ($hotel_associati != 'error') {
                                            for ($t = 0; $t < sizeof($hotel_associati); $t++) {
                                                ?>
                                                <a href="javascript:void()" class="tagit delHot"
                                                   data-sucess="<?php echo $langs['modifiche_salvate']; ?>"
                                                   data-function="delRelatedHotel"
                                                   data-params="<?php echo $lista_strutture[$i]['id']; ?>,<?php echo $hotel_associati[$t]['id_hotel']; ?>"><?php echo $hotel_associati[$t]['nome']; ?>
                                                    <i class="fa fa-close"></i></a>
                                            <?php }
                                        }

                                        echo '</td>';
                                        if ($lista_strutture[$i]['abilitata'] == 1)
                                            echo '<td><input type="checkbox" checked="checked" id="" data-success="' . $langs['modifiche_salvate'] . '" class="enable-struttura enable" value="' . $lista_strutture[$i]['id'] . '"></td>';
                                        else
                                            echo '<td><input type="checkbox"  id="" data-success="' . $langs['modifiche_salvate'] . '" class="enable-struttura enable" value="' . $lista_strutture[$i]['id'] . '"></td>';
                                        echo '<td>
                                                           <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['link_strutture'] . '" data-title="' . $langs['gestione_strutture'] . '" data-params="' . $lista_strutture[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                           <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-success="' . $langs['modifiche_salvate'] . '" data-failure="' . $langs['errore_salvataggio'] . '"  data-function="delStruttura" data-params="' . $lista_strutture[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                        </td>';
                                    } else if ($_SESSION['level'] > 2) {
                                        $query_conv = "SELECT * FROM strutture_hotel WHERE id_struttura = ? AND id_hotel = ? ";
                                        $stmt_conv = $dbh->prepare($query_conv);
                                        $stmt_conv->bindParam(1, $lista_strutture[$i]['id'], PDO::PARAM_INT);
                                        $stmt_conv->bindParam(2, $_SESSION['id_user'], PDO::PARAM_INT);
                                        $stmt_conv->execute();
                                        if ($stmt_conv->rowCount() > 0) {
                                            echo '<tr>';
                                            echo '<td>' . $lista_strutture[$i]['nome'] . '</td>';
                                            echo '<td>' . $lista_strutture[$i]['email'] . '</td>';
                                            echo '<td>' . $lista_strutture[$i]['telefono'] . '</td>';
                                            echo '<td>' . $lista_strutture[$i]['indirizzo'] . '</td>';
                                            if ($lista_strutture[$i]['abilitata'] == 1 && $lista_strutture[$i]['created_by'] != 0)
                                                echo '<td><input type="checkbox" checked="checked" id="" data-success="' . $langs['modifiche_salvate'] . '" class="enable-struttura enable" value="' . $lista_strutture[$i]['id'] . '"></td>';
                                            else if ($lista_strutture[$i]['created_by'] != 0)
                                                echo '<td><input type="checkbox"  id="" data-success="' . $langs['modifiche_salvate'] . '" class="enable-struttura enable" value="' . $lista_strutture[$i]['id'] . '"></td>';
                                            else
                                                echo '<td></td>';
                                            if ($lista_strutture[$i]['created_by'] != 0)
                                                echo '<td>
                                                                   <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['link_strutture'] . '" data-title="' . $langs['gestione_strutture'] . '" data-params="' . $lista_strutture[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                                   <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delStruttura" data-success="' . $langs['modifiche_salvate'] . '" data-failure="' . $langs['errore_salvataggio'] . '"  data-params="' . $lista_strutture[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                            </td>';
                                            else
                                                echo '<td>
                                                                   <a href="javascript:void()"  class="btn btn-primary shadow btn-xs mr-1 open-view-action-inside" data-action="' . $langs['link_convenzioni'] . '" data-title="' . $langs['convenzioni'] . '" data-params="' . $lista_strutture[$i]['id'] . '">' . $langs['gestisci_convenzione'] . '</a>

                                                            </td>';
                                        }
                                    } else echo 'Errore';

                                }
                            } ?>


                            </tbody>
                            <tfoot>
                            <tr>
                                <?php if ($_SESSION['level'] == 0) { ?>
                                    <th>ID</th>
                                <?php } ?>
                                <th><?php echo $langs['nome']; ?></th>
                                <th><?php echo $langs['email']; ?></th>
                                <th><?php echo $langs['telefono']; ?></th>
                                <th><?php echo $langs['indirizzo']; ?></th>
                                <?php if ($_SESSION['level'] < 3) { ?>
                                    <th><?php echo $langs['hotel_associati']; ?></th><?php } ?>
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