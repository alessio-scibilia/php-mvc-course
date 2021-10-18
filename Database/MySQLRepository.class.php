<?php
require_once './Database/MySQL.class.php';

abstract class MySQLRepository
{
    protected $tableName;
    protected $keyName;

    public function __construct($tableName, $keyName)
    {
        $this->tableName = $tableName;
        $this->keyName = $keyName;
    }

    protected function get(string $where, array &$params): array
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "SELECT * FROM $table WHERE $where";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function get_by_id($id): array
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "SELECT * FROM $table WHERE $key = :$key";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":$key" => $id));
        return $stmt->fetch();
    }

    public function add(array $entity): int
    {
        $table = $this->tableName;
        unset($entity[$this->keyName]);
        $keys = array_keys($entity);
        $field_list = join(', ', $keys);
        $placeholder_list = ':' . join(', :', $keys);
        $query = "INSERT INTO $table ($field_list) VALUES ($placeholder_list)";
        $stmt = MySQL::$instance->prepare($query);
        $params = array();
        foreach ($entity as $key => $value)
        {
            $params[":$key"] = $value;
        }
        $stmt->execute($params);
        return MySQL::$instance->lastInsertId();
    }

    public function remove_by_id($id): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE $key = :$key";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":$key" => $id));
        return $stmt->rowCount() == 1;
    }
}
