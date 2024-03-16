<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Amenity
 *
 * @property int $id
 * @property string $icon
 * @property string $name
 * @property string $slug
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Amenity whereUpdatedAt($value)
 */
	class Amenity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $image_icon
 * @property string $background_image
 * @property int $show_at_home
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereBackgroundImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereImageIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereShowAtHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hero
 *
 * @property int $id
 * @property string|null $background
 * @property string $title
 * @property string $subtitle
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Hero newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hero newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hero query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hero whereUpdatedAt($value)
 */
	class Hero extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Listing
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property int $location_id
 * @property int|null $package_id
 * @property string $image
 * @property string $thumbnail_image
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string|null $website
 * @property string|null $facebook_link
 * @property string|null $x_link
 * @property string|null $linkedin_link
 * @property string|null $whatsapp_link
 * @property int $is_verified
 * @property int $is_featured
 * @property int $views
 * @property string|null $google_map_embed_code
 * @property string|null $file
 * @property string $expiry_date
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property int $status
 * @property int $is_approved
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ListingAmenity> $amenities
 * @property-read int|null $amenities_count
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ListingImageGallerry> $gallery
 * @property-read int|null $gallery_count
 * @property-read \App\Models\Location $location
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ListingSchedule> $schedules
 * @property-read int|null $schedules_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ListingVideoGallerry> $videoGallery
 * @property-read int|null $video_gallery_count
 * @method static \Illuminate\Database\Eloquent\Builder|Listing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereFacebookLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereGoogleMapEmbedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereLinkedinLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereThumbnailImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereWhatsappLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing whereXLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Listing withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Listing withoutTrashed()
 */
	class Listing extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ListingAmenity
 *
 * @property int $id
 * @property int $listing_id
 * @property int $amenity_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Amenity|null $amenity
 * @method static \Illuminate\Database\Eloquent\Builder|ListingAmenity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingAmenity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingAmenity query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingAmenity whereAmenityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingAmenity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingAmenity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingAmenity whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingAmenity whereUpdatedAt($value)
 */
	class ListingAmenity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ListingImageGallerry
 *
 * @property int $id
 * @property int $listing_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImageGallerry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImageGallerry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImageGallerry query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImageGallerry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImageGallerry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImageGallerry whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImageGallerry whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingImageGallerry whereUpdatedAt($value)
 */
	class ListingImageGallerry extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ListingSchedule
 *
 * @property int $id
 * @property int $listing_id
 * @property string $day
 * @property string $start_time
 * @property string $end_time
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingSchedule whereUpdatedAt($value)
 */
	class ListingSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ListingVideoGallerry
 *
 * @property int $id
 * @property int $listing_id
 * @property string $video_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ListingVideoGallerry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingVideoGallerry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingVideoGallerry query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListingVideoGallerry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingVideoGallerry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingVideoGallerry whereListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingVideoGallerry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListingVideoGallerry whereVideoUrl($value)
 */
	class ListingVideoGallerry extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Location
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $show_at_home
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereShowAtHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 */
	class Location extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Package
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property float $price
 * @property int $num_of_days
 * @property int $num_of_listings
 * @property int $num_of_photos
 * @property int $num_of_videos
 * @property int $num_of_amenities
 * @property int $num_of_featured_listing
 * @property int $show_at_home
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Package newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Package onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Package query()
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereNumOfAmenities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereNumOfDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereNumOfFeaturedListing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereNumOfListings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereNumOfPhotos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereNumOfVideos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereShowAtHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Package withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Package withoutTrashed()
 */
	class Package extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentSetting
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting query()
 */
	class PaymentSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $user_type
 * @property string|null $avatar
 * @property string|null $banner
 * @property string $name
 * @property string $email
 * @property string|null $address
 * @property string|null $about
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $website
 * @property string|null $fb_link
 * @property string|null $x_link
 * @property string|null $in_link
 * @property string|null $wa_link
 * @property string|null $insta_link
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAbout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFbLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInstaLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWaLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereXLink($value)
 */
	class User extends \Eloquent {}
}

