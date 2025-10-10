@extends('user.layouts.layout')
@section('title', 'Blog Details')
@section('content')

<!-- shared hosting banner -->
<div class="rts-hosting-banner rts-hosting-banner-bg banner-default-height p-2">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center text-center">
            <div class="col-12">
                <div class="rts-hosting-banner__content blog__banner">
                    <h4 class="banner-title">
                        {{ $blog->title }}
                    </h4>
                    <span class="starting__price">{{ $blog->categories }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- shared hosting banner end-->

<!-- BLOG DETAILS -->
<div class="rts-blog-details section__padding" id="blogDetails">
    <div class="container">
        <div class="row g-40">
            <div class="col-lg-12">
                <article class="blog-details">
                    <!-- Wrap the image in a left section -->
                    <div class="left-section">
                        <div class="blog-details__featured-image">
                            <img src="{{ asset('admin/blog/' . $blog->image) }}" class="img-fluid w-100" alt="blog post">
                        </div>
                    </div>

                    <!-- Content section -->
                    <div class="right-section">
                        <div class="blog-details__article-meta mt--20">
                            <span><span><i class="fa-light fa-clock"></i></span>{{ \Carbon\Carbon::parse($blog->date)->format('d M, Y') }}</span>
                            <a href="#"><span><i class="fa-sharp fa-light fa-tags"></i></span>{{ $blog->categories }}</a>
                        </div>
                        <h3 class="blog-title">{{ $blog->title }}</h3>
                        <div class="blog-description">
                            <p>{!! $blog->description !!}</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

<!-- BLOG DETAILS END -->

@endsection
@push('style')

<style>
.blog-details__featured-image img {
    height: 100%;
    max-height: 500px;
   
}

/* @media (max-width: 768px) {
    .left-section,
    .right-section {
        width: 100%; 
        margin-right: 0;
    }
} */
.section__padding {
    padding: 40px 0;
}
.rts-hosting-banner.rts-hosting-banner-bg:before {
    height: 220px !important;
}
.rts-hosting-banner {
    display: flex;
    flex-direction: column; 
    justify-content: flex-start; 
    height: 250px;
    position: relative;
}
.rts-hosting-banner__content {
    padding: 20px;
    margin-top: 0; 
    z-index: 1;
}
.rts-hosting-banner.rts-hosting-banner-bg::after {
    height: 220px !important;
}
.rts-hosting-banner.banner-default-height {
    max-height: auto;
    min-height: auto;
}
.rts-hosting-banner-bg {
    display: flex;
    justify-content: center; 
    align-items: center; 
    text-align: center;
    height: 200px; 
}

.banner-area {
   
}
.rts-hosting-banner__content.blog__banner {
    display: flex;
    flex-direction: column;
    align-items: center; 
    justify-content: center; 
    max-width: 100%;
}
.blog-details__article-meta {
    gap:5 !important;
}
.blog-details__article-meta span i {
    margin-right: 0px !important;
}
</style>
@endpush