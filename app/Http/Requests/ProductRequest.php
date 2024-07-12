<?php

namespace App\Http\Requests;

use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'article' => ['required'],
            'brand' => ['required'],
            // 'name' => ['required'],//product category id
            'product_category_id' => ['required'],
        ];
    }

    public function attributes()
    {
        return [];
    }
}
