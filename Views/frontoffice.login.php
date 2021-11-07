<!DOCTYPE html>
<html>
<?php require_once 'Views/frontoffice.head.login.php'; ?>
<body>
<?php ?>
<!-- MINI MENU -->
<div class="container-menu">
    <div class="box box-1">
        <div align="center">
            <img src="img/logo-piccolo.png" alt="" title="" class="logo-menu">
        </div>
    </div>
    <div class="box box-2">
        <div align="center" id="open-menu">
            <div class="menu-bar"></div>
            <div class="menu-bar"></div>
            <div class="menu-bar"></div>
        </div>
    </div>
    <div class="box box-1"></div>
</div>

<!-- MENU MOBILE -->
<div class="menu-mobile">
    <img src="img/logo-wellcome-bianco.png" class="logo-menu-mobile" alt="" title=""/>
    <div for="" id="open-menu-mob-index">
        <input type="checkbox" id="check1"/>
        <span class="spanm1"></span>
        <span class="spanm1"></span>
        <span class="spanm1"></span>
    </div>
</div>

<!-- EXPAND MENU -->
<nav class="container-menu-expand real-out out-side-now blue-menu">
    <ol>
        <li class="blue-menu-item" data-section="1">
            <span><?php echo $view_model->translations->get('info_hotel'); ?></span>
        </li>
        <li class="blue-menu-item" data-section="2">
            <span><?php echo $view_model->translations->get('proposte'); ?></span>
        </li>
        <li class="blue-menu-item" data-section="3">
            <span><?php echo $view_model->translations->get('suggerimenti'); ?></span>
        </li>
    </ol>
</nav>

<!-- RIGHT CONTENT -->
<div class="content-container"
     style="background-image: linear-gradient(to bottom, rgba(66, 66, 66, 0.40), rgba(66, 66, 66, 0.40)), url('cp/<?php //TODO echo $img_principale; ?>')">
    <div class="welcome-container welcome-container-hidden">
        <div class="welcome">
            <?php
            $error = false; //TODO: sistemare l'error qui, al momento non appare
            if ($error == false) { ?>
                <h1 class="main-title"><span><?php echo $view_model->translations->get('benvenuti_a_home'); ?></span>
                    All'Hotel <?php echo $view_model->translations->get('nome'); ?></h1>

                <!-- Lang selectors -->
                <div class="language-container">
                    <?php require_once 'Views/backoffice.language.selector.php'; ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="login-container login-container-hidden">
        <?php if ($error == false) { ?>
            <div class="form-login-blurred"></div>
            <div class="form-login">
                <form action="/authentication" id="form-login" method="POST">
                    <input type="hidden" name="id_hotel" id="strh" value="556"> <?php //TODO id hotel dinamico ?>
                    <input type="text" name="numero_stanza" id="num_stanza" class="input-login input-stanza"
                           placeholder="<?php echo $view_model->translations->get('numero_stanza'); ?>">
                    <input type="password" name="password" id="code_stanza" class="input-login"
                           placeholder="<?php echo $view_model->translations->get('codice_stanza'); ?>">
                    <input type="submit" class="submit-login"
                           value="<?php echo $view_model->translations->get('accedi'); ?>">
                </form>
            </div>
            <div class="alert-container <?php if (!isset($_GET['invalid'])) echo 'dn'; ?>">
                <div class="alert-credentials">
                    <?php echo $view_model->translations->get('dati_inseriti_wrong'); ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php require_once 'Views/frontoffice.footer.php'; ?>
</body>
</html>