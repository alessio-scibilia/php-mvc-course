<?php
require_once 'Middlewares/Environment.class.php';

class MySQL
{
    public static $instance = null;

    public static function create() {
        if (self::$instance === null) {
            try {
                $env = Environment::get();
                $config_file = "Database/connection.$env.ini";
                $config = parse_ini_file($config_file);
                self::$instance = new PDO($config['dns'], $config['username'], $config['password']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
    }
}

MySQL::create();
