<?php

class MySQL
{
    public static $instance = null;

    public static function create() {
        if (self::$instance === null) {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            self::$instance = new mysqli(
                'localhost',
                'root',
                "fW>M'=\Um7RW(d,K->rJfnUg\";k&WFq2qs/<ndhRbB,sg-Xp8+&dCGs&SF~W3#zeU8{fy-gqY{GPn\h?4KaW9:>f[;3,.JftBj]T"
            );
        }
    }
}

MySQL::create();
