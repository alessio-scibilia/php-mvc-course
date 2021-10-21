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

    /** @var string */
    public $menu_active_btn;

    /**
     * @param string $template_name
     * @param User $user
     * @param string $title
     * @param Languages $languages
     * @param translations $translations
     * @param string $menu_active_btn
     */
    public function __construct(string $template_name, User &$user, string $title, Languages &$languages, Translations &$translations, string $menu_active_btn) {
        parent::__construct($template_name);
        $this->user = $user;
        $this->title = $title;
        $this->languages = $languages;
        $this->translations = $translations;
        $this->menu_active_btn = $menu_active_btn;
    }

}