<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Classes\BaseModel;
use App\Classes\Statistics;
use App\Classes\User;
use App\Controllers\Auth\Auth;
use App\Controllers\CourseController;
use App\Controllers\EnrollController;
use App\Controllers\StatisticsController;

new BaseModel;

$courseContr = new CourseController;
$courses = $courseContr->getAllCourses();

$statisticsContr = new StatisticsController;

$stats = $statisticsContr->getDashboardStats();
// echo "<pre>";
// var_dump($stats['PendingCourses']);
// echo "</pre>";
// die;

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
        content="Dash UI - TailwindCSS HTML Admin Template Free and open-source Github, provides developers with everything need to create Web Application & Kick start project" />
    <?php include '../components/head.php' ?>
    <link rel="stylesheet" href="../../node_modules/apexcharts/dist/apexcharts.css" />
    <link rel="stylesheet" href="../../public/assets/css/theme.css" />
    <title>Youdemy </title>
    <style>
        #enrollmentPieChart {
            max-width: 300px;
            max-height: 300px;
            width: 100%;
            height: auto;
        }
    </style>

</head>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include '../components/navbar-vertical.php'; ?>
            <!-- app layout content -->
            <div id="app-layout-content" class="min-h-screen w-full min-w-[100vw] md:min-w-0 ml-[15.625rem] [transition:margin_0.25s_ease-out]">
                <?php include '../components/top-navbar.php'; ?>

                <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                    <!-- title -->
                    <h1 class="text-xl text-white">Courses Mangments</h1>
                </div>
                <div class="-mt-12 mx-6 mb-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2 xl:grid-cols-4">
                    <!-- card -->
                    <div class="card shadow">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- content -->
                            <div class="flex justify-between items-center">
                                <h4>Courses</h4>
                                <div class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                                    <i data-feather="briefcase"></i>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-col gap-0 text-base">
                                <h2 class="text-xl font-bold"><?= $stats['TotalCourses']; ?></h2>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    <div class="card shadow">
                        <!-- card boduy -->
                        <div class="card-body">
                            <!-- content -->
                            <div class="flex justify-between items-center">
                                <h4>Teachers</h4>
                                <div class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                                    <i data-feather="list"></i>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-col gap-0 text-base">
                                <h2 class="text-xl font-bold"><?= $stats['TotalTeachers']; ?></h2>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    <div class="card shadow">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- content -->
                            <div class="flex justify-between items-center">
                                <h4>Students</h4>
                                <div class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                                    <i data-feather="users"></i>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-col gap-0 text-base">
                                <h2 class="text-xl font-bold"><?= $stats['TotalStudents'] ?></h2>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    <div class="card shadow">
                        <!-- card body -->
                        <div class="card-body">
                            <!-- content -->
                            <div class="flex justify-between items-center">
                                <h4>Total Enrollments</h4>
                                <div class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                                    <i data-feather="target"></i>
                                </div>
                            </div>
                            <div class="mt-4 flex flex-col gap-0 text-base">
                                <h2 class="text-xl font-bold"><?= $stats['TotalEnrollments'] ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mx-6 grid grid-cols-1 xl:grid-cols-3 grid-rows-1 grid-flow-row-dense gap-6">
                    <div class="xl:col-span-2">
                        <div class="card h-full shadow">
                            <!-- heading -->
                            <div class="border-b border-gray-300 px-5 py-4">
                                <h4>Courses List</h4>
                            </div>

                            <div class="relative overflow-x-auto">
                                <!-- table -->
                                <table class="text-left w-full whitespace-nowrap">
                                    <thead class="text-gray-700">
                                        <tr>
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Course name</th>
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Enrolled Students</th>
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Category</th>
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Tags</th>
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Teacher</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stats['CoursesWithtTotalEnrollments'] as $course) : ?>
                                            <tr>
                                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                    <div class="flex items-center">
                                                        <img src="./assets/images/svg/brand-logo-1.svg" alt="" class="h-6 w-6" />

                                                        <h5 class="mb-1 ml-4"><?= $course['title'] ?></h5>
                                                    </div>
                                                </td>
                                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left"><?= $course['Enrollments'] ?></td>
                                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                    <span class="bg-yellow-200 px-2 py-1 text-yellow-700 text-sm font-medium rounded-full inline-block whitespace-nowrap text-center"> <?= $course['categoryName'] ?> </span>
                                                </td>
                                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                    <div class="-space-x-5">
                                                        <?= $course['tags'] ?>
                                                    </div>
                                                </td>
                                                <td class="border-b border-gray-300 py-3 px-6 pe-6 text-left">
                                                    <?= $course['fullName'] ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Pie chart -->
                    <div class="card h-full shadow items-center w-full">
                        <div class="border-b border-gray-300 px-5 py-4 flex justify-between items-center">
                            <h4>Platform Statistics</h4>
                        </div>
                        <!-- card body -->
                        <div class="card-body items-center">
                            <canvas id="enrollmentPieChart" width="300" height="300"></canvas>
                        </div>
                    </div>
                </div>

                <div class="mx-6 my-6 grid grid-cols-1 lg:grid-cols-2 grid-rows-1 grid-flow-row-dense gap-6">
                    <div>
                        <div class="card h-full shadow">
                            <div class="border-b border-gray-300 px-5 py-4 flex items-center w-full justify-between">
                                <!-- title -->
                                <div>
                                    <h4>Pending Approvals</h4>
                                </div>
                            </div>

                            <div class="relative overflow-x-auto">
                                <!-- table -->
                                <table class="text-left w-full whitespace-nowrap">
                                    <thead class="text-gray-700">
                                        <tr>
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Teacher</th>
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Course</th>
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($stats['PendingCourses'])) : ?>
                                            <?php foreach ($stats['PendingCourses'] as $pendingCourse) :  ?>
                                                <tr>
                                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                        <div class="flex items-center">
                                                            <input
                                                                class="w-4 h-4 text-indigo-600 bg-white border-gray-300 rounded focus:ring-indigo-600 focus:outline-none focus:ring-2"
                                                                type=""
                                                                id="checkboxOne" />
                                                            <label for="checkboxOne" class="text-base ml-2 text-slate-600"><?= $pendingCourse['fullName'] ?></label>
                                                        </div>
                                                    </td>
                                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left"><?= $pendingCourse['title'] ?></td>
                                                    <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                        <span class="bg-green-100 px-2 py-1 text-green-700 text-sm font-medium rounded-md"><?= $pendingCourse['status'] ?></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3" class="border-b border-gray-300 font-medium py-3 px-6 text-center">
                                                    No courses pending approval
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    <div class="card h-full shadow">
                        <div class="border-b border-gray-300 px-5 py-4">
                            <h4>Top Teacher</h4>
                        </div>
                        <div class="relative overflow-x-auto" data-simplebar="" style="max-height: 380px">
                            <!-- table -->
                            <table class="text-left w-full whitespace-nowrap">
                                <thead class="text-gray-700">
                                    <tr>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Name</th>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Total Courses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($stats['TopTeachers'])) : ?>
                                        <?php foreach ($stats['TopTeachers'] as $teacher) : ?>
                                            <tr>
                                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                    <div class="flex items-center">
                                                        <div>
                                                            <a href="#!" class="h-10 w-10 inline-block"><img src="assets/images/avatar/avatar-2.jpg" alt="Image" class="rounded-full" /></a>
                                                        </div>
                                                        <div class="ml-3 leading-4">
                                                            <h5 class="mb-1"><a href="#!"><?= $teacher['fullName'] ?></a></h5>
                                                            <p class="mb-0 text-gray-500"><?= $teacher['email'] ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                    <?= $teacher['TotalCourses'] ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="2" class="border-b border-gray-300 font-medium py-3 px-6 text-center">
                                                No teachers found
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <?php include "../components/footer.php"; ?> -->
            </div>
        </div>
        <!-- end of project -->

    </main>
    <?php include "../components/scripts.php"; ?>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const canvas = document.getElementById('enrollmentPieChart');
        if (canvas) {
            const ctx = canvas.getContext('2d');


            const enrollmentPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Web Development', 'Data Science', 'Design'],
                    datasets: [{
                        label: 'Enrollments by Category',
                        data: [45, 30, 25],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed + '%';
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        } else {
            console.error('Canvas element for chart not found.');
        }
    </script>


    <script src="../../public/assets/js/index.js"></script>
</body>

</html>