<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/GuestRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Guest.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeGuestUpdateController
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
            $row['numero_stanza'] = $params['numero_stanza'];
            $row['numero_ospiti'] = $params['numero_ospiti'];
            $row['data_checkin'] = $params['data_checkin'];
            $row['data_checkout'] = $params['data_checkout'];

            if (strlen($params['password']) > 0)
                $row['password'] = md5($params['password']);

            $result = $this->guest_repository->update($row);


            return new HttpRedirectView('/backoffice/guests/' . $id . '/edit');

        }

        return new HttpRedirectView('/backoffice/guests');
    }
}