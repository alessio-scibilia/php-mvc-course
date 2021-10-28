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

    /** @var array */
    public $events;

    /** @var array */
    public $facilities;

    /** @var array */
    public $hotels;

    /** @var string */
    public $menu_active_btn;

    /** @var string */
    public $content_template_name;

    /**
     * @param string $content_template_name
     * @param string $title
     * @param Languages $languages
     * @param Translations $translations
     */
    public function __construct(string $content_template_name, string $title, Languages &$languages, Translations &$translations) {
        parent::__construct('backoffice');
        $this->content_template_name = $content_template_name;
        $this->title = $title;
        $this->languages = $languages;
        $this->translations = $translations;
    }

}