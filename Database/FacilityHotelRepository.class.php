<?php
require_once 'Database/MySQLRepository.class.php';

class FacilityHotelRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('strutture_hotel', 'id');
    }

    public function get_facilities_by_hotel(int $id_hotel): array
    {
        $where = "id_hotel = :id_hotel";
        $params = array(":id_hotel" => $id_hotel);
        return $this->get($where, $params);
    }

    public function get_by_facility_id(int $id_struttura): array
    {
        $where = "id_struttura = :id_struttura";
        $params = array(":id_struttura" => $id_struttura);
        return $this->get($where, $params);
    }
}