<?php
require_once 'Database/MySQLRepository.class.php';


class UserRepository
{
    public function __construct()
    {
        parent::__construct('user', 'id');
    }

    public function get_by_username_password(string $username, string $password): array
    {
        $where = "username = :username AND password = :password";
        $params = array(":username" => $username, ":password" => md5($password));
        return $this->get($where, $params);
    }
}