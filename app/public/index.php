<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Classes\Session;
use App\Classes\Teacher;
use App\Classes\Category;
use App\Classes\BaseModel;
use App\Classes\Statistics;
use App\Controllers\StatisticsController;
use App\Controllers\TeacherController;

new BaseModel;
Session::start();

if (Session::exists('user')) {
    $role = Session::get('user')[0]['role'];
} else {
    $role = null;
}

$teacher = new TeacherController;

$topCategories = (new StatisticsController)->getAdminDashboardStats()['TopCategories'];

// echo "<pre>" ;
// var_dump($topCategories) ;
// echo "</pre>";

if (isset($_POST['make-request']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump("You are requesting...");
    $message = $teacher->makeeRequest();
    var_dump($message);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Online Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <?php include '../views/components/navbar.php' ?>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 py-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Learn Without Limits</h1>
                <p class="text-xl mb-8">Access thousands of courses from expert instructors worldwide</p>
                <a href="../views/pages/courses.php" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">
                    Start Learning
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold mb-8">Top Categories</h2>

        <?php if (count($topCategories) > 0) : ?>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php foreach ($topCategories as $category) : ?>
                    <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-lg transition">
                        <div class="text-4xl mb-4">💻</div>
                        <h3 class="font-semibold"><?= htmlspecialchars($category['name']); ?></h3>
                        <p class="text-gray-600"><?= htmlspecialchars($category['totalCategories']); ?> Courses</p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p class="text-gray-600 text-center">No categories found.</p>
        <?php endif; ?>
    </div>


    <!-- Featured Courses -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Featured Courses</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Course Card 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="https://pin.it/3aJgww8nI" class="w-full object-cover">
                    <div class="p-6">
                        <div class="text-sm text-blue-600 mb-2">Programming</div>
                        <h3 class="text-xl font-semibold mb-2">Complete PHP OOP Course 2024</h3>
                        <p class="text-gray-600 mb-4">Learn object-oriented programming with PHP from scratch</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-800 font-bold">Free</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Enroll Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-blue-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <?php if ($role === 'student') :  ?>
                <h2 class="text-3xl font-bold mb-4">Start Teaching Today</h2>
                <p class="text-xl mb-8">Share your knowledge and earn money by creating online courses</p>
                <form action="" method="post">
                    <button type="submit" name="make-request" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">
                        Become an Instructor
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../views/components/footer.php' ?>
</body>

</html>