<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Classes\BaseModel;
use App\Classes\User;
use App\Classes\Category;
use App\Controllers\CourseController;

$baseModel = new BaseModel;
$category = new Category;
$courseContr = new CourseController;

$limit = 9;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($page - 1) * $limit;

$totalCourses = $courseContr->getCountCourses();
$totalPages = ceil($totalCourses / $limit);


$courses = $courseContr->getLimitCourses($limit, $offset);

$searchedCourses = $courseContr->searchCourses();
// var_dump($searchedCourses);
// die;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnHub - All Courses</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
     <?php include '../components/head.php' ?>
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


    <!-- Search Section -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <form class="max-w-3xl mx-auto" method="post">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input
                    type="search"
                    id="default-search"
                    name="keyword"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    placeholder="Search for courses..."
                 />
                <button
                    type="submit"
                    name="search-btn"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 transition-colors">
                    Search
                </button>
            </div>
        </form>
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

            <!-- Display Searched Courses if Available -->
            <?php if (!empty($searchedCourses)): ?>
                <h2 class="col-span-full text-2xl font-bold">Search Results:</h2>
                <?php foreach ($searchedCourses as $course): ?>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform hover:-translate-y-1">
                        <img src="../../public/assets/img/mohammad-rahmani-8qEB0fTe9Vw-unsplash.jpg" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm"><?= $category->getCategoryName($course['categoryId']) ?></span>
                                <span class="text-gray-800 font-bold">Free</span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($course['title']) ?></h3>
                            <p class="text-gray-600 mb-4"><?= htmlspecialchars($course['description']) ?></p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                                    <span class="ml-2 text-md text-gray-600"><?= User::getUserById($course['teacherId'])[0]['fullName'] ?></span>
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

                <!-- Display Default Courses if No Search Results -->
            <?php elseif (!empty($courses)): ?>
                <h2 class="col-span-full text-2xl font-bold">All Courses:</h2>
                <?php foreach ($courses as $course): ?>
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform hover:-translate-y-1">
                        <img src="../../public/assets/img/mohammad-rahmani-8qEB0fTe9Vw-unsplash.jpg" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm"><?= $category->getCategoryName($course['categoryId']) ?></span>
                                <span class="text-gray-800 font-bold">Free</span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($course['title']) ?></h3>
                            <p class="text-gray-600 mb-4"><?= htmlspecialchars($course['description']) ?></p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                                    <span class="ml-2 text-md text-gray-600"><?= User::getUserById($course['teacherId'])[0]['fullName'] ?></span>
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
            <?php else: ?>
                <p class="col-span-full text-gray-600">No courses found.</p>
            <?php endif; ?>

        </div>
    </div>

</body>

</html>