<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/EventRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Hotel.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeEventEnableController
{
    protected $user_repository;
    protected $event_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->event_repository = new EventRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['event'])) {
            $user = SessionManager::get_user();

            $id = intval($params['event']);
            $event = $this->event_repository->get_by_id($id);

            $event['abilitato'] = isset($params['enabled']) ? 1 : 0;
            $this->event_repository->update($event);

        }

        return new HttpRedirectView('/backoffice/events');
    }
}