<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">

            <h1><i class="fa fa-building-o"></i> <?php echo $langs['tutti_gli_hotel']; ?></h1>

            <a class="btn btn-primary open-view-action-inside mb10" data-toggle="tab"
               data-title="<?php echo $langs['gestione_hotels']; ?> | Wellcome"
               data-action="<?php echo $langs['link_hotels']; ?>" data-params="<?php echo $langs['nuovo_params']; ?>"
               href="#<?php echo $langs['link_hotel']; ?>">
                <i class="fa fa-plus"></i> <?php echo $langs['crea_nuovo_hotel']; ?>
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $langs['lista_hotels']; ?></h4>
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
                                <th><?php echo $langs['abilita']; ?></th>
                                <th><?php echo $langs['azioni']; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($lista_hotels != 'error') {
                                for ($i = 0; $i < sizeof($lista_hotels); $i++) {
                                    if ($_SESSION['level'] == 0) {
                                        echo '<tr>';
                                        echo '<td>' . $lista_hotels[$i]['id'] . '</td>';
                                        echo '<td>' . $lista_hotels[$i]['nome'] . '</td>';
                                        echo '<td>' . $lista_hotels[$i]['email'] . '</td>';
                                        echo '<td>' . $lista_hotels[$i]['telefono'] . '</td>';
                                        echo '<td>' . $lista_hotels[$i]['indirizzo'] . '</td>';
                                        if ($lista_hotels[$i]['abilitato'] == 1)
                                            echo '<td><input type="checkbox" checked="checked" id="" class="enable-hotel enable" data-success="' . $langs['modifiche_salvate'] . '" value="' . $lista_hotels[$i]['id'] . '" data-fail="' . $langs['errore_salvataggio'] . '"></td>';
                                        else
                                            echo '<td><input type="checkbox"  id="" class="enable-hotel enable" data-success="' . $langs['modifiche_salvate'] . '" value="' . $lista_hotels[$i]['id'] . '" data-fail="' . $langs['errore_salvataggio'] . '"></td>';
                                        echo '<td>
                                                       <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['link_hotels'] . '" data-title="' . $langs['gestione_hotels'] . ' | Wellcome" data-params="' . $lista_hotels[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                       <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delHotel"  data-success="' . $langs['modifiche_salvate'] . '" data-failure="' . $langs['errore_salvataggio'] . '"   data-params="' . $lista_hotels[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                    </td>';
                                    } else if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2) {
                                        echo '<tr>';
                                        echo '<td>' . $lista_hotels[$i]['nome'] . '</td>';
                                        echo '<td>' . $lista_hotels[$i]['email'] . '</td>';
                                        echo '<td>' . $lista_hotels[$i]['telefono'] . '</td>';
                                        echo '<td>' . $lista_hotels[$i]['indirizzo'] . '</td>';
                                        if ($lista_hotels[$i]['abilitato'] == 1)
                                            echo '<td><input type="checkbox" checked="checked" id="" class="enable-hotel enable" data-success="' . $langs['modifiche_salvate'] . '" value="' . $lista_hotels[$i]['id'] . '" data-fail="' . $langs['errore_salvataggio'] . '"></td>';
                                        else
                                            echo '<td><input type="checkbox"  id="" class="enable-hotel enable" data-success="' . $langs['modifiche_salvate'] . '" value="' . $lista_hotels[$i]['id'] . '" data-fail="' . $langs['errore_salvataggio'] . '"></td>';
                                        echo '<td>
                                                           <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['link_hotels'] . '" data-title="' . $langs['gestione_hotels'] . ' | Wellcome" data-params="' . $lista_hotels[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                           <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delHotel"  data-success="' . $langs['modifiche_salvate'] . '" data-failure="' . $langs['errore_salvataggio'] . '"   data-params="' . $lista_hotels[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
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
                                <th><?php echo $langs['nome']; ?></th>
                                <th><?php echo $langs['email']; ?></th>
                                <th><?php echo $langs['telefono']; ?></th>
                                <th><?php echo $langs['indirizzo']; ?></th>
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