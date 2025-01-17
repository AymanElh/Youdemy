<?php

namespace App\Classes;

use App\Classes\User;
use App\Classes\BaseModel;

class Admin extends User
{
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
        parent::__construct($fullName, $username, $email, $password, $bio, $profilePic, $dateOfBirth, 'admin', $id);
    }

    public function acceptTeacher(int $userId): bool
    {
        try {
            return BaseModel::updateRecord('users', ['role' => 'teacher'], $userId);
        } catch (\Exception $e) {
            error_log("Error accepting teacher (User ID: {$userId}): " . $e->getMessage());
            return false;
        }
    }


    public function acceptCourse(int $courseId): bool
    {
        try {
            return BaseModel::updateRecord('courses', ['status' => 'accepted'], $courseId);
        } catch (\Exception $e) {
            error_log("Error accepting course (Course ID: {$courseId}): " . $e->getMessage());
            return false;
        }
    }


    public function banUser(int $userId): bool
    {
        try {
            return  BaseModel::updateRecord('users', ['status' => 'banned'], $userId);
        } catch (\Exception $e) {
            error_log("Error banning user (User ID: {$userId}): " . $e->getMessage());
            return false;
        }
    }


    public function manageUserRole(int $userId, string $newRole): bool
    {
        try {
            return BaseModel::updateRecord('users', ['role' => $newRole], $userId);
        } catch (\Exception $e) {
            error_log("Error updating role for User ID {$userId}: " . $e->getMessage());
            return false;
        }
    }
}
