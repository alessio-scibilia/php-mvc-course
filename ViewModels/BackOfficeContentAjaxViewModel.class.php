<?php
require_once 'Models/Translations.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';

class BackOfficeContentAjaxViewModel extends BackOfficeViewModel
{
    /** @var string string */
    public $api_key_backend;

    /** @var array */
    public $users;

    public function __construct(string $template_name, User &$user, string $title, Languages &$languages, Translations &$translations, string $menu_active_btn, string $api_key_backend, array &$users)
    {
        parent::__construct($template_name, $user, $title, $languages, $translations, $menu_active_btn);
        $this->api_key_backend = $api_key_backend;
        $this->users = $users;
    }
}