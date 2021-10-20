<?php
require_once 'Models/User.class.php';
require_once 'ViewModels/AbstractTemplateViewModel.class.php';

class UserViewModel extends AbstractTemplateViewModel
{
    /** @var int */
    public $level;

    /** @var string */
    public $level_name;

    /** @var string */
    public $username;

    /** @var string */
    public $email;

    public function __construct(int $level, string $level_name, string $username, string $email)
    {
        parent::__construct('header.php');
        $this->level = $level;
        $this->level_name = $level_name;
        $this->username = $username;
        $this->email = $email;
    }
}