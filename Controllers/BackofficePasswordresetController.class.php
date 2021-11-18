<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Middlewares/MailSender.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficePasswordresetController
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
        $languages = new Languages($this->language_repository->list_all());
        $id_lingua = SessionManager::get_lang();
        $languages->select($id_lingua);

        $translations = new Translations($this->translation_repository->list_by_language($id_lingua));

        $title = $translations->get('titolo_login') . ' | ' . $translations->get('nome_sito');

        $view_model = new BackOfficeViewModel('backoffice.dashboard', $title, $languages, $translations);
        $view_model->template_name = 'backoffice.password-reset';
        $view_model->message = $params['message'] ?? '';

        return new HtmlView($view_model);
    }

    public function http_post(array &$params): IView
    {
        $languages = new Languages($this->language_repository->list_all());
        $id_lingua = SessionManager::get_lang();
        $languages->select($id_lingua);

        $translations = new Translations($this->translation_repository->list_by_language($id_lingua));

        $title = $translations->get('titolo_login') . ' | ' . $translations->get('nome_sito');

        $view_model = new BackOfficeViewModel('backoffice.dashboard', $title, $languages, $translations);
        $view_model->template_name = 'backoffice.password-reset';
        $view_model->message = 'Non è stato possibile ripristinare la password';

        if (!empty($params['email']) &&
            !empty($params['digits-code']) &&
            !empty($params['password'])
            )
        {
            $user = $this->user_repository->get_by_email_and_digitscode($params['email'], $params['digits-code']);

            $user['password'] = md5($params['password']);

            if ($this->user_repository->update($user))
            {
                // Whene all is OK, render login:
                $view_model->template_name = 'backoffice.login';
                $view_model->message = 'Password reimpostata con successo, accedi.';
            }
        }

        return new HtmlView($view_model);
    }
}