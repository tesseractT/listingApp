@extends('frontend.layouts.master')
@section('contents')
    <section id="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.dashboard.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="dashboard_content">
                        <div class="manage_dasboard">
                            <div class="row">
                                <div class="col-xl-6 col-12 col-sm-6 col-lg-6 col-xxl-3">
                                    <div class="manage_dashboard_single">
                                        <i class="far fa-star"></i>
                                        <h3>{{ $reviewCount }}</h3>
                                        <p>Total Reviews</p>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-sm-6 col-lg-6 col-xxl-3">
                                    <div class="manage_dashboard_single  green">
                                        <i class="fas fa-list-ul"></i>
                                        <h3>{{ $activeListingCount }}</h3>
                                        <p>active listings</p>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-sm-6 col-lg-6 col-xxl-3">
                                    <div class="manage_dashboard_single orange ">
                                        <i class="far fa-heart"></i>
                                        <h3>{{ $pendingListingCount }}</h3>
                                        <p>Pending Listings</p>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-12 col-sm-6 col-lg-6 col-xxl-3">
                                    <div class="manage_dashboard_single red">
                                        <i class="fal fa-comment-alt-dots"></i>
                                        <h3>{{ $listingCount }}</h3>
                                        <p>total listings</p>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="active_package">
                                        <h4>Active Package</h4>
                                        @if ($subscription === null)
                                            <p class="alert alert-warning">No active package found</p>
                                        @else
                                            <div class="table-responsive">
                                                <table class="table dashboard_table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="active_left">Package name</td>
                                                            <td class="package_right">{{ $subscription->package->name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="active_left">Price</td>
                                                            <td class="package_right">
                                                                {{ currencyPosition($subscription->package->price) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="active_left">Purchase Date</td>
                                                            <td class="package_right">
                                                                {{ date('d F, Y', strtotime($subscription->purchase_date)) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="active_left">Expiry Date</td>
                                                            <td class="package_right">
                                                                {{ date('d F, Y', strtotime($subscription->expiry_date)) }}
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="active_left">Maximum Listing </td>
                                                            <td class="package_right">

                                                                @if ($subscription->package->num_of_listings == -1)
                                                                    Unlimited
                                                                @else
                                                                    {{ $subscription->package->num_of_listings }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="active_left">Maximum Aminities</td>
                                                            <td class="package_right">
                                                                @if ($subscription->package->num_of_amenities == -1)
                                                                    Unlimited
                                                                @else
                                                                    {{ $subscription->package->num_of_amenities }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="active_left">Maximum Photo</td>
                                                            <td class="package_right">

                                                                @if ($subscription->package->num_of_photos == -1)
                                                                    Unlimited
                                                                @else
                                                                    {{ $subscription->package->num_of_photos }}
                                                                @endif

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="active_left">Maximum Video</td>
                                                            <td class="package_right">
                                                                @if ($subscription->package->num_of_videos == -1)
                                                                    Unlimited
                                                                @else
                                                                    {{ $subscription->package->num_of_videos }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="active_left">Featured Listing Available</td>
                                                            <td class="package_right">
                                                                @if ($subscription->package->num_of_featured_listing == -1)
                                                                    Unlimited
                                                                @else
                                                                    {{ $subscription->package->num_of_featured_listing }}
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
