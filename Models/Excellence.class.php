<?php

class Excellence
{
    /** @var  */
    public $id;

    /** @var  */
    public $struttura_collegata;

    /** @var string */
    public $titolo;

    /** @var string */
    public $testo;

    /** @var string */
    public $immagine;

    /** @var int */
    public $abilitato;

    /** @var int */
    public $shortcode_lingua;

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
     * @param Excellence $event
     * @return bool
     */
    public static function is_empty(Excellence &$event): bool
    {
        return empty($event->id);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function excellences(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Excellence($row);
        }
        return $results;
    }

    private static function create_samples(int $position, array &$languages)
    {
        $rows = array();
        foreach ($languages as &$language)
        {
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
        foreach ($rows as &$row)
        {
            $prototype[$row['shortcode_lingua']] = new Excellence($row);
        }
        return $prototype;
    }

    public static function grouped_excellences(array &$rows, array &$languages): array
    {
        $results = array();
        if (empty($rows))
        {
            $rows = self::create_samples(1, $languages);
        }
        foreach ($rows as &$row)
        {
            $position = intval($row['posizione']);
            if (!isset($results[$position]))
            {
                $results[$position] = self::create_prototype($position, $languages);
            }
            $results[$position][$row['shortcode_lingua']] = new Excellence($row);
        }
        return $results;
    }

}