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

    public function get_all_categories(int $id_lingua): array
    {
        $where = "shortcode_lingua = :shortcode_lingua";
        $params = array(":shortcode_lingua" => $id_lingua);
        return $this->get($where, $params);
    }


    public function get_all_enabled_categories(int $shortcode_lingua): array
    {
        $where = "abilitata = 1 AND shortcode_lingua = :shortcode_lingua";
        $params = array(":shortcode_lingua" => $shortcode_lingua);
        return $this->get($where, $params);
    }

    public function get_category_all_langs(int $related_id): array
    {
        $where = "related_id = :related_id AND abilitata = 1";
        $params = array(":related_id" => $related_id);
        return $this->get($where, $params);
    }

    public function delete_category(int $related_id): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE related_id = :$key";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":$key" => $related_id));
        return $stmt->rowCount() == 1;
    }

}