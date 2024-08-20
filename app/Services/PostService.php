<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Tag;

class PostService
{
    public function createPost(array $data)
    {

        $post = Post::create($data);
        $tags = explode(',', $data['tags']);
        if($tags> 0){
            foreach ($tags as $each){
                $tagExist = Tag::where('title', $each)->first();
                if($tagExist === null){
                    $tag = [
                        'title' => $each,
                    ];
                    self::createTag($tag);
                }else{
                    $tagExist->update(['count' => $tagExist['count'] + 1]);
                }
            }
        }
        return $post;
    }

    public function createTag(array $data)
    {
        return Tag::create($data);
    }

    public function updatePost(Post $post, array $data)
    {
        $post->update($data);
        $tags = explode(',', $data['tags']);
        if($tags> 0){
            foreach ($tags as $each){
                $tagExist = Tag::where('title', $each)->first();
                if($tagExist === null){
                    $tag = [
                        'title' => $each,
                    ];
                    self::createTag($tag);
                }
            }
        }
        return $post;
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        self::deletePostCategories([$post['id']]);
    }

    public function deletePostCategories(array $ids)
    {
        return PostCategory::whereIn('post_id', $ids)->delete();
    }

    public function getAllPost(array $filter)
    {
        $rv = Post::with('author')->orderBy($filter['orderBy'], $filter['order']);
        if (!empty($filter['keyword'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('title', 'LIKE', '%'.$filter['keyword'].'%');
            });
        }

        if (!empty($filter['status'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('status', $filter['status']);
            });
        }

        if (!empty($filter['is_featured'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('is_featured', $filter['is_featured']);
            });
        }
        return $rv->paginate($filter['limit']);

    }

    public function getPostById($id)
    {
        return Post::with('author')->findOrFail($id);
    }
}
