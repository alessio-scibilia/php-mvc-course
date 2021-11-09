<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/CategoryRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilitiesCategoriesEditController
{
    protected $user_repository;
    protected $language_repository;
    protected $translation_repository;
    protected $category_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->category_repository = new TranslationRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['categories'])) {
            $user = SessionManager::get_user();

            // Solo gli utenti con level <= 2 possono accedere a queste pagine "amministratori",
            // Gli altri bisogna mandarli su pagine adeguate tramite redirect
            if (User::is_empty($user) || $user->level > 2) {
                return new HttpRedirectView('/backoffice');
            }

            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));
            $title = $translations->get('gwstione_categprie') . ' | ' . $translations->get('nome_sito');

            $id = intval($params['categories']);
            $categories = $this->category_repository->get_by_id($id);

            $view_model = new BackOfficeViewModel('backoffice.facilities.categories.edit', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->categories = $categories;
            $view_model->menu_active_btn = 'facilities';

            return new HtmlView($view_model);
        }

        return new HttpRedirectView('/backoffice/administrators');
    }
}