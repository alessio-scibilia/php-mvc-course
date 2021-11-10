<?php
require_once 'Database/UserRepository.class.php';
require_once 'Database/CategoryRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeFacilitiesCategoryDeleteController
{
    protected $user_repository;
    protected $category_repository;


    public function __construct()
    {
        $this->user_repository = new UserRepository();
        $this->category_repository = new CategoryRepository();
    }

    public function http_get(array &$params): IView
    {
        if (isset($params['category'])) {

            $id = intval($params['facility']);
            $this->category_repository->delete_category($id);

        }

        return new HttpRedirectView('/backoffice/facilities/categories');
    }
}