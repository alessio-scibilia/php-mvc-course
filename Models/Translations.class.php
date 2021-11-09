<?php

class Translations
{
    protected $map = array();

    public $items = array();
    
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
            $this->items = $rows;
        }
    }

    public function get(string $label): string
    {
        return $this->map[$label] ?? '';
    }

    public static function reserved(string $key): bool
    {
        return (strpos($key, 'param_') !== false || strpos($key, 'link_') !== false || strpos($key, 'nuovo_params') !== false || strpos($key, 'abbreviazione') !== false || strpos($key, 'shortcode_lingua') !== false || strpos($key, 'id_lingua') !== false || strpos($key, 'id') !== false || strpos($key, 'lingua_abilitata') !== false);
    }
}