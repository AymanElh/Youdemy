<?php

namespace App\Classes;

class Session
{
    public static function start()
    {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, array $value) : void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key) : ?array
    {
        return $_SESSION[$key] ?? null;
    }

    public static function exists(string $key) : bool
    {
        return isset($_SESSION[$key]);
    }

    public static function destroy() : void
    {
        session_unset();
        session_destroy();
    }


}