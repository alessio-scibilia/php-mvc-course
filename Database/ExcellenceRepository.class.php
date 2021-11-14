<?php
require_once 'Database/MySQLRepository.class.php';

class ExcellenceRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('eccellenze', 'id');
    }

    public function get_by_facility(int $related_id)
    {
        $where = "struttura_collegata = :related_id ORDER BY posizione";
        $params = array(":related_id" => $related_id);
        return $this->get($where, $params);
    }

    public function remove_by_facility(int $related_id): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE struttura_collegata = :related_id";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":related_id" => $related_id));
        return $stmt->rowCount() > 0;
    }

}