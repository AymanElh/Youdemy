<?php

namespace App\Classes;

use App\Classes\Interfaces\CourseManagment;

class Course
{
    private ?int $id = null;
    private string $title;
    private string $description;
    private string $content;
    private int $categoryId;
    // private Teacher $teacher;
    private array $tags = [];

    public function __construct(string $title, string $description, string $content, string $category, array $tags, int $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->categoryId = $category;
        // $this->teacher = $teacher;
        $this->tags = $tags;
        $this->id = $id;
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }


    public function create(CourseManagment $courseCreator): bool
    {
        if($this->id === null) {
            return $courseCreator->createCourse($this);
        }

        return false;
    }

    public function update() : bool
    {
        if($this->id === null) {
            throw new \Exception("Id cannot be null for updating");
        }

        try {
            $data = [
                'title' => $this->getTitle(),
                'description' => $this->getDescription(),
                'content' => $this->getContent(),
                'category_id' => $this->getCategoryId(),
                'teacher_id' => 1
            ];

            $result = BaseModel::updateRecord('courses', $data, $this->id);

            if ($this->getTags()) {
                BaseModel::deleteRecord('courseTags', $this->id);
                foreach ($this->getTags() as $tag) {
                    if ($tag) {
                        BaseModel::insertRecord('course_tags', ['course_id' => $this->id, 'tag_id' => $tag]);
                    }
                }
            }

            return $result;
        } catch (\Exception $e) {
            error_log("Error updating course: " . $e->getMessage());
            return false;
        }
    }

    public function delete() : bool 
    {
        if($this->id === null) {
            throw new \Exception("Id cannot be null for deleting");
        }

        try {
            return BaseModel::deleteRecord('courses', $this->id);
        }
        catch(\Exception $e) {
            error_log("Error deleting item: " . $e->getMessage());
            return false;
        }
    }

}
