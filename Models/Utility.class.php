<?php
require_once 'Models/Level.class.php';

class Utility
{
    /** @var int */
    public $id;

    /** @var int */
    public $hotel_associato;

    /** @var string */
    public $nome_utility;

    /** @var string */
    public $indirizzo_utility;

    /** @var string */
    public $telefono_utility;

    /** @var string */
    public $immagine_utility;

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
     * @param Utility $utility
     * @return bool
     */
    public static function is_empty(Utility &$utility): bool
    {
        return empty($utility->immagine);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function utilities(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Utility($row);
        }
        return $results;
    }

    private static function create_samples(int $position, array &$languages)
    {
        $rows = array();
        foreach ($languages as &$language) {
            $row = array
            (
                'shortcode_lingua' => $language['shortcode_lingua'],
                'posizione' => $position
            );
            $rows[] = $row;
        }
        return $rows;
    }

    private static function create_prototype(int $position, array &$languages): array
    {
        $prototype = array();
        $rows = self::create_samples($position, $languages);
        foreach ($rows as &$row) {
            $prototype[$row['shortcode_lingua']] = new Utility($row);
        }
        return $prototype;
    }

    public static function grouped_utilities(array &$rows, array &$languages): array
    {
        $results = array();
        if (empty($rows)) {
            $rows = self::create_samples(1, $languages);
        }
        foreach ($rows as &$row) {
            $position = intval($row['posizione']);
            if (!isset($results[$position])) {
                $results[$position] = self::create_prototype($position, $languages);
            }
            $results[$position][$row['shortcode_lingua']] = new Utility($row);
        }
        return $results;
    }
}