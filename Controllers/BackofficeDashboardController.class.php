<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';

class BackofficeDashboardController
{
    protected $language_repository;
    protected $translation_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
    }

    public function http_get(array &$params): IView
    {
        $user = SessionManager::get_user();
        if (User::is_empty($user))
        {
            return new HttpRedirectView('/backoffice');
        }

        $languages = new Languages($this->language_repository->list_all());
        $id_lingua = SessionManager::get_lang();
        $languages->select($id_lingua);

        $translations = new Translations($this->translation_repository->list_by_language($id_lingua));

        $title = $translations->get('titolo_login') . ' | ' . $translations->get('nome_sito');
        $uri_parts = array_slice(explode('/', $_SERVER["REQUEST_URI"]), 0, 3);
        $menu_active_btn = array_pop($uri_parts);
        $users = array();
        $view_model = new BackOfficeViewModel('backoffice', $user, $title, $languages, $translations, $users, $menu_active_btn, 'backoffice.hotels.list');
        return new HtmlView($view_model);
    }
}