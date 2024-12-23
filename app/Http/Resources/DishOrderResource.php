<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DishOrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'dish_id' => $this->dish_id,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total_price' => $this->total_price,
            'modifiers' => ModifierOrderResource::collection($this->modifiers), // Вложенные модификаторы
        ];
    }
}
