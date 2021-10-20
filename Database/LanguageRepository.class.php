<?php
require_once 'Database/MySQLRepository.class.php';

class LanguageRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('lingua', 'id');
    }

    public function list_all(): array
    {
        $where = "1 = 1";
        $params = array();
        return $this->get($where, $params);
    }
}