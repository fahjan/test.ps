<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentsForAdminResource extends JsonResource
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
            'name' => $this->first_name . ' ' . $this->father_name . ' ' . $this->gfather_name . ' ' . $this->family_name,
            'license_id' => $this->license_id,
            'license' => $this->license,
            'glasses' => $this->glasses,
            'theoretical_at' => $this->theoretical_at,
            'tested_at' => $this->tested_at,
            'gender' => $this->gender,
            'agreed_amount' => $this->agreed_amount,
            'lessons_count' => $this->lessons_count,
            'payments_sum' => $this->payments_sum,
            'school' => new SchoolResource($this->school),
            'percent' => $this->percent,
            'mobile' => $this->user->mobile,
            'code' => $this->user->code,

        ];
    }
}
