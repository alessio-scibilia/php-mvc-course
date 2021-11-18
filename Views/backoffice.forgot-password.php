<!DOCTYPE html>
<html>
<?php require_once 'Views/backoffice.head.login.php'; ?>
<body>
<?php ?>
<div class="login-container">
    <div class="box-login">

        <img src="/images/logo-wellcome-scuro.png" class="logo-login mb25" title=""/>
        <!-- <img src="https://picsum.photos/370/100" class="logo-login mb25" name="" title="" /> -->

        <form action="/backoffice/forgot-password" method="POST" class="validate-it-form">
            <h1 class="title-login"><?php echo $view_model->translations->get('password_dimenticata'); ?></h1>

            <?php if (!empty($view_model->message)) { ?>
                <div class="alert alert-info alert-login"><?php echo $view_model->message; ?></div>
            <?php } ?>

            <label for="email" id="labelmail"><?php echo $view_model->translations->get('email'); ?></label>
            <input type="text" class="form-control input-md validate-1 mb5" name="email" id="email"
                   placeholder="mario@rossi.it">

            <?php include 'Views/xdebug.form.php' ?>
            <input type="submit" value="<?php echo $view_model->translations->get('ricevi_codice_recupero'); ?>" class="form-control btn btn-primary mb15 display-ease-in">
        </form>
    </div>
</div>
<?php require_once 'Views/backoffice.login.footer.php'; ?>
</body>
</html>