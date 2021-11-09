<?php
require_once 'Database/MySQLRepository.class.php';

class ServiceRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('servizi', 'id');
    }

    public function get_services_by_hotel(int $id_hotel, int $shortcode_lingua): array
    {
        $where = "hotel_associato = :id_hotel AND shortcode_lingua = :shortcode_lingua";
        $params = array(":id_hotel" => $id_hotel, ":shortcode_lingua" => $shortcode_lingua);
        return $this->get($where, $params);
    }
}