@extends('admin.layouts.layout')
@section('title', 'Edit Testimonial')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">@lang('Edit Testimonial')</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.testimonial.list') }}">Home</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Session::has('error'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">
                    {{ Session::get('error') }}
                </p>
            @endif
            <div class="content-body">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('admin.testimonial.update', $Testimonial->id) }}" method="POST"
                            id="testimonialForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="title" class="form-label">@lang('Title')</label>
                                    <input type="text" class="form-control" placeholder="@lang('Enter Title')"
                                        name="title" id="title" value="{{ $Testimonial->title }}">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <label for="description" class="form-label">@lang('Description')</label>
                                    <textarea class="form-control" name="description" id="description">{{ $Testimonial->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="image" class="form-label">@lang('Image')</label>
                                <input type="file" class="form-control" name="image" id="image">
                                @if ($Testimonial->image)
                                    <a href="{{ asset('admin/testimonials/' . $Testimonial->image) }}" target="_blank">view
                                        image</a>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('Update')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
