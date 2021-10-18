<?php
require_once 'Database/MySQLRepository.class.php';

class RestaurantRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('hotel', 'id');
    }

    public function get_related(int $id): array
    {
        $where = "related_id = :related_id";
        $params = array(":related_id" => $id);
        return $this->get($where, $params);
    }
}