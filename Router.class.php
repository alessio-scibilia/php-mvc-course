<?php
require_once 'Controllers/ErrorController.class.php';

class Router
{
    public function route(): callable
    {
        // Merge all params
        $params = array_merge($_REQUEST, $_COOKIE);

        // Extract path:
        $uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($uri, PHP_URL_PATH);
        $params['fragment'] = parse_url($uri, PHP_URL_FRAGMENT);

        // Extract parameters:
        $pieces = explode('/', $path);
        $n = count($pieces);
        $param = 'default';
        $controls = array();
        for ($i = 0; $i < $n; $i++)
        {
            $piece = $pieces[$i];
            if ($piece == '') continue;
            if (preg_match('/^\d+$/', $piece) === 1)
            {
                $params[$param] = intval($piece);
                $param = 'default';
            }
            else
            {
                $controls[] = $piece;
                $param = $piece;
            }
        }
        if (isset($params['default']))
        {
            $controls[] = 'frontoffice';
        }

        $controller_name = join('', array_map('ucfirst', $controls)) . 'Controller';
        $controller_path = "Controllers/$controller_name.class.php";

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
        return function() use($controller, $action, $params) {
          return $controller->{$action}($params);
        };
    }
}