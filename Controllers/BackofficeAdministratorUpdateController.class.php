<?php
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeAdministratorUpdateController
{
    protected $user_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['administrators'])) {
            return new Html404();
        } else {
            $user = SessionManager::get_user();
            // Solo gli utenti con level <= 2 possono accedere a queste pagine "amministratori",
            // Gli altri bisogna mandarli su pagine adeguate tramite redirect
            if (User::is_empty($user) || $user->level > 2) {
                return new HttpRedirectView('/backoffice');
            }

            if (isset($params['nome']) && isset($params['cognome']) && isset($params['email']) && isset($params['level']) && isset($params['id'])) {

                $id = intval($params['id']);
                $administrator = $this->user_repository->get_by_id($id);
                $administrator['nome'] = $params['nome'];
                $administrator['cognome'] = $params['cognome'];
                $administrator['email'] = $params['email'];
                $administrator['level'] = $params['level'];
                $result = $this->user_repository->update($administrator);


                return new HttpRedirectView('/backoffice/administrators?' . $result);
            }
        }

        return new HttpRedirectView('/backoffice/administrators');
    }
}