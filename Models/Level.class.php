<?php

class Level
{
    public static function name(int $level): string
    {
        switch ($level) {
            case 0: return 'God User';
            case 1: return 'Superadmin';
            case 2: return 'Admin';
            case 3: return 'Hotel Pro';
            default:
            case 4: return 'Hotel';
        }
    }
}