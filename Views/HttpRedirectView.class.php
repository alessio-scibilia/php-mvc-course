<?php
require_once 'Views/IView.interface.php';

class HttpRedirectView implements IView
{
    protected $redirect_url;

    public function __construct($redirect_url)
    {
        $this->redirect_url = $redirect_url;
    }

    function render(): void
    {
        header("Location: $this->redirect_url");
    }
}