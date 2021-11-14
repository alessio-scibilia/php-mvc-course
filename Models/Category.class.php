<?php

class Category
{
    /** @var string */
    public $nome;

    /** @var string */
    public $immagine;

    /** @var int */
    public $abilitata;

    /** @var int */
    public $id;

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
     * @param Category $category
     * @return bool
     */
    public static function is_empty(Categori &$category): bool
    {
        return empty($category->email);
    }

    /**
     * @param array $rows
     * @return array
     */

    public static function categories(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Category($row);
        }
        return $results;
    }

    private static function create_samples(int $related_id, array &$languages)
    {
        $rows = array();
        foreach ($languages as &$language) {
            $row = array
            (
                'shortcode_lingua' => $language['shortcode_lingua'],
                'related_id' => $related_id
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
            $prototype[$row['shortcode_lingua']] = new Category($row);
        }
        return $prototype;
    }

    public static function grouped_categories(array &$rows, array &$languages): array
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
            $results[$position][$row['shortcode_lingua']] = new Category($row);
        }
        return $results;
    }


}