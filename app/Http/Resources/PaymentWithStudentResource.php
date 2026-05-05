<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentWithStudentResource extends JsonResource
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
            'amount' => (double) $this->amount,
            'kind' => $this->kind,
            'student_id' => $this->student_id,
            'notes' => $this->notes,
            'invoice_number' => $this->invoice_number,
            'invoiced_at' => $this->invoiced_at,
            'student' => new SimpleStudentResource($this->student),
            'creator' => new UserResource($this->creator),

        ];
    }
}
