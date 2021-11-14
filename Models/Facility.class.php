<?php

class Facility
{
    /** @var string */
    public $nome_struttura;

    /** @var string */
    public $email;

    /** @var string */
    public $telefono;

    /** @var string */
    public $indirizzo_struttura;

    /** @var int */
    public $abilitata;

    /** @var int */
    public $related_id;

    /**
     * @param array|null $row
     */
    public function __construct(array $row = null)
    {
        if ($row != null) {
            foreach ($row as $key => $value) {
                $this->{$key} = $value;

                switch ($key) {
                    case 'indirizzo_struttura':
                        $this->indirizzo = $value;
                        break;
                    case 'orari_lunedi':
                        $this->lunedi = $value;
                        break;
                    case 'orari_martedi':
                        $this->martedi = $value;
                        break;
                    case 'orari_mercoledi':
                        $this->mercoledi = $value;
                        break;
                    case 'orari_giovedi':
                        $this->giovedi = $value;
                        break;
                    case 'orari_venerdi':
                        $this->venerdi = $value;
                        break;
                    case 'orari_sabato':
                        $this->sabato = $value;
                        break;
                    case 'orari_domenica':
                        $this->domenica = $value;
                        break;
                }
            }
        }
    }

    /**
     * @param Facility $facility
     * @return bool
     */
    public static function is_empty(Facility &$facility): bool
    {
        return empty($facility->email);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function facilities(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new Facility($row);
        }
        return $results;
    }


}