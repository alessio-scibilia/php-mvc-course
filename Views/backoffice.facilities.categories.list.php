<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1><i class="fa fa-list"></i> <?php echo $view_model->translations->get('categorie_strutture'); ?></h1>
            <a class="btn btn-primary open-view-action-inside mb10"
               data-title="<?php echo $view_model->translations->get('gestione_strutture'); ?>"
               data-action="<?php echo $view_model->translations->get('link_strutture'); ?>"
               data-params="<?php echo $view_model->translations->get('param_nuova_categoria'); ?>"
               href="/backoffice/facilities/categories/new">
                <i class="fa fa-plus"></i> <?php echo $view_model->translations->get('nuova_categoria'); ?>
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('lista_categorie'); ?></h4>
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
                                <th><?php echo $view_model->translations->get('immagine'); ?></th>
                                <th><?php echo $view_model->translations->get('abilita'); ?></th>
                                <th><?php echo $view_model->translations->get('azioni'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($view_model->categories as &$category) { ?>
                                <tr>
                                    <?php if ($view_model->user->level == 0) { ?>
                                        <td><?php echo $category->id; ?></td>
                                    <?php } ?>
                                    <td><?php echo $category->nome; ?></td>
                                    <td><?php echo $category->immagine; ?></td>
                                    <td>
                                        <input type="checkbox"
                                               class="enable-admin enable"
                                               data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                               data-fail="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                            <?php echo $category->abilitata == 1 ? 'checked="checked"' : ''; ?>
                                               value="<?php echo $category->id ?>">
                                    </td>
                                    <td>
                                        <a href="javascript:void()"
                                           class="btn btn-primary shadow btn-xs sharp mr-1 open-view-action-inside"
                                           data-action="<?php echo $view_model->translations->get('link_amministratori'); ?>"
                                           data-title="<?php echo $view_model->translations->get('gestione_amministratori'); ?>"
                                           data-params="<?php echo $category->id; ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="javascript:void()"
                                           class="btn btn-danger shadow btn-xs sharp view-action"
                                           data-function="delAdmin"
                                           data-success="<?php echo $view_model->translations->get('modifiche_salvate'); ?>"
                                           data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                           data-stay="true"
                                           data-params="<?php echo $category->id; ?>">
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
                                <th><?php echo $view_model->translations->get('nome'); ?></th>
                                <th><?php echo $view_model->translations->get('immagine'); ?></th>
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