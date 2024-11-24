<?php

namespace App\Http\Controllers;

use App\Http\Resources\DishResource;
use App\Models\Dish;
use App\Http\Resources\DishWithModifiersResource;

class DishController extends Controller
{

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
}
