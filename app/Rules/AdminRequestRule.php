<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AdminRequestRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passwordes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
      if($value == null){
        return true;
      }
      if(strlen($value) > 7){
        return true;
      }elseif(strlen($value) < 8){
        return false;
      }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
      return __('admin/users.password length');
    }
}
