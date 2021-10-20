<?php

class User
{
    /** @var int */
    public $level;

    /** @var string */
    public $level_name;

    /** @var string */
    public $username;

    /** @var string */
    public $email;

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