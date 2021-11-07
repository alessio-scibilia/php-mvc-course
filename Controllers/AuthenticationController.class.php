<?php
require_once 'Database/HotelRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/GuestRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Guest.class.php';
require_once 'Views/HttpRedirectView.class.php';

class AuthenticationController
{
    /** @var HotelRepository */
    protected $hotel_repository;

    /** @var UserRepository */
    protected $user_repository;

    /** @var GuestRepository */
    protected $guest_repository;

    public function __construct()
    {
        $this->hotel_repository = new HotelRepository();
        $this->user_repository = new UserRepository();
        $this->guest_repository = new GuestRepository();
    }

    /**
     * @param array $params
     * @return HttpRedirectView
     */
    public function http_get(array &$params): HttpRedirectView
    {
        $request = $params['request'];
        switch ($request) {
            case 'logout':
                SessionManager::destroy();
                return new HttpRedirectView('/backoffice');

            default:
                return new HttpRedirectView('/backoffice/dashboard');
        }
    }

    /**
     * @param array $params
     * @return HttpRedirectView
     */
    public function http_post(array &$params): HttpRedirectView
    {
        if (isset($params['email'])) {
            $email = $params['email'];
            $password = $params['password'];

            $hotel = $this->hotel_repository->get_by_email_password($email, $password);
            if ($hotel == null) {
                $user = $this->user_repository->get_by_email_password($email, $password);
                if ($user != null) {
                    $model = new User($user);
                    if ($model->enabled()) {
                        SessionManager::set_user($model);
                        return new HttpRedirectView('/backoffice/dashboard');
                    }
                }

            } else {
                $model = new User($hotel);
                if ($model->enabled()) {
                    SessionManager::set_user($model);
                    return new HttpRedirectView('/backoffice/dashboard');
                }
            }
        } else {
            $numero_stanza = $params['numero_stanza'];
            $id_hotel = $params['id_hotel'];
            $password = $params['password'];

            $guest = $this->guest_repository->get_by_room_password_hotel($numero_stanza, $password, $id_hotel);
            if ($guest != null) {
                $model = new User($guest);
                SessionManager::set_user($model);
                return new HttpRedirectView('/home');
            } else
                return new HttpRedirectView('/' . $id_hotel);
        }

        return new HttpRedirectView('/backoffice');
    }
}