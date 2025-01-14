<?php

namespace App\Config;

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use PDO;
use PDOException;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Creation of the database connection class with singleton method
class Database
{
    private static $conn = null;

    private function __construct() {}

    private static function getInstance() : Database
    {
        if(self::$conn === null) {
            return new self();
        }
        return self::$conn;
    }

    public function connect() : Database
    {
        if(self::$conn === null) {
            try {
                self::$conn = self::getInstance();
                self::$conn = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                error_log("Database connection error: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}