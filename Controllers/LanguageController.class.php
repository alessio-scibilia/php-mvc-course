<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Views/HttpRedirectView.class.php';

class LanguageController
{
    protected $language_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
    }

    public function http_get(array &$params): HttpRedirectView
    {
        $abbreviation = $params['lang'] ?? '';
        $return_url = $params['return_url'] ?? '/backoffice';

        $languages = new Languages($this->language_repository->list_all());
        $language = $languages->get_by_field('abbreviazione', $abbreviation);
        if ($language != null)
        {
            SessionManager::set_lang($language['id']);
        }

        return new HttpRedirectView($return_url);
    }
}