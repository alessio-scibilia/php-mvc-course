<?php
require_once 'Models/Level.class.php';

class Guest
{
    /** @var string */
    public $nome;

    /** @var string */
    public $cognome;

    /** @var string */
    public $email;

    /** @var string */
    public $telefono;

    /** @var string */
    public $numero_stanza;

    /** @var int */
    public $hotel_associato;

    /** @var int */
    public $numero_ospiti;

    /** @var string */
    public $data_checkin;

    /** @var string */
    public $data_checkout;

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
     * @param Guest $guest
     * @return bool
     */
    public static function is_empty(Guest &$guest): bool
    {
        return empty($guest->email);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function guests(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Guest($row);
        }
        return $results;
    }


}