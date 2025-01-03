<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModifierResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => number_format($this->price, 2),
        ];
    }
}
