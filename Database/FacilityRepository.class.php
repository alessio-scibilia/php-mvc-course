<?php
require_once 'Database/MySQLRepository.class.php';

class FacilityRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('strutture', 'id');
    }

    public function get_by_email(string $email)
    {
        $where = "email = :email";
        $params = array(":email" => $email);
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    public function get_all_facilities(int $shortcode_lingua): array
    {
        $where = "shortcode_lingua = :shortcode_lingua";
        $params = array("shortcode_lingua" => $shortcode_lingua);
        return $this->get($where, $params);
    }

    public function get_facilities_by_hotel(int $id_hotel): array
    {
        $where = "TRUE";
        $params = array();
        return $this->get($where, $params);
    }
    
    public function get_facility_all_langs(int $related_id): array
    {
        $where = "related_id = :related_id";
        $params = array(":related_id" => $related_id);
        return $this->get($where, $params);
    }

    public function delete_facility(int $related_id): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE related_id = :$key";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":$key" => $related_id));
        return $stmt->rowCount() == 1;
    }
}