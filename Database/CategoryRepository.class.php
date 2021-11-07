<?php
require_once 'Database/MySQLRepository.class.php';

class CategoryRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('categorie_strutture', 'id');
    }

    public function get_by_struttura(int $id_struttura)
    {
        $where = "related_id = :id_struttura";
        $params = array(":id_struttura" => $id_struttura);
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    public function get_all_categories(): array
    {
        $where = "TRUE";
        $params = array();
        return $this->get($where, $params);
    }

    public function get_all_enabled_categories(): array
    {
        $where = "abilitata = 1";
        $params = array();
        return $this->get($where, $params);
    }
}