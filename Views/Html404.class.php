<?php
require_once 'Views/HtmlView.class.php';
require_once 'ViewModels/EmptyViewModel.class.php';

class Html404 extends HtmlView
{
    public function __construct()
    {
        $view_model = new EmptyViewModel();
        parent::__construct($view_model);
    }
}