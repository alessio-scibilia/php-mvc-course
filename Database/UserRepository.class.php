<?php
require_once 'Database/MySQLRepository.class.php';

class UserRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('users', 'id');
    }

    public function get_by_email_password(string $email, string $password)
    {
        $where = "email = :email AND password = :password";
        $params = array(":email" => $email, ":password" => md5($password));
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    public function get_by_email(string $email)
    {
        $where = "email = :email";
        $params = array(":email" => $email);
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    /**
     * @param int $upper_level is included in results
     */
    public function filter_by_upper_level(int $upper_level): array
    {
        $where = "level >= :upper_level";
        $params = array(":upper_level" => $upper_level);
        return $this->get($where, $params);
    }


}