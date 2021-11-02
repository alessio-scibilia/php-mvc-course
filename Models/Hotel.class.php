<?php
require_once 'Models/Level.class.php';

class Hotel
{
    /** @var string */
    public $nome;

    /** @var string */
    public $email;

    /** @var string */
    public $telefono;

    /** @var string */
    public $indirizzo;

    /** @var int */
    public $abilitato;

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
     * @param Hotel $hotel
     * @return bool
     */
    public static function is_empty(Hotel &$hotel): bool
    {
        return empty($hotel->email);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function hotels(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Hotel($row);
        }
        return $results;
    }


}