<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Classes\Session;
use App\Classes\BaseModel;
use App\Classes\User;
use App\Classes\Category;
use App\Controllers\CourseController;

$baseModel = new BaseModel;
$category = new Category;
$courseContr = new CourseController;

$limit = 3;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($page - 1) * $limit;

$totalCourses = $courseContr->getCountCourses();
$totalPages = ceil($totalCourses / $limit);


$courses = $courseContr->getLimitCourses($limit, $offset);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnHub - All Courses</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <?php include '../components/navbar.php' ?>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <h1 class="text-3xl font-bold">Browse All Courses</h1>
            <p class="mt-2">Discover our collection of high-quality courses</p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex flex-wrap gap-4 items-center justify-between">
                <div class="flex flex-wrap gap-4">
                    <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>All Categories</option>
                        <option>Programming</option>
                        <option>Business</option>
                        <option>Design</option>
                        <option>Marketing</option>
                    </select>
                    <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>All Levels</option>
                        <option>Beginner</option>
                        <option>Intermediate</option>
                        <option>Advanced</option>
                    </select>
                    <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Price Range</option>
                        <option>Free</option>
                        <option>Paid</option>
                        <option>All</option>
                    </select>
                </div>
                <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Most Popular</option>
                    <option>Newest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Courses Grid -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Course Card 1 -->
            <?php foreach ($courses as $course) : ?>
                <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform hover:-translate-y-1">
                    <img src="../../public/assets/img/mohammad-rahmani-8qEB0fTe9Vw-unsplash.jpg" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm"><?= $category->getCategoryName($course['categoryId']) ?></span>
                            <span class="text-gray-800 font-bold">Free</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2"><?= $course['title'] ?></h3>
                        <p class="text-gray-600 mb-4"><?= $course['description'] ?></p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                                <span class="ml-2 text-md text-gray-600"><?= User::getUserById($course['teacherId'])[0]['fullName']; ?></span>
                            </div>
                            <div class="flex items-center">
                                <a href="./singlePageCourse.php?id=<?= $course['id'] ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Read more
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="mt-12 flex justify-center">
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                <!-- Previous Button -->
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                <?php endif; ?>

                <!-- Page Numbers -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="relative inline-flex items-center px-4 py-2 border <?= $i === $page ? 'bg-blue-50 text-blue-600' : 'bg-white text-gray-700' ?> text-sm font-medium hover:bg-gray-50">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <!-- Next Button -->
                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4-4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                <?php endif; ?>
            </nav>
        </div>

    </div>
</body>

</html>