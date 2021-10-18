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
        $key = $this->keyName;
        $where = "related_id = :$key";
        $params = array($key => $id);
        return $this->get($where, $params);
    }
}