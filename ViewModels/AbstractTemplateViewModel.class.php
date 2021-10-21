<?php

abstract class AbstractTemplateViewModel
{
    /** @var string */
    public $template_name;

    /** @var string */
    public $current_url;

    /**
     * @param string $template_name
     */
    protected function __construct(string $template_name)
    {
        $this->template_name = $template_name;
        $this->current_url = $_SERVER['REQUEST_URI'];
    }
}