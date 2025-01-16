<?php

namespace App\Helpers;


class Validation
{
    public static function validateEmail(string $email) : bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function validatePassword(string $password) : bool
    {
        return strlen($password) >= 5 && strlen($password) <= 20;
    }

    public static function sanitizeInput(string $input) : string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

}