<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once 'Middlewares/Environment.class.php';

if (Environment::get() == 'dev')
{
    error_reporting(E_ALL);
}
else
{
    error_reporting(E_ALL & ~E_NOTICE);
}

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
