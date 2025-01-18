<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

define('BASE_URL', "http://localhost/Brief-11%20Youdemy");

use App\Classes\Session;

Session::start();

if (Session::exists('user')) {
   $role = Session::get('user')[0]['role'];
} else {
   header("Location: ../../public/index.php");
}
?>


<!-- start navbar -->
<nav class="navbar-vertical navbar">
   <div id="myScrollableElement" class="h-screen" data-simplebar>
      <!-- brand logo -->
      <a class="navbar-brand" href="../Dashboard/dashboard.php">
         <img src="/assets/images/brand/logo/logo.svg" alt="" />
      </a>

      <!-- navbar nav -->
      <ul class="navbar-nav flex-col" id="sideNavbar">
         <!-- Dashboard -->
         <li class="nav-item">
            <a class="nav-link" href="../dashboard.php">
               <i data-feather="home" class="w-4 h-4 mr-2"></i>
               Dashboard
            </a>
         </li>

         <!-- Layouts & Pages Heading -->
         <li class="nav-item">
            <div class="navbar-heading">Content Mangment</div>
         </li>

         <!-- Courses -->
         <li class="nav-item" x-data="{ isOpen: false }">
            <a
               class="nav-link"
               href="#!"
               @click.prevent="isOpen = !isOpen"
               :aria-expanded="isOpen">
               <i data-feather="layers" class="w-4 h-4 mr-2"></i>
               Courses
               <span x-show="!isOpen" class="ml-auto">+</span>
               <span x-show="isOpen" class="ml-auto">-</span>
            </a>
            <div
               x-show="isOpen"
               x-collapse
               class="mt-2"
               id="navPages"
               x-cloak>
               <ul class="nav flex-col">
                  <li class="nav-item">
                     <a class="nav-link" href="../Dashboard/pages/courses.php">View All Courses</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#">Add Course</a>
                  </li>
               </ul>
            </div>
         </li>

         <!-- Categories -->
         <?php if ($role === 'admin') : ?>
            <li class="nav-item" x-data="{ isOpen: false }">
               <a
                  class="nav-link"
                  href="#!"
                  @click.prevent="isOpen = !isOpen"
                  :aria-expanded="isOpen">
                  <i data-feather="lock" class="w-4 h-4 mr-2"></i>
                  Categories
                  <span x-show="!isOpen" class="ml-auto">+</span>
                  <span x-show="isOpen" class="ml-auto">-</span>
               </a>
               <div
                  x-show="isOpen"
                  x-collapse
                  class="mt-2"
                  id="navAuthentication"
                  x-cloak>
                  <ul class="nav flex-col">
                     <li class="nav-item">
                        <a class="nav-link" href="../Dashboard/pages/categories.php">View All Categories</a>
                     </li>
                  </ul>
               </div>
            </li>

            <!-- Tags -->
            <li class="nav-item" x-data="{ isOpen: false }">
               <a
                  class="nav-link"
                  href="#!"
                  @click.prevent="isOpen = !isOpen"
                  :aria-expanded="isOpen">
                  <i data-feather="lock" class="w-4 h-4 mr-2"></i>
                  Tags
                  <span x-show="!isOpen" class="ml-auto">+</span>
                  <span x-show="isOpen" class="ml-auto">-</span>
               </a>
               <div
                  x-show="isOpen"
                  x-collapse
                  class="mt-2"
                  id="navAuthentication"
                  x-cloak>
                  <ul class="nav flex-col">
                     <li class="nav-item">
                        <a class="nav-link" href="../Dashboard/pages/tags.php">View All Tags</a>
                     </li>
                  </ul>
               </div>
            </li>

            <!-- Users Managments -->
            <li class="nav-item">
               <div class="navbar-heading">Users Managments</div>
            </li>

            <!-- Teachers -->
            <li class="nav-item" x-data="{ isOpen: false }">
               <a
                  class="nav-link"
                  href="#!"
                  @click.prevent="isOpen = !isOpen"
                  :aria-expanded="isOpen">
                  <i data-feather="package" class="w-4 h-4 mr-2"></i>
                  Teachers
                  <span x-show="!isOpen" class="ml-auto">+</span>
                  <span x-show="isOpen" class="ml-auto">-</span>
               </a>
               <div
                  x-show="isOpen"
                  x-collapse
                  class="mt-2"
                  id="navComponents"
                  x-cloak>
                  <ul class="nav flex-col">
                     <li class="nav-item">
                        <a class="nav-link" href="../Dashboard/pages/teachers.php">View All Teacher</a>
                     </li>

                  </ul>
               </div>
            </li>

         <?php endif; ?>

      </ul>
   </div>
</nav>
<!--end of navbar-->