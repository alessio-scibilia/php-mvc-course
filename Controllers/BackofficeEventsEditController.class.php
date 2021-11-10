<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/EventRepository.class.php';
require_once 'Database/FacilityHotelRepository.class.php';
require_once 'Database/FacilityRepository.class.php';
require_once 'Database/HotelRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Event.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeEventsEditController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;
    protected $event_repository;
    protected $hotel_repository;
    protected $facility_repository;
    protected $facility_hotel_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->event_repository = new EventRepository();
        $this->facility_repository = new FacilityRepository();
        $this->hotel_repository = new HotelRepository();
        $this->facility_hotel_repository = new FacilityHotelRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['events'])) {
            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));
            $title = $translations->get('gestione_eventi') . ' | ' . $translations->get('nome_sito');

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice');
            }

            $id = intval($params['events']);
            $rows = $this->event_repository->get_event($id);
            $evento = Event::events($rows);

            if ($user->level > 2) {
                $rows = $this->facility_hotel_repository->get_facilities_by_hotel($user->id);
                $related_facilities = FacilitiesHotels::facilities_hotels($rows);
            } else {
                $rows = $this->facility_repository->get_all_facilities($id_lingua);
                $related_facilities = Facility::facilities($rows);
            }

            //$descrizioni_evento = $this->facility_hotel_repository->get_by_event_id($id);

            $rows = $this->hotel_repository->get_hotels_list_by_user_level($user->level, $user->id, $id_lingua);
            $related_hotels = Hotel::hotels($rows);

            //'d92fgov02dm2jf493fspamwi2d0za201',
            $view_model = new BackOfficeViewModel('backoffice.events.edit', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->event = $evento;
            $view_model->related_facilities = $related_facilities;
            $view_model->related_hotels = $related_hotels;
            $view_model->menu_active_btn = 'events';

            return new HtmlView($view_model);
        }

        return new HttpRedirectView('/backoffice/events');
    }
}