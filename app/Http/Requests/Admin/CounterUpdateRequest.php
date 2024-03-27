<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CounterUpdateRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
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
            'backgroung' => ['nullable', 'image'],
            'counter_one' => ['nullable', 'integer'],
            'counter_one_title' => ['nullable', 'string'],
            'counter_two' => ['nullable', 'integer'],
            'counter_two_title' => ['nullable', 'string'],
            'counter_three' => ['nullable', 'integer'],
            'counter_three_title' => ['nullable', 'string'],
            'counter_four' => ['nullable', 'integer'],
            'counter_four_title' => ['nullable', 'string'],

        ];
    }
}
