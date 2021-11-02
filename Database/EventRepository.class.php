<?php
require_once 'Database/MySQLRepository.class.php';

class EventRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('eventi', 'id');
    }

    public function get_by_related_facility_hotel(int $type, int $id)
    {
        $where = "tipo_struttura_collegata = :type AND struttura_collegata = :id";
        $params = array(":type" => $type, ":id" => $id);
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    public function get_all_events(): array
    {
        $where = "TRUE";
        $params = array();
        return $this->get($where, $params);
    }
}