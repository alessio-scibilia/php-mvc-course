<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/GuestRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeGuestDeleteController
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
        if (isset($params['guest'])) {
            $user = SessionManager::get_user();

            $id = intval($params['guest']);
            $this->guest_repository->remove_by_id($id);

        }

        return new HttpRedirectView('/backoffice/guests');
    }
}