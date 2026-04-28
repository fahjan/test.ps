<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResourceWithoutExams extends JsonResource
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
            'exam_type' => $this->exam_type,
            'first_name' => $this->first_name,
            'father_name' => $this->father_name,
            'gfather_name' => $this->gfather_name,
            'family_name' => $this->family_name,
            'name' => $this->first_name . ' ' . $this->father_name . ' ' . $this->gfather_name . ' ' . $this->family_name,
            'license_id' => $this->license_id,
            'license' => $this->license,
            'dateofbirth' => $this->dateofbirth,
            'glasses' => $this->glasses,
            'theoretical_at' => $this->theoretical_at,
            'tested_at' => $this->tested_at,
            'gender' => $this->gender,
            'agreed_amount' => $this->agreed_amount,
            'paid_status' => $this->paid_status,
            'lessons_count' => $this->lessons_count,
            'payments_sum' => $this->payments_sum,
            'is_disabled' => $this->is_disabled,
            'school' => new SchoolResource($this->school),
            'percent' => $this->percent,
            'mobile' => $this->user->mobile,
            // 'exams' => ExamResource::collection($this->exams),
            'code' => $this->user->code,
            'city_id' => $this->city->id,
            'theory_trainer' => new TrainerSimpleResource($this->user->trainer),
            'practical_trainer' => new TrainerSimpleResource($this->user->trainer),
        ];
    }
}
