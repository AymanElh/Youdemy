<?php

declare(strict_types=1);

namespace App\Classes;

use App\Classes\BaseModel;
use App\Config\Database;


class Category 
{
    private static $nbrOfCategories = 0;
    private static $table;

    function __construct() {
        self::$table = 'categories';
    }

    public function createCategory(string $name) : int
    {
        self::$nbrOfCategories++;
        return BaseModel::insertRecord(self::$table, ['name' => $name]);
    }

    public function deleteCategory(int $id) : void
    {
        BaseModel::deleteRecord(self::$table, $id);
        self::$nbrOfCategories--;
    }

    public function updateCategory(int $id, string $name) : void 
    {
        BaseModel::updateRecord(self::$table, ['name' => $name], $id);
    }

    public function getAllCategories() : array
    {
        $result = BaseModel::selectRecords(self::$table);
        if(!$result) {
            return [];
        }
        return $result;
    }

    public static function getTotalNumberOfCategories() : int
    {
        return self::$nbrOfCategories;
    }

    public function getCategoryId(string $name) : int
    {
        $where = 'name = ?';
        $result = BaseModel::selectRecords(self::$table, 'id', $where, [$name]);
        if($result) {
            return $result[0]['id'];
        }
        return 0;
    }

    public function getCategoryName(int $category_id) : string
    {
        $where = "id = ?";
        $result = BaseModel::selectRecords(self::$table, 'name', $where, [$category_id]);

        if($result) { 
            return $result[0]['name'];
        }
        return "";
    }

    public function getCountCategories() : int 
    {
        $result = BaseModel::selectRecords(self::$table, 'COUNT(*) AS TotalCategories');
        return $result ? $result[0]['TotalCategories'] : 0;
    }

    public function getTopCategories() : array
    {
        $query = "SELECT cat.name, COUNT(*) AS totalCategories FROM categories cat JOIN courses c ON cat.id = c.categoryId GROUP BY cat.id LIMIT 4;";
        $stmt = (Database::connect())->prepare($query);
        if($stmt->execute()) {
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $result ?? [];
    }

}