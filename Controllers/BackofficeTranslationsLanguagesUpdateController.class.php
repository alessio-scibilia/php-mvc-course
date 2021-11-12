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

class BackofficeTranslationsLanguagesUpdateController
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

            if (isset($params['nome_lingua']) && isset($params['abbreviazione'])) {

                $id = intval($params['id']);
                $language = $this->language_repository->get_by_id($id);
                $language['nome_lingua'] = $params['nome_lingua'];
                $language['abbreviazione'] = $params['abbreviazione'];
                $result = $this->language_repository->update($language);


                return new HttpRedirectView('/backoffice/translations/language/' . $id . '/edit');
            }
        }

        return new HttpRedirectView('/backoffice/translations/languages');
    }
}