<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            "avatar" => $this->avatar ? asset('storage/' . $this->avatar) : null,
            'role' => $this->role->name,
        ];
    }
}
