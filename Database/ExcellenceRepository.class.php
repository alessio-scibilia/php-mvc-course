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
        $where = "struttura_collegata = :related_id";
        $params = array(":related_id" => $related_id);
        return $this->get($where, $params);
    }
}