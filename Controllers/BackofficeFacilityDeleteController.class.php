<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/FacilityRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilityDeleteController
{
    protected $user_repository;
    protected $hotel_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->facility_repository = new FacilityRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['facility'])) {

            $id = intval($params['facility']);
            $this->facility_repository->delete_facility($id);

        }

        return new HttpRedirectView('/backoffice/facilities');
    }
}