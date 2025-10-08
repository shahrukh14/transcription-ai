@extends('admin.layouts.layout')
@section('title', 'Add Blog Form')
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
                            <h2 class="content-header-title float-start mb-0">@lang('Add Blog')</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.blog.list') }}">Home</a></li>
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
                        <form action="{{ route('admin.blog.form') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">@lang('Title')</label>
                                    <input type="text" class="form-control" placeholder="@lang('Enter Title')"
                                        name="title" id="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="meta" class="form-label">@lang('meta')</label>
                                    <input type="text" class="form-control" placeholder="@lang('Enter Meta')"
                                        name="meta" id="meta" value="{{ old('meta') }}" required>
                                    @error('meta')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6">
                                    <label for="categories" class="form-label">@lang('Categories')</label>
                                    <input type="text" class="form-control" placeholder="@lang('Enter Categories')"
                                        value="{{ old('categories') }}" name="categories" id="categories" required>
                                    @error('categories')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="date" class="form-label">@lang('Date')</label>
                                    <input type="text" id="date" name="date"
                                        class="form-control flatpickr-basic flatpickr-input active"
                                        value="{{ old('date') }}" placeholder="DD-MM-YYYY" required>
                                    @error('date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <label for="description" class="form-label">@lang('Description')</label>
                                    <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="image" class="form-label">@lang('Image')</label>
                                <input type="file" class="form-control" name="image" id="image">
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('Add')</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END: Content-->
@endsection
