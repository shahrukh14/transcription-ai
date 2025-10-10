@extends('user.layouts.layout')
@section('title', 'FAQs')
@section('content')
<div class="rts-hosting-banner rts-hosting-banner-bg banner-default-height p-2">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center text-center">
            <div class="col-12">
                <div class="rts-hosting-banner__content blog__banner">
                    <h4 class="banner-title">
                        Latest Blogs
                    </h4>
                    <span class="starting__price">Blog</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BLOG -->
<section class="rts-blog pt-120">
    <div class="container">
        <div class="row justify-content-sm-center justify-content-md-start g-30">
            @foreach($blogs as $blog)
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="rts-blog__single">
                        <a href="{{ route('blog.details', $blog->id) }}">
                            <img class="blog__thumb" src="{{ asset('admin/blog/' . $blog->image) }} " alt="{{ $blog->title }}">
                        </a>
                        <div class="rts-blog__single--meta">
                            <div class="cat__date">
                                <a href="#" class="cat">{{ $blog->categories}}</a>
                                <span class="date">{{ \Carbon\Carbon::parse($blog->date)->format('d M, Y') }}</span>
                            </div>
                            <a href="{{ route('blog.details', $blog->id) }}" class="title">{{ $blog->title }}</a>
                            <div class="rts-blog__single--author p-0">
                                <div class="author">
                                    <img src="{{ asset('admin/blog/' . $blog->image) }}" alt="{{ $blog->title ?? '' }}">
                                </div>
                                <div class="author__content">
                                    <div class="author__content">
                                        <p class="blog-description">{!! \Str::limit($blog->description ?? 'No description available.', 50) !!}</p>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="blog-pagination-area mb-5">
            {{ $blogs->links() }}
        </div>
    </div>
</section>
<!-- BLOG END -->
@endsection
@push('style')
<style>
.rts-blog__single--author .author img {
    height: 36px !important;
}
.rts-blog__single--author {
    margin-top: 20px
}
.blog-details__featured-image img {
    height: 100%;
    max-height: 500px;
   
}
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
.rts-hosting-banner__content.blog__banner {
    display: flex;
    flex-direction: column;
    align-items: center; 
    justify-content: center; 
    max-width: 100%;
}
</style>
    
@endpush