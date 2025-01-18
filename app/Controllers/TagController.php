<?php

namespace App\Controllers;

use App\Classes\Tag;
use App\Helpers\Validation;

class TagController
{
    private $tag;

    function __construct()
    {
        $this->tag = new Tag();
    }

    public function addTag(array $data): string
    {


        $name = Validation::sanitizeInput($data['name'] ?? '');

        if (empty($name)) {
            return "Tag name cannot be empty";
        }

        if (strlen($name) < 3) {
            return "tag name should has more than 3 chars";
        }


        try {
            $tagId = $this->tag->createTag($name);
            return $tagId > 0 ? "Tag created successfuly" : "Error creating tag";
        } catch (\Exception $e) {
            error_log("Error " . $e->getMessage());
        }
    }

    public function updateTag(int $id, array $data): string
    {
        $name = Validation::sanitizeInput($data['name'] ?? '');

        if (empty($name)) {
            return "Tag name cannot be emtpy";
        }

        if ($id <= 0) {
            return "Invalid cateogry id";
        }

        try {
            $this->tag->updateTag($id, $name);
            return "Tag updated";
        } catch (\Exception $e) {
            error_log("Error updating tag exception : " . $e->getMessage());
        }
    }

    public function deleteTag(int $id)
    {
        if($id <= 0) {
            return "invalid tag id";
        }

        try {
            $this->tag->deleteTag($id);
            return "tag deleted successfuly";
        }
        catch(\Exception $e) {
            error_log("Error deleting tag exception : " . $e->getMessage());
        }
    }

    public function getAllTags()
    {
        $result = $this->tag->getAllTags();
        return $result;
    }
}
