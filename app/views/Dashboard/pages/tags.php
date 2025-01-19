<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';
// require_once __DIR__ . '/../../../config/error_config.php';

use App\Classes\BaseModel;
use App\Controllers\TagController;
use App\Controllers\Auth\Auth;

$basemodel = new BaseModel;
$tag = new TagController;

$tags = $tag->getAllTags();
// var_dump($tags);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'add' :
            $result = $tag->addTag(['name' => $_POST['tag-name']]);
            break;

        case 'edit':
            $result = $tag->updateTag($_POST['tag-id'], ['name' => $_POST['tag-name']] ?? '');
            break;
        
        case 'delete' : 
            $result = $tag->deleteTag($_POST['tag-id']);
            break;

        default :
            $result = 'Invalid action';
    }

    header("Location: tags.php?result=" . urlencode($result));
    exit;
}
Auth::checkAccess(['admin']);


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="Youdemy - Online Learning Platform" />
    <?php include '../../components/head.php'; ?>
    <link rel="stylesheet" href="../../../public/assets/css/theme.css" />
    <link rel="stylesheet" href="../../../public/assets/css/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>Tags - Youdemy</title>
    <style>
        /* Custom CSS for modal positioning */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            position: relative;
            background-color: white;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 24rem;
            width: 100%;
            margin: 1.25rem;
        }
    </style>
</head>

<body>
    <main>
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include '../../components/navbar-vertical.php'; ?>
            <div id="app-layout-content" class="min-h-screen w-full min-w-[100vw] md:min-w-0 ml-[15.625rem] [transition:margin_0.25s_ease-out]">
                <?php include '../../components/top-navbar.php'; ?>

                <!-- Page Header -->
                <div class="bg-indigo-600 px-6 pt-6 pb-8 h-20 flex justify-between items-center mb-8">
                    <h1 class="text-lg text-white">Tags</h1>
                    <nav class="text-white text-sm">
                        <a href="../dashboard.php" class="hover:underline">Dashboard</a> / Tags
                    </nav>
                    <button onclick="openCreateTagModal()" class="btn bg-white text-gray-800 border-gray-600 hover:bg-gray-100 hover:text-gray-800 hover:border-gray-200 active:bg-gray-100 active:text-gray-800 active:border-gray-200 focus:outline-none focus:ring-4 focus:ring-indigo-300">Create New Tag</button>
                </div>

                <!-- Tags Table -->
                <div class="mx-6 mb-6">
                    <div class="card shadow">
                        <div class="border-b border-gray-300 px-5 py-4">
                            <h4>Tags List</h4>
                        </div>

                        <div class="relative overflow-x-auto">
                            <table class="text-left w-full whitespace-nowrap border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-300 bg-gray-100">
                                        <th scope="col" class="px-6 py-3 font-medium text-gray-700">#</th>
                                        <th scope="col" class="px-6 py-3 font-medium text-gray-700">Tag Name</th>
                                        <th scope="col" class="px-6 py-3 font-medium text-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    <!-- Example Row -->
                                    <?php
                                    $count = 1;
                                    foreach ($tags as $tag) :
                                    ?>
                                        <tr>
                                            <td class="px-6 py-3"><?= $count++ ?></td>
                                            <td class="px-6 py-3"><?= $tag['name'] ?></td>
                                            <td class="px-6 py-3">
                                                <button onclick="openEditTagModal(<?= $tag['id'] ?>, '<?= $tag['name'] ?>')" class="btn btn-sm bg-indigo-500 text-white px-3 py-1 rounded">Edit</button>
                                                <button onclick="openDeleteTagModal(<?= $tag['id'] ?>)" class="btn btn-sm bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("../../components/modals.php"); ?>
    </main>


    <script src="../../../public/assets/js/main.js"></script>
    <script src="../../../public/assets/js/index.js"></script>
</body>

</html>