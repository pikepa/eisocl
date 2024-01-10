<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Spamfree implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (preg_match('/(.)\\1{4,}/', $value) == true) {
            $fail('The :attribute contains repeating key strokes.');
        }

        foreach ($this->keywords as $keyword) {
            if (stripos($value, $keyword) !== false) {
                $fail('The :attribute contains forbidden terms.');
            }
        }
    }

    // spam keywords not allowed in replies or threads
    protected $keywords = [
        'yahoo customer support',
        'hamas',
        'Palestine',
        'fuck off',
    ];
}
