<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/GuestRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeGuestsAddController
{
    protected $user_repository;
    protected $guest_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->guest_repository = new GuestRepository();
    }

    public function http_post(array &$params): IView
    {
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
                $new_user['hotel_associato'] = $user->hotel_associato;

                $id = $this->guest_repository->add($new_user);
                $result = ($id === false) ? 'error' : 'success';

                return new HttpRedirectView('/backoffice/guests');
            }
        }

        return new HttpRedirectView('/backoffice/guests');
    }
}