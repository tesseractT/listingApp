<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageStoreRequest extends FormRequest
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
            'type' => ['required', 'in:free,paid'],
            'name' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric'],
            'num_of_days' => ['required', 'integer'],
            'num_of_listings' => ['required', 'integer'],
            'num_of_photos' => ['required', 'integer'],
            'num_of_videos' => ['required', 'integer'],
            'num_of_amenities' => ['required', 'integer'],
            'num_of_featured_listing' => ['required', 'integer'],
            'show_at_home' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],

        ];
    }

    function messages()
    {
        return [
            'type.required' => 'Type is required',
            'type.in' => 'Type must be free or paid',
            'name.required' => 'Name is required',
            'name.string' => 'Name must be string',
            'name.max' => 'Name must be less than 50 characters',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be numeric',
            'num_of_days.required' => 'Number of days is required',
            'num_of_days.integer' => 'Number of days must be a number',
            'num_of_listings.required' => 'Number of listings is required',
            'num_of_listings.integer' => 'Number of listings must be a number',
            'num_of_photos.required' => 'Number of photos is required',
            'num_of_photos.integer' => 'Number of photos must be a number',
            'num_of_videos.required' => 'Number of videos is required',
            'num_of_videos.integer' => 'Number of videos must be a number',
            'num_of_amenities.required' => 'Number of amenities is required',
            'num_of_amenities.integer' => 'Number of amenities must be a number',
            'num_of_featured_listing.required' => 'Number of featured listing is required',
            'num_of_featured_listing.integer' => 'Number of featured listing must be a number',
            'show_at_home.required' => 'Show at home is required',
            'show_at_home.boolean' => 'Show at home must be yes or no',
            'status.required' => 'Status is required',
            'status.boolean' => 'Status must be active or inactive',
        ];
    }
}
