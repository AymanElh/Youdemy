<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Classes\User;
use App\Classes\Session;
use App\Classes\BaseModel;
use App\Controllers\Auth\Auth;
new BaseModel;

Session::start();

if(!Session::exists('user')) {
    throw new Exception("You have logged in");
}

$email = Session::get('user')[0]['email'];


$user = User::getUser($email);

Auth::checkAccess(['student']);

?>


<!DOCTYPE html>
<html>

<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">


    <!-- navigation bar -->

    <?php include '../components/navbar.php' ?>
    <div class="min-h-screen p-6">
        <!-- Profile Container -->
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">

            <!-- Cover Image and Profile Picture Section -->
            <div class="relative h-48 bg-gradient-to-r from-blue-500 to-indigo-600">
                <div class="absolute -bottom-10 left-8">
                    <div class="relative">
                        <img src="/api/placeholder/120/120" alt="Profile Picture"
                            class="w-32 h-32 rounded-full border-4 border-white object-cover" />
                        <div class="absolute bottom-2 right-2 bg-green-500 w-4 h-4 rounded-full border-2 border-white"></div>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="pt-16 px-8 pb-8">
                <!-- Header Section -->
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900"><?= $user[0]['fullName'] ?></h1>
                        <p class="text-gray-600">Senior Software Developer</p>
                    </div>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Update Profile
                    </button>
                </div>

                <!-- Contact Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase">Contact Information</h3>
                            <div class="mt-2 space-y-2">
                                <p class="flex items-center text-gray-600">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <?= $user[0]['email']; ?>
                                </p>
                            </div>
                        </div>
                    </div>


                <!-- Skills Section -->
                <div class="mt-8">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-4">Skills</h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">JavaScript</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">React</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Node.js</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Python</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Docker</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">AWS</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>