<?php
require_once 'Database/MySQLRepository.class.php';

class ProfileRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('hotel', 'id');
    }

    public function get_profile(int $shortcode_lingua, $id_user): array
    {
        $where = "shortcode_lingua = :shortcode_lingua AND related_id = :related_id";
        $params = array(":shortcode_lingua" => $shortcode_lingua, ":related_id" => $id_user);
        return $this->get($where, $params);
    }
}