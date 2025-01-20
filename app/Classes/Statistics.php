<?php

namespace App\Classes;

use App\Config\Database;
use App\Classes\BaseModel;

class Statistics
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getCourses(int $teacherId = null): array
    {
        $query = "SELECT c.title, COUNT(e.id) AS 'Enrollments', cat.name AS categoryName, GROUP_CONCAT(tags.name, ' ') AS tags  , u.fullName FROM courses c 
        LEFT JOIN enrollments e ON c.id = e.courseId 
        LEFT JOIN categories cat ON cat.id = c.categoryId
        LEFT JOIN courseTags ct ON ct.courseId = c.id
        LEFT JOIN tags ON tags.id = ct.tagId
        LEFT JOIN users u ON u.id = c.teacherId
        WHERE c.status = 'published'";

        if($teacherId !== null) {
            $query .= " AND c.teacherId = $teacherId";
        }

        $query .= " GROUP BY c.id;";
        
        $stmt = $this->db->prepare($query);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
        return [];
    }

    public function getPendingCourses()
    {
        $query = "SELECT fullName, title, status FROM courses JOIN users ON users.id = courses.teacherId WHERE status = 'draft';";
        $stmt = $this->db->prepare($query);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getTopTeachers()
    {
        $query = "SELECT u.fullName, u.email, COUNT(c.id) AS 'TotalCourses' FROM courses c JOIN users u ON u.id = c.teacherId GROUP BY c.teacherId ORDER BY TotalCourses DESC LIMIT 5;";
        $stmt = $this->db->prepare($query);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function totalEnrollmentsByTeacher(int $teacherId)
    {
        $query = "SELECT COUNT(e.Id) AS totalEnrollments FROM  Courses c JOIN Enrollments e ON c.Id = e.courseId JOIN Users u ON c.teacherId = u.Id WHERE c.teacherId = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$teacherId]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        // var_dump($result);
        // die;
        return $result ? $result['totalEnrollments'] : 0;
    }

    public function getTeacherCourses(int $teacherId): array
    {
        $query = "SELECT c.title, cat.name AS categoryName, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags, COUNT(e.id) AS Enrollments FROM courses c
                LEFT JOIN categories cat ON c.categoryId = cat.id LEFT JOIN courseTags ct ON c.id = ct.courseId
                LEFT JOIN tags t ON ct.tagId = t.id
                LEFT JOIN enrollments e ON c.id = e.courseId
                WHERE c.teacherId = ?
                GROUP BY c.id;
        ";

        $stmt = $this->db->prepare($query);
        if ($stmt->execute([$teacherId])) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
        return [];
    }

    public function getPendingCoursesByTeacher(int $teacherId): array
    {
        $query = "SELECT fullName, c.id AS courseId, c.title, c.status, cat.name AS category, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags  FROM  courses c
                LEFT JOIN categories cat ON c.categoryId = cat.id
                LEFT JOIN courseTags ct ON c.id = ct.courseId
                LEFT JOIN tags t ON ct.tagId = t.id
                LEFT JOIN users ON users.id = c.teacherId
                WHERE c.teacherId = ? AND c.status = 'draft'
                GROUP BY c.id;";

        $stmt = $this->db->prepare($query);
        if ($stmt->execute([$teacherId])) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
        return [];
    }

    public function getTopCategories() : array
    {
        $query = "SELECT cat.name, COUNT(*) AS totalCategories FROM categories cat JOIN courses c ON cat.id = c.categoryId GROUP BY cat.id;";
        $stmt = (Database::connect())->prepare($query);
        if($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $result ?? [];
    }
}
