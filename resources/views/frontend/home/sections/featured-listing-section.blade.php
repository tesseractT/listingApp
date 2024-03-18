<section id="wsus__featured_listing">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 m-auto">
                <div class="wsus__heading_area">
                    <h2>Our Featured Listing </h2>
                    <p>Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola estut
                        clita dolorem ei est mazim fuisset scribentur.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row listing_slider">
            @foreach ($featuredListings as $listing)
                <div class="col-xl-4 col-sm-6">
                    <div class="wsus__featured_single">
                        <div class="wsus__featured_single_img">
                            <img src="{{ asset($listing->image) }}" alt="{{ $listing->title }}" class="img-fluid w-100">
                            <a href="#" class="love"><i class="fas fa-heart"></i></a>
                            <a href="{{ route('listings', ['category' => $listing->category->slug]) }}"
                                class="small_text">{{ $listing->category->name }}</a>
                        </div>
                        <a class="map" onclick="showListingModal('{{ $listing->id }}')" data-bs-toggle="modal"
                            data-bs-target="#exampleModal2" href="#"><i class="fas fa-info"></i></a>
                        <div class="wsus__featured_single_text">
                            <p class="list_rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span>(5 review)</span>
                            </p>
                            <a
                                href="{{ route('listing.show', $listing->slug) }}">{{ truncateText($listing->title) }}</a>
                            <p class="address">{{ $listing->location->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
