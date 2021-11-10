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

class BackofficeSettingsUpdateController
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

            if (isset($params['nome']) && isset($params['cognome']) && isset($params['email'])) {

                $id = intval($params['id']);
                $row = $this->user_repository->get_by_id($id);
                $row['nome'] = $params['nome'];
                $row['cognome'] = $params['cognome'];
                $row['email'] = $params['email'];

                if ($user->level < 2)
                    $result = $this->user_repository->update($row);
                else
                    $result = $this->hotel_repository->update($row);

                if ($result) {
                    $user = new User($row);
                    SessionManager::set_user($user);
                }

                return new HttpRedirectView('/backoffice/settings?' . $result);
            }
        }

        return new HttpRedirectView('/backoffice/settings');
    }
}