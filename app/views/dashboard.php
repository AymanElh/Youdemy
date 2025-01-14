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
    <?php include './partials/head.php' ?>
    <link rel="stylesheet" href="../../node_modules/apexcharts/dist/apexcharts.css" />
    <link rel="stylesheet" href="../public/assets/css/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>Youdemy </title>
</head>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include './partials/navbar-vertical.php'; ?>
            <!-- app layout content -->
            <div id="app-layout-content" class="min-h-screen w-full min-w-[100vw] md:min-w-0 ml-[15.625rem] [transition:margin_0.25s_ease-out]">
                <?php include './partials/top-navbar.php'; ?>

                <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                    <!-- title -->
                    <h1 class="text-xl text-white">Courses</h1>
                    <a
                        href="#"
                        class="btn bg-white text-gray-800 border-gray-600 hover:bg-gray-100 hover:text-gray-800 hover:border-gray-200 active:bg-gray-100 active:text-gray-800 active:border-gray-200 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                        Create New Course
                    </a>
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
                                <h2 class="text-xl font-bold">18</h2>
                                <div>
                                    <span>2</span>
                                    <span class="text-gray-500">Completed</span>
                                </div>
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
                                <h2 class="text-xl font-bold">132</h2>
                                <div>
                                    <span>28</span>
                                    <span class="text-gray-500">Completed</span>
                                </div>
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
                                <h2 class="text-xl font-bold">12</h2>
                                <div>
                                    <span>1</span>
                                    <span class="text-gray-500">Completed</span>
                                </div>
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
                                <h2 class="text-xl font-bold">20</h2>
                                <div>
                                    <span class="text-green-600">5%</span>
                                    <span class="text-gray-500">Completed</span>
                                </div>
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
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Tags</th>
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Teacher</th>
                                            <th scope="col" class="border-b bg-gray-100 px-6 py-3">Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                <div class="flex items-center">
                                                    <img src="./assets/images/svg/brand-logo-1.svg" alt="" class="h-6 w-6" />

                                                    <h5 class="mb-1 ml-4"><a href="#!">FrontEnd Development</a></h5>
                                                </div>
                                            </td>
                                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">34</td>
                                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                <span class="bg-yellow-200 px-2 py-1 text-yellow-700 text-sm font-medium rounded-full inline-block whitespace-nowrap text-center">Medium</span>
                                            </td>
                                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                <div class="-space-x-5">
                                                    <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2" src="./assets/images/avatar/avatar-1.jpg" alt="Profile image" />
                                                    <img class="relative inline-block object-cover w-8 h-8 rounded-full border-white border-2" src="./assets/images/avatar/avatar-2.jpg" alt="Profile image" />
                                                    <img class="relative inline-block object-cover w-8 h-8 border-2 rounded-full border-white" src="./assets/images/avatar/avatar-1.jpg" alt="Profile image" />
                                                    <div class="relative w-8 h-8 bg-indigo-600 rounded-full inline-flex items-center justify-center text-white text-sm border-2 border-white">2+</div>
                                                </div>
                                            </td>
                                            <td class="border-b border-gray-300 py-3 px-6 pe-6 text-left">
                                                <div class="flex items-center gap-2">
                                                    <div>15%</div>
                                                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                                                        <div class="bg-indigo-600 h-1.5 rounded-full" style="width: 15%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- card pie chart-->
                    <div class="card h-full shadow">
                        <div class="border-b border-gray-300 px-5 py-4 flex justify-between items-center">
                            <h4>Platform Statistics</h4>
                            <!-- dropdown -->
                            <div class="dropdown leading-4">
                                <button class="text-gray-600 p-2 hover:bg-gray-300 rounded-full transition-all" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i data-feather="more-vertical" class="w-4 h-4"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- card body -->
                        <div class="card-body">
                            <div id="perfomanceChart"></div>
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
                                <div>
                                    <!-- button -->
                                    <div class="dropdown leading-4">
                                        <button
                                            class="btn btn-sm gap-x-2 bg-white text-gray-800 border-gray-300 border disabled:opacity-50 disabled:pointer-events-none hover:text-white hover:bg-gray-700 hover:border-gray-700 active:bg-gray-700 active:border-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Add Task
                                        </button>
                                        <!-- list -->
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </div>
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
                                        <tr>
                                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                <div class="flex items-center">
                                                    <input
                                                        class="w-4 h-4 text-indigo-600 bg-white border-gray-300 rounded focus:ring-indigo-600 focus:outline-none focus:ring-2"
                                                        type="checkbox"
                                                        id="checkboxOne" />
                                                    <label for="checkboxOne" class="text-base ml-2 text-slate-600">Ayman Elh</label>
                                                </div>
                                            </td>
                                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">Backend Development</td>
                                            <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                                <span class="bg-green-100 px-2 py-1 text-green-700 text-sm font-medium rounded-md">Approve</span>
                                                <span class="bg-green-100 px-2 py-1 text-green-700 text-sm font-medium rounded-md">Reject</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    <div class="card h-full shadow">
                        <div class="border-b border-gray-300 px-5 py-4">
                            <h4>Teams</h4>
                        </div>
                        <div class="relative overflow-x-auto" data-simplebar="" style="max-height: 380px">
                            <!-- table -->
                            <table class="text-left w-full whitespace-nowrap">
                                <thead class="text-gray-700">
                                    <tr>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Name</th>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Role</th>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Last Activity</th>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <div>
                                                    <a href="#!" class="h-10 w-10 inline-block"><img src="assets/images/avatar/avatar-2.jpg" alt="Image" class="rounded-full" /></a>
                                                </div>
                                                <div class="ml-3 leading-4">
                                                    <h5 class="mb-1"><a href="#!">Anita Parmar</a></h5>
                                                    <p class="mb-0 text-gray-500">anita@example.com</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">Front End Developer</td>
                                        <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">3 May, 2023</td>
                                        <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                            <div class="dropdown leading-4">
                                                <button class="text-gray-600 p-2 hover:bg-gray-300 rounded-full transition-all" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i data-feather="more-vertical" class="w-4 h-4"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <?php include "./partials/footer.php"; ?> -->
            </div>
        </div>
        <!-- end of project -->
    </main>
    <?php include "./partials/scripts.php"; ?>
</body>

</html>