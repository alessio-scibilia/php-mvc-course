<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/GuestRepository.class.php';
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Middlewares/MailSender.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeGuestsAddController
{
    protected $user_repository;
    protected $guest_repository;
    protected $translation_repository;
    protected $languages_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->guest_repository = new GuestRepository();
        $this->translation_repository = new TranslationRepository;
        $this->language_repository = new LanguageRepository;
    }

    public function http_post(array &$params): IView
    {
        $languages = new Languages($this->language_repository->list_all());
        $id_lingua = SessionManager::get_lang();
        $languages->select($id_lingua);
        $translations = new Translations($this->translation_repository->list_by_language($id_lingua));

        if (isset($params['guests'])) {
            return new Html404();
        } else {

            $user = SessionManager::get_user();

            if (isset($params['nome']) && isset($params['cognome']) && isset($params['email']) && isset($params['password'])) {

                $new_user['nome'] = $params['nome'];
                $new_user['cognome'] = $params['cognome'];
                $new_user['email'] = $params['email'];
                $new_user['telefono'] = $params['telefono'];
                $new_user['data_checkin'] = $params['data_checkin'];
                $new_user['data_checkout'] = $params['data_checkout'];
                $new_user['numero_ospiti'] = $params['numero_ospiti'];
                $new_user['abilitato'] = $params['abilitato'];
                $new_user['numero_stanza'] = $params['numero_stanza'];
                $new_user['password'] = md5($params['password']);
                $new_user['hotel_associato'] = $user->related_id;

                $id = $this->guest_repository->add($new_user);
                $result = ($id === false) ? 'error' : 'success';

                $link = 'https://alfiere.digital/home/index.php?strh=' . $user->related_id;
                $msg = "Benvenuto su Wellcome ecco le tue credenziali di accesso:" . PHP_EOL . PHP_EOL . "Link di accesso: " . $link . PHP_EOL . "Numero stanza: " . $params['numero_stanza'] . PHP_EOL . "Password: " . $params['password'] . PHP_EOL . PHP_EOL;
                $msg .= 'Goditi il relax!';


                if ($result == 'success') {
                    MailSender::send($params['email'], $translations->get('benvenuto_wellcome'), $msg);
                }

                return new HttpRedirectView('/backoffice/guests');
            }
        }

        return new HttpRedirectView('/backoffice/guests');
    }
}