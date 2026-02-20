<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SimpleUserResource extends JsonResource
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
            'mobile' => $this->mobile,
            'name' => $this->name,
            'id_number' => $this->id_number,
            // Generate API token here (e.g., using Laravel Sanctum)
            // 'token' => $this->createToken('api-token')->plainTextToken,
            // 'students' => StudentResource::collection($this->students),
            // 'roles' => RoleResource::collection($this->roles),
            // 'managers' => ManagerResource::collection($this->managers),
            // 'trainers' => TrainerResource::collection($this->trainers),
        ];
    }
}
