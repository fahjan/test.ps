<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminLessonResource extends JsonResource
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

            'lesson_at' => $this->lesson_at,
            'car' => new CarResource($this->car),
            'student' => new SimpleStudentResource($this->student),
            'creator' => new UserResource($this->creator),
            'school' => new SchoolResource($this->creator),
        ];
    }
}
