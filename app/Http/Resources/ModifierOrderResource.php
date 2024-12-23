<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModifierOrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_item_id' => $this->order_item_id,
            'modifier_id' => $this->modifier_id,
            'name' => $this->name,
            'price' => $this->price,
        ];
    }
}
