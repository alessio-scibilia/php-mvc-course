<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/EventRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Event.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeAdministratorDeleteController
{
    protected $user_repository;
    protected $event_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['event'])) {
            $id = intval($params['event']);
            $this->event_repository->remove_by_id($id);
        }

        return new HttpRedirectView('/backoffice/events');
    }
}