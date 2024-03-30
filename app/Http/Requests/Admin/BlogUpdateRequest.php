<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:3000'],
            'title' => ['required', 'string', 'max:255', 'unique:blogs,title,' . $this->blog],
            'category' => ['required', 'integer'],
            'content' => ['required', 'string'],
            'status' => ['required', 'integer', 'boolean'],
            'is_popular' => ['boolean', 'integer', 'required'],
        ];
    }
}
