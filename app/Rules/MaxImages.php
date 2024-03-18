<?php

namespace App\Rules;

use App\Models\ListingImageGallerry;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class MaxImages implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $packageImageLimit = Auth::user()->subscription->package->num_of_photos;
        $listingImagesCount = ListingImageGallerry::where('listing_id', $value)->count();
        $uploadedImagesCount = count(request('images'));

        if ($packageImageLimit === -1) return;

        if ($listingImagesCount + $uploadedImagesCount > $packageImageLimit) {
            $fail('You have reached the maximum number of ' . $packageImageLimit . ' images allowed for your subscription package');
        }
    }
}
