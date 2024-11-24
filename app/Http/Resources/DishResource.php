<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DishResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'discount_percent' => $this->discount_percent,
            'final_price' => $this->final_price,
            'category' => $this->category->name, // Связь с категорией
            'img' => asset('storage/' . $this->img),
        ];
    }
}
