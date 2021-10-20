<?php
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

try
{
    require_once 'Router.class.php';

    session_start();
    $router = new Router();
    $callable = $router->route();
    $view = $callable();
    $view->render();
}
catch (Exception $e)
{
    echo $e->getMessage();
}
