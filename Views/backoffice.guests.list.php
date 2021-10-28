<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">

            <h1><i class="fa fa-users"></i> <?php echo $langs['gestione_ospiti']; ?></h1>
            <div>
                <a class="btn btn-primary open-view-action-inside mb10" data-toggle="tab" data-title="testasd"
                   data-action="<?php echo $langs['param_ospiti']; ?>"
                   data-params="<?php echo $langs['nuovo_params']; ?>" href="#<?php echo $langs['param_ospiti']; ?>">
                    <i class="fa fa-plus"></i> <?php echo $langs['aggiungi_ospiti']; ?>
                </a>
                <a class="btn btn-primary open-view-action-inside mb10" data-toggle="tab" data-title="testasd"
                   data-action="<?php echo $langs['param_ospiti']; ?>"
                   data-params="<?php echo $langs['param_carica']; ?>" href="#<?php echo $langs['param_ospiti']; ?>">
                    <i class="fa fa-upload"></i> <?php echo $langs['carica_ospiti']; ?>
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $langs['lista_ospiti']; ?></h4>
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
                                <th><?php echo $langs['abilitato']; ?></th>
                                <th><?php echo $langs['azioni']; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($lista_ospiti != false) {
                                for ($i = 0; $i < sizeof($lista_ospiti); $i++) {
                                    if ($_SESSION['level'] == 0) {
                                        echo '<tr>';
                                        echo '<td>' . $lista_ospiti[$i]['id'] . '</td>';
                                        echo '<td>' . $lista_ospiti[$i]['nome'] . '</td>';
                                        echo '<td>' . $lista_ospiti[$i]['email'] . '</td>';
                                        echo '<td>' . $lista_ospiti[$i]['telefono'] . '</td>';

                                        if ($lista_ospiti[$i]['abilitato'] == 1)
                                            echo '<td><input type="checkbox" id="" class="enable-guest enable" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '" checked="checked" value="' . $lista_ospiti[$i]['id'] . '"></td>';
                                        else
                                            echo '<td><input type="checkbox" id="" class="enable-guest enable" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '"  value="' . $lista_ospiti[$i]['id'] . '"></td>';


                                        echo '<td>
                                                       <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['param_ospiti'] . '" data-title="teo" data-params="' . $lista_ospiti[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                       <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delGuest"  data-success="' . $langs['modifiche_salvate'] . '" data-failure="' . $langs['errore_salvataggio'] . '"  data-params="' . $lista_ospiti[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
                                                    </td>';
                                    } else if ($_SESSION['level'] >= 3) {
                                        echo '<tr>';
                                        echo '<td>' . $lista_ospiti[$i]['nome'] . '</td>';
                                        echo '<td>' . $lista_ospiti[$i]['email'] . '</td>';
                                        echo '<td>' . $lista_ospiti[$i]['telefono'] . '</td>';
                                        if ($lista_ospiti[$i]['abilitato'] == 1)
                                            echo '<td><input type="checkbox" id="" class="enable-guest enable" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '" checked="checked" value="' . $lista_ospiti[$i]['id'] . '"></td>';
                                        else
                                            echo '<td><input type="checkbox" id="" class="enable-guest enable" data-success="' . $langs['modifiche_salvate'] . '" data-fail="' . $langs['errore_salvataggio'] . '"  value="' . $lista_ospiti[$i]['id'] . '"></td>';
                                        echo '<td>
                                                           <a href="javascript:void()"  class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside" data-action="' . $langs['param_ospiti'] . '" data-title="teo" data-params="' . $lista_ospiti[$i]['id'] . '"><i class="fa fa-pencil"></i></a>
                                                           <a href="javascript:void()" class="btn btn-danger shadow btn-xs sharp view-action" data-function="delGuest"  data-success="' . $langs['modifiche_salvate'] . '" data-failure="' . $langs['errore_salvataggio'] . '" data-params="' . $lista_ospiti[$i]['id'] . '"><i class="fa fa-trash"></i></a>    
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
                                <th><?php echo $langs['abilitato']; ?></th>
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