<?php

namespace App\Config;

use Dotenv\Dotenv;


use PDO;
use PDOException;

// Creation of the database connection class with singleton method
class Database
{
    private static $conn = null;
    
    private function __construct() {
    }
    
    public static function connect()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__ . '/../../../'));
        $dotenv->load();
        if(self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                error_log("Database connection error: " . $e->getMessage());
                return null;
            }
        }
        return self::$conn;
    }
}