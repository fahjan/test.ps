<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentGraduateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // $manager_has_role_to_school = $this->student->where(function ($query) {
        //     $query->whereIn('school_id', function ($subQuery) {
        //         $subQuery->select('school_id')
        //             ->from('managers')
        //             ->where('user_id', auth()->id());
        //     });
        // })->exists();

        // return $manager_has_role_to_school;

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'field' => ['required', 'in:tested_at,theoretical_at'],
        ];
    }
}
