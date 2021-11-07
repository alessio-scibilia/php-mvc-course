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
        $where = "email = :email AND password = :password";
        $params = array(":email" => $email, ":password" => md5($password));
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    public function get_all_hotels(): array
    {
        $where = "level != 0";
        $params = array();
        return $this->get($where, $params);
    }

    public function get_hotels_list_by_user_level(int $level, int $id_user): array
    {
        if ($level <= 2) {
            $where = "TRUE";
            $params = array();
        } else {
            $where = "related_id = :id";
            $params = array(":id" => $id_user);

        }
        return $this->get($where, $params);
    }
}