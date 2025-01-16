<?php

namespace App\Controllers\Auth;

use App\Helpers\Validation;
use App\Classes\User;
use App\Classes\Student;
use App\Classes\Session;

class Auth
{
    public function singup(array $data) : string|bool
    {
        $fullName = Validation::sanitizeInput($data['fullName'] ?? '');
        $email = Validation::sanitizeInput($data['email'] ?? '');
        $username = Validation::sanitizeInput($data['username'] ?? '');
        $password = $data['password'] ?? '';
        $confirmPassword = $data['confirmPassword'] ?? '';
        $bio = $data['bio'] ?? '';
        $profilePicture = $data['profilePic'] ?? '';
        $dateOfBirth = $data['dateOfBirth'] ?? '';
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

        if(User::getUser($email)) {
            return "User is already exist";
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if($role === 'student') {
            $student = new Student($fullName, $username, $email, $hashedPassword, $bio, $profilePicture, $dateOfBirth, $role);
            if($student->createUser()) {
                return true;
            }
        }

        return false;
    }

    public function login(string $email, string $password) : bool|string
    {
        $userData = User::getUser($email);

        if(!$userData) {
            return "the user doesn't exist";
        }

        if(password_verify($password, $userData['passwordHashed'])) {
            Session::set('user', $userData);
            return true;
        }

        return false;
    }

    public function logout()
    {
        Session::destroy();
    }
}