<?php
require_once 'Database/HotelRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/User.class.php';

class SessionManager
{
    public static function start()
    {
        session_start();
        if (empty($_SESSION['language'])) {
            $_SESSION['language'] = Languages::IT;
        }
    }

    public static function set_lang(int $id_lingua)
    {
        $_SESSION['language'] = $id_lingua;
    }

    public static function get_lang(): int
    {
        return $_SESSION['language'] ?? Languages::IT;
    }

    public static function set_user(User $user)
    {
        $_SESSION['user'] = $user;
        $type = isset($user->related_id) ? 'hotel' : 'user';
        self::set_user_cookie($type, $user->id);
    }

    const COOKIE_NAME = 'backoffice_id';
    const LOCALHOST = 'localhost';

    /**
     * @param string $type
     * @param string $id
     * @return void
     */
    protected static function set_user_cookie(string $type, string $id)
    {
        $host = $_SERVER['HTTP_HOST'];
        $lifetime = 24 * 60 * 60;
        $value = rawurlencode("$type-$id");
        $v = phpversion();
        if ($v > '7.3')
        {
            $expire_time = time() + $lifetime;
            $options = array
            (
                'expires' => $expire_time,
                'path' => '/',
                'domain' => $host,
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Lax'
            );
            setcookie(self::COOKIE_NAME, $value, $options);
        }
        else
        {
            $key = self::COOKIE_NAME;
            //$header = "Set-Cookie: $key=$value; Max-Age=$lifetime; Domain=$host; Path=/; Secure; HttpOnly; SameSite=Lax";
            $header = "Set-Cookie: $key=$value; Max-Age=$lifetime; Domain=$host; Path=/";
            header($header, true);
        }
    }

    protected static function remove_user_cookie()
    {
        $host = $_SERVER['HTTP_HOST'];
        $v = phpversion();
        if ($v > '7.3')
        {
            $options = array
            (
                'expires' => time(),
                'path' => '/',
                'domain' => $host,
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Lax'
            );
            setcookie(self::COOKIE_NAME, '', $options);
        }
        else
        {
            $key = self::COOKIE_NAME;
            //$header = "Set-Cookie: $key=; Max-Age=$lifetime; Domain=$host; Path=/; Secure; HttpOnly; SameSite=Lax";
            $header = "Set-Cookie: $key=; Max-Age=0; Domain=$host; Path=/";
            header($header, true);
        }
    }

    public static function get_user(): User
    {
        $user = $_SESSION['user'] ?? new User();
        if (User::is_empty($user))
        {
            $user_id = $_COOKIE[self::COOKIE_NAME] ?? false;
            if ($user_id === false)
            {
                return $user;
            }
            list($type, $id) = explode('-', $user_id);
            switch ($type)
            {
                case 'hotel':
                    $hotel_repository = new HotelRepository();
                    $hotel = $hotel_repository->get_by_id($id);
                    $user = new User($hotel);
                    if ($user->enabled()) {
                        self::set_user($user);
                    } else {
                        $user = new User();
                    }
                    break;

                case 'user':
                    $user_repository = new UserRepository();
                    $row = $user_repository->get_by_id($id);
                    $user = new User($row);
                    if ($user->enabled()) {
                        self::set_user($user);
                    } else {
                        $user = new User();
                    }
                    break;
            }
        }

        return $user;
    }

    public static function set_user_level(int $level)
    {
        return $_SESSION['level'] = $level;
    }

    public static function destroy()
    {
        self::remove_user_cookie();
        session_destroy();
    }
}