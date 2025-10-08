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
                            <h2 class="content-header-title float-start mb-0">@lang('Add Role')</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Button trigger modal -->

                <div class="card w-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('admin.add-role') }}" method="POST" id="roleAddForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="role_name" class="form-label">@lang('Role Title')</label>
                                        <input type="text" class="form-control" placeholder="@lang('Enter Role Title')"
                                            name="role_name" value="{{old('role_name')}}" id="role_name" required>
                                        @error('role_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">@lang('Add')</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
