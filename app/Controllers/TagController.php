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


        $tags = Validation::sanitizeInput($data['name'] ?? '');
        // if (empty($name)) {
        //     return "Tag name cannot be empty";
        // }

        // if (strlen($name) < 3) {
        //     return "tag name should has more than 3 chars";
        // }

        $tags = explode(', ', $tags);
        // var_dump($tags); die;
        if(empty($tags)) {
            return "Tag name cannot be empty";
        }


        try {
            // $tagId = $this->tag->createTag($name);
            foreach($tags as $tag) {
                $tagId = $this->tag->createTag($tag);
                if($tagId <= 0) {
                    return "Error creating tag";
                }
            }
            return "Tag created successfuly";
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
