<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/FacilityRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Facility.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilityEnableController
{
    protected $user_repository;
    protected $facility_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->facility_repository = new FacilityRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['facility'])) {

            $id = intval($params['facility']);
            $facility_all_langs = $this->facility_repository->get_facility_all_langs($id);
            foreach ($facility_all_langs as $facility) {
                $facility['abilitata'] = isset($params['enabled']) ? 1 : 0;
                $this->facility_repository->update($facility);
            }
        }

        return new HttpRedirectView('/backoffice/facilities');
    }
}