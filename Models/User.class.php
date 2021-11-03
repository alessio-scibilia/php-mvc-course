<?php
require_once 'Models/Level.class.php';

class User
{
    /** @var int */
    public $level;

    /** @var string */
    public $level_name;

    /** @var string */
    public $nome;
    
    /** @var string */
    public $cognome;

    /** @var string */
    public $email;

    /** @var int */
    public $abilitato;

    /**
     * @param array|null $row
     */
    public function __construct(array $row = null)
    {
        if ($row != null) {
            foreach ($row as $key => $value) {
                $this->{$key} = $value;
            }
            if (isset($this->level)) {
                $this->level_name = Level::name($this->level);
            }
        }
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function is_empty(User &$user): bool
    {
        return empty($user->email);
    }

    /**
     * @param array $rows
     * @return array
     */
    public static function users(array &$rows): array
    {
        $results = array();
        foreach ($rows as &$row) {
            $results[] = new User($row);
        }
        return $results;
    }


}