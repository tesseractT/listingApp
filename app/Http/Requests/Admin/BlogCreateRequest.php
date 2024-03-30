<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogCreateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],
            'title' => ['required', 'string', 'max:255', 'unique:blogs,title'],
            'category' => ['required', 'integer'],
            'content' => ['required', 'string'],
            'status' => ['required', 'integer', 'boolean'],
            'is_popular' => ['boolean', 'integer', 'required'],
        ];
    }
}
