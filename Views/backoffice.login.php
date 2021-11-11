<!DOCTYPE html>
<html>
<?php require_once 'Views/backoffice.head.login.php'; ?>
<body>
<?php ?>
<div class="login-container">
    <div class="box-login">

        <img src="images/logo-wellcome-scuro.png" class="logo-login mb25" title=""/>
        <!-- <img src="https://picsum.photos/370/100" class="logo-login mb25" name="" title="" /> -->

        <form action="/authentication" method="POST" class="validate-it-form">
            <h1 class="title-login"><?php echo $view_model->translations->get('accedi'); ?></h1>
            <?php if (isset($_GET['reset']) && $_GET['reset'] == true)
                echo '<div class="alert alert-info alert-login">Password reimpostata con successo, accedi.</div>'; ?>
            <?php if (isset($_GET['reset']) && $_GET['reset'] == false)
                echo '<div class="alert alert-info alert-login">Non è stato possibile ripristinare la password</div>'; ?>
            <label for="email" id="labelmail"><?php echo $view_model->translations->get('email'); ?></label>
            <input type="text" class="form-control input-md validate-1 mb5" name="email" id="email"
                   placeholder="mario@rossi.it">

            <label for="password"><?php echo $view_model->translations->get('password'); ?></label>
            <input type="password" class="form-control input-md validate-1 mb15" name="password" id="password">

            <input type="text" id="digits-code" class="form-control input-md mb5 text-center" style="display: none;"
                   placeholder="XXXXXX">

            <input type="hidden" name="type_login" id="type_login" value="0">
            <?php include 'Views/xdebug.form.php' ?>

            <input type="submit" value="Login" class="form-control btn btn-primary mb15 display-ease-in">
            <a href="javascript:void()"
               class="forgot-password"><?php echo $view_model->translations->get('password_dimenticata'); ?></a>
        </form>
    </div>
</div>
<?php require_once 'Views/backoffice.login.footer.php'; ?>
</body>
</html>