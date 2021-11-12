<?php
require_once 'Models/Translations.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Hotel.class.php';
require_once 'Models/Facility.class.php';
require_once 'Models/FacilityHotel.php';
require_once 'Models/Service.class.php';
require_once 'Models/Profile.class.php';
require_once 'Models/Guest.class.php';
require_once 'Models/Category.class.php';
require_once 'Models/Event.class.php';
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
     * @var Public
     */
    public $language;

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
    public $guests;

    /** @var Guest */
    public $guest;

    /** @var array */
    public $facilities;

    /** @var array */
    public $facilities_hotels;

    /** @var Facility */
    public $facility;

    /** @var array */
    public $categories;

    /** @var Category */
    public $category;

    /** @var array */
    public $hotels;

    /** @var Hotel */
    public $hotel;

    /** @var Profile */
    public $profile;

    /** @var Event */
    public $event;

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
    public function __construct(string $content_template_name, string $title, Languages &$languages, Translations &$translations)
    {
        parent::__construct('backoffice');
        $this->content_template_name = $content_template_name;
        $this->title = $title;
        $this->languages = $languages;
        $this->translations = $translations;
    }

}