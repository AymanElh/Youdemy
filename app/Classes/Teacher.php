<?php

namespace App\Classes;

use App\Classes\User;
use App\Classes\BaseModel;
use App\Config\Database;

class Teacher extends User
{
    public function __construct(
        string $fullName,
        string $username,
        string $email,
        string $password,
        string $role = 'teacher',
        string $bio = '',
        string $profilePic = '',
        string $dateOfBirth = '',
        ?int $id = null
    ) {
        parent::__construct($fullName, $username, $email, $password, $role, $bio, $profilePic, $dateOfBirth, $id);
    }

    public static function makeRequest(int $userId)
    {
        try {
            $query = "SELECT * FROM teacherRequests WHERE userId = ? AND status IN ('pending', 'approved')";
            $stmt = (Database::connect())->prepare($query);
            $stmt->execute([$userId]);
            $result = $stmt->fetchAll();
            if ($result) {
                return "You already make a request";
            }

            $insertId = BaseModel::insertRecord('teacherRequests', ['userId' => $userId]) > 0;
            return $insertId > 0 ? "Request maked successfuly" : "Request failed";
        } catch (\Exception $e) {
            error_log("Error inserting the request : " . $e->getMessage());
            return "Request failed";
        }
    }

    public static function accept(int $userId)
    {
        try {
            if (BaseModel::updateRecord('users', ['role' => 'teacher'], $userId)) {
                $stmt = (Database::connect())->prepare("UPDATE teacherRequests SET status = ? WHERE userId = ?;");
                $stmt->execute(['approved', $userId]);
            }
        } catch (\Exception $e) {
            error_log("Error updaing tables: " . $e->getMessage());
        }
    }

    public static function getAllTeachers(): array
    {
        try {
            $query = "SELECT users.id AS userId, users.fullName, users.username, users.email, users.role, r.status, isBanned FROM users JOIN teacherRequests r ON  users.id = r.userId WHERE  users.role = 'teacher';";

            $stmt = (Database::connect())->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result ?: [];
        } catch (\Exception $e) {
            error_log("Error fetching teachers with status: " . $e->getMessage());
            return [];
        }
    }

    public static function getTeacherRequests()
    {
        $query = "SELECT * FROM users JOIN teacherRequests tr ON tr.userId = users.id WHERE status = 'pending';";
        $stmt = (Database::connect())->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result ?: [];
    }
}
