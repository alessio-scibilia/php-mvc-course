<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
    }

    public function http_get(array &$params): HtmlView
    {
        $languages = new Languages($this->language_repository->list_all());
        $id_lingua = SessionManager::get_lang();
        $languages->select($id_lingua);

        $translations = new Translations($this->translation_repository->list_by_language($id_lingua));

        $title = $translations->get('titolo_login') . ' | ' . $translations->get('nome_sito');
        $template_name = 'backoffice.login';

        $user = SessionManager::get_user();
        if ($user != null)
        {
            $title = $translations->get('titolo_dashboard') . ' | ' . $translations->get('nome_sito');
            $template_name = 'backoffice';
        }

        $view_model = new BackOfficeViewModel($template_name, $user, $title, $languages, $translations);
        return new HtmlView($view_model);
    }
}