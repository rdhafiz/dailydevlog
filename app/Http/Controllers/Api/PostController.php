<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
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

            $posts = $this->postService->getAllPost($filter);
            return response()->json($posts, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        if ($post->views_count == 0) {
            $post->views_count = 1;
        } else {
            $post->views_count = $post->views_count + 1;
        }
        $post->save();
        return response()->json($post, 200);
    }

    public function store(PostRequest $request): JsonResponse
    {
//        try {
//            DB::beginTransaction();
//            $data = $request->validated();
//            $data['user_id'] = Auth::id();
//            if($data['status'] === 'published'){
//                $data['published_at'] = Carbon::now();
//            }
//            $post = $this->postService->createPost($data);
//            return response()->json($post, 201);
//            DB::commit();
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return ['status' => 500, 'error' => $e->getMessage()];
//        }
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        if($data['status'] === 'published'){
            $data['published_at'] = Carbon::now();
        }
        $post = $this->postService->createPost($data);
        return response()->json($post, 201);
    }

    public function update(PostRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $post = $this->postService->getPostById($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
        $post = $this->postService->updatePost($post, $data);

        return response()->json($post, 200);
    }

    public function destroy($id): JsonResponse
    {
//        try {
//            DB::beginTransaction();
//            DB::commit();
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return ['status' => 500, 'error' => $e->getMessage()];
//        }
        $post = $this->postService->getPostById($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $this->postService->deletePost($post);

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
