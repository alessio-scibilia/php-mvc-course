<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/GuestRepository.class.php';
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Middlewares/MailSender.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Guest.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeGuestUpdateController
{
    protected $user_repository;
    protected $guest_repository;
    protected $translation_repository;
    protected $language_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->guest_repository = new GuestRepository();
        $this->translation_repository = new TranslationRepository();
        $this->language_repository = new LanguageRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['guests'])) {
            return new Html404();
        } else {
            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);
            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice');
            }

            $id = intval($params['id']);
            $row = $this->guest_repository->get_by_id($id);

            $row['nome'] = $params['nome'];
            $row['cognome'] = $params['cognome'];
            $row['email'] = $params['email'];
            $row['telefono'] = $params['telefono'];
            $row['abilitato'] = $params['abilitato'];
            $row['numero_ospiti'] = $params['numero_ospiti'];
            $row['data_checkin'] = $params['data_checkin'];
            $row['data_checkout'] = $params['data_checkout'];

            $cr1 = false;
            $cr2 = false;
            if (strlen($params['password']) > 0) {
                $row['password'] = md5($params['password']);
                $cr1 = true;
            }
            if ($row['numero_stanza'] != $params['numero_stanza']) {
                $cr2 = true;
            }
            $row['numero_stanza'] = $params['numero_stanza'];

            $result = $this->guest_repository->update($row);

            //mail da mandare solo se le credenziali di accesso al frontoffice sono state cambiate
            if ($cr1 || $cr2) {
                $link = 'https://alfiere.digital/home/index.php?strh=' . $user->related_id;
                $msg = "Ciao! Le tue credenziali di accesso a Wellcome sono state cambiate:" . PHP_EOL . PHP_EOL . "Link di accesso: " . $link . PHP_EOL . "Numero stanza: " . $params['numero_stanza'] . PHP_EOL;
                if ($cr1)
                    $msg .= "Password: " . $params['password'];
                $msg .= PHP_EOL . PHP_EOL . 'Goditi il relax!';

                if ($result == 'success') {
                    MailSender::send($params['email'], $translations->get('informazioni_wellcome'), $msg);
                }
            }

            return new HttpRedirectView('/backoffice/guests/' . $id . '/edit');

        }

        return new HttpRedirectView('/backoffice/guests');
    }
}