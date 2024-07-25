<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\categoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private categoryService $categoryService;

    public function __construct(categoryService $categoryService)
    {
        $this->categoryService = $categoryService;
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

            $categories = $this->categoryService->getAllCategory($filter);
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return response()->json($category, 200);
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $category = $this->categoryService->createCategory($data);
        return response()->json($category, 201);
    }

    public function update(CategoryRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $category = $this->categoryService->getCategoryById($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category = $this->categoryService->updateCategory($category, $data);

        return response()->json($category, 200);
    }

    public function destroy($id): JsonResponse
    {
        $category = $this->categoryService->getCategoryById($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category = $this->categoryService->getCategoryById($id);
        $this->categoryService->deleteCategory($category);

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
