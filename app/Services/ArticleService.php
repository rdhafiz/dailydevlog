<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    public function createArticle(array $data)
    {
        return Article::create($data);
    }

    public function updateArticle(Article $article, array $data)
    {
        $article->update($data);
        return $article;
    }

    public function deleteArticle(Article $slide)
    {
        $slide->delete();
    }

    public function getAllArticle(array $filter)
    {
        $rv = Article::with('author')->orderBy($filter['orderBy'], $filter['order']);
        if (!empty($filter['keyword'])) {
            $rv->where(function($q) use ($filter) {
                $q->where('title', 'LIKE', '%'.$filter['keyword'].'%');
                $q->orWhere('content', 'LIKE', '%'.$filter['keyword'].'%');
            });
        }
        return $rv->paginate($filter['limit']);

    }

    public function getArticleById($id)
    {
        return Article::findOrFail($id);
    }
}
