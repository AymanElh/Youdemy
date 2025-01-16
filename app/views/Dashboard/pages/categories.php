<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="Youdemy - Online Learning Platform" />
    <?php include '../partials/head.php'; ?>
    <link rel="stylesheet" href="../../public/assets/css/theme.css" />
    <link rel="stylesheet" href="../../public/assets/css/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>Categories - Youdemy</title>
</head>

<body>
    <main>
        <!-- Start the project -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include '../partials/navbar-vertical.php'; ?>
            <div id="app-layout-content" class="min-h-screen w-full min-w-[100vw] md:min-w-0 ml-[15.625rem] [transition:margin_0.25s_ease-out]">
                <?php include '../partials/top-navbar.php'; ?>

                <!-- Page Header -->
                <div class="bg-indigo-600 px-6 pt-6 pb-8 h-20 flex justify-between items-center mb-8">
                    <h1 class="text-lg text-white">Categories</h1>
                    <nav class="text-white text-sm">
                        <a href="../dashboard.php" class="hover:underline">Dashboard</a> / Categories
                    </nav>
                    <a href="#" class="btn bg-white text-gray-800 border-gray-600 hover:bg-gray-100 hover:text-gray-800 hover:border-gray-200 active:bg-gray-100 active:text-gray-800 active:border-gray-200 focus:outline-none focus:ring-4 focus:ring-indigo-300">Create New Category</a>
                </div>

                <!-- Categories Table -->
                <div class="mx-6 mb-6">
                    <div class="card shadow">
                        <!-- Table Heading -->
                        <div class="border-b border-gray-300 px-5 py-4">
                            <h4>Categories List</h4>
                        </div>

                        <!-- Table -->
                        <div class="relative overflow-x-auto">
                            <table class="text-left w-full whitespace-nowrap border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-300 bg-gray-100">
                                        <th scope="col" class="px-6 py-3 font-medium text-gray-700">#</th>
                                        <th scope="col" class="px-6 py-3 font-medium text-gray-700">Category Name</th>
                                        <th scope="col" class="px-6 py-3 font-medium text-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    <!-- Example Row -->
                                    <tr>
                                        <td class="px-6 py-3">1</td>
                                        <td class="px-6 py-3">Web Development</td>
                                        <td class="px-6 py-3">
                                            <button class="btn btn-sm bg-indigo-500 text-white px-3 py-1 rounded">Edit</button>
                                            <button class="btn btn-sm bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-3">2</td>
                                        <td class="px-6 py-3">Data Science</td>
                                        <td class="px-6 py-3">
                                            <button class="btn btn-sm bg-indigo-500 text-white px-3 py-1 rounded">Edit</button>
                                            <button class="btn btn-sm bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of project -->
    </main>
    <script src="../../public/assets/js/index.js"></script>
</body>

</html>