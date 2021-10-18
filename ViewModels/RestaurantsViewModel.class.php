<?php
require_once 'Models/Restaurant.class.php';
require_once 'ViewModels/AbstractTemplateViewModel.class.php';

class RestaurantsViewModel extends AbstractTemplateViewModel
{
    protected $restaurant;
    protected $restaurants;

    public function __construct(array &$restaurants, Restaurant &$restaurant)
    {
        parent::__construct('restaurants');
        $this->restaurants = $restaurants;
        $this->restaurant = $restaurant;
    }
}