<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
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
            'created_at' => $this->created_at,
            'finished_at' => $this->finished_at,
            'application' => $this->application,
            'student_id' => $this->student_id,
            'grade' => (float) $this->grade,
            'questions_count' => $this->questions_count,
        ];
    }
}
