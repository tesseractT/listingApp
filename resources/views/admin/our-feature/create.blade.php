@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.category.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Our Feature</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.our-features.index') }}">Our Features</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Feature</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.our-features.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label for="">Icon <span class="text-danger">*</span></label>
                                        <div role="iconpicker" data-align="left" data-unselected-class=""
                                            data-selected-class="btn-primary" name="icon"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" value="">
                                </div>
                                <div class="form-group">
                                    <label for="">Short Description <span class="text-danger">*</span></label>
                                    <textarea name="short_description" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Create Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@push('scripts')
    <script></script>
@endpush
