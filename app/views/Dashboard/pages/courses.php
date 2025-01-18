<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';
// require_once __DIR__ . '/../../../Config/error_config.php';

use App\Classes\Session;
use App\Classes\BaseModel;
use App\Classes\Category;
use App\Classes\Tag;
use App\Classes\User;
use App\Controllers\CourseController;

Session::start();
$baseModel = new BaseModel;

$catgory = new Category;

$courseContr = new CourseController;
$courses = $courseContr->getAllCourses();

echo "<pre>";
// var_dump($_SESSION);
echo "</pre>";

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
    <?php include '../../partials/head.php' ?>
    <link rel="stylesheet" href="../../../node_modules/apexcharts/dist/apexcharts.css" />
    <link rel="stylesheet" href="../../../public/assets/css/theme.css" />
    <link rel="stylesheet" href="../../../public/assets/css/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <title>Courses - Youdemy</title>
</head>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include '../../partials/navbar-vertical.php'; ?>
            <!-- app layout content -->
            <div id="app-layout-content" class="min-h-screen w-full min-w-[100vw] md:min-w-0 ml-[15.625rem] [transition:margin_0.25s_ease-out]">
                <?php include '../../partials/top-navbar.php'; ?>

                <!-- Page Header -->
                <div class="bg-indigo-600 px-6 pt-6 pb-8 h-20 flex justify-between items-center mb-8">
                    <h1 class="text-lg text-white">Courses</h1>
                    <nav class="text-white text-sm">
                        <a href="../dashboard.php" class="hover:underline">Dashboard</a> / Courses
                    </nav>
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
                                    $count = 1;
                                    foreach ($courses as $course) :
                                        $tags = $courseContr->getCourseTags(6);

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
                                                <?php if ($course['status'] === 'draft' && $_SESSION['user']['role'] === 'admin') : ?>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                                        <button type="submit" class="bg-green-100 text-green-800 text-sm font-medium px-2 py-1 rounded" name="accept-course">Accept Course</button>
                                                    </form>
                                                <?php else : ?>
                                                    <span class="badge badge-success p-2"><?= htmlspecialchars($course['status']) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="py-3 px-6 text-left">
                                                <button class="btn btn-sm bg-indigo-500 text-white">Read</button>
                                                <button class="btn btn-sm bg-red-500 text-white">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of project -->
    </main>
    <script src="../../../public/assets/js/index.js"></script>

</body>

</html>