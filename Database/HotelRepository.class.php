<?php
require_once 'Database/MySQLRepository.class.php';

class HotelRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('hotel', 'id');
    }

    public function get_by_email_password(string $email, string $password)
    {
        $where = "email = :email AND password = :password AND shortcode_lingua = 1 AND abilitato = 1";
        $params = array(":email" => $email, ":password" => md5($password));
        $results = $this->get($where, $params);
        return array_pop($results);
        
    }

    public function get_all_hotels(int $shortcode_lingua): array
    {
        $where = "level != 0 AND shortcode_lingua = :shortcode_lingua";
        $params = array(":shortcode_lingua" => $shortcode_lingua);
        return $this->get($where, $params);
    }


    public function get_hotels_list_by_user_level(int $level, int $id_user, int $shortcode_lingua): array
    {
        if ($level <= 2) {
            $where = "shortcode_lingua = :shortcode_lingua";
            $params = array(":shortcode_lingua" => $shortcode_lingua);
        } else {
            $where = "related_id = :id AND shortcode_lingua = :shortcode_lingua";
            $params = array(":id" => $id_user, ":shortcode_lingua" => $shortcode_lingua);

        }
        return $this->get($where, $params);
    }

    public function get_profile(int $shortcode_lingua, $id_user): array
    {
        $where = "shortcode_lingua = :shortcode_lingua AND related_id = :related_id";
        $params = array(":shortcode_lingua" => $shortcode_lingua, ":related_id" => $id_user);
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    public function get_by_related_id(int $related_id): array
    {
        $where = "related_id = :related_id";
        $params = array(":related_id" => $related_id);
        return $this->get($where, $params);
    }

    public function get_translations(int $related_id)
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "SELECT $key, related_id, shortcode_lingua, nome, descrizione_ospiti FROM $table WHERE related_id = :related_id";
        $params = array(":related_id" => $related_id);
        return $this->query($query, $params);
    }

    public function delete_hotel(int $related_id): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE $key = :$key";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":$key" => $related_id));
        return $stmt->rowCount() == 1;
    }

    public function get_hotel_all_langs(int $related_id): array
    {
        $where = "related_id = :related_id";
        $params = array(":related_id" => $related_id);
        return $this->get($where, $params);
    }
}