<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateManagaerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $isSchoolManager = auth()->user()->managers()->where('school_id', $this->school_id)->exists();

        return $isSchoolManager;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'required|in:active,inactive',
            'can_edit' => 'required|boolean',
            'can_delete' => 'required|boolean',
            'can_manage_managers' => 'required|boolean',

        ];
    }
}
