<?php
require_once 'Database/MySQLRepository.class.php';


class TranslationRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('traduzioni', 'id');
    }

    public function list_by_language(int $id_lingua): array
    {
        $where = "id_lingua = :id_lingua";
        $params = array(":id_lingua" => $id_lingua);
        return $this->get($where, $params);
    }
}