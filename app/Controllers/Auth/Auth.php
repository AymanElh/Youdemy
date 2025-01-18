<?php

namespace App\Controllers\Auth;

use App\Helpers\Validation;
use App\Classes\User;
use App\Classes\Student;
use App\Classes\Session;

class Auth
{
    public function singup(array $data): string|bool
    {
        $fullName = Validation::sanitizeInput($data['fullName'] ?? '');
        $email = Validation::sanitizeInput($data['email'] ?? '');
        $username = Validation::sanitizeInput($data['username'] ?? '');
        $password = $data['password'] ?? '';
        $confirmPassword = $data['confirmPassword'] ?? '';
        $role = $data['role'] ?? 'student';


        if (!Validation::validateEmail($email)) {
            return "Invalid email format.";
        }

        if (!Validation::validatePassword($password)) {
            return "Invalid password";
        }

        if ($password !== $confirmPassword) {
            return "Passwords do not match.";
        }



        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if ($role === 'student') {
            $student = new Student($fullName, $username, $email, $hashedPassword, 'student');
            if ($student->createUser()) {
                return "singup success";
            }
        }

        return false;
    }

    public function login(string $email, string $password): bool|string
    {
        $userData = User::getUser($email);

        if (!$userData) {
            return "the user doesn't exist";
        }

        if (password_verify($password, $userData[0]['passwordHashed'])) {
            Session::start();
            Session::set('user', $userData);
            return "login successfuly";
        }

        return false;
    }

    public function logout()
    {
        Session::destroy();
    }
}
