<?php
require_once 'Models/Languages.class.php';
require_once 'Models/User.class.php';

class SessionManager
{
    public static function start()
    {
        session_start();
        if (empty($_SESSION['lang'])) {
            $_SESSION['lang'] = Languages::IT;
        }
    }

    public static function set_lang(int $id_lingua)
    {
        $_SESSION['lang'] = $id_lingua;
    }

    public static function get_lang(): int
    {
        return $_SESSION['lang'] ?? Languages::IT;
    }

    public static function set_user(User $user)
    {
        $_SESSION['user'] = $user;
    }

    public static function get_user(): User
    {
        return $_SESSION['user'] ?? new User();
    }

    public static function destroy()
    {
        session_destroy();
    }
}