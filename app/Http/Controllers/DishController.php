<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Services\Interfaces\DishServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Services\CategoryService;
use App\Http\Resources\DishResource;
use App\Http\Resources\DishWithModifiersResource;
use App\Http\Requests\DishIndexRequest;
use App\Http\Requests\UpdateDishRequest;
use App\Http\Requests\CreateDishRequest;
use App\Repositories\ModifierRepository;


class DishController extends Controller
{
    protected DishServiceInterface $dishService;
    protected CategoryServiceInterface $categoryService;
    protected ModifierRepository $modifierRepository;

    public function __construct(DishServiceInterface $dishService, CategoryService $categoryService, ModifierRepository $modifierRepository)
    {
        $this->dishService = $dishService;
        $this->categoryService = $categoryService;
        $this->modifierRepository = $modifierRepository;
    }

    public function index(DishIndexRequest $request): JsonResponse|View
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page');

        // Получаем базовый запрос через репозиторий
        $query = $this->dishService->getDishesQuery($search);

        // Возвращаем ответ в зависимости от типа запроса
        if ($request->expectsJson()) {

            /** @var Builder $query */
            $dishes = $query->cursorPaginate($perPage ?? 4);
            return DishResource::collection($dishes)->response();
        }

        /** @var Builder $query */
        $dishes = $query->paginate($perPage ?? 10);
        return view('dishes.index', ['dishes' => $dishes]);
    }

    public function show(int $id, Request $request): JsonResponse|View
    {

        $dish = $this->dishService->findById($id);

        if (!$dish) {
            abort(404, 'Dish not found');
        }

        if ($request->expectsJson()) {
            return (new DishWithModifiersResource($dish))->response();
        }

        $categories = $this->categoryService->getAllCategories();

        return view('dishes.show', compact('dish', 'categories'));
    }

    public function getByCategory(int $id): array|JsonResponse
    {
        $dishes = $this->dishService->getByCategory($id);
        return DishResource::collection($dishes)->resolve();
    }

    public function getByDiscount(): array|JsonResponse
    {
        $dishes = $this->dishService->getByDiscount();
        return DishResource::collection($dishes)->resolve();
    }

    public function findBySlug(string $slug): JsonResponse
    {
        $dish = $this->dishService->findBySlug($slug);
        return (new DishWithModifiersResource($dish))->response();
    }

    public function update(UpdateDishRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        $file = $request->hasFile('img') ? $request->file('img') : null;

        $dish = $this->dishService->updateDish($id, $data, $file);

        return redirect()
            ->route('dishes.show', ['id' => $dish->id])
            ->with('success', 'Dish updated successfully!');
    }

    public function create(): View
    {
        $categories = $this->categoryService->getAllCategories();
        $modifiers = $this->modifierRepository->all();

        return view('dishes.create', compact('categories', 'modifiers'));
    }

    public function store(CreateDishRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $file = $request->file('img') ?? null;
        $modifierIds = $request->input('modifiers', []);

        $dish = $this->dishService->createDish($data, $file, $modifierIds);

        return redirect()
            ->route('dishes.show', ['id' => $dish->id])
            ->with('success', 'Dish created successfully!');
    }
}
