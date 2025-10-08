@extends('admin.layouts.layout')
@section('title', 'Add photo')
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
                            <h2 class="content-header-title float-start mb-0">@lang('Add Album ')</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.gallery.list')}}">Home</a>
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
                        <form action="{{route('admin.gallery.update',$galleryes->id)}}" method="POST" id="blogForm"
                            enctype="multipart/form-data">
                             @method('PUT')
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">@lang('Title')</label>
                                    <input type="text" class="form-control" placeholder="@lang('Enter Title')"
                                        name="name" id="name" value="{{ old('title', $galleryes->name) }}" required>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">@lang('Image')</label>
                                <input type="file" class="form-control" name="image" id="image">
                                 @if ($galleryes->image)
                                    <a href="{{ asset('admin/gallery/' . $galleryes->image) }}" target="_blank">view
                                        image</a>
                                @endif
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">@lang('Add')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection



