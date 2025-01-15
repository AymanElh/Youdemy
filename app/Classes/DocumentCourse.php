<?php

namespace App\Classes;

use App\Classes\Interfaces\CourseManagment;

class DocumentCourse implements CourseManagment
{
    public function createCourse(Course $course): bool
    {
        
        $data = [
            'title' => $course->getTitle(),
            'description' => $course->getDescription(),
            'type' => 'document',
            'content' => $course->getContent(),
            'categoryId' => $course->getCategoryId(),
            'teacherId' => 1
        ];

        $courseId = BaseModel::insertRecord('courses', $data);

        if ($course->getTags()) {
            foreach ($course->getTags() as $tag) {
                BaseModel::insertRecord('courseTags', ['courseId' => $courseId, 'tagId' => $tag]);
            }
        }

        return true;
    }
}
