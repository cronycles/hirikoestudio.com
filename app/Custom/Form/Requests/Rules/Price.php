<?php

namespace App\Custom\Form\Requests\Rules;

use Illuminate\Contracts\Validation\Rule;

class Price implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $basicRegex = '/^[0-9]{1,}([,.][0-9]{1,2})?$/';

        return preg_match($basicRegex, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.attributes.price');
    }
}
