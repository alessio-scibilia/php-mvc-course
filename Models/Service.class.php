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
    public $shortcode_lingua;

    /** @var int */
    public $posizione;

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
        return empty($service->posizione);
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


    private static function create_prototype(int $position, array &$languages)
    {
        $prototype = array();
        foreach ($languages as &$language)
        {
            $row = array
            (
                'shortcode_lingua' => $language['shortcode_lingua'],
                'posizione' => $position
            );
            $prototype[$language['shortcode_lingua']] = new Service($row);
        }
        return $prototype;
    }

    public static function grouped_services(array &$rows, array &$languages): array
    {
        $results = array();
        foreach ($rows as &$row)
        {
            $position = intval($row['posizione']);
            if (!isset($results[$position]))
            {
                $results[$position] = self::create_prototype($position, $languages);
            }
            $results[$position][$row['shortcode_lingua']] = new Service($row);
        }
        return $results;
    }
}