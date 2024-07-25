<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostCategory;

class PostService
{
    public function createPost(array $data)
    {
        /*This will update tomorrow
        $post = Post::create($data);
            if(count($data['category_ids']) > 0){
                foreach ($data['category_ids'] as $each){
                    $pageSlideData = [
                        'post_id' => $post->id,
                        'category_id' => $each ?? null,
                    ];
                    self::createPostCategories($pageSlideData);
                }
            }
        */

        return Post::create($data);
    }

    public function createPostCategories(array $data)
    {
        return PostCategory::create($data);
    }

    public function updatePost(Post $post, array $data)
    {
        $post->update($data);
        return $post;
    }

    public function deletePost(Post $slide)
    {
        $slide->delete();
    }

    public function getAllPost(array $filter)
    {
        $rv = Post::with('author')->orderBy($filter['orderBy'], $filter['order']);
        if (!empty($filter['keyword'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('title', 'LIKE', '%'.$filter['keyword'].'%');
                $q->orWhere('content', 'LIKE', '%'.$filter['keyword'].'%');
            });
        }
        return $rv->paginate($filter['limit']);

    }

    public function getPostById($id)
    {
        return Post::findOrFail($id);
    }
}
