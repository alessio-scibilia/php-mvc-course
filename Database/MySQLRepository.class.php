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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function join(string $join, string $where, array &$params): array
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "SELECT x.* FROM $table x $join WHERE $where";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_by_id($id): array
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "SELECT * FROM $table WHERE $key = :$key";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":$key" => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add(array $entity)
    {
        $table = $this->tableName;
        unset($entity[$this->keyName]);
        $keys = array_keys($entity);
        $field_list = join(', ', $keys);
        $placeholder_list = ':' . join(', :', $keys);
        $query = "INSERT INTO $table ($field_list) VALUES ($placeholder_list)";
        $stmt = MySQL::$instance->prepare($query);
        $params = array();
        foreach ($entity as $key => $value) {
            $params[":$key"] = $value;
        }
        $stmt->execute($params);
        return MySQL::$instance->lastInsertId();
    }

    public function update(array $entity): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;

        $params = array();
        $fields = array();
        foreach ($entity as $field => $value) {
            $params[":$field"] = $value;
            if ($field == $key) continue;
            $fields[] = "$field = :$field";
        }
        $field_list = join(', ', $fields);
        $query = "UPDATE $table SET $field_list WHERE $key = :$key";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute($params);
        return $stmt->rowCount() == 1;
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
