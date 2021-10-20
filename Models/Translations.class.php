<?php

class Translations
{
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