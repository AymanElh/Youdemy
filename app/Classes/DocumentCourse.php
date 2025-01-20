<?php

namespace App\Classes;

use App\Classes\Interfaces\CourseManagment;
use App\Classes\Session;

class DocumentCourse implements CourseManagment
{
    public function createCourse(Course $course): bool
    {
        
        $data = [
            'title' => $course->getTitle(),
            'description' => $course->getDescription(),
            'type' => 'document',
            'content' => $course->getContent(),
            'coverImg' => $course->getImage(),
            'categoryId' => $course->getCategoryId(),
            'teacherId' => $course->getTeacherId()
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
