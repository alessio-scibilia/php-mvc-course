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

    public function get_by_facility(int $id_struttura, int $shortcode_lingua)
    {
        $table = $this->tableName;
        $query = join("\r\n", array(
            "SELECT cs.*",
            "FROM $table cs",
            "INNER JOIN strutture_categorie sc ON",
            "   cs.related_id = sc.id_categoria AND",
            "   cs.shortcode_lingua = :shortcode_lingua",
            "WHERE sc.id_struttura = :id_struttura",
        ));
        $params = array(":id_struttura" => $id_struttura, ":shortcode_lingua" => $shortcode_lingua);
        return $this->query($query, $params);
    }

    public function get_all_categories(int $shortcode_lingua): array
    {
        $where = "shortcode_lingua = :shortcode_lingua";
        $params = array(":shortcode_lingua" => $shortcode_lingua);
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
        $where = "related_id = :related_id";
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

    public function get_category(int $shortcode_lingua, $id_category): array
    {
        $where = "shortcode_lingua = :shortcode_lingua AND related_id = :related_id";
        $params = array(":shortcode_lingua" => $shortcode_lingua, ":related_id" => $id_category);
        return $this->get($where, $params);
    }

    public function get_by_related_id(int $related_id): array
    {
        $where = "related_id = :related_id";
        $params = array(":related_id" => $related_id);
        return $this->get($where, $params);
    }
}