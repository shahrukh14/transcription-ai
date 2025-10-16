@extends('admin.layouts.layout')
@section('title', 'Edit Customer')
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
                        <h2 class="content-header-title float-start mb-0">@lang('Customers')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.customers.list') }}">List</a></li>
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
                    <form action="{{route('admin.customers.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6 mb-1">
                                <label for="first_name" class="form-label">@lang('First Name')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="@lang('Enter First Name')" name="first_name" id="first_name" value="{{$user->first_name}}" required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="last_name" class="form-label">@lang('Last Name')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="@lang('Enter Last Name')" name="last_name" id="last_name" value="{{$user->last_name}}" required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="email" class="form-label">@lang('E-mail')<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" placeholder="@lang('Enter email address')" name="email" id="email" value="{{$user->email}}" required readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="mobile" class="form-label">@lang('Mobile')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="@lang('Enter mobile number')" name="mobile" id="mobile"  value="{{$user->mobile}}"  required>
                            </div>
                            {{-- <div class="col-md-6 mb-1">
                                <label for="sso_google_id" class="form-label">@lang('Google Login ID')</label>
                                <input type="text" class="form-control" placeholder="@lang('Enter google ID for login with google')" name="sso_google_id" id="sso_google_id"  value="{{$user->sso_google_id}}">
                            </div> --}}
                            <div class="col-md-6 mb-1">
                                <label for="image" class="form-label">@lang('Profile Picture')</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('Save')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@push('script')
<script>
    $(document).ready(function() {
       
    });
</script>
@endpush