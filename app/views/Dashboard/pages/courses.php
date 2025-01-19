<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';
require_once __DIR__ . '/../../../Config/error_config.php';

use App\Classes\Session;
use App\Classes\BaseModel;
use App\Classes\Category;
use App\Classes\Tag;
use App\Classes\User;
use App\Controllers\CourseController;
use App\Controllers\Auth\Auth;

Session::start();

if (!Session::exists('user')) {
    header("Location: ../../../public/index.php");
    exit;
}

$role = Session::get('user')[0]['role'];
$userId = Session::get('user')[0]['id'];
$baseModel = new BaseModel;

$catgory = new Category;

$courseContr = new CourseController;

echo "<pre>";
// var_dump($_SESSION);
echo "</pre>";

if ($role === 'admin') {
    $courses = $courseContr->getAllCourses();
} else if ($role === 'teacher') {
    $courses = $courseContr->getTeacherCourses($userId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete-course'])) {
        $courseContr->deleteCourse($_POST['course-id']);
    }

    if(isset($_POST['accept-course'])) {
        $courseId = $_POST['course_id'];
        if($courseContr->acceptCourse($courseId) === "Course Accepted") {
            header("Location: courses.php");
        }
    }
}

Auth::checkAccess(['admin', 'teacher']);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />
    <meta
        name="description"
        content="Youdemy - Online Learning Platform" />
    <?php include '../../components/head.php' ?>
    <link rel="stylesheet" href="../../../node_modules/apexcharts/dist/apexcharts.css" />
    <link rel="stylesheet" href="../../../public/assets/css/theme.css" />
    <link rel="stylesheet" href="../../../public/assets/css/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        /* Custom CSS for modal positioning */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            position: relative;
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 24rem;
            width: 100%;
            margin: 1.25rem;
        }
    </style>

    <title>Courses - Youdemy</title>
</head>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include '../../components/navbar-vertical.php'; ?>
            <!-- app layout content -->
            <div id="app-layout-content" class="min-h-screen w-full min-w-[100vw] md:min-w-0 ml-[15.625rem] [transition:margin_0.25s_ease-out]">
                <?php include '../../components/top-navbar.php'; ?>

                <!-- Page Header -->
                <div class="bg-indigo-600 px-6 pt-6 pb-8 h-20 flex justify-between items-center mb-8">
                    <h1 class="text-lg text-white">Courses</h1>
                    <nav class="text-white text-sm">
                        <a href="../dashboard.php" class="hover:underline">Dashboard</a> / Courses
                    </nav>
                    <?php if ($role === 'teacher') : ?>
                        <a href="../forms/addCourse.php" class="btn bg-white text-gray-800 border-gray-600 hover:bg-gray-100 hover:text-gray-800 hover:border-gray-200 active:bg-gray-100 active:text-gray-800 active:border-gray-200 focus:outline-none focus:ring-4 focus:ring-indigo-300">Create New Course</a>
                    <?php endif; ?>
                </div>

                <!-- Courses Table -->
                <div class="mx-6 mb-6">
                    <div class="card shadow">
                        <!-- Table Heading -->
                        <div class="border-b border-gray-300 px-5 py-4">
                            <h4>Courses List</h4>
                        </div>

                        <!-- Table -->
                        <div class="relative overflow-x-auto">
                            <table class="data-table text-left w-full whitespace-nowrap">
                                <thead class="">
                                    <tr class="border-gray-300 border-b ">
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">Course Name</th>
                                        <th scope="col" class="px-6 py-3">Category</th>
                                        <th scope="col" class="px-6 py-3">Tags</th>
                                        <th scope="col" class="px-6 py-3">Teacher</th>
                                        <th scope="col" class="px-6 py-3">Created Date</th>
                                        <th scope="col" class="px-6 py-3">Enrolls</th>
                                        <th scope="col" class="px-6 py-3">Status</th>
                                        <th scope="col" class="px-6 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y ">
                                    <?php
                                    if (!empty($courses)) :
                                        $count = 1;
                                        foreach ($courses as $course) :
                                            $tags = $courseContr->getCourseTags($course['id']);
                                    ?>
                                            <tr class="border-gray-300 border-b ">
                                                <td class="py-3 px-6 text-left"><?= $count++ ?></td>
                                                <td class="py-3 px-6 text-left"><?= $course['title'] ?></td>
                                                <td class="py-3 px-6 text-left"><?= $catgory->getCategoryName($course['categoryId']) ?></td>
                                                <td class="py-3 px-6 text-left">
                                                    <?php foreach ($tags as $tag) : ?>
                                                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2 py-1 rounded"><?= Tag::getTagName($tag['tagId']) ?></span>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="py-3 px-6 text-left"><?= User::getUserById($course['teacherId'])[0]['fullName'] ?></td>
                                                <td class="py-3 px-6 text-left"><?= $course['creationDate'] ?></td>
                                                <td class="py-3 px-6 text-left">20</td>
                                                <td>
                                                    <?php if ($course['status'] === 'draft' && Session::get('user')[0]['role'] === 'admin') : ?>
                                                        <form action="" method="POST">
                                                            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                                            <button type="submit" onclick="if(confirm('Are you sure you want accept the course?')) this.form.submit()" class="bg-yellow-100 text-yellow-800 text-sm font-medium px-2 py-1 rounded" name="accept-course">Accept Course</button>
                                                        </form>
                                                    <?php else : ?>
                                                        <span class="bg-green-100 text-green-800 text-sm font-medium px-2 py-1 rounded" name="accept-course"><?= htmlspecialchars($course['status']) ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="py-3 px-6 text-left">
                                                    <button class="btn btn-sm bg-indigo-500 text-white">Read</button>
                                                    <?php if (Session::get('user')[0]['role'] === 'teacher') : ?>
                                                        <a href="../forms/editCourse.php?courseId=<?= $course['id'] ?>" class="btn btn-sm bg-indigo-500 text-white">Edit</a>
                                                    <?php endif; ?>
                                                    <button class="btn btn-sm bg-red-500 text-white" onclick="openDeleteCourseModal(<?= $course['id'] ?>)">Delete</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <td class="py-3 px-6">No Courses Available</td>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of project -->

        <?php include '../../components/modals.php' ?>
    </main>
    <script src="../../../public/assets/js/main.js"></script>
    <script src="../../../public/assets/js/index.js"></script>

</body>

</html>