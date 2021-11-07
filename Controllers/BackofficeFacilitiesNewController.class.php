<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/FacilityRepository.class.php';
require_once 'Database/HotelRepository.class.php';
require_once 'Database/CategoryRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilitiesNewController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;
    protected $facility_repository;
    protected $hotel_repository;
    protected $category_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->facility_repository = new FacilityRepository();
        $this->hotel_repository = new HotelRepository();
        $this->category_repository = new CategoryRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['facilities'])) {
            return new Html404();
        } else {
            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));
            $title = $translations->get('gestione_strutture') . ' | ' . $translations->get('nome_sito');

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice');
            }

            $rows = $this->facility_repository->get_all_facilities();
            $facilities = Facility::facilities($rows);

            $rows = $this->category_repository->get_all_enabled_categories();
            $categories = Category::categories($rows);

            if ($user->level > 2)
                $rows = $this->hotel_repository->get_hotels_list_by_user_level(3, $user->id); //Vede solo il proprio hotel
            else
                $rows = $this->hotel_repository->get_hotels_list_by_user_level(2, 0); //Vede tutti gli hotel essendo un admin

            $related_hotels = Hotel::hotels($rows); //se l'utente è hotel/hotel pro avremo il suo id per la funzione successiva


            //'d92fgov02dm2jf493fspamwi2d0za201',
            $view_model = new BackOfficeViewModel('backoffice.facilities.create', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->facilities = $facilities;
            $view_model->categories = $categories;
            $view_model->related_hotels = $related_hotels;
            $view_model->menu_active_btn = 'facilities';

            return new HtmlView($view_model);
        }
    }
}