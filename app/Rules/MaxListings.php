<?php

namespace App\Rules;

use App\Models\Listing;
use Auth;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxListings implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $packageListingLimit = Auth::user()->subscription->package->num_of_listings;
        $userListingsCount = Listing::where(['user_id' => Auth::user()->id, 'status' => 1])->count();

        if ($packageListingLimit === -1) return;

        if ($userListingsCount >= $packageListingLimit) {
            $fail('You have reached the maximum number of ' . $packageListingLimit . ' listings allowed for your package.');
        }
    }
}
