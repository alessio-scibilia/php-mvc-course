<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
