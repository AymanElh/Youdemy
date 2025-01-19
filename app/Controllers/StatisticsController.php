<?php

namespace App\Controllers;

use App\Config\Database;
use App\Classes\Statistics;
use App\Classes\User;
use App\Classes\Course;
use App\Classes\Enroll;

class StatisticsController {
    private $statistics;

    public function __construct() {
        $this->statistics = new Statistics(Database::connect());
    }

    public function getDashboardStats() {
        return [
            'TotalCourses' => Course::getCountCourses(),
            'TotalTeachers' => User::getCountUser('teacher'),
            'TotalStudents' => User::getCountUser('student'), 
            'TotalEnrollments' => Enroll::getTotalEnrollments(),
            'CoursesWithtTotalEnrollments' => $this->statistics->getCourses(),
            'PendingCourses' => $this->statistics->getPendingCourses(),
            'TopTeachers' => $this->statistics->getTopTeachers()
        ];
    }
}
