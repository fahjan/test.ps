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
            'lesson_at' => $this->lesson_at,
            'created_at' => $this->created_at,
            'notes' => $this->notes,
            'car' => new CarResource($this->car),
            'student' => new SimpleStudentResource($this->student),
            'trainer' => new TrainerResource($this->trainer),
            'creator' => new SimpleUserResource($this->creator),
        ];
    }
}
