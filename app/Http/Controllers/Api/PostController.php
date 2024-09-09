<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'is_featured' => 'nullable|integer',
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
                'is_featured' => $request->is_featured ?? '',
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
        $post->save();
        return response()->json($post, 200);
    }

    /**
     * @param array $data
     * @return array
     */
    public function getData(array $data): array
    {
        $data['user_id'] = Auth::id();
        if ($data['status'] === 'published') {
            $data['published_at'] = Carbon::now();
        }
        if (isset($data['tags']) && is_array($data['tags']) && count($data['tags']) > 0) {
            $data['tags'] = implode(', ', $data['tags']);
        }
        if (!empty($data['content'])) {
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
                        $_jstUp = '[APP_URL]/storage/media/image/' . $attachment . '?optimize=0';
                        $data['content'] = str_replace($imgSrc, $_jstUp, $data['content']);
                    }
                }
            }
        }
        dd($data['content']);
        $data['meta_title'] = trim($data['title']);
        $data['meta_description'] = trim($data['content']);
        $data['is_featured'] = isset($data['is_featured']) && $data['is_featured'] == 'on' ? true : false;
        $data['allow_comments'] = isset( $data['allow_comments']) && $data['allow_comments'] == 'on' ? true : false;
        return $data;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'short_description' => 'required|string',
            'content' => 'required|string',
            'tags' => 'required|array',
            'featured_image' => 'nullable|image',
            'status' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'is_featured' => 'nullable',
            'allow_comments' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $this->getData($data);
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('public/media');
            $featured_image = basename($path);
        } else {
            $featured_image = null;
        }
        $data['featured_image'] = $featured_image;
        $post = $this->postService->createPost($data);
        return redirect()->route('user.panel.my.post')->with('success', 'Post has been updated');
    }

    public function update(Request $request, $id)
    {
        $postData = Post::find($id);
        if ($postData == null){
            return redirect()->back()->with('error', 'Post not found.');
        }
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required|string',
            'short_description' => 'required|string',
            'content' => 'required|string',
            'tags' => 'required|array',
            'featured_image' => 'nullable|image',
            'status' => 'required|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'is_featured' => 'nullable',
            'allow_comments' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $postData = Post::find($id);
        if ($postData == null){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $this->getData($data);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('public/media');
            $featured_image = basename($path);
            $data['featured_image'] = $featured_image;
        }
        $post = $this->postService->updatePost($postData, $data); // Assuming a method to update the post
        return redirect()->route('user.panel.my.post')->with(['success', 'Post has been updated']);
    }


    public function destroy($id)
    {
        $post = $this->postService->getPostById($id);

        if (!$post) {
            return redirect()->back()->withErrors(['message' => 'Blog not found']);
        }

        $this->postService->deletePost($post);

        return redirect()->route('user.panel.my.post')->with('success', 'Post has been deleted');
    }
}
