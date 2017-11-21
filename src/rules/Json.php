<?php

namespace Iankov\ControlPanel\Rules;

use Illuminate\Contracts\Validation\Rule;

class Json implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return json_decode($value) !== null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid json string.';
    }
}