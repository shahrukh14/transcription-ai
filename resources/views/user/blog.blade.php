@extends('user.layouts.layout')
@section('title', 'Blogs')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <!-- Blog List -->
            <div class="blog-list-wrapper">
                <!-- Blog List Items -->
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-md-4 col-6">
                        <div class="card">
                            <a href="{{ route('blog.details', $blog->id) }}">
                                <img class="card-img-top img-fluid" src="{{ asset('admin/blog/' . $blog->image) }}" alt="{{$blog->title}}" style="width: 470px; height:330px;" />
                            </a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="{{ route('blog.details', $blog->id) }}" class="blog-title-truncate text-body-heading">{{$blog->title}}</a>
                                </h4>
                                <div class="d-flex">
                                    <div class="author-info">
                                        <span class="text-muted ms-50 me-25">Category : </span>
                                        <span class="badge rounded-pill badge-light-info me-50"> {{ $blog->categories}}</span>
                                    </div>
                                </div>
                                <hr />
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="author-info">
                                        <span class="card-text">Posted on : {{ date('d M, Y', strtotime($blog->date)) }}</span>
                                    </div>
                                    <a href="{{ route('blog.details', $blog->id) }}" class="fw-bold">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--/ Blog List Items -->

                <!-- Pagination -->
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            {{ $blogs->links() }}
                        </nav>
                    </div>
                </div>
                <!--/ Pagination -->
            </div>
            <!--/ Blog List -->
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

 
    