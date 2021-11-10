<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/HotelRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'ViewModels/FrontOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';

class HomeController
{
    protected $language_repository;
    protected $translation_repository;
    protected $hotel_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->hotel_repository = new HotelRepository();
    }

    public function http_get(array &$params): IView
    {
        $user = SessionManager::get_user();
        if (User::is_empty($user)) {
            return new HttpRedirectView('/frontoffice');
        }

        $languages = new Languages($this->language_repository->list_all());
        $id_lingua = SessionManager::get_lang();
        $languages->select($id_lingua);

        $translations = new Translations($this->translation_repository->list_by_language($id_lingua));

        $title = $translations->get('titolo_homepage') . ' | ' . $translations->get('nome_sito');

        $view_model = new FrontOfficeViewModel('frontoffice.home', $title, $languages, $translations);
        $view_model->user = $user;

        $id = intval($user->hotel_associato);
        $row = $this->hotel_repository->get_by_id($id);
        $view_model->hotel = new Hotel($row);

        return new HtmlView($view_model);
    }
}