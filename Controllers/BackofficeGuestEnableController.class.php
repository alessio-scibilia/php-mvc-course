<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/GuestRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Guest.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeGuestEnableController
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
            $guest = $this->guest_repository->get_by_id($id);
            $guest['abilitato'] = isset($params['enabled']) ? 1 : 0;
            $this->guest_repository->update($guest);
        }

        return new HttpRedirectView('/backoffice/guests');
    }
}