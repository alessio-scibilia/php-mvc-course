<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1><i class="fa fa-envelope"></i> <?php echo $view_model->translations->get('notifiche'); ?></h1>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 100%">
                            <thead>
                            <tr>
                                <?php if ($view_model->user->level == 0) { ?>
                                    <th>ID</th>
                                <?php } ?>
                                <th><?php echo $view_model->translations->get('data'); ?></th>
                                <th><?php echo $view_model->translations->get('messaggio'); ?></th>
                                <th><?php echo $view_model->translations->get('azioni'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($lista_notifiche)) {
                                for ($i = 0;
                                     $i < sizeof($lista_notifiche);
                                     $i++) {

                                    $query = "SELECT * FROM hotel WHERE id = ?";
                                    $stmt = $dbh->prepare($query);
                                    $stmt->bindParam(1, $lista_notifiche[$i]['da'], PDO::PARAM_INT);
                                    $stmt->execute();
                                    if ($stmt->rowCount() > 0) {
                                        $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $user = $dati['email'];
                                        $id = $dati['id'];
                                    }
                                    $query = "SELECT * FROM messaggi_predefiniti WHERE tipo_messaggio = ? AND shortcode_lingua = ?";
                                    $stmt = $dbh->prepare($query);
                                    $stmt->bindParam(1, $lista_notifiche[$i]['tipo'], PDO::PARAM_INT);
                                    $stmt->bindParam(2, $_SESSION['lang'], PDO::PARAM_INT);
                                    $stmt->execute();
                                    if ($stmt->rowCount() > 0) {
                                        $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $messaggio = $dati['messaggio'];
                                        if ($lista_notifiche[$i]['tipo'] == 0)
                                            $foa = '<i class="fa fa-building-o foa-notifications"></i> ';
                                        else if ($lista_notifiche[$i]['tipo'] == 1)
                                            $foa = '<i class="fa fa-pencil foa-notifications"></i> ';
                                        $messaggio = str_replace('{user}', '<a href="javascript:void()" class="open-view-action-inside link-notifications" data-action="' . $langs['link_hotels'] . '" data-params="' . $id . '" >' . $user . '</a>', $messaggio);
                                    }
                                    ?>
                                    <tr>
                                        <?php if ($_SESSION['level'] == 0) { ?>
                                            <td><?php echo $lista_notifiche[$i]['id']; ?></td>
                                        <?php } ?>
                                        <td><?php echo $lista_notifiche[$i]['data']; ?></td>
                                        <td><?php echo $foa . $messaggio; ?></td>
                                        <td><a href="javascript:void()"
                                               class="btn btn-danger shadow btn-xs sharp view-action"
                                               data-function="delNotifica"
                                               data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                               data-stay="true"
                                               data-params="<?php echo $view_model->translations->get('id'); ?>"><i
                                                        class="fa fa-trash"></i></a></td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>