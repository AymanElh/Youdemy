<?php

namespace App\Classes;

use App\Classes\Interfaces\CourseManagment;

class VideoCourseCreator implements CourseManagment
{
    public function createCourse(Course $course): bool
    {
        $data = [
            'title' => $course->getTitle(),
            'description' => $course->getDescription(),
            'type' => 'video',
            'content' => $course->getContent(),
            'category_id' => $course->getCategoryId(),
            'teacher_id' => 1
        ];

        $courseId = BaseModel::insertRecord('courses', $data);

        if ($course->getTags()) {
            foreach ($course->getTags() as $tag) {
                BaseModel::insertRecord('course_tags', ['course_id' => $courseId, 'tag_id' => $tag]);
            }
        }

        return true;
    }

}
