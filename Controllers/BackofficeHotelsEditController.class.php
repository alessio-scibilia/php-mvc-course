<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/HotelRepository.class.php';
require_once 'Database/ServiceRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Profile.class.php';
require_once 'Models/Hotel.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeHotelsEditController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;
    protected $hotel_repository;
    protected $service_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->hotel_repository = new HotelRepository();
        $this->service_repository = new ServiceRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['hotels'])) {
            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));
            $title = $translations->get('gestione_ospiti') . ' | ' . $translations->get('nome_sito');

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice');
            }

            $id = intval($params['hotels']);
            $row = $this->hotel_repository->get_profile($id_lingua, $id);
            $profile = new Hotel($row);

            $servizi = array();
            $i = 0;
            $lingue = $this->language_repository->list_all();
            foreach ($lingue as $lingua) {
                $rows = $this->service_repository->get_services_by_hotel($id, $lingua['shortcode_lingua']);
                $servizi[$i] = Service::services($rows);
                $i++;
            }

            $rows = $this->hotel_repository->get_translations($profile->related_id);
            $hotel_translations = Hotel::hotels($rows);

            //'d92fgov02dm2jf493fspamwi2d0za201',
            $view_model = new BackOfficeViewModel('backoffice.hotels.edit', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->profile = $profile;
            $view_model->language = $languages->get($id_lingua);
            $view_model->hotel_translations = $hotel_translations;
            $view_model->services = $servizi;
            $view_model->menu_active_btn = 'hotels';

            return new HtmlView($view_model);
        }

        return new HttpRedirectView('/backoffice/hotels');
    }
}