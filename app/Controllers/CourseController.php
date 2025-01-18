<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Classes\Course;
use App\Classes\DocumentCourse;
use App\Classes\VideoCourseCreator;
use App\Classes\Session;
use App\Helpers\Validation;
use Exception;

Session::start();

class CourseController
{
    private Course $course;
    public function createCourse(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-course'])) {
            $title = Validation::sanitizeInput($_POST['title'] ?? '');
            $description = Validation::sanitizeInput($_POST['description'] ?? '');
            $categoryId = (int)($_POST['categoryId'] ?? 0);
            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
            $courseType = $_POST['courseType'] ?? '';
            $teacherId = Session::get('user')[0]['id'];

            if($courseType === 'video') {
                $content = Validation::sanitizeInput($_POST['video-content'] ?? '');
            } else if($courseType === 'document') {
                $content = Validation::sanitizeInput($_POST['doc-content'] ?? '');
            }else {
                throw new Exception("Content Invalid");
            }

            $this->course = new Course($title, $description, $content, $categoryId, $tags, $teacherId, '');

            if ($courseType === 'document') {
                $courseCreator = new DocumentCourse();
            } else if ($courseType === 'video') {
                $courseCreator = new VideoCourseCreator();
            } else {
                throw new \Exception("invalide course type");
            }

            $result = $this->course->create($courseCreator);

            if ($result) {
                header("Location: ../../dashboard/dashboard.php");
                exit;
            }
        }
    }

    public function updateCourse(int $courseId): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-course'])) {
            

            $title = Validation::sanitizeInput($_POST['title'] ?? '');
            $description = Validation::sanitizeInput($_POST['description'] ?? '');
            $content = Validation::sanitizeInput($_POST['content'] ?? '');
            $categoryId = (int)($_POST['categoryId'] ?? 0);
            $tags = $_POST['tags'] ?? [];
            $teacherId = Session::get('user')[0]['id'];


            $this->course = Course::getCourseById($courseId);

            $this->course = new Course($title, $description, $content, $categoryId, $tags, $teacherId, '', $courseId);
            echo "<pre>";
            var_dump($this->course);
            echo "</pre>";
            $courseUpdated = $this->course->update();
            if ($courseUpdated) {
                header("Location: ../courses.php");
            }
            exit;
        }
    }

    public function deleteCourse(int $courseId): void
    {
        if ($courseId > 0) {
            $this->course = Course::getCourseById($courseId);
            echo "<pre>";
            var_dump($this->course);
            echo "</pre>";
            // die;

            if ($this->course->delete()) {
                header("Location: ../pages/courses.php");
            } else {
                header("Location: ../pages/courses.php");
            }
        } else {
            header("Location: ../pages/courses.php");
        }
        exit;
    }

    public function getAllCourses(): array
    {
        return Course::getAllCourses();
    }

    public function getCourseTags(int $courseId): array|bool
    {
        return Course::getCourseTags($courseId);
    }

    public function getLimitCourses(int $limit, int $offset): array
    {
        return Course::getLimitCourses($limit, $offset);
    }

    public function getCountCourses(): int
    {
        $result = Course::getCountCourses();
        return $result ? $result[0]['totalCourses'] : 0;
    }

    public function getTeacherCourses(int $teacherId): array
    {
        if (!Session::exists('user')) {
            throw new \Exception("Teacher not logged in.");
        }

        $courses = Course::getTeacherCourses($teacherId);

        // if ($courses === false) {
        //     throw new \Exception("Failed to fetch courses for the teacher.");
        // }
        return $courses;
    }
}
