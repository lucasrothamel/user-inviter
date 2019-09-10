<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'image' => 'nullable|dimensions:min_width=100,min_height=100|image|max:10240',
            'description' => 'max:64000|required_without:image',
        ];
    }
}
