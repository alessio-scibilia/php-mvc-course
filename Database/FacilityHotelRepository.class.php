<?php
require_once 'Database/MySQLRepository.class.php';

class FacilityHotelRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('strutture_hotel', 'id');
    }

    public function get_facilities_by_hotel(int $id_hotel): array
    {
        $where = "id_hotel = :id_hotel";
        $params = array(":id_hotel" => $id_hotel);
        return $this->get($where, $params);
    }

    public function get_by_facility_id(int $id_struttura): array
    {
        $where = "id_struttura = :id_struttura";
        $params = array(":id_struttura" => $id_struttura);
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    public function get_by_related_id(int $id_struttura): array
    {
        $where = "id_struttura = :id_struttura";
        $params = array(":id_struttura" => $id_struttura);
        return $this->get($where, $params);
    }

    public function get_related_by_facility_id_and_language_id(int $id_struttura, int $id_lingua): array
    {
        $table = $this->tableName;
        $query = join("\r\n", array(
            "SELECT sh.id_hotel, h.nome",
            "FROM $table sh",
            "INNER JOIN hotel h ON",
            "   h.related_id = sh.id_hotel AND",
            "   h.shortcode_lingua = 1",
            "WHERE id_struttura = :id_struttura",
        ));
        $params = array(":id_struttura" => $id_struttura);
        return $this->query($query, $params);
    }

    public function delete_relation(int $id_hotel, int $id_struttura): bool
    {
        $table = $this->tableName;
        $query = "DELETE FROM $table WHERE id_hotel = :id_hotel AND id_struttura = :id_struttura";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":id_hotel" => $id_hotel, ":id_struttura" => $id_struttura));
        return $stmt->rowCount() == 1;
    }
}