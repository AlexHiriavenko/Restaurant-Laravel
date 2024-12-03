<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\DishServiceInterface;
use App\Http\Resources\DishResource;
use App\Http\Resources\DishWithModifiersResource;
use App\Http\Requests\DishIndexRequest;

class DishController extends Controller
{
    protected DishServiceInterface $dishService;

    public function __construct(DishServiceInterface $dishService)
    {
        $this->dishService = $dishService;
    }

    public function index(DishIndexRequest $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 4);

        $dishes = $this->dishService->getDishesWithPagination($search, $perPage);

        return DishResource::collection($dishes);
    }

    public function show(int $id)
    {
        $dish = $this->dishService->findById($id);
        return new DishWithModifiersResource($dish);
    }

    public function getByCategory(int $id)
    {
        $dishes = $this->dishService->getByCategory($id);
        return DishResource::collection($dishes)->resolve();
    }

    public function getByDiscount()
    {
        $dishes = $this->dishService->getByDiscount();
        return DishResource::collection($dishes)->resolve();
    }

    public function findBySlug(string $slug)
    {
        $dish = $this->dishService->findBySlug($slug);
        return new DishWithModifiersResource($dish);
    }
}
