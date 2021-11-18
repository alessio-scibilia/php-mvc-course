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

class BackofficeForgotpasswordController
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
        $view_model->template_name = 'backoffice.forgot-password';
        $view_model->message = $params['message'] ?? '';

        return new HtmlView($view_model);
    }

    public function http_post(array &$params): IView
    {
        if (empty($params['email']))
        {
            return new HttpRedirectView('/backoffice/forgot-password');
        }

        $email = $params['email'];

        $user = $this->user_repository->get_by_email($email);
        if ($user != null)
        {
            mt_srand(time());
            for ($restore_code = '', $i = 0; $i < 6; $x = mt_rand(0, 100000000) % 10, $restore_code = $restore_code.$x, $i++) ;

            $user['restore_code'] = $restore_code;

            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));

            if ($this->user_repository->update($user))
            {
                $message = join("\r\n", array(
                    $translations->get('reset_password'),
                    "\r\n",
                    $restore_code
                ));
                MailSender::send($email, $translations->get('reset_password'), $message);
            }
            else
            {
                $params['message'] = $translations->get('informazioni_wellcome');
                return http_get($params);
            }
        }

        return new HttpRedirectView('/backoffice/password-reset');
    }
}