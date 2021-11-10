<?php

class FacilityEvent
{
    /** @var int */
    public $id;

    /** @var int */
    public $id_evento;

    /** @var int */
    public $shortcode_lingua;

    /** @var string */
    public $testo_convenzione;

    /** @var string */
    public $descrizione_evento;

    /** @var int */
    public $id_hotel;

    /** @var int */
    public $id_struttura;

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
     * @param array $rows
     * @return array
     */
    public static function facility_events(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new FacilityEvent($row);
        }
        return $results;
    }


}