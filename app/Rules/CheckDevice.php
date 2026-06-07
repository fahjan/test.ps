<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckDevice implements ValidationRule
{

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = $this->user;

        if ($user && $user->device_info) {
            if ($user->device_info !== $value) {
                $fail('عذراً، لا يمكنك تسجيل الدخول باستخدام جهاز مختلف.');
            }
        }
    }
}
