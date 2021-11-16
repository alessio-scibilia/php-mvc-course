<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1>
                <i class="fa fa-users"></i> <?php echo $view_model->translations->get('gestione_amministratori'); ?>
            </h1>

            <a class="btn btn-primary open-view-action-inside mb10"
               data-title="<?php echo $view_model->translations->get('gestione_amministratori'); ?>"
               data-action="<?php echo $view_model->translations->get('link_amministratori'); ?>"
               data-params="<?php echo $view_model->translations->get('nuovo_params'); ?>"
               href="/backoffice/administrators/new">
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
                            <?php foreach ($view_model->users as &$user) { ?>
                                <tr>
                                    <?php if ($view_model->user->level == 0) { ?>
                                        <td><?php echo $user->id; ?></td>
                                    <?php } ?>
                                    <td><?php echo $user->nome; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $user->level . ' | ' . $user->level_name; ?></td>
                                    <td>

                                        <form action="/backoffice/administrator/<?php echo $user->id ?>/enable"
                                              method="POST" enctype="multipart/form-data">
                                            <input type="checkbox"
                                                   data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                                   data-fail="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                                <?php echo $user->abilitato == 1 ? 'checked="checked"' : ''; ?>
                                                   name="enabled"
                                                   value="1"
                                                   onclick="this.closest('form').submit(); return false;">
                                        </form>
                                    </td>
                                    <td class="d-flex">
                                        <a href="/backoffice/administrators/<?php echo $user->id; ?>/edit"
                                           class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside"
                                           data-action="<?php echo $view_model->translations->get('link_amministratori'); ?>"
                                           data-title="<?php echo $view_model->translations->get('gestione_amministratori'); ?>"
                                           data-params="<?php echo $user->id; ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form action="/backoffice/administrator/<?php echo $user->id; ?>/delete"
                                              method="POST" enctype="multipart/form-data">
                                            <button type="submit"
                                               class="btn btn-danger shadow btn-xs sharp"
                                               onclick="return confirm('Confermare eliminazione?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
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
