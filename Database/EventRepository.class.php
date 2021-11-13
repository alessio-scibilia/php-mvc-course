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

    public function get_events_by_hotel(int $id_hotel): array
    {
        $lines = array
        (
            'SELECT e.*',
            'FROM eventi e',
            'INNER JOIN strutture_eventi se ON se.id_evento = e.id',
            'INNER JOIN strutture_hotel sh ON sh.id_struttura = se.id_struttura',
            'WHERE sh.id_hotel = :id_hotel',
            'UNION',
            'SELECT e.*',
            'FROM eventi e',
            'INNER JOIN strutture_eventi se ON se.id_evento = e.id',
            'WHERE se.id_hotel = :id_hotel'
        );
        $query = join("\r\n", $lines);
        $params = array(':id_hotel', $id_hotel);
        return $this->query($query, $params);
    }

    public function get_event(int $id): array
    {
        $where = "id = :id";
        $params = array(":id" => $id);
        $results = $this->get($where, $params);
        return array_pop($results);
    }
}