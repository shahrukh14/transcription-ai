@extends('user.layouts.layout')
@section('title', 'Contact Us')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-7 mt-1">
                    <div class="text-center mb-2">
                        <img src="{{ asset('user-assets/images/contact/contact-form.png') }}" width="260" height="188" alt="">
                    </div>
                    <h1 class="text-center">  Ask a Question </h1>
                    <p class="text-center">
                        Schedule a call today and one of our experts to help you decide which service is ideal for your business and budget.
                    </p>
                </div>
                <div class="col-md-5 mt-1">
                    <h6 class="section-label mt-25">Send a message</h6>
                    <div class="card">
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('contact.store') }}">
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-2">
                                            <input type="text" class="form-control" name="fname" placeholder="First Name" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-2">
                                            <input type="text" class="form-control" name="lname" placeholder="Last Name" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-2">
                                            <input type="email" class="form-control" name="email" placeholder="Email" required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="mb-2">
                                            <input type="email" class="form-control" name="text" placeholder="Phone Number" required/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control mb-2" rows="4" name="message" placeholder="A brief description about your consultation"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
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
 

@push('style')
<!-- Dropzone CSS -->
<style> 
</style>
@endpush

 
    