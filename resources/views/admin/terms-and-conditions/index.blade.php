@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1> Terms and Conditions</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"> Terms and Conditions</div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Terms and Conditions</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.terms-and-conditions.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control summernote" id="" cols="30" rows="10">{!! $termsAndCondition?->description !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> Update Terms and Conditions</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
