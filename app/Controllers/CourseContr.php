<?php

namespace App\Controllers;

use App\Classes\Course;
use App\Classes\DocumentCourse;
use App\Classes\VideoCourseCreator;
use App\Helpers\Validation;

class CourseContr
{
    private Course $course;
    public function createCourse(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = Validation::sanitizeInput($_POST['title'] ?? '');
            $description = Validation::sanitizeInput($_POST['description'] ?? '');
            $content = Validation::sanitizeInput($_POST['content'] ?? '');
            $categoryId = (int)($_POST['categoryId'] ?? 0);
            $tags = $_POST['tags'] ?? [];
            $courseType = $_POST['courseType'] ?? '';

            $this->course = new Course($title, $description, $content, $categoryId, $tags);

            if ($courseType === 'document') {
                $courseCreator = new DocumentCourse();
            } else if ($courseType === 'video') {
                $courseCreator = new VideoCourseCreator();
            } else {
                throw new \Exception("invalide course type");
            }

            $result = $this->course->create($courseCreator);

            if ($result) {
                header("Location: ../views/dashboard/courses.php");
                exit;
            }
        }
    }

    public function updateCourse(int $courseId): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = Validation::sanitizeInput($_POST['title'] ?? '');
            $description = Validation::sanitizeInput($_POST['description'] ?? '');
            $content = Validation::sanitizeInput($_POST['content'] ?? '');
            $categoryId = (int)($_POST['categoryId'] ?? 0);
            $tags = $_POST['tags'] ?? [];


            $this->course = Course::getCourseById($courseId);  
            
            $this->course = new Course($title, $description, $content, $categoryId, $tags, $courseId);

            
            $courseUpdated = $this->course->update();

            if ($courseUpdated) {
                header("Location: ../views/dashboard/courses.php");
            } 
            exit;
        }
    }

    public function deleteCourse(int $courseId): void
    {
        if ($courseId > 0) {
            $this->course = Course::getCourseById($courseId);  

            if ($this->course->delete()) {
                header("Location: ../views/dashboard/courses.php");
            } else {
                header("Location: ../views/dashboard/courses.php");
            }
        } else {
            header("Location: ../views/dashboard/courses.php");
        }
        exit;
    }
}
