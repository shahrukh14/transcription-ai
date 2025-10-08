@extends('admin.layouts.layout')
@section('title', 'Add Role Form')
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
                            <h2 class="content-header-title float-start mb-0">@lang('Add User')</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Button trigger modal -->

                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('admin.add-user') }}" method="POST">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">@lang('First Name')</label>
                                    <input type="text" class="form-control" placeholder="@lang('Enter First Name')"
                                        name="first_name" id="first_name" value="{{old('first_name')}}" >
                                    @error('first_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">@lang('Last Name')</label>
                                    <input type="text" class="form-control" placeholder="@lang('Enter Last Name')"
                                        name="last_name" id="last_name" value="{{old('last_name')}}" required>
                                    @error('last_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">@lang('Email')</label>
                                    <input type="email" class="form-control" placeholder="@lang('Enter Email')"
                                        name="email" id="email" value="{{old('email')}}" required>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">@lang('Password')</label>
                                    <input type="password" class="form-control form-control-merge" placeholder="@lang('Enter Password')"
                                        name="password" id="password" value="{{old('password')}}" required>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="role" class="form-label">@lang('Select Role')</label>
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($roles as $role)
                                        <option value="{{$role->name}}" {{old('role')==$role->name ? 'selected' : ''}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
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
