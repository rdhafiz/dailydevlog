<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\TagService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    private TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
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

            $categories = $this->tagService->getAllTag($filter);
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function show($id)
    {
        $tag = $this->tagService->getTagById($id);
        return response()->json($tag, 200);
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $tag = $this->tagService->createTag($data);
        return response()->json($tag, 201);
    }

    public function update(CategoryRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $tag = $this->tagService->getTagById($id);
        if (!$tag) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
        $tag = $this->tagService->updateTag($tag, $data);

        return response()->json($tag, 200);
    }

    public function destroy($id): JsonResponse
    {
        $tag = $this->tagService->getTagById($id);

        if (!$tag) {
            return response()->json(['message' => 'Tag not found'], 404);
        }

        $tag = $this->tagService->getTagById($id);
        $this->tagService->deleteTag($tag);

        return response()->json(['message' => 'Tag deleted successfully'], 200);
    }
}
