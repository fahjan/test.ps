<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mobile' => ['required', Rule::phone()->country(config('services.countries'))],
            'first_name' => 'required|string|max:199',
            'father_name' => 'required|string|max:199',
            'gfather_name' => 'required|string|max:199',
            'family_name' => 'required|string|max:199',
            // add rule for unique student id number with the same license type, and the same school

            'id_number' => [
                'required',
                'string',
                'max:9',
                'min:4',
                Rule::unique('students')->where(function ($query) {
                    return $query->where('license_id', $this->input('license_id'))
                        ->where('school_id', $this->input('school_id'));
                }),
            ],
            'dateofbirth' => 'required|date',

            'exam_type' => 'required',
            'license_id' => 'required',
            'city_id' => 'required',
            'agreed_amount' => 'required',
            'trainer_id' => 'required',
            'drivingtrainer_id' => 'required',
            'gender' => 'required',

            'agreed_lessons' => ['required', 'integer'],

            'school_id' => ['required', 'integer'],


        ];
    }

    protected function prepareForValidation()
    {

        $this->merge([
            'mobile' => phone((string) $this->input('mobile'), config('services.countries')),
            'agreed_lessons' => $this->input('agreed_lessons', 12),
            'active' => $this->input('active', 'yes'),
        ]);

        return parent::getValidatorInstance();
    }

    public function messages(): array
    {
        return [
            'id_number.unique' => 'هذا الطالب مسجل مسبقاً في نفس نوع الرخصة.',
        ];
    }
}
