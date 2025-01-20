<?php

namespace App\Controllers;

use App\Classes\Enroll;
use App\Classes\Session;

class EnrollController
{
    public function enrollCourse() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enroll-course'])) {
            $userId = $_POST['userid'];
            $courseId = $_POST['courseid'];

            if(empty($userId) || empty($courseId)) {
                throw new \Exception("user id and course cannot be empty");
            }

            if(!Session::exists('user')) {
                return "You must be logged it to enroll course!";
            }

            $enroll = new Enroll();

            if($enroll->EnrollStudent($userId, $courseId)) {
                return "Course Enrolled";
                header("Location: ../../public/index.php");
                exit;
            } else {
                return "Course not enrolled";
            }
        }

    }
}