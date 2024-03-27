<section id="wsus__features">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 m-auto">
                <div class="wsus__heading_area">
                    <h2>Our Features</h2>
                    <p>Lorem ipsum dolor sit amet, qui assum oblique praesent te. Quo ei erant essent scaevola estut
                        clita dolorem ei est mazim fuisset scribentur.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($ourFeatures as $feature)
                <div class="col-xl-4 col-md-6">
                    <div class="wsus__feature_single">
                        <div class="icon">
                            <i class="{{ $feature->icon }}"></i>
                        </div>
                        <h5>{{ $feature->title }}</h5>
                        <p>{{ truncateText($feature->short_description, 60) }}</p>
                        <span>{{ ++$loop->index }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
