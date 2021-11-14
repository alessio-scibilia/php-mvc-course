<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/FacilityHotelRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/FacilityHotel.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilitiesHotelsSetController
{
    protected $user_repository;
    protected $facility_hotel_repository;


    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->facility_hotel_repository = new FacilityHotelRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['hotel']) && isset($params['facility'])) {
            $id_hotel = intval($params['hotel']);
            $id_facility = intval($params['facility']);
            $this->facility_hotel_repository->delete_relation($id_hotel, $id_facility);
        }

        return new HttpRedirectView('/backoffice/facilities/');
    }
}