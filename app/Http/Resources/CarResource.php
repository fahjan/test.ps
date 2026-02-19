<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'title' => $this->title,
            'car_number' => $this->car_number,
            'renewal_at' => $this->renewal_at,
            'insurance_at' => $this->insurance_at,
            'model_year' => $this->model_year,
            'trainer_id' => $this->trainer_id,
            'school' => new SchoolResource($this->school),
            'vehicletype' => new VehicletypeResource($this->vehicletype),
        ];
    }
}
