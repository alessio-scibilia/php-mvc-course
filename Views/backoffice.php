<!DOCTYPE html>
<html>
<?php
    if ($view_model->template_name == 'login')
        require_once 'Views/backoffice.head.login.php';
    else
        require_once 'Views/backoffice.head.common.php';
?>
<body>
<?php if($currentPage != 'login') { ?>
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
                <div class="tab-pane fade <?php if($menu_active_btn == 'dashboard') echo 'active show';?>" id="dashboard" role="tabpanel">
                    <ul class="metismenu tab-nav-menu">
                        <li class="nav-label"><?php echo $langs['dashboard'];?></li>
                        <p>Accedi ai collegamenti rapidi, visualizza le comunicazioni e le statistiche.</p>
                    </ul>
                </div>

                <?php if($_SESSION['level'] <= 4) { ?>
                    <div class="tab-pane fade <?php if(strtolower($menu_active_btn) == strtolower($langs['link_hotels'])) echo 'active show'; else echo $menu_active_btn;?>" id="<?php echo $langs['link_hotels'];?>" role="tabpanel">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label"><?php echo $langs['link_hotels'];?></li>
                            <li>
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <?php echo $langs['gestione_hotels'];?>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="javascript:void()" data-action="<?php echo $langs['link_hotels'];?>" data-params="false" class="open-view-action"><?php echo $langs['tutti_gli_hotel'];?></a></li>
                                    <li><a href="javascript:void()" data-action="<?php echo $langs['link_hotels'];?>" class="open-view-action" data-params="<?php echo $langs['nuovo_params'];?>"><?php echo $langs['nuovo_hotel'];?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php } ?>

                <?php if($_SESSION['level'] == 0) { ?>
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

                <?php if($_SESSION['level'] <= 2) { ?>
                    <div class="tab-pane fade <?php if(strtolower($menu_active_btn) == strtolower($langs['amministratori'])) echo 'active show'; else echo $menu_active_btn;?>" id="<?php echo strtolower($langs['amministratori']);?>">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label"><?php echo $langs['amministratori'];?></li>
                            <li>
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text"><?php echo $langs['gestione_amministratori'];?></span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo strtolower($langs['amministratori']);?>" data-title="<?php echo $langs['amministratori'].' | '.$langs['nome_sito'];?>" data-params="false"><?php echo $langs['tutti_amministratori'];?></a></li>
                                    <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo strtolower($langs['amministratori']);?>" data-title="<?php echo $langs['amministratori'].' | '.$langs['nome_sito'];?>" data-params="<?php echo $langs['nuovo_params'];?>"><?php echo $langs['crea_amministratore'];?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php } ?>

                <?php if($_SESSION['level'] <= 4) { ?>
                    <div class="tab-pane fade <?php if(strtolower($menu_active_btn) == strtolower($langs['link_strutture'])) echo 'active show'; else echo $menu_active_btn;?>" id="<?php echo $langs['link_strutture'];?>">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label"><?php echo $langs['gestione_strutture'];?></li>
                            <li class="mega-menu mega-menu-xl">
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text"><?php echo $langs['lista_strutture'];?></span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $langs['link_strutture'];?>" data-params="false"><?php echo $langs['lista_strutture'];?></a></li>
                                    <?php if($_SESSION['level'] <= 3) { ?>
                                        <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $langs['link_strutture'];?>" data-params="<?php echo $langs['nuovo_params'];?>"><?php echo $langs['crea_nuova_struttura'];?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php if($_SESSION['level'] <= 2) { ?>
                                <li class="mega-menu mega-menu-xl">
                                    <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                        <span class="nav-text"><?php echo $langs['categorie_strutture'];?></span>
                                    </a>
                                    <ul aria-expanded="false">
                                        <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $langs['link_strutture'];?>" data-params="<?php echo $langs['categorie'];?>"><?php echo $langs['lista_categorie'];?></a></li>
                                        <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $langs['link_strutture'];?>" data-params="<?php echo $langs['param_nuova_categoria'];?>"><?php echo $langs['nuova_categoria'];?></a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php if($_SESSION['level'] >= 3 || $_SESSION['level'] == 0) { ?>
                    <div class="tab-pane fade" id="<?php echo $langs['link_mio_hotel'];?>">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label">NOME HOTEL</li>
                            <li class="">
                                <a class="ai-icon" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text"><?php echo $langs['informazioni_hotel'];?></span>
                                </a>
                            </li>

                        </ul>
                    </div>
                <?php } ?>

                <div class="tab-pane fade <?php if(strtolower($menu_active_btn) == strtolower($langs['eventi'])) echo 'active show'; else echo $menu_active_btn;?>" id="<?php echo strtolower($langs['eventi']);?>">
                    <ul class="metismenu tab-nav-menu">
                        <li class="nav-label"><?php echo $langs['eventi'];?></li>
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <span class="nav-text"><?php echo $langs['gestione_eventi'];?></span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $langs['params_eventi'];?>" data-title="<?php echo $langs['eventi'].' | '.$langs['nome_sito'];?>"data-params="false"><?php echo $langs['tutti_eventi'];?></a></li>
                                <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $langs['params_eventi'];?>" data-title="<?php echo $langs['eventi'].' | '.$langs['nome_sito'];?>"data-params="<?php echo $langs['nuovo_params'];?>"><?php echo $langs['crea_evento'];?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <?php if($_SESSION['level'] >= 3 || $_SESSION['level'] == 0) { ?>
                    <div class="tab-pane fade <?php if(strtolower($menu_active_btn) == strtolower($langs['param_ospiti'])) echo 'active show'; else echo $menu_active_btn;?>" id="<?php echo strtolower($langs['param_ospiti']);?>">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label"><?php echo $langs['ospiti'];?></li>
                            <li>
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text"><?php echo $langs['gestione_ospiti'];?></span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo strtolower($langs['param_ospiti']);?>" data-title="<?php echo $langs['ospiti'].' | '.$langs['nome_sito'];?>" data-params="false"><?php echo $langs['tutti_ospiti'];?></a></li>
                                    <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo strtolower($langs['param_ospiti']);?>" data-title="<?php echo $langs['ospiti'].' | '.$langs['nome_sito'];?>" data-params="<?php echo $langs['param_carica'];?>"><?php echo $langs['carica_ospiti'];?></a></li>
                                    <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo strtolower($langs['param_ospiti']);?>" data-title="<?php echo $langs['ospiti'].' | '.$langs['nome_sito'];?>" data-params="<?php echo $langs['nuovo_params'];?>"><?php echo $langs['aggiungi_ospiti'];?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php } ?>

                <div class="tab-pane fade <?php if(strtolower($menu_active_btn) == strtolower($langs['link_impostazioni'])) echo 'active show'; else echo $menu_active_btn;?>" id="<?php echo $langs['link_impostazioni'];?>">
                    <ul class="metismenu tab-nav-menu">
                        <li class="nav-label"><?php echo $langs['impostazioni'];?></li>
                        <li><a href="javascript:void()" class="open-view-action" data-action="<?php echo $langs['link_impostazioni'];?>" data-params="false"><?php echo $langs['impostazioni_account'];?></a></li>
                    </ul>
                </div>
                <?php if($_SESSION['level'] <= 1) { ?>
                    <div class="tab-pane fade <?php if(strtolower($menu_active_btn) == strtolower($langs['link_traduzioni'])) echo 'active show'; else echo $menu_active_btn;?>" id="<?php echo $langs['link_traduzioni'];?>">
                        <ul class="metismenu tab-nav-menu">
                            <li class="nav-label"><?php echo $langs['traduzioni'];?></li>
                            <li><a class="open-view-action" data-action="<?php echo $langs['link_traduzioni'];?>" data-params="false" href="javascript:void()"><?php echo $langs['traduzioni'];?></a></li>
                            <!--<li><a class="open-view-action" data-action="<?php echo $langs['link_traduzioni'];?>" data-params="<?php echo $langs['params_messaggi_predefiniti'];?>" href="javascript:void()"><?php echo $langs['messaggi_predefiniti'];?></a></li>-->

                            <li class="mega-menu mega-menu-xl">
                                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                    <span class="nav-text"><?php echo $langs['lingue'];?></span>
                                </a>
                                <ul aria-expanded="false">
                                    <li><a class="open-view-action" href="javascript:void()" data-params="<?php echo $langs['params_lingue'];?>" data-action="<?php echo $langs['link_traduzioni'];?>"><?php echo $langs['lingue_create'];?></a></li>
                                    <li><a class="open-view-action" href="javascript:void()" data-params="<?php echo $langs['params_nuova_lingua'];?>" data-action="<?php echo $langs['link_traduzioni'];?>"><?php echo $langs['crea_nuova_lingua'];?></a></li>
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
                            <a class="nav-link bell ai-icon open-view-action" href="javascript:void()" data-action="<?php echo $langs['link_notifiche'];?>" data-title="<?php echo $langs['notifiche'].' | '.$langs['nome_sito'];?>" data-params="false" role="button">
                                <i class="fa fa-envelope fa-env-header"></i>
                            </a>
                        </li>
                        <li class="nav-item  header-profile">
                            <a class="nav-link nav-modded open-menu" data-menu="<?php echo $langs['link_impostazioni'];?>" href="javascript:void()" data-action="<?php echo $langs['link_impostazioni']?>" id="impostazioni" data-params="false" role="button" data-toggle="dropdown">
                                <i class="fa fa-user-o fa-user-modded"></i>
                                <div class="header-info">
                                    <span>Hey, <strong><?php echo $_SESSION['name'];?></strong></span>
                                    <small><?php echo $_SESSION['level_text'];?></small>
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
                <?php if($_SESSION['level'] == 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#role">
                            <i class="fa fa-user"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php if($_SESSION['level'] <= 2) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($menu_active_btn == $langs['link_amministratori']) echo 'active';?>" data-toggle="tab" data-title="<?php echo $langs['menu_amministratori'].' | '.$langs['nome_sito'];?>" data-action="<?php echo strtolower($langs['amministratori']);?>" data-params="false" href="#<?php echo strtolower($langs['amministratori']);?>" id="menu-<?php echo strtolower($langs['amministratori']);?>">
                            <i class="fa fa-users"></i>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link open-view-action <?php if($menu_active_btn == $langs['param_dashboard']) echo 'active';?>" data-action="<?php echo $langs['param_dashboard'];?>" data-params="false" data-toggle="tab" data-title="<?php echo $langs['dashboard'].' | '.$langs['nome_sito'];?>" href="#<?php echo $langs['param_dashboard'];?>">
                        <i class="fa fa-dashboard"></i>
                    </a>
                </li>
                <?php if($_SESSION['level'] <= 2) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($menu_active_btn == $langs['link_hotels']) echo 'active';?>" data-toggle="tab" data-action="<?php echo $langs['link_hotels'];?>" data-params="false" data-title="<?php echo $langs['titolo_hotel'].' | '.$langs['nome_sito'];?>" href="#<?php echo $langs['link_hotels'];?>" id="menu-<?php echo $langs['link_hotels'];?>">
                            <i class="fa fa-building-o"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php if($_SESSION['level'] <= 4) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($menu_active_btn == $langs['link_strutture']) echo 'active';?>" data-action="<?php echo $langs['link_strutture'];?>" data-params="false" data-title="<?php echo $langs['titolo_strutture'].' | '.$langs['nome_sito'];?>" data-toggle="tab" href="#<?php echo $langs['link_strutture'];?>">
                            <i class="fa fa-building"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php if($_SESSION['level'] >= 3 || $_SESSION['level'] == 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($menu_active_btn == $langs['param_ospiti']) echo 'active';?>" data-title="<?php echo $langs['titolo_ospiti'].' | '.$langs['nome_sito'];?>" data-action="<?php echo $langs['param_ospiti'];?>" data-params="false" data-toggle="tab" href="#<?php echo $langs['param_ospiti'];?>">
                            <i class="fa fa-users"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php if($_SESSION['level'] >= 3 || $_SESSION['level'] == 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action" data-action="<?php echo $langs['link_mio_hotel'];?>" data-params="false" data-title="<?php echo $_SESSION['name'].' | '.$langs['nome_sito'];?>" data-toggle="tab" href="#<?php echo $langs['link_mio_hotel'];?>">
                            <i class="fa fa-building-o"></i>
                        </a>
                    </li>
                <?php } ?>
                <?php if($_SESSION['level'] <= 3) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($menu_active_btn == $langs['params_eventi']) echo 'active';?>" data-title="<?php echo $langs['titolo_eventi'].' | '.$langs['nome_sito'];?>" data-action="<?php echo $langs['params_eventi'];?>" data-params="false" data-toggle="tab" href="#<?php echo $langs['params_eventi'];?>">
                            <i class="fa fa-calendar"></i>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link open-view-action <?php if($menu_active_btn == $langs['link_impostazioni']) echo 'active';?>" data-action="<?php echo $langs['link_impostazioni'];?>" data-params="false" data-title="<?php echo $langs['titolo_impostazioni'].' | '.$langs['nome_sito'];?>" data-toggle="tab" href="#<?php echo $langs['link_impostazioni'];?>" id="menu-<?php echo $langs['link_impostazioni'];?>">
                        <i class="fa fa-gear"></i>
                    </a>
                </li>
                <?php if($_SESSION['level'] <= 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link open-view-action <?php if($menu_active_btn == $langs['link_traduzioni']) echo 'active';?>" data-action="<?php echo $langs['link_traduzioni'];?>" data-title="<?php echo $langs['titolo_traduzioni'].' | '.$langs['nome_sito'];?>"  data-params="false" data-toggle="tab" href="#<?php echo $langs['link_traduzioni'];?>">
                            <i class="fa fa-language"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <a href="process/logout.php" class="logout-btn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg></a>
    </div>
    <!-- /Minimenu -->
    <?php } ?>

