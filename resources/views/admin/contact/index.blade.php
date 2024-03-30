@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Contact Us</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Contact Us</div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update About Us</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.contact-us.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ $contact?->phone }}">
                                </div>

                                <div class="form-group
                                    <label for="">Email <span
                                        class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ $contact?->email }}">
                                </div>

                                <div class="form-group
                                    <label for="">Address <span
                                        class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" id="" cols="30" rows="10">{!! $contact?->address !!}</textarea>
                                </div>

                                <div class="form-group
                                    <label for="">Map <span
                                        class="text-danger">*</span></label>
                                    <textarea name="map_link" class="form-control" id="" cols="30" rows="10">{!! $contact?->map_link !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> Update Contact Us</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
