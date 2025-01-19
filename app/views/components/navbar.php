<?php

define('BASE_URL', "http://localhost/Brief-11%20Youdemy");

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Classes\Session;

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    Session::destroy();
    header("Location: /Brief-11%20Youdemy/app/public/index.php");
    exit;
}

?>

<!-- Navigation -->
<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold text-blue-600">Youdemy</a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <a href="#" class="text-gray-600 hover:text-blue-600">Categories</a>
                <?php if (Session::exists('user')): ?>
                    <?php if (Session::get('user')[0]['role'] === 'student') : ?>
                        <a href="#" class="text-gray-600 hover:text-blue-600">My Courses</a>

                    <?php elseif (Session::get('user')[0]['role'] === 'admin' || Session::get('user')[0]['role'] === 'teacher') : ?>
                        <a href="<?= BASE_URL ?>/app/views/dashboard/dashboard.php" class="text-gray-600 hover:text-blue-600">Dashboard</a>

                    <?php endif; ?>
                    <form action="" method="POST">
                        <button name="logout" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Logout</button>
                    </form>
                <?php else : ?>
                    <a href="<?= BASE_URL ?>/app/views/pages/login.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>