<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'start' => $this->start,
      'end' => $this->end,
      'title' => $this->title,
      'vehicle' => [
        'id' => $this->vehicle->id,
        'plate' => $this->vehicle->plate,
      ],
      'driver' => [
        'id' => $this->driver->id,
        'name' => $this->driver->name,
      ],
      'creator' => [
        'id' => $this->creator->id,
        'name' => $this->creator->name,
      ],
      'status' => $this->status,
      'previous_reservation' => $this->previous_reservation,
    ];
  }
}
