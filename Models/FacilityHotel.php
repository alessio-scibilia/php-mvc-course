<?php
require_once 'Models/Level.class.php';

class FacilityHotel
{
    /** @var int */
    public $id_hotel;

    /** @var int */
    public $id_struttura;

    /** @var int */
    public $convenzionato;

    /**
     * @param array|null $row
     */
    public function __construct(array $row = null)
    {
        if ($row != null) {
            foreach ($row as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @param FacilitiesHotels $facilities_hotels
     * @return bool
     */
    public static function is_empty(FacilityHotel &$facilities_hotels): bool
    {
        return empty($facilities_hotels->convenzionato);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function facilities_hotels(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Hotel($row);
        }
        return $results;
    }


}