<?php
require_once 'Database/MySQLRepository.class.php';

class FacilityRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('strutture', 'id');
    }

    public function get_by_email(string $email)
    {
        $where = "email = :email";
        $params = array(":email" => $email);
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    public function get_all_facilities(): array
    {
        $where = "TRUE";
        $params = array();
        return $this->get($where, $params);
    }
}