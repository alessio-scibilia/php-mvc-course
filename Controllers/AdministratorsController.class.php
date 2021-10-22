<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeContentAjaxViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class AdministratorsController
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

    public function http_get(array &$params): IView
    {
        if (isset($params['administrators']))
        {
            return new Html404();
        }
        else
        {
            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));

            $title = $translations->get('titolo_login') . ' | ' . $translations->get('nome_sito');
            $template_name = 'backoffice.administrators';

            $user = SessionManager::get_user();
            if (User::is_empty($user))
            {
                return new HttpRedirectView('/backoffice');
            }

            // Solo gli utenti con level <= 2 possono accedere a queste pagine "amministratori",
            // Gli altri bisogna mandarli su pagine adeguate tramite redirect
            if ($user->level > 2)
            {
                return new HttpRedirectView('/backoffice');
            }

            // La lista utenti dipende dall'utente connesso, ovvero:
            // Non mostriamo mai gli utenti di livello superiore al proprio
            $users = $this->user_repository->filter_by_upper_level($user->level);

            $view_model = new BackOfficeContentAjaxViewModel($template_name, $user, $title, $languages, $translations, 'administrators', 'd92fgov02dm2jf493fspamwi2d0za201', $users);

            return new HtmlView($view_model);
        }
    }
}