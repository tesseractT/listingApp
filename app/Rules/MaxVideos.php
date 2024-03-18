<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use App\Models\ListingVideoGallerry;

class MaxVideos implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $packageVideoLimit = Auth::user()->subscription->package->num_of_videos;
        $listingVideossCount = ListingVideoGallerry::where('listing_id', $value)->count();

        if ($packageVideoLimit === -1) return;

        if ($listingVideossCount >= $packageVideoLimit) {
            $fail('You have reached the maximum number of ' . $packageVideoLimit . ' videos allowed for your subscription package');
        }
    }
}
