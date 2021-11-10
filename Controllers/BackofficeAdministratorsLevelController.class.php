<?php
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Level.class.php';
require_once 'Views/HttpRedirectView.class.php';

class BackofficeAdministratorsLevelController
{
    public function __construct()
    {
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

        $level = $params['level'];
        $user->level = intval($level);
        $user->level_name = Level::name($level);
        SessionManager::set_user($user);

        return new HttpRedirectView($return_url);
    }
}
