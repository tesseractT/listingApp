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
                        <div class="my_listing">
                            <h4>Basic Information</h4>
                            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-xl-8 col-md-12">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6">
                                                <div class="my_listing_single">
                                                    <label>Name <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="Name" name="name"
                                                            value="{{ $user->name }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-md-6">
                                                <div class="my_listing_single">
                                                    <label>Phone <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="Phone" name="phone"
                                                            value="{{ $user->phone }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label>Email<span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="email" placeholder="Email" name="email"
                                                            value="{{ $user->email }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label>Address<span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="Address" name="address"
                                                            value="{{ $user->address }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="my_listing_single">
                                                    <label>About Me <span class="text-danger">*</span></label>
                                                    <div class="input_area">
                                                        <textarea cols="3" rows="3" placeholder="Your Text" required name="about">{!! $user->about !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Website</label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="Website" name="website"
                                                            value="{{ $user->website }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Facebook</label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="Facebook Link" name="fb_link"
                                                            value="{{ $user->fb_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>X</label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="X Link" name="x_link"
                                                            value="{{ $user->x_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Linkedin</label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="Linkein Link" name="in_link"
                                                            value="{{ $user->in_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Whatsapp</label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="Whatsapp No" name="wa_link"
                                                            value="{{ $user->wa_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="my_listing_single">
                                                    <label>Instagram</label>
                                                    <div class="input_area">
                                                        <input type="text" placeholder="Instagram Link" name="insta_link"
                                                            value="{{ $user->insta_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-5">
                                        <div class="my_listing_single">
                                            <label for="">Avatar</label>
                                            <div class="profile_pic_upload">
                                                <img src="{{ asset($user->avatar) }}" alt="img"
                                                    class="imf-fluid w-100">
                                                <input type="file" name="avatar">
                                                <input type="hidden" name="old_avatar" value="{{ $user->avatar }}">

                                            </div>
                                        </div>

                                        <div class="my_listing_single">
                                            <label for="">Banner</label>
                                            <div class="profile_pic_upload">
                                                <img src="{{ asset($user->banner) }}" alt="img"
                                                    class="imf-fluid w-100">
                                                <input type="file" name="banner">
                                                <input type="hidden" name="old_banner" value="{{ $user->banner }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="read_btn">Update Profile</button>
                                </div>
                            </form>
                        </div>
                        <div class="my_listing list_mar">
                            <h4>change password</h4>
                            <form action="{{ route('user.profile-password.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="my_listing_single">
                                            <label>current password</label>
                                            <div class="input_area">
                                                <input type="password" placeholder="Current Password"
                                                    name="current_password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="my_listing_single">
                                            <label>new password</label>
                                            <div class="input_area">
                                                <input type="password" placeholder="New Password" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="my_listing_single">
                                            <label>confirm password</label>
                                            <div class="input_area">
                                                <input type="password" placeholder="Confirm Password"
                                                    name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="read_btn">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
