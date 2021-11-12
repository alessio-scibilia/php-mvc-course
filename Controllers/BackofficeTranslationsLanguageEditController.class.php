<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Translations.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeTranslationsLanguageEditController
{
    protected $user_repository;
    protected $language_repository;
    protected $translation_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['language'])) {
            $user = SessionManager::get_user();

            $languages = new Languages($this->language_repository->list_all_including_enabled());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));
            $title = $translations->get('gestione_lingue') . ' | ' . $translations->get('nome_sito');

            $id = intval($params['language']);
            $language = $this->language_repository->get_by_id($id);

            $view_model = new BackOfficeViewModel('backoffice.translations.languages.edit', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->language = $language;
            $view_model->menu_active_btn = 'translations';

            return new HtmlView($view_model);
        }

        return new HttpRedirectView('/backoffice/translations/languages');
    }
}