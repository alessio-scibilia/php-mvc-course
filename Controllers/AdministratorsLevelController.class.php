<?php
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Level.class.php';
require_once 'Views/HttpRedirectView.class.php';

class AdministratorsLevelController
{

    /** @var UserRepository */
    protected $user_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
    }

    /**
     * @param array $params
     * @return HttpRedirectView
     */
    public function http_get(array &$params): HttpRedirectView
    {
        $return_url = $params['return_url'] ?? '/backoffice';
        $user = SessionManager::get_user();

        if (User::is_empty($user) || $user->level != 0) //Solo gli utenti con livello God user possono cambiare il proprio livello a piacimento
        {
            return new HttpRedirectView('/backoffice');
        }

        $request = $params['request'];
        switch ($request) {
            case '0':
                // Settare sessionManager o user o entrambi?
                return new HttpRedirectView($return_url);
                break;
            case '1':
                break;

            case '2':
                break;

            case '3':
                break;

            case '4':
                break;

            default:
                return new HttpRedirectView('/backoffice/dashboard');


                SessionManager::set_lang($language['id']);    //forse una cosa del genere è da fare sullo user?
        }
    }

    /*
     * @param array $params
     * @return HttpRedirectView
     *
    public function http_post(array &$params): HttpRedirectView
    {
        $email = $params['email'];
        $password = $params['password'];

        $hotel = $this->hotel_repository->get_by_email_password($email, $password);
        if ($hotel == null) {
            $user = $this->user_repository->get_by_email_password($email, $password);
            if ($user == null) {
                return new HttpRedirectView('/backoffice');
            } else {
                SessionManager::set_user(new User($user));
                return new HttpRedirectView('/backoffice/dashboard');
            }
        } else {
            SessionManager::set_user(new User($hotel));
            return new HttpRedirectView('/backoffice/dashboard');
        }
    }
    */
}