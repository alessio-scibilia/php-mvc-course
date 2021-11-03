<?php
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeAdministratorEnableController
{
    protected $user_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['administrator'])) {
            $user = SessionManager::get_user();

            // Solo gli utenti con level <= 2 possono accedere a queste pagine "amministratori",
            // Gli altri bisogna mandarli su pagine adeguate tramite redirect
            if (User::is_empty($user) || $user->level > 2) {
                return new HttpRedirectView('/backoffice');
            }

            $id = intval($params['administrator']);
            $administrator = $this->user_repository->get_by_id($id);
            $administrator['abilitato'] = isset($params['enabled']) ? 1 : 0;
            $this->user_repository->update($administrator);
        }

        return new HttpRedirectView('/backoffice/administrators');
    }
}