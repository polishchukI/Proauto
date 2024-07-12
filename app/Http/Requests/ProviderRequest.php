<?php

namespace App\Http\Requests;

use App\Provider;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return ['name' => ['required', 'min:3'],];
    }
}
