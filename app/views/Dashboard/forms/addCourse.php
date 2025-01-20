<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Classes\BaseModel;
use App\Controllers\TagController;
use App\Controllers\CategoryController;
use App\Controllers\CourseController;

new BaseModel;

$tagContr = new TagController;
$categoryContr = new CategoryController;

$tags = $tagContr->getAllTags();
$categories = $categoryContr->getAllCategories();

$courseContr = new CourseController;
$courseContr->createCourse();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="../../../public/assets/css/theme.css" />

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">


    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #create-course {
            width: 70%;
        }
    </style>
</head>

<body>

    <div id="create-course" class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Create New Course</h2>

        <form method="POST" class="space-y-6">
            <!-- Course Title -->
            <div class="mb-3">
                <label for="title" class="mb-2 block text-gray-800">Course Title</label>
                <input
                    type="text"
                    id="courseTitle"
                    name="title"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                    placeholder="Enter course title" required />
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="mb-2 block text-gray-800">Description</label>
                <textarea
                    id="description"
                    rows="4"
                    name="description"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                    placeholder="Enter course description" required></textarea>
            </div>

            <!-- Type -->
            <div class="mb-3">
                <label for="type" class="mb-2 block text-gray-800">Type</label>
                <select
                    id="type"
                    name="courseType"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none" required>
                    <option value="seletectype">Select type</option>
                    <option value="video">Video</option>
                    <option value="document">Document</option>
                </select>
            </div>

            <!-- Content (Dynamic based on Type) -->
            <div id="videoContent" class="" style="display: none">
                <label for="videoLink" class="mb-2 block text-gray-800">Video Link</label>
                <input
                    type="url"
                    name="video-content"
                    id="videoLink"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                    placeholder="Enter video URL" />
            </div>

            <!-- <div id="docContent" class="hidden">
                <label for="editor" class="mb-2 block text-gray-800">Document Content</label>
                <div id="editor" class="h-64 mb-4"></div>
                <input type="hidden" id="editorContent" name="doc-content">
            </div> -->

             <!-- Document Content (Hidden Initially) -->
             <div id="docContent" class="" sytle="display: none;">
                <label for="doc-content">Content</label>
                <textarea name="doc-content" id="doc-content"></textarea>
            </div>
            
            <!-- Category -->
            <div class="mb-3">
                <label for="category" class="mb-2 block text-gray-800">Category</label>
                <select
                    id="category"
                    name="categoryId"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none" required>
                    <option value="">Select category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tags -->
            <div class="mb-3">
                <label for="tags" class="mb-2 block text-gray-800">Tags</label>
                <?php foreach ($tags as $tag) : ?>
                    <div class="flex">
                        <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>" class="w-4 h-4 text-indigo-600 bg-white border-gray-300 rounded focus:ring-indigo-600 focus:outline-none focus:ring-2" id="default-checkbox" />
                        <label for="default-checkbox" class="text-gray-500 ms-3 "><?= $tag['name'] ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <button
                    name="create-course"
                    type="submit"
                    class="w-full bg-indigo-600 text-white rounded px-4 py-2 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Create Course
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.min.js"></script>
    <script>
        // const quill = new Quill('#docContent', {
        //     modules: {
        //         toolbar: [
        //             [{
        //                 header: [1, 2, false]
        //             }],
        //             ['bold', 'italic', 'underline'],
        //             ['image', 'code-block'],
        //         ],
        //     },
        //     placeholder: 'Compose an epic...',
        //     theme: 'snow', // or 'bubble'
        // });
                
        // courseType = document.getElementById("type");
        // console.log(courseType);

        document.getElementById("type").addEventListener('change', function() {
            const videoContent = document.getElementById('videoContent');
            const docContent = document.getElementById('docContent');
            console.log(videoContent);
            console.log(docContent);
            
            if(this.value === "video") {
                videoContent.style.display = 'block';
                docContent.style.display = 'none';
            } 
            else if(this.value === "document") {
                videoContent.style.display = 'none';
                docContent.style.display = 'block;'
            } 
            else if(this.value === "seletectype") {
                videoContent.style.display = 'none';
                docContent.style.display = 'none';
            }
            
        });
    </script>