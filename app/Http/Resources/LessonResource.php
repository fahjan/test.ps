<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'student' => new SimpleStudentResource($this->student),
            'car' => new CarResource($this->car),
            'notes' => $this->notes,
            'lesson_at' => $this->lesson_at,
            'trainer' => new TrainerResource($this->trainer),
        ];
    }
}
