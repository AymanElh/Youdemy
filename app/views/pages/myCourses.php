<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses - Youdemy</title>
    <?php include '../components/head.php' ?>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <?php include '../components/navbar.php' ?>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <h1 class="text-3xl font-bold">Browse My Courses</h1>
            <p class="mt-2">Follow you completed and uncompleted courses</p>
        </div>
    </div>
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">My Courses</h1>

        <!-- In Progress Courses -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-6">In Progress</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Course Card 1 -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <img src="/api/placeholder/400/200" alt="Web Development" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="inline-block bg-blue-100 text-blue-600 px-2 py-1 rounded text-sm mb-2">Web Development</span>
                        <h3 class="text-xl font-semibold mb-2">Introduction to Web Development</h3>
                        <p class="text-gray-600 mb-4">Learn the basics of web development.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                                <span class="ml-2 text-sm text-gray-600">Senior PHP Developer</span>
                            </div>
                            <span class="text-blue-600">45% Complete</span>
                        </div>
                        <div class="mt-4 bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <img src="/api/placeholder/400/200" alt="Data Science" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="inline-block bg-blue-100 text-blue-600 px-2 py-1 rounded text-sm mb-2">Data Science</span>
                        <h3 class="text-xl font-semibold mb-2">Python for Data Science</h3>
                        <p class="text-gray-600 mb-4">An introductory course on Python for Data Science.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                                <span class="ml-2 text-sm text-gray-600">Data Scientist</span>
                            </div>
                            <span class="text-blue-600">30% Complete</span>
                        </div>
                        <div class="mt-4 bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 30%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Completed Courses -->
        <section>
            <h2 class="text-2xl font-semibold mb-6">Completed</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Completed Course Card -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <img src="/api/placeholder/400/200" alt="UI/UX Design" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="inline-block bg-green-100 text-green-600 px-2 py-1 rounded text-sm mb-2">Design</span>
                        <h3 class="text-xl font-semibold mb-2">UI/UX Design Fundamentals</h3>
                        <p class="text-gray-600 mb-4">Learn the basics of UI/UX design.</p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                                <span class="ml-2 text-sm text-gray-600">UX Designer</span>
                            </div>
                            <span class="text-green-600">Completed</span>
                        </div>
                        <div class="mt-4 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full w-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../components/footer.php' ?>
</body>

</html>