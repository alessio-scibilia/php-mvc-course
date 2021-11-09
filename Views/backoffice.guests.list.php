<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">

            <h1><i class="fa fa-users"></i> <?php echo $view_model->translations->get('gestione_ospiti'); ?></h1>
            <div>
                <a class="btn btn-primary open-view-action-inside mb10" data-title="testasd"
                   data-action="<?php echo $view_model->translations->get('param_ospiti'); ?>"
                   data-params="<?php echo $view_model->translations->get('nuovo_params'); ?>"
                   href="/backoffice/guests/new">
                    <i class="fa fa-plus"></i> <?php echo $view_model->translations->get('aggiungi_ospiti'); ?>
                </a>
                <a class="btn btn-primary open-view-action-inside mb10"
                   data-action="<?php echo $view_model->translations->get('param_ospiti'); ?>"
                   data-params="<?php echo $view_model->translations->get('param_carica'); ?>"
                   href="/backoffice/guests/load">
                    <i class="fa fa-upload"></i> <?php echo $view_model->translations->get('carica_ospiti'); ?>
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('lista_ospiti'); ?></h4>
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
                                <th><?php echo $view_model->translations->get('telefono'); ?></th>
                                <th><?php echo $view_model->translations->get('abilitato'); ?></th>
                                <th><?php echo $view_model->translations->get('azioni'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($view_model->guests as &$guest) { ?>
                                <tr>
                                    <?php if ($view_model->user->level == 0) { ?>
                                        <td><?php echo $guest->id; ?></td>
                                    <?php } ?>
                                    <td><?php echo $guest->nome; ?></td>
                                    <td><?php echo $guest->email; ?></td>
                                    <td><?php echo $guest->telefono; ?></td>
                                    <td>
                                        <form action="/backoffice/guest/<?php echo $guest->id ?>/enable"
                                              method="POST" enctype="multipart/form-data">
                                            <input type="checkbox"
                                                   data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                                   data-fail="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                                <?php echo $guest->abilitato == 1 ? 'checked="checked"' : ''; ?>
                                                   name="enabled"
                                                   value="1"
                                                   onclick="this.closest('form').submit(); return false;">
                                        </form>
                                    </td>
                                    <td>
                                        <a href="javascript:void()"
                                           class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside"
                                           data-action="<?php echo $view_model->translations->get('link_amministratori'); ?>"
                                           data-title="<?php echo $view_model->translations->get('gestione_amministratori'); ?>"
                                           data-params="<?php echo $guest->id; ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="/backoffice/guest/<?php echo $guest->id; ?>/delete"
                                              method="POST" enctype="multipart/form-data">
                                            <a href="javascript:void()"
                                               class="btn btn-danger shadow btn-xs sharp"
                                               onclick="this.closest('form').submit();return false;">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>


                            </tbody>
                            <tfoot>
                            <tr>
                                <?php if ($view_model->user->level == 0) { ?>
                                    <th>ID</th>
                                <?php } ?>
                                <th><?php echo $view_model->translations->get('nome'); ?></th>
                                <th><?php echo $view_model->translations->get('email'); ?></th>
                                <th><?php echo $view_model->translations->get('telefono'); ?></th>
                                <th><?php echo $view_model->translations->get('abilitato'); ?></th>
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