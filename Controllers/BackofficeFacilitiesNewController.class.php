<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/FacilityRepository.class.php';
require_once 'Database/FacilityHotelRepository.class.php';
require_once 'Database/HotelRepository.class.php';
require_once 'Database/CategoryRepository.class.php';
require_once 'Database/ExcellenceRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'Models/FacilityHotel.class.php';
require_once 'Models/Excellence.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilitiesNewController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;
    protected $hotel_repository;
    protected $facility_repository;
    protected $facility_hotel_repository;
    protected $category_repository;
    protected $excellence_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->facility_repository = new FacilityRepository();
        $this->hotel_repository = new HotelRepository();
        $this->facility_hotel_repository = new FacilityHotelRepository();
        $this->category_repository = new CategoryRepository();
        $this->excellence_repository = new ExcellenceRepository();
    }

    public function http_get(array &$params): IView
    {
        $languages = new Languages($this->language_repository->list_all());
        $id_lingua = SessionManager::get_lang();
        $languages->select($id_lingua);
        $language = $languages->get($id_lingua);

        $translations = new Translations($this->translation_repository->list_by_language($id_lingua));
        $title = $translations->get('gestione_eventi') . ' | ' . $translations->get('nome_sito');

        $user = SessionManager::get_user();
        if (User::is_empty($user)) {
            return new HttpRedirectView('/backoffice');
        }

        $facilities = new Facility();
        $principal = $facilities;

        if ($user->level <= 2) {
            $rows = $this->hotel_repository->get_all_hotels($language['shortcode_lingua']);
            $hotels = Hotel::hotels($rows);

            $rows = $this->category_repository->get_all_categories($language['shortcode_lingua']);
            $categories = Category::categories($rows);
        } else {
            $hotels = array();
            $categories = array();
        }

        $rows = $this->facility_hotel_repository->get_related_by_facility_id_and_language_id($principal->related_id, $language['shortcode_lingua']);
        $related_hotels = Hotel::hotels($rows);

        $rows = $this->category_repository->get_by_facility($principal->related_id, $language['shortcode_lingua']);
        $related_categories = Category::categories($rows);


        $view_model = new BackOfficeViewModel('backoffice.facilities.edit', $title, $languages, $translations);
        $view_model->user = $user;
        $view_model->language = $language;
        $view_model->facilities = $facilities; // all available languages
        $view_model->principal = $principal;
        $view_model->hotels = $hotels;
        $view_model->categories = $categories;
        $view_model->related_hotels = $related_hotels;
        $view_model->related_categories = $related_categories;

        $view_model->menu_active_btn = 'facilities';

        return new HtmlView($view_model);
    }
}