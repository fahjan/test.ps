<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SchoolResource;
use App\Http\Resources\TrainereResource;
use App\Http\Resources\ManagerResource;

class SimpleStudentResource extends JsonResource
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
            'exam_type' => $this->exam_type,
            'name' => $this->first_name . ' ' . $this->father_name . ' ' . $this->gfather_name . ' ' . $this->family_name,
            'license_id' => $this->license_id,
            'license' => $this->license,
            'glasses' => $this->glasses,
            'theoretical_at' => $this->theoretical_at,
            'tested_at' => $this->tested_at,
            'gender' => $this->gender,
            'agreed_amount' => (double) $this->agreed_amount,
            'lessons_count' => (int) $this->lessons_count,
            'payments_sum' => (double) $this->payments_sum,
            // 'school' => new SchoolResource($this->school),
            'percent' => $this->percent,
            'mobile' => $this->user->mobile,
            'dateofbirth' => $this->dateofbirth,
            'drivingtrainer_id' => $this->drivingtrainer_id,
            'trainer_id' => $this->trainer_id,
            'city_id' => $this->city_id,
            'code' => $this->user->code,
            'active' => $this->active,
            // 'exams' => ExamResource::collection($this->exams),

        ];
    }
}
