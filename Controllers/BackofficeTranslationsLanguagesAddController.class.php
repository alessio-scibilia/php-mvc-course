<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/LanguageRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Languages.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeTranslationsLanguagesAddController
{
    protected $user_repository;
    protected $language_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->language_repository = new LanguageRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['translations'])) {
            return new Html404();
        } else {

            $user = SessionManager::get_user();
            // Solo gli utenti con level <= 2 possono accedere a queste pagine "amministratori",
            // Gli altri bisogna mandarli su pagine adeguate tramite redirect
            if (User::is_empty($user) || $user->level > 2) {
                return new HttpRedirectView('/backoffice');
            }

            if (isset($params['nome_lingua']) && isset($params['abbreviazione']) && isset($params['shortcode_lingua'])) {

                $language['nome_lingua'] = $params['nome_lingua'];
                $language['abbreviazione'] = $params['abbreviazione'];
                $language['shortcode_lingua'] = $params['shortcode_lingua'];

                $this->language_repository->add($language);

                return new HttpRedirectView('/backoffice/translations/languages');
            }
        }

        return new HttpRedirectView('/backoffice/translations/languages');
    }
}