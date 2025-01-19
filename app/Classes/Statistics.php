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

    public function getCourses() : array
    {
        $query = "SELECT c.title, COUNT(e.id) AS 'Enrollments', cat.name AS categoryName, GROUP_CONCAT(tags.name, ' ') AS tags  , u.fullName FROM courses c 
        JOIN enrollments e ON c.id = e.courseId 
        JOIN categories cat ON cat.id = c.categoryId
        JOIN courseTags ct ON ct.courseId = c.id
        JOIN tags ON tags.id = ct.tagId
        JOIN users u ON u.id = c.teacherId
        GROUP BY e.courseId;";

        $stmt = $this->db->prepare($query);
        if($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
        return [];
    }

    public function getPendingCourses()
    {
        $query = "SELECT fullName, title, status FROM courses JOIN users ON users.id = courses.teacherId WHERE status = 'pending';";
        $stmt = $this->db->prepare($query);
        if($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getTopTeachers()
    {
        $query = "SELECT u.fullName, u.email, COUNT(c.id) AS 'TotalCourses' FROM courses c JOIN users u ON u.id = c.teacherId GROUP BY c.teacherId ORDER BY TotalCourses DESC LIMIT 5;";
        $stmt = $this->db->prepare($query);
        if($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }
    }
}