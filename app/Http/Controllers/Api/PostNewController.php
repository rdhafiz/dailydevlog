<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\PostService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostNewController extends Controller
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
            'status' => 'nullable|string',
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
                'status' => $request->status ?? '',
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
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        if($data['status'] === 'published'){
            $data['published_at'] = Carbon::now();
        }
        if(!empty($data['content'])){
            $htmlDom = new \DOMDocument();
            @$htmlDom->loadHTML($data['content']);
            $imageTags = $htmlDom->getElementsByTagName('img');
            if (count($imageTags) > 0) {
                foreach ($imageTags as $imageTag) {
                    $imgSrc = $imageTag->getAttribute('src');
                    if (strpos($imgSrc, ';base64')) {
                        $imgdata = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgSrc));
                        $attachment = uniqid() . time() . '.png';
                        Storage::disk('public')->put('/media/image/' . $attachment, $imgdata);
                        $_jstUp = '[APP_URL]/storage/media/image/' . $attachment.'?optimize=0';
                        $data['content'] = str_replace($imgSrc, $_jstUp, $data['content']);
                    }
                }
            }
        }
        $data['meta_title'] = trim($data['title']);
        $data['meta_description'] = trim($data['content']);
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
        if($data['status'] === 'published' && $post['status'] !== 'published'){
            $data['published_at'] = Carbon::now();
        } else if($data['status'] !== 'published' && $post['status'] == 'published'){
            $data['published_at'] = null;
        }
        if(!empty($data['content'])){
            $htmlDom = new \DOMDocument();
            @$htmlDom->loadHTML($data['content']);
            $imageTags = $htmlDom->getElementsByTagName('img');
            if (count($imageTags) > 0) {
                foreach ($imageTags as $imageTag) {
                    $imgSrc = $imageTag->getAttribute('src');
                    if (strpos($imgSrc, ';base64')) {
                        $imgdata = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgSrc));
                        $attachment = uniqid() . time() . '.png';
                        Storage::disk('public')->put('/media/image/' . $attachment, $imgdata);
                        $_jstUp = '[APP_URL]/storage/media/image/' . $attachment.'?optimize=0';
                        $data['content'] = str_replace($imgSrc, $_jstUp, $data['content']);
                    }
                }
            }
        }
        $data['meta_title'] = trim($data['title']);
        $data['meta_description'] = trim($data['content']);
        $post = $this->postService->updatePost($post, $data);

        return response()->json($post, 200);
    }

    public function destroy($id): JsonResponse
    {
        $post = $this->postService->getPostById($id);

        if (!$post) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $this->postService->deletePost($post);

        return response()->json(['message' => 'Blog has been deleted successfully'], 200);
    }



    public function views_increment(Request $request, $id)
    {
        $post = Post::find($id);
        $post->views_count = $post->views_count + 1;
        $post->save();
        return response()->json(['message' => 'Blog fetched successfully', 'data' => $post]);
    }
}