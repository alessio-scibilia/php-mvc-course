<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/EventRepository.class.php';
require_once 'Database/FacilityHotelRepository.class.php';
require_once 'Database/FacilityEventRepository.class.php';
require_once 'Database/FacilityRepository.class.php';
require_once 'Database/HotelRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Event.class.php';
require_once 'Models/FacilityEvent.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilitiesEditController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;
    protected $event_repository;
    protected $hotel_repository;
    protected $facility_repository;
    protected $facility_hotel_repository;
    protected $facility_event_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->event_repository = new EventRepository();
        $this->facility_repository = new FacilityRepository();
        $this->hotel_repository = new HotelRepository();
        $this->facility_hotel_repository = new FacilityHotelRepository();
        $this->facility_event_repository = new FacilityEventRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['facilities'])) {
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

            $id = intval($params['facilities']);
            $rows = $this->facility_repository->get_facility_all_langs($id);
            $facilities = Facility::facilities($rows);

            $view_model = new BackOfficeViewModel('backoffice.facilities.edit', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->language = $language;
            $view_model->facilities = $facilities; // all available languages
            $view_model->principal = $facilities[0];
            $view_model->menu_active_btn = 'facilities';

            return new HtmlView($view_model);
        }

        return new HttpRedirectView('/backoffice/facilities');
    }
}