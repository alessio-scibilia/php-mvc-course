<?php
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeAdministratorsAddController
{
    protected $user_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['administrator'])) {
            return new Html404();
        } else {

            $user = SessionManager::get_user();
            // Solo gli utenti con level <= 2 possono accedere a queste pagine "amministratori",
            // Gli altri bisogna mandarli su pagine adeguate tramite redirect
            if (User::is_empty($user) || $user->level > 2) {
                return new HttpRedirectView('/backoffice');
            }

            if (isset($params['nome']) && isset($params['cognome']) && isset($params['email']) && isset($params['password']) && isset($params['level'])) {

                $new_user['nome'] = $params['nome'];
                $new_user['cognome'] = $params['cognome'];
                $new_user['email'] = $params['email'];
                $new_user['level'] = $params['level'];
                $new_user['password'] = md5($params['password']);
                
                //abilitato = 1 di default
                $new_user['abilitato'] = 1;

                $user_to_add = $this->user_repository->get_by_email($params['email']);

                if ($user_to_add == null) {
                    $id = $this->user_repository->add($new_user);
                    $result = ($id === false) ? 'error' : 'success';
                } else {
                    $result = 'error';
                }

                return new HttpRedirectView('/backoffice/administrators?' . $result);
            }
        }

        return new HttpRedirectView('/backoffice/administrators');
    }
}