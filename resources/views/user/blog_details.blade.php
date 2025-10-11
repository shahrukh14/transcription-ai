@extends('user.layouts.layout')
@section('title', 'Blog Details')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
           <!-- Blog Detail -->
           <div class="blog-detail-wrapper">
            <div class="row">
                <!-- Blog -->
                <div class="col-12">
                    <div class="card">
                        <img src="{{ asset('admin/blog/' . $blog->image) }}" class="img-fluid card-img-top" alt="Blog Detail Pic" />
                        <div class="card-body">
                            <h4 class="card-title">{{$blog->title}}</h4>
                            <div class="d-flex">
                                <div class="author-info">
                                    <span class="card-text">Posted on : {{ date('d M, Y', strtotime($blog->date)) }}</span>
                                    <span class="text-muted ms-50 me-25">|</span>
                                    <span class="text-muted ms-50 me-25">Category : </span>
                                    <span class="badge rounded-pill badge-light-info me-50"> {{ $blog->categories}}</span>
                                </div>
                            </div>
                            <p class="card-text mb-2">{!! $blog->description !!}</p>
                            <hr class="mb-1" />
                        </div>
                    </div>
                </div>
                <!--/ Blog -->
            </div>
        </div>
        <!--/ Blog Detail -->
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

 
    