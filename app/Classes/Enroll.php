<?php

namespace App\Classes;

use App\Classes\BaseModel;
use App\Config\Database;

class Enroll
{
    private string $table = 'enrollments';

    public function EnrollStudent(int $studentId, int $couseId) : bool
    {

        try {
            $data = [
                'userId' => $studentId,
                'courseId' => $couseId
            ];

            return BaseModel::insertRecord($this->table, $data);
        }
        catch(\Exception $e) {
            error_log("Error inserting on enrollments table: " . $e->getMessage());
            return false;
        }
    }

    public function getErollStudents(int $courseId) : array
    {
        try {
            $query = "SELECT * FROM users WHERE id IN (SELECT userId FROM enrollments WHERE courseId = ?)";

            $stmt = (Database::connect())->prepare($query);
            if($stmt->execute([$courseId])) {
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            return $result ?: [];
        }
        catch(\Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }
}