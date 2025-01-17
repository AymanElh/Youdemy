
    <!-- add modal -->
    <div id="categoryModal" class="fixed top-0 hidden">
        <!-- Background Overlay -->
        <div class="fixed inset-0 bg-black opacity-50"></div>

        <!-- Modal Content -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md">
                <!-- Modal Header -->
                <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                    <h3 id="modalTitle" class="text-lg font-medium text-gray-900">Add New Category</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <form id="categoryForm" action="" method="POST">
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <label for="categoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
                                <input type="text"
                                    id="categoryName"
                                    name="category-name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Enter category name"
                                    required>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button"
                                onclick="closeModal()"
                                class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit" name="action" value="add"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                                Add Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editCategoryModal" class="fixed top-0 hidden">
        <!-- Background Overlay -->
        <div class="fixed inset-0 bg-black opacity-50"></div>

        <!-- Modal Content -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md">
                <!-- Modal Header -->
                <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Edit Category</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <form id="editCategoryForm" action="" method="POST">
                    <div class="p-6">
                        <input type="hidden" id="editCategoryId" name="category-id" />
                        <div class="space-y-4">
                            <div>
                                <label for="editCategoryName" class="block text-sm font-medium text-gray-700">Category Name</label>
                                <input type="text"
                                    id="editCategoryName"
                                    name="category-name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    placeholder="Enter category name"
                                    required>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button"
                                onclick="closeEditModal()"
                                class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit" name="action" value="edit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete modal -->
    <div id="deleteCategoryModal" class="fixed top-0 hidden">
        <!-- Background Overlay -->
        <div class="fixed inset-0 bg-black opacity-50"></div>

        <!-- Modal Content -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="relative bg-white rounded-lg shadow-xl w-full max-w-md">
                <!-- Modal Header -->
                <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Delete Category</h3>
                    <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <form id="deleteCategoryForm" action="" method="POST">
                    <div class="p-6">
                        <!-- Hidden input for Category ID -->
                        <input type="hidden" id="deleteCategoryId" name="category-id" />

                        <p class="text-gray-700 text-sm">
                            Are you sure you want to delete this category? This action cannot be undone.
                        </p>

                        <!-- Modal Footer -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button"
                                onclick="closeDeleteModal()"
                                class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit" name="action" value="delete"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300">
                                Yes, Delete
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
