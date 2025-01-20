<?php

namespace App\Classes;

use App\Classes\BaseModel;
use App\Config\Database;
use Exception;

class Enroll
{
    private string $table = 'enrollments';

    public function EnrollStudent(int $studentId, int $couseId): bool
    {

        try {
            $data = [
                'userId' => $studentId,
                'courseId' => $couseId
            ];

            return BaseModel::insertRecord($this->table, $data);
        } catch (\Exception $e) {
            error_log("Error inserting on enrollments table: " . $e->getMessage());
            return false;
        }
    }

    public function getErollStudents(int $courseId): array
    {
        try {
            $query = "SELECT * FROM users WHERE id IN (SELECT userId FROM enrollments WHERE courseId = ?)";

            $stmt = (Database::connect())->prepare($query);
            if ($stmt->execute([$courseId])) {
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            return $result ?: [];
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getCountEnrollByCourse(int $courseId): int
    {
        try {
            $query = "SELECT COUNT(*) AS totalEnroll FROM users WHERE id IN (SELECT userId FROM enrollments WHERE courseId = ?)";

            $stmt = (Database::connect())->prepare($query);
            if ($stmt->execute([$courseId])) {
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }

            return $result ? $result[0]['totalEnroll'] : 0;
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public static function getTotalEnrollments(): int
    {
        try {
            $result = BaseModel::selectRecords('enrollments', 'COUNT(*) AS TotalEnrollments');
            if (!$result) {
                throw new Exception("cannot get enrollments");
            }
            return $result ? $result[0]['TotalEnrollments'] : 0;
        } catch (\Exception $e) {
            error_log("Error getting the total enrollments: " . $e->getMessage());
        }
    }

    public static function getEnrolmentsStatus(int $courseId, int $userId)
    {
        try {
        $query = "SELECT status FROM enrollments WHERE userId = ? AND courseId = ?";
        $stmt = (Database::connect())->prepare($query);
        $stmt->execute([$userId, $courseId]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['status'] ?? [];
        }
        catch(\Exception $e) {
            error_log("Error : " . $e->getMessage());
        }
    }

    public function completeCourse(int $courseId, int $userId) 
    {
        try {
            $stmt = (Database::connect())->prepare("UPDATE enrollments SET status = 'completed' WHERE userId = ? AND CourseId = ?");
            if($stmt->execute([$userId, $courseId])) {
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
            return $result;
        }
        catch (\Exception $e) {
            error_log("Error updating enrollments" . $e->getMessage());
        }
    }
}
