<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;

class CategoryService
{
    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
    }

    public function getAllCategory(array $filter)
    {
        $rv = Category::orderBy($filter['orderBy'], $filter['order']);
        if (!empty($filter['keyword'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('name', 'LIKE', '%'.$filter['keyword'].'%');
            });
        }
        return $rv->paginate($filter['limit']);

    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }
}
