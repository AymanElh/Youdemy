<?php

namespace App\Controllers;

use App\Classes\Session;
use App\Classes\Teacher;

Session::start();

class TeacherController
{
    public function makeeRequest()
    {
        if (!Session::exists('user')) {
            throw new \Exception("You mussed be logged in");
        }

        $userId = Session::get('user')[0]['id'];

        $result = Teacher::makeRequest($userId);

        return $result;
    }

    public function accpetTeacher()
    {
        if (isset($_POST['accept-teacher']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user-id'];
            if ($userId < 1) {
                throw new \Exception("User id is invalid");
            }
            Teacher::accept($userId);
        }
    }

    public function getAllTeachers()
    {
        if (!Session::exists('user')) {
            throw new \Exception("you must be logged in");
        }
        return Teacher::getAllTeachers();
    }

    public function getTeacherRequests(): array
    {
        if (!Session::exists('user')) {
            throw new \Exception("you must be logged in");
        }
        return Teacher::getTeacherRequests();
    }
}
