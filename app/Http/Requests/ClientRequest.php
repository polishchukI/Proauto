<?php

namespace App\Http\Requests;

use App\Models\Client\Client;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }
	
    public function rules()
    {
        return [

            // 'email' => [
                // 'required', 'email', Rule::unique((new Client)->getTable())->ignore($this->route()->client->id ?? null)
            // ],

        ];
    }
}
