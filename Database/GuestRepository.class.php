<?php
require_once 'Database/MySQLRepository.class.php';

class GuestRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('ospiti_hotel', 'id');
    }

    public function get_by_hotel(int $id)
    {
        $where = "hotel_associato = :id_hotel";
        $params = array(":id_hotel" => $id);
        $results = $this->get($where, $params);
        return array_pop($results);
    }

    public function get_all_guests(): array
    {
        $where = "TRUE";
        $params = array();
        return $this->get($where, $params);
    }

    public function get_by_room_password_hotel(string $numero_stanza, string $password, int $id_hotel): array
    {
        $where = "hotel_associato = :id_hotel AND password = :password AND numero_stanza = :numero_stanza";
        $params = array(":id_hotel" => $id_hotel, ":password" => md5($password), ":numero_stanza" => $numero_stanza);
        return $this->get($where, $params);
    }
}