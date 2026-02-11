<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListTrainersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $manager_has_role_to_school = $this->student->where(function ($query) {
            $query->whereIn('school_id', function ($subQuery) {
                $subQuery->select('school_id')
                    ->from('managers')
                    ->where('user_id', auth()->id());
            });
        });

        return $manager_has_role_to_school;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
