<?php
require_once 'Database/MySQLRepository.class.php';

class FacilityEventRepository extends MySQLRepository
{
    public function __construct()
    {
        parent::__construct('strutture_eventi', 'id');
    }

    public function get_by_event_id(int $id_evento): array
    {
        $where = "id_evento = :id_evento";
        $params = array(":id_evento" => $id_evento);
        return $this->get($where, $params);
    }

    public function get_by_event_id_and_hotel_id(int $id_evento, int $id_hotel): array
    {
        $where = "id_evento = :id_evento AND id_hotel = :id_hotel";
        $params = array(":id_evento" => $id_evento, ":id_hotel" => $id_hotel);
        return $this->get($where, $params);
    }

    public function get_related_by_event_id_and_language_id(int $id_evento, int $id_lingua): array
    {
        $table = $this->tableName;
        $query = join("\r\n", array(
            "SELECT se.*, h.nome",
            "FROM $table se",
            "INNER JOIN hotel h ON",
            "   h.related_id = se.id_hotel AND",
            "   h.shortcode_lingua = se.shortcode_lingua AND",
            "   se.id_struttura IS NULL",
            "WHERE id_evento = :id_evento",
            "  AND se.shortcode_lingua = :id_lingua",
            "UNION",
            "SELECT se.*, s.nome_struttura AS nome",
            "FROM $table se",
            "INNER JOIN strutture s ON",
            "   s.related_id = se.id_struttura AND",
            "   s.shortcode_lingua = se.shortcode_lingua AND",
            "   se.id_struttura IS NOT NULL",
            "WHERE id_evento = :id_evento",
            "  AND se.shortcode_lingua = :id_lingua",
        ));
        $params = array(":id_evento" => $id_evento, ":id_lingua" => $id_lingua);
        return $this->query($query, $params);
    }

    public function get_related_by_event_id(int $id_evento): array
    {
        $table = $this->tableName;
        $query = join("\r\n", array(
            "SELECT *",
            "FROM $table",
            "WHERE id_evento = :id_evento",
            "  AND id_struttura IS NULL",
            "UNION",
            "SELECT *",
            "FROM $table",
            "WHERE id_evento = :id_evento",
            "  AND id_struttura IS NOT NULL"
        ));
        $params = array(":id_evento" => $id_evento);
        return $this->query($query, $params);
    }

    public function get_related_by_event_id_and_hotel_id_and_language_id(int $id_evento, int $id_hotel, int $id_lingua): array
    {
        $table = $this->tableName;
        $query = join("\r\n", array(
            "SELECT se.*, h.nome",
            "FROM $table se",
            "INNER JOIN hotel h ON",
            "   h.related_id = se.id_hotel AND",
            "   h.shortcode_lingua = se.shortcode_lingua AND",
            "   se.id_struttura IS NULL",
            "WHERE id_evento = :id_evento",
            "  AND se.id_hotel = :id_hotel",
            "  AND se.shortcode_lingua = :id_lingua",
            "UNION",
            "SELECT se.*, s.nome_struttura AS nome",
            "FROM $table se",
            "INNER JOIN strutture s ON",
            "   s.related_id = se.id_struttura AND",
            "   s.shortcode_lingua = se.shortcode_lingua AND",
            "   se.id_struttura IS NOT NULL",
            "WHERE id_evento = :id_evento",
            "  AND se.id_hotel = :id_hotel",
            "  AND se.shortcode_lingua = :id_lingua",
        ));
        $params = array(":id_evento" => $id_evento, "id_hotel" => $id_hotel, ":id_lingua" => $id_lingua);
        return $this->query($query, $params);
    }

    public function get_related_by_event_and_hotel_without_facility(int $id_evento, int $id_hotel): array
    {
        $table = $this->tableName;
        $query = join("\r\n", array(
            "SELECT se.*, h.nome",
            "FROM $table se",
            "INNER JOIN hotel h ON",
            "   h.related_id = se.id_hotel AND",
            "   se.id_struttura IS NULL",
            "WHERE id_evento = :id_evento",
            "  AND se.id_hotel = :id_hotel"
        ));
        $params = array(":id_evento" => $id_evento, "id_hotel" => $id_hotel);
        return $this->query($query, $params);
    }

    public function get_related_by_event_and_hotel_and_facility(int $id_evento, int $id_hotel, int $id_struttura): array
    {
        $table = $this->tableName;
        $query = join("\r\n", array(
            "SELECT se.*, h.nome",
            "FROM $table se",
            "INNER JOIN hotel h ON",
            "   h.related_id = se.id_hotel AND",
            "   se.id_struttura = :id_struttura",
            "WHERE id_evento = :id_evento",
            "  AND se.id_hotel = :id_hotel"
        ));
        $params = array(":id_evento" => $id_evento, "id_hotel" => $id_hotel, ":id_struttura" => $id_struttura);
        return $this->query($query, $params);
    }

    public function get_related_by_event_id_and_hotel_id(int $id_evento, int $id_hotel): array
    {
        $table = $this->tableName;
        $query = join("\r\n", array(
            "SELECT *",
            "FROM $table",
            "WHERE id_evento = :id_evento",
            "  AND id_hotel = :id_hotel",
            "  AND id_struttura IS NULL",
            "UNION",
            "SELECT *",
            "FROM $table",
            "WHERE id_evento = :id_evento",
            "  AND id_hotel = :id_hotel",
            "  AND id_struttura IS NOT NULL"
        ));
        $params = array(":id_evento" => $id_evento, "id_hotel" => $id_hotel);
        return $this->query($query, $params);
    }

    public function get_related_by_event_id_and_hotel_id_without_facility(int $id_evento, int $id_hotel): array
    {
        $table = $this->tableName;
        $query = join("\r\n", array(
            "SELECT *",
            "FROM $table",
            "WHERE id_evento = :id_evento",
            "  AND id_hotel = :id_hotel",
            "  AND id_struttura IS NULL",
        ));
        $params = array(":id_evento" => $id_evento, "id_hotel" => $id_hotel);
        return $this->query($query, $params);
    }

    public function remove_by_event_id(int $id_evento): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE id_evento = :id_evento";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":id_evento" => $id_evento));
        return $stmt->rowCount() > 0;
    }

    public function remove_by_event_id_and_hotel_id(int $id_evento, int $id_hotel): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE id_evento = :id_evento AND id_hotel = :id_hotel";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":id_evento" => $id_evento, ":id_hotel" => $id_hotel));
        return $stmt->rowCount() > 0;
    }

    public function remove_by_event_id_and_hotel_id_facility_null(int $id_evento, int $id_hotel): bool
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "DELETE FROM $table WHERE id_evento = :id_evento AND id_hotel = :id_hotel AND id_struttura IS NULL";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":id_evento" => $id_evento, ":id_hotel" => $id_hotel));
        return $stmt->rowCount() > 0;
    }

    public function get_convenzionato(int $id_evento, int $id_hotel): int
    {
        $table = $this->tableName;
        $key = $this->keyName;
        $query = "SELECT convenzionato FROM $table WHERE id_evento = :id_evento AND id_hotel = :id_hotel AND convenzionato = 1";
        $stmt = MySQL::$instance->prepare($query);
        $stmt->execute(array(":id_evento" => $id_evento, ":id_hotel" => $id_hotel));
        if ($stmt->rowCount() > 0)
            return 1;
        else
            return 0;
    }
}
