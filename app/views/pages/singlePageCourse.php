<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once '../../helpers/ChangeVideoLink.php';

use App\Classes\BaseModel;
use App\Classes\Category;
use App\Classes\Tag;
use App\Classes\Course;
use App\Classes\User;
use App\Classes\Session;
use App\Classes\Enroll;
use App\Controllers\EnrollController;

Session::start();

if (Session::exists('user')) {
    $role = Session::get('user')[0]['role'];
}
new BaseModel;


$category = new Category;
$tagClass = new Tag;

if (isset($_GET['id'])) {
    $courseId = $_GET['id'];

    $course = Course::getCourseById($courseId);
}

$isEnrolled = false;

if (Session::exists('user')) {
    $userId = Session::get('user')[0]['id'];

    $enroll = new Enroll();
    $enrolledStudents = $enroll->getErollStudents($courseId);

    $isEnrolled = in_array($userId, array_column($enrolledStudents, 'id'));
}

$enroll = (new EnrollController)->enrollCourse();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $course->getTitle() ?> - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <?php include '../components/navbar.php' ?>

    <!-- Course Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <!-- Course Info -->
                <div>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 bg-green-200 bg-opacity-25 rounded-full text-sm"><?= $category->getCategoryName($course->getCategoryId()); ?></span>
                        <!-- <span class="px-3 py-1 bg-green-500 bg-opacity-25 rounded-full text-sm">Intermediate</span> -->
                        <?php foreach ($course->getTags() as $tag) : ?>
                            <span class="px-3 py-1 bg-purple-500 bg-opacity-25 rounded-full text-sm"><?= $tagClass->getTagName($tag) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <h1 class="text-4xl font-bold mb-4"><?= $course->getTitle(); ?></h1>
                    <p class="text-xl text-gray-200 mb-6"><?= $course->getDescription(); ?></p>
                    <div class="flex items-center space-x-6 mb-6">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-1">4.8 (256 reviews)</span>
                        </div>
                        <div>1,234 students enrolled</div>
                        <div><?= $course->getCreationDate() ?></div>
                    </div>
                    <!-- Instructor -->
                    <div class="flex items-center">
                        <img src="../../public/assets/img/mohammad-rahmani-8qEB0fTe9Vw-unsplash.jpg" alt="John Doe" class="w-16 h-16 rounded-full border-2 border-white">
                        <div class="ml-4">
                            <div class="font-medium text-lg"><?= User::getUserById($course->getTeacherId())[0]['fullName']; ?></div>
                            <div class="text-gray-300">Senior PHP Developer</div>
                        </div>
                    </div>
                </div>
                <!-- Course Preview -->
                <div class="bg-white rounded-xl shadow-xl p-6 text-gray-900">
                    <img src="../../public/assets/img/mohammad-rahmani-8qEB0fTe9Vw-unsplash.jpg" alt="Course preview" class="w-full rounded-lg mb-6 object-cover" style="max-height: 200px;">
                    <div class="text-3xl font-bold mb-4">FREE</div>
                    <?php if ($isEnrolled): ?>
                        <button class="w-full bg-gray-400 text-white py-3 rounded-lg font-semibold mb-4 cursor-not-allowed" disabled>
                            Enrolled
                        </button>
                    <?php else : ?>
                        <form action="" method="post">
                            <input type="hidden" name="courseid" value="<?= $courseId ?>">
                            <input type="hidden" name="userid" value="<?= $userId ?>">
                            <button type="submit" name="enroll-course" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold mb-4 hover:bg-blue-700 transition">
                                Enroll Now
                            </button>
                            <span><?= var_dump($enroll) ?></span>
                        </form>
                    <?php endif; ?>
                    <div class="space-y-4 text-sm">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            20 hours of video content
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            15 downloadable resources
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Certificate of completion
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Lifetime access
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Content -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- About Course -->
                <div class="bg-white rounded-xl shadow p-6 mb-8">
                    <h2 class="text-2xl font-bold mb-4">About This Course</h2>
                    <p class="text-gray-600 mb-4">
                        This comprehensive course will teach you everything you need to know about Object-Oriented Programming in PHP.
                        From basic concepts to advanced design patterns, you'll learn how to write clean, maintainable, and efficient code.
                    </p>
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold mb-2">What you'll learn</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    OOP Fundamentals
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Design Patterns
                                </li>
                            </ul>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-semibold mb-2">Requirements</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Basic PHP Knowledge
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Text Editor
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Course Content -->
                <?php if ($isEnrolled) : ?>
                    <div class="bg-white rounded-xl shadow p-6">
                        <h2 class="text-2xl font-bold mb-6">Course Content</h2>
                        <!-- Section 1 -->
                        <div class="border rounded-lg mb-4">
                            <button class="flex items-center justify-between w-full p-4 text-left">
                                <span class="font-semibold">1. Introduction to OOP</span>
                                <span class="text-gray-500">3 lectures • 45min</span>
                            </button>
                            <?php if ($course->getType() === 'video') :
                                $link = getYoutubeEmbedUrl($course->getContent());
                                if ($link) : ?>
                                    <iframe width="775" height="315" src="<?= $link ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <?php else : ?>
                                    <p>Invalid YouTube URL.</p>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="border-t p-4 bg-gray-50">
                                <ul class="space-y-4">
                                    <li class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>What is OOP?</span>
                                        </div>
                                        <span class="text-gray-500">15:00</span>
                                    </li>
                                    <li class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Classes and Objects</span>
                                        </div>
                                        <span class="text-gray-500">20:00</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Section 2 -->
                    <div class="border rounded-lg">
                        <button class="flex items-center justify-between w-full p-4 text-left">
                            <span class="font-semibold">2. Properties and Methods</span>
                            <span class="text-gray-500">4 lectures • 60min</span>
                        </button>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <?php include '../components/footer.php' ?>
</body>

</html>