<?php

namespace App\Classes;


use App\Classes\BaseModel;


class Tag
{
    private static $nbrOfTags = 0;
    private static $table = 'tags';

    // function __construct() {
    //     $this->table = 'tags';
    // }

    public function createTag(string $name) : int
    {
        self::$nbrOfTags++;
        return BaseModel::insertRecord(self::$table, ['name' => $name]);
    }

    public function deleteTag(int $id) : void
    {
        BaseModel::deleteRecord(self::$table, $id);
        self::$nbrOfTags--;
    }

    public function updateTag(int $id, string $name) : void 
    {
        BaseModel::updateRecord(self::$table, ['name' => $name], $id);
    }

    public function getAllTags() : array
    {
        $result = BaseModel::selectRecords(self::$table);
        if(!$result) {
            return [];
        }
        return $result;
    }

    public static function getTotalNumberOfTags() : int
    {
        return self::$nbrOfTags;
    }

    public function getTagName(int $tag_id) : string
    {
        $where = "id = ?";
        $result = BaseModel::selectRecords(self::$table, 'name', $where, [$tag_id]);

        if($result) { 
            return $result[0]['name'];
        }
        return "";
    }
}
