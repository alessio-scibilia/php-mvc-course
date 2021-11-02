<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1><i class="fa fa-calendar"></i> <?php echo $view_model->translations->get('gestione_eventi'); ?></h1>
            <a class="btn btn-primary open-view-action-inside mb10"
               data-title="<?php echo $view_model->translations->get('gestione_eventi'); ?>"
               data-action="<?php echo $view_model->translations->get('link_eventi'); ?>"
               data-params="<?php echo $view_model->translations->get('nuovo_params'); ?>"
               href="/backoffice/events/new">
                <i class="fa fa-plus"></i> <?php echo $view_model->translations->get('crea_evento'); ?>
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('lista_eventi'); ?></h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 100%">
                            <thead>
                            <tr>
                                <?php if ($view_model->user->level == 0) { ?>
                                    <th>ID</th>
                                <?php } ?>
                                <th><?php echo $view_model->translations->get('nome_evento'); ?></th>
                                <th><?php echo $view_model->translations->get('nome_struttura_evento'); ?></th>
                                <th><?php echo $view_model->translations->get('struttura_collegata'); ?></th>
                                <th><?php echo $view_model->translations->get('indirizzo'); ?></th>
                                <th><?php echo $view_model->translations->get('data'); ?></th>
                                <th><?php echo $view_model->translations->get('abilita'); ?></th>
                                <th><?php echo $view_model->translations->get('azioni'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($view_model->events as &$event) { ?>
                                <tr>
                                    <?php if ($view_model->user->level == 0) { ?>
                                        <td><?php echo $event->id; ?></td>
                                    <?php } ?>
                                    <td><?php echo $event->nome_evento; ?></td>
                                    <td><?php echo $event->nome_struttura; ?></td>
                                    <td><?php echo $event->struttura_collegata; ?></td>
                                    <td><?php echo $event->indirizzo; ?></td>
                                    <td><?php echo $event->data_inizio_evento; ?></td>
                                    <td>
                                        <input type="checkbox"
                                               class="enable-admin enable"
                                               data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                               data-fail="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                            <?php echo $event->abilitato == 1 ? 'checked="checked"' : ''; ?>
                                               value="<?php echo $event->id ?>">
                                    </td>
                                    <td>
                                        <a href="javascript:void()"
                                           class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside"
                                           data-action="<?php echo $view_model->translations->get('link_amministratori'); ?>"
                                           data-title="<?php echo $view_model->translations->get('gestione_amministratori'); ?>"
                                           data-params="<?php echo $event->id; ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="javascript:void()"
                                           class="btn btn-danger shadow btn-xs sharp view-action"
                                           data-function="delAdmin"
                                           data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                           data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                           data-stay="true"
                                           data-params="<?php echo $event->id; ?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <?php if ($view_model->user->level == 0) { ?>
                                    <th>ID</th>
                                <?php } ?>
                                <th><?php echo $view_model->translations->get('nome_evento'); ?></th>
                                <th><?php echo $view_model->translations->get('nome_struttura_evento'); ?></th>
                                <th><?php echo $view_model->translations->get('struttura_collegata'); ?></th>
                                <th><?php echo $view_model->translations->get('indirizzo'); ?></th>
                                <th><?php echo $view_model->translations->get('data'); ?></th>
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