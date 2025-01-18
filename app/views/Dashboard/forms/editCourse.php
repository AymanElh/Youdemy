<?php

require_once __DIR__ . '/../../../../vendor/autoload.php';

use App\Classes\Course;
use App\Classes\BaseModel;
use App\Classes\Category;
use App\Controllers\TagController;
use App\Controllers\CategoryController;
use App\Controllers\CourseController;

new BaseModel;

// Fetch the course ID from the query parameter or set a default
$courseId = (int)$_GET['courseId'] ?? null;

// Initialize Tag and Category Controllers
$tagContr = new TagController;
$categoryContr = new CategoryController;

$tags = $tagContr->getAllTags();
$categories = $categoryContr->getAllCategories();

// Retrieve the course using the static method
$course = $courseId ? Course::getCourseById($courseId) : null;

// If the course is not found, redirect or show an error
if (!$course) {
    die('Course not found');
}

(new CourseController)->updateCourse($courseId);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <link rel="stylesheet" href="../../../public/assets/css/theme.css" />

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #edit-course {
            width: 70%;
        }
    </style>
</head>

<body>

    <div id="edit-course" class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Course</h2>

        <form method="POST" class="space-y-6">
            <!-- Hidden Input for Course ID -->
            <input type="hidden" name="course_id" value="<?= htmlspecialchars($course->getId()) ?>">

            <!-- Course Title -->
            <div class="mb-3">
                <label for="title" class="mb-2 block text-gray-800">Course Title</label>
                <input
                    type="text"
                    id="courseTitle"
                    name="title"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                    placeholder="Enter course title"
                    value="<?= htmlspecialchars($course->getTitle()) ?>" required />
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="mb-2 block text-gray-800">Description</label>
                <textarea
                    id="description"
                    rows="4"
                    name="description"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                    placeholder="Enter course description" required><?= htmlspecialchars($course->getDescription()) ?></textarea>
            </div>


            <!-- Content Type -->
            <div class="mb-3">
                <label for="type" class="mb-2 block text-gray-800">Content Type</label>
                <select
                    id="type"
                    name="courseType"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                    onchange="toggleContentType()" required>
                    <option value="video" <?= $course->getContent() ? 'selected' : '' ?>>Video</option>
                    <option value="document" <?= !$course->getContent() ? 'selected' : '' ?>>Document</option>
                </select>
            </div>

            <!-- Video Input -->
            <div id="video-input" class="mb-3" style="display: <?= $course->getContent() ? 'block' : 'none' ?>;">
                <label for="video" class="mb-2 block text-gray-800">Video URL</label>
                <input
                    type="text"
                    id="video"
                    name="video"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                    placeholder="Enter video URL"
                    value="<?= htmlspecialchars($course->getContent()) ?>">
            </div>

            <!-- Document Input -->
            <div id="document-input" class="mb-3" style="display: <?= !$course->getContent() ? 'block' : 'none' ?>;">
                <label for="document" class="mb-2 block text-gray-800">Document Content</label>
                <textarea
                    id="document"
                    name="document"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                    placeholder="Enter document content"><?= htmlspecialchars(!$course->getContent() ? $course->getContent() : '') ?></textarea>
            </div>


            <!-- Category -->
            <div class="mb-3">
                <label for="category" class="mb-2 block text-gray-800">Category</label>
                <select
                    id="category"
                    name="categoryId"
                    class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3" required>
                    <option value="">Select category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>" <?= $course->getCategoryId() == $category['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tags -->
            <div class="mb-3">
                <label for="tags" class="mb-2 block text-gray-800">Tags</label>
                <?php foreach ($tags as $tag) : ?>
                    <div class="flex">
                        <input
                            type="checkbox"
                            name="tags[]"
                            value="<?= $tag['id'] ?>"
                            class="w-4 h-4 text-indigo-600 bg-white border-gray-300 rounded focus:ring-indigo-600 focus:outline-none focus:ring-2"
                            <?= in_array($tag['id'], $course->getTags()) ? 'checked' : '' ?>>
                        <label class="text-gray-500 ms-3"><?= htmlspecialchars($tag['name']) ?></label>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <button
                    name="update-course"
                    type="submit"
                    class="w-full bg-indigo-600 text-white rounded px-4 py-2 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Update Course
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleContentType() {
            const type = document.getElementById('type').value;
            document.getElementById('video-input').style.display = type === 'video' ? 'block' : 'none';
            document.getElementById('document-input').style.display = type === 'document' ? 'block' : 'none';
        }
    </script>

</body>

</html>