<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateManagerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->managers()->where('school_id', $this->school_id)->exists();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mobile' => ['required', Rule::phone()->country(config('services.countries'))],
            'school_id' => 'required|exists:schools,id',
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('managers')
                    ->where(
                        fn($query) => $query
                            ->where('user_id', $this->user_id)
                            ->where('school_id', $this->school_id)
                    ),
            ],
            'can_edit' => 'required|boolean',
            'can_delete' => 'required|boolean',
            'status' => 'required|in:active,inactive',

        ];
    }

    protected function prepareForValidation()
    {
        $user = User::where('mobile', phone((string) $this->input('mobile'), config('services.countries')))->firstOrFail();

        $this->merge([
            'user_id' => $user->id,

        ]);
    }

}
