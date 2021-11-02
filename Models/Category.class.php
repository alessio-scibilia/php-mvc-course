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


}