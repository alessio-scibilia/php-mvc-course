<?php

class Translations
{
    protected $map = array();

    public function __construct(array $rows = null)
    {
        if (!empty($rows))
        {
            foreach ($rows as &$row)
            {
                $label = $row['etichetta'];
                $value = $row['valore'];
                $this->map[$label] = $value;
            }
        }
    }

    public function get(string $label): string
    {
        return $this->map[$label] ?? '';
    }
}