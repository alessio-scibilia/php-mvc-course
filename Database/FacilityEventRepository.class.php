<?php
require_once 'Database/MySQLRepository.class.php';

class FacilityEventRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('strutture_eventi', 'id');
    }

    public function get_by_event_id(int $id_evento): array
    {
        $where = "id_evento = :id_evento";
        $params = array(":id_evento" => $id_evento);
        return $this->get($where, $params);
    }

    public function get_by_event_id_and_hotel_id(int $id_evento, int $id_hotel): array
    {
        $where = "id_evento = :id_evento AND id_hotel = :id_hotel";
        $params = array(":id_evento" => $id_evento, ":id_hotel" => $id_hotel);
        return $this->get($where, $params);
    }

    public function remove_by_event_id(int $id_evento): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE id_evento = :id_evento";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":id_evento" => $id_evento));
        return $stmt->rowCount() > 0;
    }

    public function remove_by_event_id_and_hotel_id(int $id_evento, int $id_hotel): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE id_evento = :id_evento AND id_hotel = :id_hotel";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":id_evento" => $id_evento, ":id_hotel" => $id_hotel));
        return $stmt->rowCount() > 0;
    }
}
