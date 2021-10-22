<?php
require_once 'Views/IView.interface.php';

class JsonView implements IView
{
    protected $view_model;

    function __construct($view_model)
    {
        $this->view_model = $view_model;
    }

    function render() /*: void*/
    {
        header('Content-Type: application/json');
        echo json_encode($this->view_model, JSON_PRETTY_PRINT);
    }
}