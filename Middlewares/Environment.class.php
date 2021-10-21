<?php

class Environment
{
    public static function get()
    {
        $env = getenv('ENV');
        if (empty($env)) $env = 'prod';
        return $env;
    }
}