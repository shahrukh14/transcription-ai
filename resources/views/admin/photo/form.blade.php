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
                            <h2 class="content-header-title float-start mb-0">@lang('Add Photo ')</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.gallery.list') }}">Home</a>
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
            @elseif (Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center fs-3">
                    {{ Session::get('success') }}
                </p>
            @endif
            <div class="content-body">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('admin.photo.add', $gallerys->id) }}" method="POST" id="blogForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="image" class="form-label">@lang('Image')</label>
                                    <input type="file" class="form-control" name="image[]" id="image" multiple>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">@lang('Add')</button>
                        </form>
                        @if (count($photos) > 0)
                            <table class="datatables-ajax table table-hover mt-2">
                                <thead>
                                    <tr>
                                        <th>@lang('Sl.No')</th>
                                        <th>@lang('Image')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($photos as $key => $photo)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset('admin/photos/album/' . $photo->image) }}" alt="Image"
                                                    width="40"></td>
                                            <td><a href="{{route('admin.photo.delete',$photo->id)}}" class="btn btn-outline-danger"><i
                                                        class="fa fa-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Content-->
@endsection
