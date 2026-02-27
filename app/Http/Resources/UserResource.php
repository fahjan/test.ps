<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\ManagerResource;
use App\Http\Resources\TrainerResource;
use App\Http\Resources\StudentResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'mobile' => $this->mobile,
            'name' => $this->name,
            'id_number' => $this->id_number,
            // Generate API token here (e.g., using Laravel Sanctum)
            'token' => $this->createToken('api-token')->plainTextToken,
            'students' => StudentResource::collection($this->students),
            'roles' => RoleResource::collection($this->roles),
            'managers' => ManagerResource::collection($this->managers),
            'trainers' => TrainerResource::collection($this->trainers),
            // 'device_info' => $this->device_info,
        ];
    }
}
