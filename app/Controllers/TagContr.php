<?php

namespace App\Controllers;

use App\Classes\Tag;
use App\Helpers\Validation;

class TagContr
{
    private $tag;

    function __construct()
    {
        $this->tag = new Tag();
    }

    public function addTag(): string|bool
    {

        if (isset($_POST['add-tag']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = Validation::sanitizeInput($_POST['tag-name']);

            if (strlen($name) < 3) {
                return "tag name should has more than 3 chars";
            }

            $this->tag->createTag($name);
            header("Location: ../views/Dashboard/tags.php");
            exit;
        }
        return true;
    }

    public function updateTag(): string|bool
    {

        if (isset($_POST['update-tag']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = Validation::sanitizeInput($_POST['name']);

            $tag_id = $_POST['tag_id'];

            if (strlen($name) < 2) {
                return "tag name sould has more than 2 chars";
            }

            $this->tag->updateTag($tag_id, $name);
            header("Location: ../views/Dashboard/tags.php");
            exit;
        }


        return true;
    }

    public function deleteTag()
    {
        if (isset($_POST['delete-tag']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $tag_id = (int)$_POST['tag_id'];

            $this->tag->deleteTag($tag_id);
            header("Location: ../views/Dashbaord/tags.php");
        }
    }

    public function getAllTags()
    {
        $result = $this->tag->getAllTags();
        return $result;
    }
}
