<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = config('app.recaptcha_secret');
        $recaptcha_response = $value;

        $recaptcha_response = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha_response_decoded = json_decode($recaptcha_response);	

        if (!$recaptcha_response_decoded->success)
		{
          return false;
        }
		else if($recaptcha_response_decoded->score < 0.5)
		{
          return false;
        }
		else
		{
          return $recaptcha_response_decoded->success;
        }
    }
  
    public function message()
    {
        return [
            'recaptcha' => 'Human validation error. Please try again.'
        ];
    }
}