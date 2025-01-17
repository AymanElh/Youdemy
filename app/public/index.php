<?php

require_once __DIR__ . '/../../vendor/autoload.php';


use App\Config\Database;


$db = Database::connect();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn Hub - Online Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold text-blue-600">Youdemy</a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <input type="text" placeholder="Search courses..." class="px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <a href="#" class="text-gray-600 hover:text-blue-600">Categories</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">My Courses</a>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Sign In</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 py-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Learn Without Limits</h1>
                <p class="text-xl mb-8">Access thousands of courses from expert instructors worldwide</p>
                <button class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">
                    Start Learning
                </button>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold mb-8">Top Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-lg transition">
                <div class="text-4xl mb-4">💻</div>
                <h3 class="font-semibold">Programming</h3>
                <p class="text-gray-600">500+ Courses</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-lg transition">
                <div class="text-4xl mb-4">📊</div>
                <h3 class="font-semibold">Business</h3>
                <p class="text-gray-600">300+ Courses</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-lg transition">
                <div class="text-4xl mb-4">🎨</div>
                <h3 class="font-semibold">Design</h3>
                <p class="text-gray-600">200+ Courses</p>
            </div>
            <div class="bg-gray-50 p-6 rounded-lg text-center hover:shadow-lg transition">
                <div class="text-4xl mb-4">📱</div>
                <h3 class="font-semibold">Marketing</h3>
                <p class="text-gray-600">400+ Courses</p>
            </div>
        </div>
    </div>

    <!-- Featured Courses -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8">Featured Courses</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Course Card 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full object-cover">
                    <div class="p-6">
                        <div class="text-sm text-blue-600 mb-2">Programming</div>
                        <h3 class="text-xl font-semibold mb-2">Complete PHP OOP Course 2024</h3>
                        <p class="text-gray-600 mb-4">Learn object-oriented programming with PHP from scratch</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-800 font-bold">$49.99</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Enroll Now
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full object-cover">
                    <div class="p-6">
                        <div class="text-sm text-blue-600 mb-2">Web Development</div>
                        <h3 class="text-xl font-semibold mb-2">MySQL Database Mastery</h3>
                        <p class="text-gray-600 mb-4">Master MySQL database design and optimization</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-800 font-bold">$39.99</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Enroll Now
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Course Card 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                    <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full object-cover">
                    <div class="p-6">
                        <div class="text-sm text-blue-600 mb-2">Web Design</div>
                        <h3 class="text-xl font-semibold mb-2">Tailwind CSS Masterclass</h3>
                        <p class="text-gray-600 mb-4">Build modern responsive websites with Tailwind CSS</p>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-800 font-bold">$29.99</span>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Enroll Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-blue-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Start Teaching Today</h2>
            <p class="text-xl mb-8">Share your knowledge and earn money by creating online courses</p>
            <button class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100">
                Become an Instructor
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">LearnHub</h3>
                    <p class="text-gray-400">Empower yourself with quality online education</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Development</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Business</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Design</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Newsletter</h3>
                    <p class="text-gray-400 mb-4">Subscribe for updates</p>
                    <input type="email" placeholder="Enter your email" class="w-full px-4 py-2 rounded-lg text-gray-800">
                </div>
            </div>
        </div>
    </footer>
</body>
</html>