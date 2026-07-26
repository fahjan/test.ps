<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureReorderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'lectures' => 'required|array',
            'lectures.*.id' => 'required|exists:lectures,id',
            'lectures.*.sort_order' => 'required|integer',
        ];
    }
}
