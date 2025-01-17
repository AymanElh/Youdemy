<?php

namespace App\Controllers;

use App\Classes\Category; 
use App\Helpers\Validation; 


class CategoryController
{
    private Category $category;
    public function __construct() 
    {
        $this->category = new Category();
    }

    public function createCategory($data): string
    {

        $name = Validation::sanitizeInput($data['name'] ?? '');


        if (empty($name)) {
            return "Category name is required.";
        }

        if ($this->category->getCategoryId($name) > 0) {
            return "Category with this name already exists.";
        }

        try {
            $categoryId = $this->category->createCategory($name);

            return $categoryId > 0 ? "Category created successfully." : "Error creating category.";
        } catch (\Exception $e) {
            error_log("Error: " . $e->getMessage());
        }
    }

    public function deleteCategory(int $id): string
    {
        if ($id <= 0) {
            return "Invalid category ID.";
        }

        try {
            $this->category->deleteCategory($id);
            return "Category deleted successfully.";
        } catch (\Exception $e) {
            error_log("Error deleting category: " . $e->getMessage());
        }
    }

    public function updateCategory(int $id, array $data): string
    {
        $name = Validation::sanitizeInput($data['name'] ?? '');

        if (empty($name)) {
            return "Category name is required.";
        }

        if ($id <= 0) {
            return "Invalid category ID.";
        }

        try {
            $this->category->updateCategory($id, $name);
            return "Category updated successfully.";
        } catch (\Exception $e) {
            error_log("Error updating category: " . $e->getMessage());
        }
    }

    public function getAllCategories(): array
    {
        try {
            return $this->category->getAllCategories();
        } catch (\Exception $e) {
            error_log("error getting categories: " . $e->getMessage());
            return [];
        }
    }

    public function getTotalCategories(): int
    {
        try {
            return $this->category->getCountCategories();
        } catch (\Exception $e) {
            error_log("error getting total categories: " . $e->getMessage());
            return 0;
        }
    }
}
