<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
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
        if(strlen($value) == 0){
            return true;
        }
        $number = str_replace(array('-', '.', ' '), '', $value);
        return (!preg_match('/^(09|08|07|05|03)[0-9]{8}$/', $number)) > 0 ? false: true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sai định dạng điện thoại.';
    }
}
