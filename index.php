<?php
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

try
{
    require_once 'Middlewares/SessionManager.class.php';
    SessionManager::start();

    require_once 'Router.class.php';
    $router = new Router();
    $callable = $router->route();
    $view = $callable();
    $view->render();
}
catch (Exception $e)
{
    echo $e->getMessage();
}
