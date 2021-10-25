<?php
require_once 'Models/Translations.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/AbstractTemplateViewModel.class.php';

class BackOfficeViewModel extends AbstractTemplateViewModel
{
    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $title;

    /**
     * @var Languages
     */
    public $languages;

    /**
     * @var Translations
     */
    public $translations;

    /** @var array */
    public $users;

    /** @var string */
    public $menu_active_btn;

    /** @var string */
    public $content_template_name;

    /**
     * @param string $template_name
     * @param User $user
     * @param string $title
     * @param Languages $languages
     * @param translations $translations
     * @param string $menu_active_btn
     */
    public function __construct(string $template_name, User &$user, string $title, Languages &$languages, Translations &$translations, array &$users, string $menu_active_btn, string $content_template_name) {
        parent::__construct($template_name);
        $this->user = $user;
        $this->title = $title;
        $this->languages = $languages;
        $this->translations = $translations;
        $this->menu_active_btn = $menu_active_btn;
        $this->users = $users;
        $this->content_template_name = $content_template_name;
    }

}