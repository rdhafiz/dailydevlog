<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Tag;

class TagService
{
    public function createTag(array $data)
    {
        return Tag::create($data);
    }

    public function updateTag(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }

    public function deleteTag(Post $slide)
    {
        $slide->delete();
    }

    public function getAllTag(array $filter)
    {
        $rv = Tag::orderBy($filter['orderBy'], $filter['order']);
        if (!empty($filter['keyword'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('title', 'LIKE', '%'.$filter['keyword'].'%');
            });
        }
        return $rv->paginate($filter['limit']);

    }

    public function getTagById($id)
    {
        return Tag::findOrFail($id);
    }
}
