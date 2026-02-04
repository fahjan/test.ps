<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
            'password' => 'required|string|max:199|min:4',
            'device_info' => ['required', 'string'],

        ];
    }

    protected function prepareForValidation()
    {

        $this->merge([
            'mobile' => ltrim(phone((string) $this->input('mobile'), config('services.countries')), '+'),
        ]);

        return parent::getValidatorInstance();
    }
}
