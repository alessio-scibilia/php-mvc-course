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
    public $name;

    /** @var string */
    public $email;

    /**
     * @param string $template_name
     * @param User &$user
     */
    public function __construct(string $template_name, User &$user)
    {
        parent::__construct($template_name);
        $this->level = $user->level;
        $this->level_name = $user->level_name;
        $this->name = $user->nome;
        $this->email = $user->email;
    }
}