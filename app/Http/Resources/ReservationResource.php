<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'user' => new UserResource($this->whenLoaded('user')),
      'table' => new TableResource($this->whenLoaded('table')),
      'reservation_date' => $this->reservation_date,
      'start_time' => $this->start_time,
      'end_time' => $this->end_time,
      'phone_number' => $this->phone_number,
      'name' => $this->name,
    ];
  }
}
