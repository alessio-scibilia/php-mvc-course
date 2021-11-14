<?php
require_once 'Database/MySQLRepository.class.php';

class FacilityCategoryRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('strutture_categorie', 'id');
    }

    public function get_all_by_facility($id_struttura): array
    {
        $where = "id_struttura = :id_struttura";
        $params = array(":id_struttura" => $id_struttura);
        return $this->get($where, $params);
    }

    public function remove_by_facility($id_struttura): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE id_struttura = :id_struttura";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":id_struttura" => $id_struttura));
        return $stmt->rowCount() > 0;
    }
}
