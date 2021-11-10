<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/CategoryRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Models/Facility.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilitiesCategoryEnableController
{
    protected $user_repository;
    protected $category_repository;


    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->category_repository = new CategoryRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['category'])) {

            $id = intval($params['category']);
            $categories = $this->category_repository->get_category_all_langs($id);
            foreach ($categories as $category) {
                $category['abilitata'] = isset($params['enabled']) ? 1 : 0;
                $this->category_repository->update($category);
            }
        }

        return new HttpRedirectView('/backoffice/facilities/categories');
    }
}