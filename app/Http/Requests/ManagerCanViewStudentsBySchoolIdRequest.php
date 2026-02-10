<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ManagerCanViewStudentsBySchoolIdRequest extends FormRequest
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
            'school_id' => [
                'required',
                Rule::exists('schools', 'id')->where(function ($query) {
                    // نتحقق أن المدرسة مرتبطة بالمدير الحالي عبر جدول المنيجرز
                    $query->whereHas('managers', function ($q) {
                        $q->where('id', auth()->id());
                    });
                }),
            ],
        ];
    }
}
