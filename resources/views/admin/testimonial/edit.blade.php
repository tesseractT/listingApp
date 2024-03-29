@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.testimonial.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Testimonial</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.testimonial.index') }}">All Testimonials</a>
                </div>
                <div class="breadcrumb-item">Update</div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Testimonial</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.testimonial.update', $testimonial->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Image<span class="text-danger">*</span></label>
                                        <div id="image-preview-2" class="image-preview">
                                            <label for="image-upload-2" id="image-label-2">Choose File</label>
                                            <input type="file" name="image" id="image-upload-2" />
                                            <input type="hidden" name="old_image" value="{{ $testimonial->image }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $testimonial->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ $testimonial->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Rating <span class="text-danger">*</span></label>
                                    <select name="rating" class="form-control">
                                        <option @selected($testimonial->rating === 1) value="1">1</option>
                                        <option @selected($testimonial->rating === 2) value="2">2</option>
                                        <option @selected($testimonial->rating === 3) value="3">3</option>
                                        <option @selected($testimonial->rating === 4) value="4">4</option>
                                        <option @selected($testimonial->rating === 5) value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" rows="5">{{ $testimonial->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option @selected($testimonial->rating === 1) value="1">Active</option>
                                        <option @selected($testimonial->rating === 0) value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
    <script>
        $('.image-preview').css({
            'background-image': 'url({{ asset($testimonial->image) }})',
            'background-size': 'cover',
            'background-position': 'center center'
        });
    </script>
@endpush
