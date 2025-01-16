<?php

require_once __DIR__ . '/../../vendor/autoload.php';


use App\Config\Database;


$db = Database::connect();  

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
        name="description"
        content="Youdemy - Online Learning Platform" />
    <title>Youdemy - Home</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-indigo-600 text-white">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold">Youdemy</a>
            <!-- Navigation -->
            <nav class="space-x-6">
                <a href="#" class="hover:text-indigo-300">Home</a>
                <a href="#" class="hover:text-indigo-300">Courses</a>
                <a href="#" class="hover:text-indigo-300">About</a>
                <a href="#" class="hover:text-indigo-300">Contact</a>
                <a href="#" class="bg-white text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-50">Sign Up</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-indigo-600 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold mb-4">Learn New Skills Online</h1>
            <p class="text-lg mb-8">Join thousands of students and start learning today.</p>
            <form class="flex justify-center">
                <input
                    type="text"
                    placeholder="Search for courses..."
                    class="w-96 px-4 py-3 rounded-l-lg focus:outline-none text-gray-800"
                />
                <button
                    type="submit"
                    class="bg-white text-indigo-600 px-6 py-3 rounded-r-lg hover:bg-indigo-50"
                >
                    Search
                </button>
            </form>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="container mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold text-center mb-8">Featured Courses</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Course Card 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x200" alt="Course Image" class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">FrontEnd Development</h3>
                    <p class="text-gray-600 mb-4">Learn HTML, CSS, and JavaScript to build modern web applications.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-600 font-bold">$49.99</span>
                        <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Enroll Now</a>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x200" alt="Course Image" class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Backend Development</h3>
                    <p class="text-gray-600 mb-4">Master Node.js, Express, and MongoDB to build scalable APIs.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-600 font-bold">$59.99</span>
                        <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Enroll Now</a>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x200" alt="Course Image" class="w-full h-48 object-cover" />
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2">Full Stack Development</h3>
                    <p class="text-gray-600 mb-4">Become a full-stack developer with React, Node.js, and SQL.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-indigo-600 font-bold">$79.99</span>
                        <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Enroll Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-indigo-600 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Start Learning Today</h2>
            <p class="text-lg mb-8">Join thousands of students and advance your career.</p>
            <a href="#" class="bg-white text-indigo-600 px-8 py-3 rounded-lg hover:bg-indigo-50">Get Started</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2023 Youdemy. All rights reserved.</p>
        </div>
    </footer>

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>
</body>

</html>