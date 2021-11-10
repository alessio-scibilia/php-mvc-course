<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/HotelRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Hotel.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeSettingsPasswordUpdateController
{
    protected $user_repository;
    protected $hotel_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->hotel_repository = new HotelRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['settings'])) {
            return new Html404();
        } else {

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice');
            }

            $id = intval($params['id']);

            if ($user->level <= 2) {
                $user = $this->user_repository->get_by_id($id);
                $user['password'] = md5($params['password'];
                $result = $this->user_repository->update($user);

            } else {
                $user = $this->hotel_repository->get_by_email_password($user->email, $user->password);
                $user['password'] = md5($params['password'];
                $result = $this->hotel_repository->update($user);

            }

            return new HttpRedirectView('/backoffice/settings?' . $result);
        }
        return new HttpRedirectView('/backoffice/settings');
    }
}