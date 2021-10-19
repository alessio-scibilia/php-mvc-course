<?php

class MySQL
{
    public static $instance = null;

    public static function create() {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO(
                    "mysql:host=localhost;dbname=wellcoxwellcome",
                    'root',
                    'secret1234'
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
    }
}

MySQL::create();
