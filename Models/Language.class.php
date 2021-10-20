<?php

/**
 * Language enum
 */
class Language
{
    const IT = 1;
    const EN = 2;
    const DE = 3;

    public $id;
    public $nome_lingua;
    public $shortcode_lingua;
    public $abbreviazione;

    /**
     * @param array|null $row
     */
    public function __construct(array $row = null)
    {
        if ($row != null)
        {
            foreach ($row as $key => $value)
            {
                $this->{$key} = $value;
            }
        }
    }

    public static function abbreviation(int $id_lingua): string
    {
        switch ($id_lingua)
        {
            default:
            case 1: return 'IT';
            case 2: return 'EN';
            case 3: return 'DE';
        }
    }
}