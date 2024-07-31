<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostCategory;

class PostService
{
    public function createPost(array $data)
    {

        $post = Post::create($data);
        $category_ids_array = explode(',', $data['category_ids']);
        $data['category_ids'] = $category_ids_array;
            if(count($data['category_ids']) > 0){
                foreach ($data['category_ids'] as $each){
                    $postCategoryData = [
                        'post_id' => $post->id,
                        'category_id' => $each ?? null,
                    ];
                    self::createPostCategories($postCategoryData);
                }
            }


        return $post;
    }

    public function createPostCategories(array $data)
    {
        return PostCategory::create($data);
    }

    public function updatePost(Post $post, array $data)
    {
        $post->update($data);
        $category_ids_array = explode(',', $data['category_ids']);
        $data['category_ids'] = $category_ids_array;
        PostCategory::whereIn('post_id', [$post['id']])->delete();
//        $post_categories = PostCategory::where('')
        if(count($data['category_ids']) > 0){
            foreach ($data['category_ids'] as $each){
                $postCategoryData = [
                    'post_id' => $post->id,
                    'category_id' => $each ?? null,
                ];
                self::createPostCategories($postCategoryData);
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
                $q->orWhere('content', 'LIKE', '%'.$filter['keyword'].'%');
            });
        }
        return $rv->paginate($filter['limit']);

    }

    public function getPostById($id)
    {
        return Post::with('author')->findOrFail($id);
    }
}
