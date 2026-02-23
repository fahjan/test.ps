<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolForAdminResource extends JsonResource
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
            'address' => $this->address,
            'city' => $this->city,
            'cars' => CarResource::collection($this->cars),
            'trainers' => TrainerSimpleResource::collection($this->trainers),
            'managers' => ManagerWithoutSchool::collection($this->managers),
        ];

    }
}
