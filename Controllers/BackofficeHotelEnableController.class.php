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

class BackofficeHotelEnableController
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
        if (isset($params['hotel'])) {
            $user = SessionManager::get_user();

            $id = intval($params['hotel']);
            $hotel_all_langs = $this->hotel_repository->get_hotel_all_langs($id);
            foreach ($hotel_all_langs as $hotel) {
                $hotel['abilitato'] = isset($params['enabled']) ? 1 : 0;
                $this->hotel_repository->update($hotel);
            }
        }

        return new HttpRedirectView('/backoffice/hotels');
    }
}