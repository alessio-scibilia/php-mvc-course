<?php
require_once 'Database/MySQLRepository.class.php';

class LanguageRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('lingue', 'id');
    }

    public function list_all(): array
    {
        $where = "abilitata = 1";
        $params = array();
        return $this->get($where, $params);
    }

    public function list_all_including_enabled(): array
    {
        $where = "1 = 1";
        $params = array();
        return $this->get($where, $params);
    }
}