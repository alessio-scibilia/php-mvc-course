<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/HotelRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeHotelDeleteController
{
    protected $user_repository;
    protected $hotel_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->hotel_repository = new HotelRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['hotel'])) {

            $id = intval($params['hotel']);
            $this->hotel_repository->delete_hotel($id);

        }

        return new HttpRedirectView('/backoffice/hotels');
    }
}