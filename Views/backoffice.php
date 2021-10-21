<!DOCTYPE html>
<html>
<?php
    if ($view_model->template_name == 'login')
        require_once 'Views/backoffice.head.login.php';
    else
        require_once 'Views/backoffice.head.common.php';
?>
<body>

<!-- Preloader -->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<!-- /Preloader -->


<!-- Content -->
<div id="main-wrapper">

    <div class="nav-header">
        <a href="index" class="brand-logo">
            <img class="logo-abbr" src="./images/logo-piccolo.png" alt="">
            <img class="logo-compact" src="./images/logo-text.png" alt="">
            <img class="brand-title" src="./images/logo-text.png" alt="">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>

    <!-- Sidebar fixed -->
    <div class="fixed-content-box">
        <div class="head-name">
            Wellcome
            <span class="close-fixed-content fa-left d-lg-none">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000) " x="14" y="7" width="2" height="10" rx="1"/><path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) "/></g></svg>
				</span>
        </div>
        <div class="fixed-content-body dz-scroll" id="DZ_W_Fixed_Contant">
            <div class="tab-content" id="menu">
                <div class="tab-pane chart-sidebar fade" id="dashboard-area" role="tabpanel"></div>
                <div class="tab-pane fade <?php if($view_model->menu_active_btn == 'dashboard') echo 'active show';?>" id="dashboard" role="tabpanel">
                    <ul class="metismenu tab-nav-menu">
                        <li class="nav-label"><?php echo $view_model->translations->get('dashboard');?></li>
                        <p>Accedi ai collegamenti rapidi, visualizza le comunicazioni e le statistiche.</p>
                    </ul>
                </div>

                <?php if($view_model->user->level <= 4) { ?>
                    <div class="tab-pane fade <?php if(strtolower($view_model->menu_active_btn) == 'hotels') echo 'active show'; else echo $view_model->menu_active_btn;?>" id="hotels" role="tabpanel">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label"><?php echo $view_model->translations->get('link_hotels');?></li>
                            <li>
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <?php echo $view_model->translations->get('gestione_hotels');?>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="javascript:void()" data-action="hotels" data-params="false" class="open-view-action"><?php echo $view_model->translations->get('tutti_gli_hotel');?></a></li>
                                    <li><a href="javascript:void()" data-action="hotels" class="open-view-action" data-params="<?php echo $$view_model->translations->get('nuovo_params');?>"><?php echo $view_model->translations->get('nuovo_hotel');?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php } ?>

                <?php if($view_model->user->level == 0) { ?>
                    <div class="tab-pane fade" id="role">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label">Cambio ruolo</li>
                            <li class="mm-active">
                                <a class="has-arrow" href="javascript:void()" aria-expanded="true">
                                    <span class="nav-text">Passa a:</span>
                                </a>
                                <ul aria-expanded="true">
                                    <li><a href="process/change_role?set=0">Developer (God user)</a></li>
                                    <li><a href="process/change_role?set=1">Superadmin user</a></li>
                                    <li><a href="process/change_role?set=2">Admin user</a></li>
                                    <li><a href="process/change_role?set=3">Hotel Pro user</a></li>
                                    <li><a href="process/change_role?set=4">Hotel user</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php } ?>

                <?php if($view_model->user->level <= 2) { ?>
                    <div class="tab-pane fade <?php if(strtolower($view_model->menu_active_btn) == 'administrators') echo 'active show'; else echo $view_model->menu_active_btn;?>" id="administrators">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label"><?php echo $view_model->translations->get('amministratori');?></li>
                            <li>
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text"><?php echo $view_model->translations->get('gestione_amministratori');?></span>
                                </a>
                                <ul aria-expanded="false">
                                    <li>
                                        <a href="javascript:void()" class="open-view-action" data-action="<?php echo strtolower($view_model->translations->get('amministratori'));?>" data-title="<?php echo $view_model->translations->get('amministratori').' | '.$view_model->translations->get('nome_sito');?>" data-params="false">
                                            <?php echo $view_model->translations->get('tutti_amministratori');?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void()" class="open-view-action" data-action="<?php echo strtolower($view_model->translations->get('amministratori'));?>" data-title="<?php echo $view_model->translations->get('amministratori').' | '.$view_model->translations->get('nome_sito');?>" data-params="<?php echo $view_model->translations->get('nuovo_params');?>">
                                            <?php echo $view_model->translations->get('crea_amministratore');?>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php } ?>

                <?php if($view_model->user->level <= 4) { ?>
                    <div class="tab-pane fade <?php if(strtolower($view_model->menu_active_btn) == 'facilities') echo 'active show'; else echo $view_model->menu_active_btn;?>" id="facilities">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label"><?php echo $view_model->translations->get('gestione_strutture');?></li>
                            <li class="mega-menu mega-menu-xl">
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text"><?php echo $view_model->translations->get('lista_strutture');?></span>
                                </a>
                                <ul aria-expanded="false">
                                    <li>
                                        <a href="javascript:void()" class="open-view-action" data-action="<?php echo $view_model->translations->get('link_strutture');?>" data-params="false">
                                            <?php echo $view_model->translations->get('lista_strutture');?>
                                        </a>
                                    </li>
                                    <?php if($view_model->user->level <= 3) { ?>
                                        <li>
                                            <a href="javascript:void()" class="open-view-action" data-action="<?php echo $view_model->translations->get('link_strutture');?>" data-params="<?php echo $view_model->translations->get('nuovo_params');?>">
                                                <?php echo $view_model->translations->get('crea_nuova_struttura');?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php if($view_model->user->level <= 2) { ?>
                                <li class="mega-menu mega-menu-xl">
                                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                        <span class="nav-text"><?php echo $view_model->translations->get('categorie_strutture');?></span>
                                    </a>
                                    <ul aria-expanded="false">
                                        <li>
                                            <a href="javascript:void()" class="open-view-action" data-action="<?php echo $view_model->translations->get('link_strutture');?>" data-params="<?php echo $view_model->translations->get('categorie');?>"><?php echo $view_model->translations->get('lista_categorie');?></a></li>
                                        <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $view_model->translations->get('link_strutture');?>" data-params="<?php echo $view_model->translations->get('param_nuova_categoria');?>"><?php echo $view_model->translations->get('nuova_categoria');?></a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php if($view_model->user->level >= 3 || $view_model->user->level == 0) { ?>
                    <div class="tab-pane fade <?php if(strtolower($view_model->menu_active_btn) == 'profile') echo 'active show'; else echo $view_model->menu_active_btn;?>" id="profile">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label">NOME HOTEL</li>
                            <li class="">
                                <a class="ai-icon" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text"><?php echo $view_model->translations->get('informazioni_hotel');?></span>
                                </a>
                            </li>

                        </ul>
                    </div>
                <?php } ?>

                <div class="tab-pane fade <?php if(strtolower($view_model->menu_active_btn) == 'events') echo 'active show'; else echo $view_model->menu_active_btn;?>" id="events">
                    <ul class="metismenu tab-nav-menu">
                        <li class="nav-label"><?php echo $view_model->translations->get('eventi');?></li>
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text"><?php echo $view_model->translations->get('gestione_eventi');?></span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $view_model->translations->get('params_eventi');?>" data-title="<?php echo $view_model->translations->get('eventi').' | '.$view_model->translations->get('nome_sito');?>"data-params="false"><?php echo $view_model->translations->get('tutti_eventi');?></a></li>
                                <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $view_model->translations->get('params_eventi');?>" data-title="<?php echo $view_model->translations->get('eventi').' | '.$view_model->translations->get('nome_sito');?>"data-params="<?php echo $view_model->translations->get('nuovo_params');?>"><?php echo $view_model->translations->get('crea_evento');?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <?php if($view_model->user->level >= 3 || $view_model->user->level == 0) { ?>
                    <div class="tab-pane fade <?php if(strtolower($view_model->menu_active_btn) == 'guests') echo 'active show'; else echo $view_model->menu_active_btn;?>" id="guests">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label"><?php echo $view_model->translations->get('ospiti');?></li>
                            <li>
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text"><?php echo $view_model->translations->get('gestione_ospiti');?></span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo strtolower($view_model->translations->get('param_ospiti'));?>" data-title="<?php echo $view_model->translations->get('ospiti').' | '.$view_model->translations->get('nome_sito');?>" data-params="false"><?php echo $view_model->translations->get('tutti_ospiti');?></a></li>
                                    <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo strtolower($view_model->translations->get('param_ospiti'));?>" data-title="<?php echo $view_model->translations->get('ospiti').' | '.$view_model->translations->get('nome_sito');?>" data-params="<?php echo $view_model->translations->get('param_carica');?>"><?php echo $view_model->translations->get('carica_ospiti');?></a></li>
                                    <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo strtolower($view_model->translations->get('param_ospiti'));?>" data-title="<?php echo $view_model->translations->get('ospiti').' | '.$view_model->translations->get('nome_sito');?>" data-params="<?php echo $view_model->translations->get('nuovo_params');?>"><?php echo $view_model->translations->get('aggiungi_ospiti');?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php } ?>

                <div class="tab-pane fade <?php if(strtolower($view_model->menu_active_btn) == 'settings') echo 'active show'; else echo $view_model->menu_active_btn;?>" id="settings">
                    <ul class="metismenu tab-nav-menu">
                        <li class="nav-label"><?php echo $view_model->translations->get('impostazioni');?></li>
                        <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $view_model->translations->get('link_impostazioni');?>" data-params="false"><?php echo $view_model->translations->get('impostazioni_account');?></a></li>
                    </ul>
                </div>

                <?php if($view_model->user->level <= 1) { ?>
                    <div class="tab-pane fade <?php if(strtolower($view_model->menu_active_btn) == 'translations') echo 'active show'; else echo $view_model->menu_active_btn;?>" id="translations">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label"><?php echo $view_model->translations->get('traduzioni');?></li>
                            <li><a class="open-view-action" data-action="<?php echo $view_model->translations->get('link_traduzioni');?>" data-params="false" href="javascript:void()"><?php echo $view_model->translations->get('traduzioni');?></a></li>
                            <!--<li><a class="open-view-action" data-action="<?php echo $view_model->translations->get('link_traduzioni');?>" data-params="<?php echo $view_model->translations->get('params_messaggi_predefiniti');?>" href="javascript:void()"><?php echo $view_model->translations->get('messaggi_predefiniti');?></a></li>-->

                            <li class="mega-menu mega-menu-xl">
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text"><?php echo $view_model->translations->get('lingue');?></span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a class="open-view-action" href="javascript:void()" data-params="<?php echo $view_model->translations->get('params_lingue');?>" data-action="<?php echo $view_model->translations->get('link_traduzioni');?>"><?php echo $view_model->translations->get('lingue_create');?></a></li>
                                    <li><a class="open-view-action" href="javascript:void()" data-params="<?php echo $view_model->translations->get('params_nuova_lingua');?>" data-action="<?php echo $view_model->translations->get('link_traduzioni');?>"><?php echo $view_model->translations->get('crea_nuova_lingua');?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="notification-message"></div>
                    </div>

                    <ul class="navbar-nav header-right">
                        <li class="nav-item">
                            <a class="nav-link bell ai-icon open-view-action" href="javascript:void()" data-action="<?php echo $view_model->translations->get('link_notifiche');?>" data-title="<?php echo $view_model->translations->get('notifiche').' | '.$view_model->translations->get('nome_sito');?>" data-params="false" role="button">
                                <i class="fa fa-envelope fa-env-header"></i>
                            </a>
                        </li>
                        <li class="nav-item  header-profile">
                            <a class="nav-link nav-modded open-menu" data-menu="<?php echo $view_model->translations->get('link_impostazioni');?>" href="javascript:void()" data-action="<?php echo $view_model->translations->get('link_impostazioni')?>" data-params="false" role="button" data-toggle="dropdown">
                                <i class="fa fa-user-o fa-user-modded"></i>
                                <div class="header-info">
                                    <span>Hey, <strong><?php echo $view_model->user->name;?></strong></span>
                                    <small><?php echo $view_model->user->level_name;?></small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- /Header -->

    <!-- Minimenu -->
    <div class="deznav">
        <div class="deznav-scroll">
            <ul class="nav menu-tabs">
                <?php if($view_model->user->level == 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#role">
                            <i class="fa fa-user"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php if($view_model->user->level <= 2) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($view_model->menu_active_btn == 'administrators') echo 'active';?>" data-toggle="tab" data-title="<?php echo $view_model->translations->get('menu_amministratori').' | '.$view_model->translations->get('nome_sito');?>" data-action="<?php echo strtolower($view_model->translations->get('amministratori'));?>" data-params="false" href="#administrators" id="menu-administrators">
                            <i class="fa fa-users"></i>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link open-view-action <?php if($view_model->menu_active_btn == 'dashboard') echo 'active';?>" data-action="<?php echo $view_model->translations->get('param_dashboard');?>" data-params="false" data-toggle="tab" data-title="<?php echo $view_model->translations->get('dashboard').' | '.$view_model->translations->get('nome_sito');?>" href="#dashboard">
                        <i class="fa fa-dashboard"></i>
                    </a>
                </li>
                <?php if($view_model->user->level <= 2) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($view_model->menu_active_btn == 'hotels') echo 'active';?>" data-toggle="tab" data-action="<?php echo $view_model->translations->get('link_hotels');?>" data-params="false" data-title="<?php echo $view_model->translations->get('titolo_hotel').' | '.$view_model->translations->get('nome_sito');?>" href="#hotels" id="menu-hotels">
                            <i class="fa fa-building-o"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php if($view_model->user->level <= 4) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($view_model->menu_active_btn == 'facilities') echo 'active';?>" data-action="<?php echo $view_model->translations->get('link_strutture');?>" data-params="false" data-title="<?php echo $view_model->translations->get('titolo_strutture').' | '.$view_model->translations->get('nome_sito');?>" data-toggle="tab" href="#facilities">
                            <i class="fa fa-building"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php if($view_model->user->level >= 3 || $view_model->user->level == 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($view_model->menu_active_btn == 'guests') echo 'active';?>" data-title="<?php echo $view_model->translations->get('titolo_ospiti').' | '.$view_model->translations->get('nome_sito');?>" data-action="<?php echo $view_model->translations->get('param_ospiti');?>" data-params="false" data-toggle="tab" href="#guests">
                            <i class="fa fa-users"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php if($view_model->user->level >= 3 || $view_model->user->level == 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($view_model->menu_active_btn == 'profile') echo 'active';?>" data-action="<?php echo $view_model->translations->get('link_mio_hotel');?>" data-params="false" data-title="<?php echo $view_model->user->name.' | '.$view_model->translations->get('nome_sito');?>" data-toggle="tab" href="#profile">
                            <i class="fa fa-building-o"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php if($view_model->user->level <= 3) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($view_model->menu_active_btn == 'events') echo 'active';?>" data-title="<?php echo $view_model->translations->get('titolo_eventi').' | '.$view_model->translations->get('nome_sito');?>" data-action="<?php echo $view_model->translations->get('params_eventi');?>" data-params="false" data-toggle="tab" href="#menu">
                            <i class="fa fa-calendar"></i>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link open-view-action <?php if($view_model->menu_active_btn == 'settings') echo 'active';?>" data-action="<?php echo $view_model->translations->get('link_impostazioni');?>" data-params="false" data-title="<?php echo $view_model->translations->get('titolo_impostazioni').' | '.$view_model->translations->get('nome_sito');?>" data-toggle="tab" href="#settings" id="menu-settings">
                        <i class="fa fa-gear"></i>
                    </a>
                </li>
                <?php if($view_model->user->level <= 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($view_model->menu_active_btn == 'translations') echo 'active';?>" data-action="<?php echo $view_model->translations->get('link_traduzioni');?>" data-title="<?php echo $view_model->translations->get('titolo_traduzioni').' | '.$view_model->translations->get('nome_sito');?>"  data-params="false" data-toggle="tab" href="#translations">
                            <i class="fa fa-language"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <a href="process/logout.php" class="logout-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg></a>
    </div>
    <!-- /Minimenu -->

    <!--**********************************
    Content body start
    ***********************************-->
    <div class="content-body">
        <div class="content-ajax"></div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


</div>
