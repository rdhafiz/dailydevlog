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

    public function updateCategory(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }

    public function deleteCategory(Post $slide)
    {
        $slide->delete();
    }

    public function getAllCategory(array $filter)
    {
        $rv = Category::orderBy($filter['orderBy'], $filter['order']);
        if (!empty($filter['keyword'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('title', 'LIKE', '%'.$filter['keyword'].'%');
                $q->orWhere('content', 'LIKE', '%'.$filter['keyword'].'%');
            });
        }
        return $rv->paginate($filter['limit']);

    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }
}
