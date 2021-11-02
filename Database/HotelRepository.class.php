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
}