<?php

namespace App\Rules;

use App\Utilities\Circleaptcha;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Validation\Rule;

class Captcha implements Rule
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
        if (Session::exists('captcha')) {
            $radius   = Session::get('captcha')['r'];
            $distance = Circleaptcha::_calculateDistance($value[0], Session::get('captcha')['x'], $value[1], Session::get('captcha')['y']);

            Session::put('captcha', array('x' => $value[0], 'y' => $value[1]));

            if ($distance < $radius) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Captcha is invalid.';
    }
}
