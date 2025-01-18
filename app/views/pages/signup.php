<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../config/error_config.php';

use App\Controllers\Auth\Auth;
use App\Classes\BaseModel;

$baseModel = new BaseModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {

    $data = [
        "fullName" => $_POST['fullName'],
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "confirmPassword" => $_POST['confirm-password'],
        "role" => 'student'
    ];

    // $data = [
    //     "fullName" => 'ayman',
    //     "username" => 'aymanelh',
    //     "email" => "aymanelh@gmail.com",
    //     "password" => "123456",
    //     "confirmPassword" => "123456",
    //     "role" => 'student'
    // ];

    $authentication = new Auth();
    $result = $authentication->singup($data);
    if (!$result) {
        throw new \Exception("invalide singup");
    } else if ($result === "signup success") {
        echo "user inserted successfuly";
        header("Location: ../../public/index.php");
        exit;
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="Sign Up - TailwindCSS HTML Admin Template Free - Dash UI" />
    <title>Sign Up - TailwindCSS HTML Admin Template Free - Dash UI</title>
    <link rel="stylesheet" href="../../public/assets/css/theme.css" />
</head>

<body>
    <!-- start signup page -->
    <div class="flex flex-col items-center justify-center g-0 h-screen px-4">
        <!-- card -->
        <div class="justify-center items-center w-full bg-white rounded-md shadow lg:flex md:mt-0 max-w-md xl:p-0">
            <!-- card body -->
            <div class="p-6 w-full sm:p-8 lg:p-8">
                <div class="mb-4">
                    <a href="../../public/index.php">
                        <h1 class="text-indigo-600">Youdemy Signup</h1>
                    </a>
                    <p class="mb-6">Please enter your user information.</p>
                </div>
                <!-- form -->
                <form action="" method="POST">
                    <!-- username -->
                    <div class="lg:flex 2xl:block gap-4">
                        <div class="mb-3">
                            <label for="fullName" class="inline-block mb-2">Full Name</label>
                            <input
                                type="text"
                                id="username"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                                name="fullName"
                                placeholder="Full Name"
                                required="" />
                        </div>
                        <div class="mb-3">
                            <label for="username" class="inline-block mb-2">User Name</label>
                            <input
                                type="text"
                                id="username"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                                name="username"
                                placeholder="User Name"
                                required="" />
                        </div>
                        <!-- email -->
                        <div class="mb-3">
                            <label for="email" class="inline-block mb-2">Email</label>
                            <input
                                type="email"
                                id="email"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                                name="email"
                                placeholder="Email address here"
                                required="" />
                        </div>
                    </div>
                    <!-- password -->
                    <div class="mb-3">
                        <label for="password" class="inline-block mb-2">Password</label>
                        <input
                            type="password"
                            id="password"
                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                            name="password"
                            placeholder="**************"
                            required="" />
                    </div>
                    <!-- password -->
                    <div class="mb-5">
                        <label for="confirm-password" class="inline-block mb-2">Confirm Password</label>
                        <input
                            type="password"
                            id="confirm-password"
                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                            name="confirm-password"
                            placeholder="**************"
                            required="" />
                    </div>
                    <!-- checkbox -->
                    <div class="mb-5">
                        <div class="flex items-start gap-2">
                            <input type="checkbox" class="mr-1 mt-1 w-4 h-4 text-indigo-600 bg-white border-gray-300 rounded focus:ring-indigo-600 focus:outline-none focus:ring-2" id="agreeCheck" />
                            <label class="inline-block" for="agreeCheck">
                                <span>
                                    I agree to the
                                    <a href="#!" class="text-indigo-600 hover:text-indigo-600">Terms of Service</a>
                                    and
                                    <a href="#!" class="text-indigo-600 hover:text-indigo-600">Privacy Policy.</a>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <!-- button -->
                        <div class="grid">
                            <button
                                type="submit"
                                name="signup"
                                class="btn bg-indigo-600 text-white border-indigo-600 hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                                Create Free Account
                            </button>
                        </div>
                        <div class="md:flex md:justify-between mt-4">
                            <div class="mb-2 mb-md-0">
                                Already member?
                                <a href="login.php" class="text-indigo-600 hover:text-indigo-600">Login</a>
                            </div>
                            <div>
                                <a href="forget-password.html" class="text-indigo-600 hover:text-indigo-600">Forgot your password?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of signup page -->
    <?php include('../partials/scripts.php'); ?>
</body>

</html>