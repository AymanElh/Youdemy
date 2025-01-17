<?php

namespace App\Classes;

use App\Classes\BaseModel;

abstract class User
{
    protected string $fullName;
    protected string $username;
    protected string $email;
    protected string $password;
    protected string $bio;
    protected string $profilePic;
    protected string $dateOfBirth;
    protected string $role;
    private string $table;
    private ?int $id;

    public function __construct(
        string $fullName,
        string $username,
        string $email,
        string $password,
        string $role,
        string $bio = '',
        string $profilePic = '',
        string $dateOfBirth = '',
        ?int $id = null
    ) {
        $this->fullName = $fullName;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->bio = $bio;
        $this->profilePic = $profilePic;
        $this->dateOfBirth = $dateOfBirth;
        $this->role = $role;
        $this->table = 'users';
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function createUser(): bool
    {
        $data = [
            "fullName" => $this->fullName,
            "username" => $this->username,
            "email" => $this->email,
            "passwordHashed" => $this->password,
            "bio" => $this->bio,
            "profilePicture" => $this->profilePic,
            "dateOfBirth" => '2022-12-01',
            "role" => $this->role
        ];

        try {
            $this->id = BaseModel::insertRecord($this->table, $data);
            return $this->id !== null;
        } catch (\Exception $e) {
            error_log("Error creating user: " . $e->getMessage());
            return false;
        }
    }

    public function updateUser(): bool
    {
        if ($this->id === null) {
            throw new \InvalidArgumentException("User ID is required for updating.");
        }

        $data = [
            "fullName" => $this->fullName,
            "username" => $this->username,
            "email" => $this->email,
            "password" => $this->password,
            "bio" => $this->bio,
            "profilePicture" => $this->profilePic,
            "dateOfBirth" => $this->dateOfBirth,
            "role" => $this->role
        ];

        try {
            return BaseModel::updateRecord($this->table, $data, $this->id);
        } catch (\Exception $e) {
            error_log("Error updating user: " . $e->getMessage());
            return false;
        }
    }

    public function deleteUser(): bool
    {
        if ($this->id === null) {
            throw new \InvalidArgumentException("User ID is required for deletion.");
        }

        try {
            return BaseModel::deleteRecord($this->table, $this->id);
        } catch (\Exception $e) {
            error_log("Error deleting user: " . $e->getMessage());
            return false;
        }
    }

    public function changeRole(string $newRole) : bool
    {
        try {
            return BaseModel::updateRecord('users', ['role' => $newRole], $this->id);
        }
        catch (\Exception $e) {
            error_log("Error changing the role: " . $e->getMessage());
            return false;
        }
    }

    public static function getUser(string $email) : ?array
    {
        try {
            $where = "email = ?";
            return BaseModel::selectRecords('users', '*', $where, [$email]) ?? null;
        }
        catch(\Exception $e) {
            error_log("error gettting the user" . $e->getMessage());
            return null;
        }
    }

    
}
