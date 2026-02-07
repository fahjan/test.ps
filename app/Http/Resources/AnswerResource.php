<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'exam_id' => $this->exam_id,
            'question_id' => $this->question_id,
            'answer' => $this->answer,
            'is_true' => $this->is_true,
        ];
    }
}
