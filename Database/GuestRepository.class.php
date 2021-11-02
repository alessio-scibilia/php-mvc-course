<?php
require_once 'Database/MySQLRepository.class.php';

class GuestRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('ospiti_hotel', 'id');
    }

    public function get_by_hotel(int $id)
    {
        $where = "hotel_associato = :id_hotel";
        $params = array(":id_hotel" => $id);
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    public function get_all_guests(): array
    {
        $where = "TRUE";
        $params = array();
        return $this->get($where, $params);
    }
}