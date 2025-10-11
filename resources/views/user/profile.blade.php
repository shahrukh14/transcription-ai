@extends('user.layouts.layout')
@section('title', 'Dashboard')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center fs-3">
                    {{ Session::get('message') }}
                </p>
            @endif
            @if (Session::has('error'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">
                    {{ Session::get('error') }}
                </p>
            @endif
            <div class="content-body">
                <section id="input-file-browser">
                    <div class="card">
                        <div class="card-body pt-1">
                            <!-- form -->
                            <form action="{{ route('user.profile.update') }}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">First Name<sup><span class="text-danger fs-5">*</span></sup></label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text" id="first_name" name="first_name" value="{{ old('first_name', $users->first_name) }}" required />
                                            @error('first_name')
                                                <small class="-mt-3 text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Last Name<sup><span class="text-danger fs-5">*</span></sup> </label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text" id="last_name" name="last_name" value="{{ old('last_name', $users->last_name) }}" required />
                                            @error('last_name')
                                                <small class="-mt-3 text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Email</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="email" id="email" name="email"  value="{{ old('email', $users->email) }}" />
                                        </div>
                                        @error('email')  <small class="-mt-3 text-red-500">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Mobile Number</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="mobile" id="mobile"  value="{{ old('mobile', $users->mobile) }}" />
                                        </div>
                                        @error('mobile') <small class="-mt-3 text-red-500">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="" aria-describedby="login-password" tabindex="2"/><span class="input-group-text cursor-pointer"><i data-feather="eye" ></i></span>
                                        </div>
                                        @error('password')
                                            <small class="-mt-3 text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <div class="mb-1">
                                            <label for="image" class="form-label">Profile pic</label>
                                            <input class="form-control" type="file" name="image" id="image" >
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection


