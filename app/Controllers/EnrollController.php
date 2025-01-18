<?php

namespace App\Controllers;

use App\Classes\Enroll;

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

            $enroll = new Enroll();

            if($enroll->EnrollStudent($userId, $courseId)) {
                header("Location: ../../public/index.php");
                exit;
            } else {
                return "Course not enrolled";
            }
        }

    }
}