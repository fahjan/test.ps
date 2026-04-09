<?php

namespace App\Http\Requests;

use App\Models\Manager;
use App\Models\Trainer;
use Illuminate\Foundation\Http\FormRequest;

class ListTrainersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // list trainers for manager and trainers 

        /* // check if the current user is manager of the school, if not return false
        $manager_has_role_to_school = Manager::whereHas('user', function ($q) {
            $q->where('id', auth()->id());
        })->whereHas('school', function ($q) {
            return $q->where('id', request('school_id'));
        })->exists();


        // check if the current user is trainer of the school, if not return false

        $trainer_has_role_to_school = Trainer::whereHas('user', function ($q) {
            $q->where('id', auth()->id());
        })->whereHas('school', function ($q) {
            return $q->where('id', request('school_id'));
        })->exists();
        // return $manager_has_role_to_school || $trainer_has_role_to_school;
 */
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
            //
        ];
    }
}
