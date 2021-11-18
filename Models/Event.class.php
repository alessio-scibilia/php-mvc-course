<?php

class Event
{
    /** @var string */
    public $nome_evento;

    /** @var string */
    public $data_inizio_evento;

    /** @var string */
    public $data_fine_evento;

    /** @var string */
    public $ora_inizio_evento;

    /** @var string */
    public $ora_fine_evento;

    /** @var string */
    public $email;

    /** @var string */
    public $telefono;

    /** @var string */
    public $indirizzo;

    /** @var int */
    public $abilitato;

    /** @var int */
    public $convenzionato;

    /** @var string */
    public $sito_web;

    /** @var string */
    public $nome_struttura;

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
     * @param Event $event
     * @return bool
     */
    public static function is_empty(Event &$event): bool
    {
        return empty($event->email);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function events(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Event($row);
        }
        return $results;
    }


}