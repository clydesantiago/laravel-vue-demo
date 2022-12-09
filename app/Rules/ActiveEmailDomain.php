<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ActiveEmailDomain implements Rule
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
         // Extract the email domain from the email address
         $domain = substr($value, strpos($value, '@') + 1);

         // Check if the email domain has an MX record
         return checkdnsrr($domain, 'MX');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid email address with an active domain.';
    }
}
