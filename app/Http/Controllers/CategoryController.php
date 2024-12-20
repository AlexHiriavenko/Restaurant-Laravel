<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Показать список категорий.
     */
    public function index(Request $request): JsonResponse|\Illuminate\View\View
    {
        $categories = $this->categoryService->getAllCategories();

        // Если запрос ожидает JSON, возвращаем данные как JSON
        if ($request->expectsJson()) {
            return response()->json(CategoryResource::collection($categories));
        }

        // В противном случае возвращаем Blade-шаблон
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Показать информацию о категории.
     */
    public function show(int $id, Request $request): JsonResponse|\Illuminate\View\View
    {
        $category = $this->categoryService->getCategoryById($id);

        // Если запрос ожидает JSON, возвращаем данные как JSON
        if ($request->expectsJson()) {
            return response()->json(new CategoryResource($category));
        }

        // В противном случае возвращаем Blade-шаблон
        return view('categories.show', ['category' => $category]);
    }
}
