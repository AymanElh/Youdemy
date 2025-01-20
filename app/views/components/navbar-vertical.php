<?php

define('BASE_URL', "http://localhost/Brief-11%20Youdemy");

require_once __DIR__ . '/../../../vendor/autoload.php';


use App\Classes\Session;

Session::start();

if (Session::exists('user')) {
   $role = Session::get('user')[0]['role'];
} else {
   header("Location: ../../public/index.php");
}
?>

<nav class="navbar-vertical w-64 bg-gray-900 text-gray-100 h-screen fixed left-0 top-0 overflow-y-auto transition-all duration-300">
   <div class="h-screen" data-simplebar>
      <!-- Brand Logo -->
      <div class="px-6 py-8">
         <a class="flex items-center justify-center" href="../Dashboard/dashboard.php">
            <img src="/assets/images/brand/logo/logo.svg" alt="Logo" class="h-8" />
         </a>
      </div>

      <!-- Navigation Menu -->
      <ul class="px-4 space-y-2">
         <!-- Dashboard -->
         <li>
            <a href="../dashboard.php"
               class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200">
               <i class="fas fa-home w-5 h-5"></i>
               <span class="ml-3">Dashboard</span>
            </a>
         </li>

         <!-- Content Management Section -->
         <li class="pt-4">
            <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
               Content Management
            </div>
         </li>

         <!-- Courses -->
         <li x-data="{ open: false }">
            <button @click="open = !open"
               class="flex items-center justify-between w-full px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200">
               <div class="flex items-center">
                  <i class="fas fa-book-open w-5 h-5"></i>
                  <span class="ml-3">Courses</span>
               </div>
               <i class="fas fa-chevron-down w-4 h-4 transition-transform duration-200"
                  :class="{ 'transform rotate-180': open }"></i>
            </button>
            <div x-show="open"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="opacity-0 transform -translate-y-2"
               x-transition:enter-end="opacity-100 transform translate-y-0"
               class="pl-10 pr-4 space-y-1 mt-1">
               <a href="<?= BASE_URL ?>/app/views/Dashboard/pages/courses.php"
                  class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-colors duration-200">
                  View All Courses
               </a>
               <a href="#"
                  class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-colors duration-200">
                  Add Course
               </a>
            </div>
         </li>

         <?php if ($role === 'admin') : ?>
            <!-- Categories -->
            <li x-data="{ open: false }">
               <button @click="open = !open"
                  class="flex items-center justify-between w-full px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200">
                  <div class="flex items-center">
                     <i class="fas fa-folder w-5 h-5"></i>
                     <span class="ml-3">Categories</span>
                  </div>
                  <i class="fas fa-chevron-down w-4 h-4 transition-transform duration-200"
                     :class="{ 'transform rotate-180': open }"></i>
               </button>
               <div x-show="open"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 transform -translate-y-2"
                  x-transition:enter-end="opacity-100 transform translate-y-0"
                  class="pl-10 pr-4 space-y-1 mt-1">
                  <a href="<?= BASE_URL ?>/app/views/Dashboard/pages/categories.php"
                     class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-colors duration-200">
                     View All Categories
                  </a>
               </div>
            </li>

            <!-- Tags -->
            <li x-data="{ open: false }">
               <button @click="open = !open"
                  class="flex items-center justify-between w-full px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200">
                  <div class="flex items-center">
                     <i class="fas fa-tags w-5 h-5"></i>
                     <span class="ml-3">Tags</span>
                  </div>
                  <i class="fas fa-chevron-down w-4 h-4 transition-transform duration-200"
                     :class="{ 'transform rotate-180': open }"></i>
               </button>
               <div x-show="open"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 transform -translate-y-2"
                  x-transition:enter-end="opacity-100 transform translate-y-0"
                  class="pl-10 pr-4 space-y-1 mt-1">
                  <a href="<?= BASE_URL ?>/app/views/Dashboard/pages/tags.php"
                     class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-colors duration-200">
                     View All Tags
                  </a>
               </div>
            </li>

            <!-- Users Management Section -->
            <li class="pt-4">
               <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                  Users Management
               </div>
            </li>

            <!-- Teachers -->
            <li x-data="{ open: false }">
               <button @click="open = !open"
                  class="flex items-center justify-between w-full px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200">
                  <div class="flex items-center">
                     <i class="fas fa-chalkboard-teacher w-5 h-5"></i>
                     <span class="ml-3">Teachers</span>
                  </div>
                  <i class="fas fa-chevron-down w-4 h-4 transition-transform duration-200"
                     :class="{ 'transform rotate-180': open }"></i>
               </button>
               <div x-show="open"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 transform -translate-y-2"
                  x-transition:enter-end="opacity-100 transform translate-y-0"
                  class="pl-10 pr-4 space-y-1 mt-1">
                  <a href="<?= BASE_URL ?>/app/views/Dashboard/pages/teachers.php"
                     class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-colors duration-200">
                     View All Teachers
                  </a>
               </div>
            </li>

            <!-- Students -->
            <li x-data="{ open: false }">
               <button @click="open = !open"
                  class="flex items-center justify-between w-full px-4 py-3 text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200">
                  <div class="flex items-center">
                     <i class="fas fa-user-graduate w-5 h-5"></i>
                     <span class="ml-3">Students</span>
                  </div>
                  <i class="fas fa-chevron-down w-4 h-4 transition-transform duration-200"
                     :class="{ 'transform rotate-180': open }"></i>
               </button>
               <div x-show="open"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 transform -translate-y-2"
                  x-transition:enter-end="opacity-100 transform translate-y-0"
                  class="pl-10 pr-4 space-y-1 mt-1">
                  <a href="<?= BASE_URL ?>/app/views/pages/students.php"
                     class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-colors duration-200">
                     View All Students
                  </a>
               </div>
            </li>
         <?php endif; ?>
      </ul>
   </div>
</nav>