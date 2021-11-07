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
        $joins = array
        (
            'INNER JOIN strutture_eventi se ON se.id_evento = x.id',
            'RIGHT OUTER JOIN hotel h ON h.id = se.id_hotel',
            'RIGHT OUTER JOIN strutture_hotel sh ON sh.id_struttura = se.id_struttura AND sh.id_hotel = h.id',
        );
        $join = join("\r\n", $joins);
        $where = "h.id = :id_hotel";
        $params = array(':id_hotel', $id_hotel);
        return $this->join($join, $where, $params);
    }
}