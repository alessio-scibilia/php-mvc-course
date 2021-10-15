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

    protected static function bind_type($value): string
    {
        switch (true)
        {
            case is_string($value): return 's'; // string
            case is_integer($value): return 'i'; // integer
            case is_float($value): return 'd'; // double
            default: return 'b'; // blob
        }
    }

    public function get_by_id($id): array
    {
        $name = $this->tableName;
        $query = "SELECT * FROM $name WHERE Id = ?";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->bind_param(self::bind_type($id), $id);
        $stmt->execute();
        $result_set = $stmt->get_result();
        $stmt->close();
        return $result_set->fetch_assoc();
    }

    public function add(array $entity): int
    {
        $name = $this->tableName;
        unset($entity[$this->keyName]);
        $keys = array_keys($entity);
        $field_list = join(', ', $keys);
        $placeholder_list = join(', ', str_repeat('?', count($keys)));
        $query = "INSERT INTO $name ($field_list) VALUES ($placeholder_list)";
        $stmt = MySQL::$instance->prepare($query);
        foreach ($keys as $key)
        {
            $value = $entity[$key];
            $stmt->bind_param(self::bind_type($value), $value);
        }
        $stmt->execute();
        $stmt->close();
        return $stmt->insert_id;
    }

    public function remove_by_id($id): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE $key = ?";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->bind_param(self::bind_type($id), $id);
        $stmt->execute();
        $stmt->close();
        return $stmt->affected_rows == 1;
    }
}
