<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Classes\Course;
use App\Classes\Session;
use App\Controllers\Auth\Auth;

Session::start();

if (Session::exists('user')) {
    $userId = Session::get('user')[0]['id'];
} else {
    throw new Exception("Invali user id");
}

$inProgressCourses = Course::getCoursesByCompletion($userId, 'active');
// var_dump($inProgressCourses); die;
$completedCourses = Course::getCoursesByCompletion($userId, 'completed');

Auth::checkAccess(['student']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Youdemy</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <?php include '../components/head.php' ?>
</head>

<body class="bg-gray-50">
    <?php include '../components/navbar.php' ?>

    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <h1 class="text-3xl font-bold">Browse My Courses</h1>
            <p class="mt-2">Follow your completed and uncompleted courses</p>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">My Courses</h1>

        <!-- In Progress Courses -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-6">In Progress</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (count($inProgressCourses) > 0): ?>
                    <?php foreach ($inProgressCourses as $course): ?>
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="../../public/assets/img/<?= $course['coverImg'] ?>" alt="<?= htmlspecialchars($course['title']); ?>" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <span class="inline-block bg-blue-100 text-blue-600 px-2 py-1 rounded text-sm mb-2"><?= htmlspecialchars($course['category']); ?></span>
                                <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($course['title']); ?></h3>
                                <p class="text-gray-600 mb-4"><?= htmlspecialchars($course['description']); ?></p>
                                <div class="flex items-center">
                                    <a href="./singlePageCourse.php?id=<?= $course['id'] ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                        Read more
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-500">No courses in progress yet.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Completed Courses -->
        <section>
            <h2 class="text-2xl font-semibold mb-6">Completed</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (count($completedCourses) > 0): ?>
                    <?php foreach ($completedCourses as $course): ?>
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="../../public/assets/img/<?= $course['coverImg'] ?>" alt="<?= htmlspecialchars($course['title']); ?>" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <span class="inline-block bg-green-100 text-green-600 px-2 py-1 rounded text-sm mb-2"><?= htmlspecialchars($course['category']); ?></span>
                                <h3 class="text-xl font-semibold mb-2"><?= htmlspecialchars($course['title']); ?></h3>
                                <p class="text-gray-600 mb-4"><?= htmlspecialchars($course['description']); ?></p>
                                <div class="flex items-center">
                                    <a href="./singlePageCourse.php?id=<?= $course['id'] ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                        Read more
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-500">No completed courses yet.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include '../components/footer.php' ?>
</body>

</html>