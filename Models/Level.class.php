<?php

class Level
{
    /**
     * @param int $level
     * @return string
     */
    public static function name(int $level): string
    {
        switch ($level) {
            case 0: return 'Developer (God User)';
            case 1: return 'Superadmin user';
            case 2: return 'Admin user';
            case 3: return 'Hotel Pro user';
            default:
            case 4: return 'Hotel user';
        }
    }
}