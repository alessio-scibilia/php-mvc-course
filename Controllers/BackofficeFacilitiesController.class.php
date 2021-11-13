<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/FacilityRepository.class.php';
require_once 'Database/FacilityHotelRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/FacilityHotel.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilitiesController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;
    protected $facility_repository;
    protected $facility_hotel_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->facility_repository = new FacilityRepository();
        $this->facility_hotel_repository = new FacilityHotelRepository();
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

            $rows = $this->facility_repository->get_all_facilities($id_lingua);
            $facilities = Facility::facilities($rows);
            //$facilities = array(); // TODO: da recuperare dal DB

            foreach ($facilities as $fac) {
                $hotel = $this->facility_hotel_repository->get_related_by_facility_id_and_language_id($fac->id, $id_lingua);
                $hotel_associati[$fac->related_id] = Hotel::hotels($hotel);
            }

            //'d92fgov02dm2jf493fspamwi2d0za201',
            $view_model = new BackOfficeViewModel('backoffice.facilities.list', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->facilities = $facilities;
            $view_model->hotel_associati = $hotel_associati;
            $view_model->menu_active_btn = 'facilities';

            return new HtmlView($view_model);
        }
    }
}