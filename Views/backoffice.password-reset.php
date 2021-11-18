<!DOCTYPE html>
<html>
<?php require_once 'Views/backoffice.head.login.php'; ?>
<body>
<?php ?>
<div class="login-container">
    <div class="box-login">

        <img src="/images/logo-wellcome-scuro.png" class="logo-login mb25" title=""/>
        <!-- <img src="https://picsum.photos/370/100" class="logo-login mb25" name="" title="" /> -->

        <form action="/password-reset" method="POST" class="validate-it-form">
            <h1 class="title-login"><?php echo $view_model->translations->get('conferma_nuova_password'); ?></h1>

            <label for="email" id="labelmail"><?php echo $view_model->translations->get('email'); ?></label>
            <input type="text"
                   class="form-control input-md validate-1 mb5"
                   name="email"
                   id="email"
                   placeholder="mario@rossi.it">

            <label for="digits-code"><?php echo $view_model->translations->get('email'); ?></label>
            <input type="text"
                   name="digits-code"
                   id="digits-code"
                   class="form-control input-md mb5 text-center"
                   placeholder="XXXXXX">

            <label for="password"><?php echo $view_model->translations->get('password'); ?></label>
            <input type="password"
                   name="password"
                   value=""
                   autocomplete="new-password"
                   id="password"
                   class="form-control">

            <label for="conferma_password-type-2"><?php echo $view_model->translations->get('conferma_password'); ?></label>
            <input type="password"
                   value=""
                   autocomplete="new-password"
                   id="conferma_password-type-2"
                   class="form-control">

            <?php include 'Views/xdebug.form.php' ?>
            <input type="submit" value="Login" class="form-control btn btn-primary mb15 display-ease-in">
        </form>
    </div>
</div>
<?php require_once 'Views/backoffice.login.footer.php'; ?>
</body>
</html>