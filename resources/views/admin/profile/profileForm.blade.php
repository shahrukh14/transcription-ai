@extends('admin.layouts.layout')
@section('title', 'Update Profile')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9  mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="">
                            <h2 class="content-header-title float-start mb-0">Update Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic File Browser start -->
                <section id="input-file-browser">
                    <div class="card">
                        @if (Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center fs-3">
                                {{ Session::get('message') }}</p>
                        @endif
                        @error('email')
                            <h3 class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">
                                {{ $message }}</h3>
                        @enderror
                        <div class="card-body pt-1">
                            <!-- form -->
                            <form action="{{ route('admin.updateProfile', ['id' => $userdata->id]) }}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">First Name<sup><span
                                                    class="text-danger fs-5">*</span></sup> </label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text" id="first_name"
                                                value="{{ $userdata->first_name }}" name="first_name" required />
                                            @error('first_name')
                                                <small class="-mt-3 text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Last Name<sup><span
                                                    class="text-danger fs-5">*</span></sup> </label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text" id="last_name"
                                                value="{{ $userdata->last_name }}" name="last_name" required />
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
                                            <input class="form-control" type="email" id="email" max-lenght="10"
                                                value="{{ $userdata->email }}" name="email" disabled required />
                                        </div>
                                        @error('email')
                                            <small class="-mt-3 text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Password</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control form-control-merge" id="login-password" type="password" name="password" placeholder="" aria-describedby="login-password" tabindex="2"/><span class="input-group-text cursor-pointer"><i data-feather="eye" ></i></span>
                                        </div>
                                        @error('password')
                                            <small class="-mt-3 text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <div class="mb-1">
                                            <label for="customFile1" class="form-label">Profile pic</label>
                                            <input class="form-control" type="file" name="image" id="customFile1" >
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/ form -->
            </div>
            </section>
        </div>
        <!--CARD END-->

    </div>
    </div>
    </div>
    <!-- END: Content-->

    {{-- <!-- MODAL -->
<div class="modal-size-lg d-inline-block" id="LeadModal">
   <div class="modal fade text-start" id="large" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel17">Enter Your Lead Details</h4>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!--CARD -->
            <div class="content-body">

           
         </div>
      </div>
   </div>
</div>
<!--MODAL END-->   --}}
@endsection
