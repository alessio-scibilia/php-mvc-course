<?php
require_once 'Controllers/ErrorController.class.php';

class Router
{
    public function route(): callable
    {
        // Extract path:
        $uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($uri, PHP_URL_PATH);

        // Extract controller:
        $pieces = explode('/', $path);
        $controller_name = join('', array_map('ucfirst', $pieces)) . 'Controller';
        $controller_path = "/Controllers/$controller_name.class.php";

        if (!is_file($controller_path))
        {
            $controller = new ErrorController();
            $action = 'http_get';
        }
        else
        {
            require_once $controller_path;
            $controller = new $controller_name();

            // Extract action:
            $action = 'http_' . strtolower($_SERVER['REQUEST_METHOD']);
        }

        // Callable
        return function() use($controller, $action) {
          return $controller->{$action}($_REQUEST);
        };
    }
}