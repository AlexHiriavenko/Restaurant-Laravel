<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DishWithModifiersResource extends JsonResource
{
    public function toArray($request)
    {
        // Основные данные блюда
        $dish = (new DishResource($this))->resolve();

        // Добавляем вложенные модификаторы
        $dish['modifiers'] = ModifierResource::collection($this->modifiers)->resolve();

        return $dish;
    }
}
