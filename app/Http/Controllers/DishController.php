<?php

namespace App\Http\Controllers;

use App\Http\Resources\DishResource;
use App\Models\Dish;
use App\Http\Resources\DishWithModifiersResource;
use Illuminate\Http\Request;

class DishController extends Controller
{

    // Загрузка блюд с лейзи лоад и фильтрацией
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string',
            'per_page' => 'nullable|integer|min:1|max:100',
        ]);

        $search = $validated['search'] ?? null;
        $perPage = $validated['per_page'] ?? 4;

        $dishes = Dish::getDishesWithPagination($search, $perPage);

        return DishResource::collection($dishes);
    }

    // example: http://localhost:8080/api/categories/4/dishes
    public function getByCategory($id)
    {
        $dishes = Dish::getByCategory($id);
        return DishResource::collection($dishes)->resolve();
    }


    // example: http://localhost:8080/api/dishes/1
    public function show($id)
    {
        $dish = Dish::getById($id);
        return new DishWithModifiersResource($dish);
    }

    // example: http://localhost:8080/api/dishes/americano
    public function getBySlug($slug)
    {
        $dish = Dish::getBySlug($slug);
        return new DishWithModifiersResource($dish);
    }
}
