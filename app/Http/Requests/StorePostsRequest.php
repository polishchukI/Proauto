<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
				'tag.*' => 'exists:blog_tags,id',
				'category.*' => 'exists:blog_categories,id',
				];
    }
}
