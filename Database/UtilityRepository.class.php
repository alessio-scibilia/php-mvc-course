<?php
require_once 'Database/MySQLRepository.class.php';

class UtilityRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('utilities', 'id');
    }

    public function get_utilities_by_hotel_and_language(int $id_hotel, int $shortcode_lingua): array
    {
        $where = "hotel_associato = :id_hotel AND shortcode_lingua = :shortcode_lingua";
        $params = array(":id_hotel" => $id_hotel, ":shortcode_lingua" => $shortcode_lingua);
        return $this->get($where, $params);
    }

    public function get_utilities_by_hotel(int $id_hotel): array
    {
        $where = "hotel_associato = :id_hotel ORDER BY posizione";
        $params = array(":id_hotel" => $id_hotel);
        return $this->get($where, $params);
    }

    public function remove_by_hotel(int $related_id): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE hotel_associato = :related_id";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":related_id" => $related_id));
        return $stmt->rowCount() > 0;
    }
}