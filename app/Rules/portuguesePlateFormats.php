<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class portuguesePlateFormats implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^(?:[A-Z]{2}-\d{2}-\d{2})|(?:\d{2}-[A-Z]{2}-\d{2})|(?:\d{2}-\d{2}-[A-Z]{2})|(?:[A-Z]{2}-\d{2}-[A-Z]{2})$/i', $value)) {
            $fail('The ' . $attribute . ' does not match the expected format.');
        }
    }
}

