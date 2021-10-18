<?php
require_once 'ViewModels/AbstractTemplateViewModel.class.php';
require_once 'Views/IView.interface.php';

class HtmlView implements IView
{
    protected $template_path;
    protected $view_model;

    function __construct(AbstractTemplateViewModel &$view_model)
    {
        $this->view_model = $view_model;
        $name = $view_model->template_name;
        $this->template_path = "Views/$name.php";
    }

    function render(): void
    {
        header('Content-Type', 'text/html; charset=UTF-8');
        $view_model = $this->view_model;
        require_once $this->template_path;
    }
}