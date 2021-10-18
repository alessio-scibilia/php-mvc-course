<?php
require_once 'ViewModels/AbstractTemplateViewModel.class.php';

class EmptyViewModel extends AbstractTemplateViewModel
{
    public function __construct()
    {
        parent::__construct('empty');
    }
}