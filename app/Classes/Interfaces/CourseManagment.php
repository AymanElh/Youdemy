<?php

namespace App\Classes\Interfaces;


use App\Classes\Course;

interface CourseManagment
{
    public function createCourse(Course $course): bool;
}
