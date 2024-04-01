@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.amenity.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Social Link</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.amenity.index') }}">All Social Links</a></div>
                <div class="breadcrumb-item">Update</div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Social Link</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.social-link.update', $social->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Icon <span class="text-danger">*</span></label>
                                    <div role="iconpicker" data-align="left" data-unselected-class=""
                                        data-selected-class="btn-primary" name="icon" data-icon="{{ $social->icon }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">URL <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="url" value="{{ $social->url }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option @selected($social->status === 1) value="1">Active</option>
                                        <option @selected($social->status === 0) value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Social Links</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
