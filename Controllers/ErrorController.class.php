<?php
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class ErrorController
{
    public function http_get(array &$params): HtmlView
    {
        return new Html404();
    }
}