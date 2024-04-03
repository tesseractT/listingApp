<section id="wsus__package">
    <div class="wsus__package_overlay">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__heading_area">
                        <h2>
                            {{ $sectionTitle?->our_pricing_title }}
                        </h2>
                        <p>
                            {{ $sectionTitle?->our_pricing_sub_title }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="procing_area">
                <div class="row">
                    @foreach ($packages as $package)
                        <div class="col-xl-4 col-md-6 col-lg-4">
                            <div class="member_price">
                                <h4>{{ $package->name }}</h4>
                                <h5>{{ currencyPosition($package->price) }}
                                    @if ($package->num_of_days === -1)
                                        <span>/ Lifetime</span>
                                    @else
                                        <span>/ {{ $package->num_of_days }} Days</span>
                                    @endif

                                </h5>
                                @if ($package->num_of_listings === -1)
                                    <p>Unlimited Listings</p>
                                @else
                                    <p>{{ $package->num_of_listings }} Listings</p>
                                @endif

                                @if ($package->num_of_amenities === -1)
                                    <p>Unlimited Listing Amenities</p>
                                @else
                                    <p>{{ $package->num_of_amenities }} Listing Amenities</p>
                                @endif

                                @if ($package->num_of_photos === -1)
                                    <p>Unlimited Listing Photos</p>
                                @else
                                    <p>{{ $package->num_of_photos }} Listing Photos</p>
                                @endif

                                @if ($package->num_of_videos === -1)
                                    <p>Unlimited Listing Videos</p>
                                @else
                                    <p>{{ $package->num_of_videos }} Listing Videos</p>
                                @endif
                                @if ($package->num_of_featured_listing === -1)
                                    <p>Unlimited Featured Listings</p>
                                @else
                                    <p>{{ $package->num_of_featured_listing }} Featured Listings</p>
                                @endif
                                <a href="{{ route('checkout.index', $package->id) }}">Order now</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
