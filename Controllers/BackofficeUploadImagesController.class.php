<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/JsonView.class.php';

class BackofficeUploadImagesController
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
        if (isset($params['administrators'])) {
            return new JsonView(false);
        } else {

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new JsonView(false);
            }

            return new JsonView($params);
        }
    }
}