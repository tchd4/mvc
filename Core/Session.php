<?php


namespace App\Core;



use App\Contracts\SessionInterface;

class Session implements SessionInterface
{

    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @inheritDoc
     */
    public static function get(string $key)
    {
        return (self::has($key)) ? $_SESSION[$key] : NULL;
    }


    /**
     * @inheritDoc
     */
    public static function set(string $key, $value): SessionInterface
    {
        $_SESSION[$key] = $value;
        return self;
    }

    /**
     * @inheritDoc
     */
    public static function remove(string $key): void
    {
         if ( self::has($key) )
         {
             unset($_SESSION[$key]);
         }
    }

    /**
     * @inheritDoc
     */
    public static function clear(): void
    {
        session_unset();
        session_destroy();
    }

    /**
     * @inheritDoc
     */
    public static function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }
}