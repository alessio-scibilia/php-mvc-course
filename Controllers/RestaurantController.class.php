<?php
require_once 'Database/RestaurantRepository.class.php';
require_once 'Models/Restaurant.class.php';
require_once 'ViewModels/RestaurantsViewModel.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class RestaurantController
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new RestaurantRepository();
    }

    public function http_get(array &$params): HtmlView
    {
        $id = $params['restaurant'];
        $row = $this->repository->get_by_id($id);
        $restaurant = new Restaurant($row);
        $rows = $this->repository->get_related($restaurant->id);
        $restaurants = array();
        foreach ($rows as $row)
        {
            $restaurants[] = new Restaurant($row);
        }
        $view_model = new RestaurantsViewModel($restaurants, $restaurant);
        return new HtmlView($view_model);
    }

    public function http_delete(array &$params): HtmlView
    {
        return new Html404();
    }
}