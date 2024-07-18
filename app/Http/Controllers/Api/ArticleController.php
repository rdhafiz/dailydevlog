<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request): JsonResponse
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'limit' => 'nullable|integer',
            'keyword' => 'nullable|string',
            'orderBy' => 'nullable|string',
            'order' => 'nullable|in:asc,desc',
        ]);

        // If validator fails return error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Data sanitization
            $filter = [
                'limit' => $request->limit ?? 20,
                'keyword' => $request->keyword ?? '',
                'orderBy' => $request->orderBy ?? 'id',
                'order' => $request->sort_mode ?? 'asc',
            ];

            $articles = $this->articleService->getAllArticle($filter);
            return response()->json($articles, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function show($id)
    {
        $article = $this->articleService->getArticleById($id);
        return response()->json($article, 200);
    }

    public function store(ArticleRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['author_id'] = Auth::id();
        $article = $this->articleService->createArticle($data);
        return response()->json($article, 201);
    }

    public function update(ArticleRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $article = $this->articleService->getArticleById($id);
        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }
        $article = $this->articleService->updateArticle($article, $data);

        return response()->json($article, 200);
    }

    public function destroy($id): JsonResponse
    {
        $article = $this->articleService->getArticleById($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        $article = $this->articleService->getArticleById($id);
        $this->articleService->deleteArticle($article);

        return response()->json(['message' => 'Article deleted successfully'], 200);
    }
}
