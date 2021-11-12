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

class BackofficeTranslationsLanguageEnableController
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
        if (isset($params['language'])) {
            $user = SessionManager::get_user();

            $id = intval($params['language']);
            $language = $this->language_repository->get_by_id($id);
            $language['abilitata'] = isset($params['enabled']) ? 1 : 0;
            $this->language_repository->update($language);
        }

        return new HttpRedirectView('/backoffice/translations/languages/');
    }
}