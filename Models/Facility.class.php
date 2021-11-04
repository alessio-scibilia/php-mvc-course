<?php

class Facility
{
    /** @var string */
    public $nome_struttura;

    /** @var string */
    public $email;

    /** @var string */
    public $telefono;

    /** @var string */
    public $indirizzo_struttura;

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
     * @param Facility $facility
     * @return bool
     */
    public static function is_empty(Facility &$facility): bool
    {
        return empty($facility->email);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function facilities(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Facility($row);
        }
        return $results;
    }


}