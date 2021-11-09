<?php
require_once 'Models/Level.class.php';

class Profile
{
    /** @var string */
    public $nome;

    /** @var string */
    public $email;

    /** @var string */
    public $telefono;

    /** @var string */
    public $indirizzo;

    /** @var string */
    public $sito_web;

    /** @var string */
    public $immagini_secondarie;

    /** @var string */
    public $descrizione_ospiti;

    /** @var int */
    public $abilitato;

    /** @var int */
    public $latitudine;

    /** @var int */
    public $longitudine;

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
     * @param Profile $profile
     * @return bool
     */
    public static function is_empty(Profile &$profile): bool
    {
        return empty($profile->email);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function profile(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Profile($row);
        }
        return $results;
    }


}