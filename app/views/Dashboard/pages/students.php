<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Classes\BaseModel;
use App\Classes\Session;
use App\Controllers\Auth\Auth;
use App\Classes\Student;
use App\Classes\User;

new BaseModel;

$students = Student::getAllStudents();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    if (!$userId) {
        throw new Exception("Invalid user id");
    }
    if (isset($_POST['ban-user'])) {
        User::banUser($userId);
    }

    if(isset($_POST['unban-user'])) {
        User::UnbanUser($userId);
    }

    header("Location: students.php");
}

Auth::checkAccess(['admin']);

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
                    <a href="#" class="btn bg-white text-gray-800 border-gray-600 hover:bg-gray-100 hover:text-gray-800 hover:border-gray-200 active:bg-gray-100 active:text-gray-800 active:border-gray-200 focus:outline-none focus:ring-4 focus:ring-indigo-300">Create New Course</a>
                </div>

                <!-- All Students -->
                <div class="mx-6 mb-6">
                    <div class="card shadow">
                        <!-- Table Heading -->
                        <div class="border-b border-gray-300 px-5 py-4">
                            <h4>All Teacher</h4>
                        </div>

                        <!-- Table -->
                        <table class="data-table text-left w-full whitespace-nowrap">
                            <thead class="">
                                <tr class="border-gray-300 border-b ">
                                    <th scope="col" class="px-6 py-3">#</th>
                                    <th scope="col" class="px-6 py-3">Student Name</th>
                                    <th scope="col" class="px-6 py-3">Username</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Enrolled Courses</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y ">
                                <?php if (!empty($students)) : ?>
                                    <?php
                                    $count = 1;
                                    foreach ($students as $student) : ?>
                                        <div class="relative overflow-x-auto">
                                            <tr class="border-gray-300 border-b ">
                                                <td class="py-3 px-6 text-left"><?= $count++ ?></td>
                                                <td class="py-3 px-6 text-left"><?= $student['fullName'] ?></td>
                                                <td class="py-3 px-6 text-left"><?= $student['username'] ?></td>
                                                <td class="py-3 px-6 text-left"><?= $student['email'] ?> </td>
                                                <td class="py-3 px-6 text-left">9</td>
                                                <td class="py-3 px-6 text-left">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="userId" value="<?= $student['id'] ?>">
                                                        <?php if ($student['isBanned']) : ?>
                                                            <button type="submit" name="unban-user" onclick="if(confirm('Are you sure to unban user?')) this.form.submit()" class="btn btn-sm bg-indigo-500 text-white">Unban</button>
                                                        <?php else: ?>
                                                            <button type="submit" name="ban-user" onclick="if(confirm('Are you sure to ban user?')) this.form.submit()" class="btn btn-sm bg-indigo-500 text-white">Ban</button>
                                                        <?php endif; ?>
                                                        <button class="btn btn-sm bg-red-500 text-white">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <td class="py-3 px-6 text-left">No student Available</td>
                                    <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        </div>
        </div>
        <!-- end of project -->
    </main>
    <script src="../../public/assets/js/index.js"></script>

</body>

</html>