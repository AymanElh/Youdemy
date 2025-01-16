<?php

declare(strict_types=1);

namespace App\Classes;

use App\Config\Database;

class BaseModel
{
    private static $db;

    function __construct()
    {
        self::$db = Database::connect();
        if(self::$db === null) {
            throw new \Exception("Failed to connect with database");
        }
    }

    public static function insertRecord(string $table, array $data) : int
    {
        // Use prepared statements to prevent SQL injection
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $table($columns) VALUES($placeholders)";
        try {
            $stmt = self::$db->prepare($sql);

            if (!$stmt) {
                error_log("Error preparing statment: " .  implode(', ', self::$db->errorInfo()));
                return 0;
            }
    

            $stmt->execute(array_values($data));

            return (int)self::$db->lastInsertId();
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            return 0;
        }
    }

    public static function updateRecord(string $table, array $data, int $id) : bool
    {

        // Use prepared statements to prevent SQL injection
        $args = [];
        foreach ($data as $key => $value) {
            $args[] = "$key = ?";
        }

        $sql = "UPDATE $table SET " . implode(',', $args) . " WHERE id = ?";

        try {
            $stmt = self::$db->prepare($sql);

            if (!$stmt) {
                error_log("error preparing statment: " . implode(', ', self::$db->errorInfo()));
                return false;
            }

            return $stmt->execute(array_merge(array_values($data), [$id]));
        } 
        catch (\PDOException $e) {
            error_log("Error updating record: " . $e->getMessage());
            return false;
        }
    }

    public static function deleteRecord(string $table, int $id, string $column = 'id') : bool
    {
        $sql = "DELETE FROM $table WHERE $column = ?";

        try {
            $stmt = self::$db->prepare($sql);

            if(!$stmt) {
                error_log("error preparing statment: " . implode(', ', self::$db->errorInfo()));
                return false;
            }
            var_dump("HELLOOD");
            return $stmt->execute([$id]);
        }
        catch(\PDOException $e) {
            error_log("Error deleting record: " . $e->getMessage());
            return false;
        }
    }

    public static function selectRecords(string $table, string $columns = '*', string $where = null, array $args = []) : array|bool
    {
        $sql = "SELECT $columns FROM $table";

        if($where !== NULL) {
            $sql .= " WHERE $where";
        }

        try {
            $stmt = self::$db->prepare($sql);

            if(!$stmt) {
                error_log("Error preparing statment: " . implode(', ', self::$db->errorInfo()));
                return false;
            }

            if($stmt->execute($args)) {
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                return false;
            }
            return $result;
        }
        catch (\PDOException $e) {
            error_log("Error selecting records: " . $e->getMessage());
            return false;
        }
    }
}
