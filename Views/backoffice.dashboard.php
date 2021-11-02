<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1><i class="fa fa-dashboard"></i> <?php echo $view_model->translations->get('dashboard'); ?></h1>
            <hr/>
            <h4 class="mb15"><?php echo $view_model->translations->get('collegamenti_rapidi'); ?></h4>
        </div>

        <?php if ($view_model->user->level <= 2) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4">

                <a class="open-view-action-inside dashboard-shortcut mb10 d-flex justify-content-center align-items-center shortcuts"
                   data-title="<?php echo $view_model->translations->get('gestione_amministratori'); ?>"
                   data-action="<?php echo $view_model->translations->get('amministratori'); ?>"
                   data-params="<?php echo $view_model->translations->get('nuovo_params'); ?>"
                   href="/backoffice/administrators/new"
                   id="<?php echo strtolower($view_model->translations->get('amministratori')); ?>">
                    <div align="center">
                        <i class="fa fa-user fa-shortcuts"></i>
                        <div><?php echo $view_model->translations->get('crea_nuovo_amministratore'); ?></div>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">

                <a class="open-view-action-inside dashboard-shortcut mb10 d-flex justify-content-center align-items-center shortcuts "
                   data-title="<?php echo $view_model->translations->get('gestione_hotels'); ?>"
                   data-action="<?php echo strtolower($view_model->translations->get('gestione_amministratori')); ?>"
                   data-params="<?php echo $view_model->translations->get('nuovo_params'); ?>"
                   href="/backoffice/hotels/new"
                   id="<?php echo $view_model->translations->get('link_hotels'); ?>">
                    <div align="center">
                        <i class="fa fa-building-o fa-shortcuts"></i>
                        <div><?php echo $view_model->translations->get('crea_nuovo_hotel'); ?></div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php if ($view_model->user->level <= 2) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <a class="open-view-action-inside dashboard-shortcut mb10 d-flex justify-content-center align-items-center shortcuts "
                   data-title="<?php echo $view_model->translations->get('gestione_strutture'); ?>"
                   data-action="<?php echo strtolower($view_model->translations->get('link_strutture')); ?>"
                   data-params="<?php echo $view_model->translations->get('nuovo_params'); ?>"
                   href="/backoffice/facilities/new">
                    <div align="center">
                        <i class="fa fa-building fa-shortcuts"></i>
                        <div><?php echo $view_model->translations->get('crea_nuova_struttura'); ?></div>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <a class="open-view-action-inside dashboard-shortcut mb10 d-flex justify-content-center align-items-center shortcuts "
                   data-title="testasd"
                   data-action="<?php echo strtolower($view_model->translations->get('link_eventi')); ?>"
                   data-params="<?php echo $view_model->translations->get('nuovo_params'); ?>"
                   href="/backoffice/events/new">
                    <div align="center">
                        <i class="fa fa-calendar fa-shortcuts"></i>
                        <div><?php echo $view_model->translations->get('crea_evento'); ?></div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php if ($view_model->user->level <= 1) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <a class="open-view-action-inside dashboard-shortcut mb10 d-flex justify-content-center align-items-center shortcuts "
                   data-title="<?php echo $view_model->translations->get('link_traduzioni'); ?>"
                   data-action="<?php echo strtolower($view_model->translations->get('link_traduzioni')); ?>"
                   data-params="<?php echo $view_model->translations->get('params_nuova_lingua'); ?>"
                   href="/backoffice/translations/languages/new">
                    <div align="center">
                        <i class="fa fa-language fa-shortcuts"></i>
                        <div><?php echo $view_model->translations->get('crea_nuova_lingua'); ?></div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php if ($view_model->user->level >= 3) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <a class="open-view-action-inside dashboard-shortcut mb10 d-flex justify-content-center align-items-center shortcuts "
                   data-title="<?php echo $view_model->translations->get('gestione_ospiti'); ?>"
                   data-action="<?php echo strtolower($view_model->translations->get('param_ospiti')); ?>"
                   data-params="false"
                   href="/backoffice/guests/new">
                    <div align="center">
                        <i class="fa fa-users fa-shortcuts"></i>
                        <div><?php echo $view_model->translations->get('gestione_ospiti'); ?></div>
                    </div>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <a class="open-view-action-inside dashboard-shortcut mb10 d-flex justify-content-center align-items-center shortcuts "
                   data-title="<?php echo $_SESSION['nome']; ?>"
                   data-action="<?php echo strtolower($view_model->translations->get('link_mio_hotel')); ?>"
                   data-params="false"
                   href="/backoffice/profile">
                    <div align="center">
                        <i class="fa fa-building-o fa-shortcuts"></i>
                        <div><?php echo $view_model->translations->get('il_mio_hotel'); ?></div>
                    </div>
                </a>
            </div>
        <?php } ?>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <a class="open-view-action-inside dashboard-shortcut mb10 d-flex justify-content-center align-items-center shortcuts "
               data-title="<?php echo $view_model->translations->get('impostazioni_account'); ?>"
               data-action="<?php echo strtolower($view_model->translations->get('link_impostazioni')); ?>"
               data-params="false"
               href="/backoffice/settings">
                <div align="center">
                    <i class="fa fa-gear fa-shortcuts"></i>
                    <div><?php echo $view_model->translations->get('impostazioni_account'); ?></div>
                </div>
            </a>
        </div>


    </div>
</div>