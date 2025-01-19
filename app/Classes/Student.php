<?php

namespace App\Classes;

use App\Classes\User;
use App\Classes\Enroll;
use App\Config\Database;

class Student extends User
{
    private Enroll $enrollService;

    public function __construct(
        string $fullName,
        string $username,
        string $email,
        string $password,
        string $role,
        ?int $id = null
    ) {
        parent::__construct($fullName, $username, $email, $password, $role);
        $this->enrollService = new Enroll();
    }


    public function enrollInCourse(int $courseId): bool
    {
        if ($this->getId() === null) {
            throw new \InvalidArgumentException("Invalid student Id");
        }

        try {
            return $this->enrollService->EnrollStudent($this->getId(), $courseId);
        } catch (\Exception $e) {
            error_log("Error enrolling in course: " . $e->getMessage());
            return false;
        }
    }


    public function getEnrolledCourses(): array
    {
        if ($this->getId() === null) {
            throw new \InvalidArgumentException("Student must have an ID to retrieve enrolled courses.");
        }

        try {
            $query = "SELECT * FROM courses WHERE id IN (SELECT courseId FROM enrollments WHERE studentId = ?)";
            $stmt = (Database::connect())->prepare($query);
            $stmt->execute([$this->getId()]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
        } catch (\Exception $e) {
            error_log("Error fetching enrolled courses: " . $e->getMessage());
            return [];
        }
    }

    public static function getAllStudents(): array
    {
        try {
            $stmt = (Database::connect())->prepare(" SELECT * FROM users WHERE id NOT IN (SELECT userId FROM teacherRequests) AND role = ?;");
            if ($stmt->execute(['student'])) {
                $reuslt = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $reuslt ?: [];
            }
        } catch (\Exception $e) {
            error_log("Error get the students: " . $e->getMessage());
        }
    }
}
