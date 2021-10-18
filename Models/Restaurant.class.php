<?php

class Restaurant
{
    /** @var int */
    public $id;

    /** @var int */
    public $abilitato;

    /** @var string */
    public $descrizione_ospiti;

    /** @var string */
    public $email;

    /** @var string */
    public $immagine_principale;

    /** @var string */
    public $immagini_secondarie;

    /** @var string */
    public $indirizzo;

    /** @var int */
    public $livello;

    /** @var string */
    public $latitudine;

    /** @var string */
    public $longitudine;

    /** @var string */
    public $nome;

    /** @var string */
    public $password;

    /** @var int */
    public $related_id;

    /** @var string */
    public $restore_code;

    /** @var string */
    public $shortcode_lingua;

    /** @var string */
    public $sito_web;

    /** @var string */
    public $telefono;

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
}