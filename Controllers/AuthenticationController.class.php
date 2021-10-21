<?php
require_once 'Database/HotelRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Views/HttpRedirectView.class.php';

class AuthenticationController
{
    /** @var HotelRepository */
    protected $hotel_repository;

    /** @var UserRepository */
    protected $user_repository;

    public function __construct()
    {
        $this->hotel_repository = new HotelRepository();
        $this->user_repository = new UserRepository();
    }

    /**
     * @param array $params
     * @return HttpRedirectView
     */
    public function http_get(array &$params): HttpRedirectView
    {
        $request = $params['request'];
        switch ($request)
        {
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
        $email = $params['email'];
        $password = $params['password'];

        $hotel = $this->hotel_repository->get_by_email_password($email, $password);
        if ($hotel == null)
        {
            $user = $this->user_repository->get_by_email_password($email, $password);
            if ($user == null)
            {
                return new HttpRedirectView('/backoffice');
            }
            else
            {
                SessionManager::set_user(new User($user));
                return new HttpRedirectView('/backoffice/dashboard');
            }
        }
        else
        {
            SessionManager::set_user(new User($hotel));
            return new HttpRedirectView('/backoffice/dashboard');
        }
    }
}