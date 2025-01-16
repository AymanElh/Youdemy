<?php

namespace App\Classes;

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
        string $bio,
        string $profilePic,
        string $dateOfBirth,
        ?int $id = null
    ) {
        parent::__construct($fullName, $username, $email, $password, $bio, $profilePic, $dateOfBirth, 'student', $id);
        $this->enrollService = new Enroll();
    }


    public function enrollInCourse(int $courseId): bool
    {
        if ($this->getId() === null) {
            throw new \InvalidArgumentException("Student must have an ID to enroll in a course.");
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
}
