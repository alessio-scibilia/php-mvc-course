<?php

abstract class AbstractTemplateViewModel
{
    public $template_name;

    protected function __construct($template_name)
    {
        $this->template_name = $template_name;
    }
}