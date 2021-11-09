<?php
require_once 'Models/Level.class.php';

class Service
{
    /** @var int */
    public $id;

    /** @var int */
    public $hotel_associato;

    /** @var int */
    public $abilitato;

    /** @var string */
    public $titolo;

    /** @var string */
    public $descrizione;

    /** @var string */
    public $lunedi;

    /** @var string */
    public $martedi;

    /** @var string */
    public $mercoledi;

    /** @var string */
    public $giovedi;

    /** @var string */
    public $venerdi;

    /** @var string */
    public $sabato;

    /** @var string */
    public $domenica;

    /** @var string */
    public $immagine;

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
     * @param Service $service
     * @return bool
     */
    public static function is_empty(Service &$service): bool
    {
        return empty($service->convenzionato);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function services(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Service($row);
        }
        return $results;
    }


}