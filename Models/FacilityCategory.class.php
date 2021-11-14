<?php

class FacilityCategory
{
    /** @var int */
    public $id;

    /** @var int */
    public $id_struttura;

    /** @var int */
    public $id_categoria;

    /** @var string */
    public $email_struttura;

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
    public static function facility_categories(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new FacilityEvent($row);
        }
        return $results;
    }

}