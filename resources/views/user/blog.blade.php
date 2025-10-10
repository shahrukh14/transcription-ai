@extends('user.layouts.layout')
@section('title', 'FAQs')
@section('content')

<!-- shared hosting banner -->
<div class="rts-hosting-banner rts-hosting-banner-bg banner-default-height">
    <div class="container">
        <div class="row">
            <div class="banner-area">
                <div class="rts-hosting-banner rts-hosting-banner__content blog__banner">
                    <span class="starting__price">Blog & Article </span>
                    <h1 class="banner-title">
                        Latest News & Articale
                    </h1>
                    <p class="slogan">You can also do this by logging into a server directly, but the process requires some technical knowledge since a single mistake can break your entire site...</p>
                    <div class="hosting-action">
                        <a href="blog.details.php" class="btn__two secondary__bg secondary__color">View Details <i class="fa-regular fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="rts-hosting-banner__image blog">
                    <img src="{{ asset('user-assets/images/banner/banner__blog__image.svg') }}" alt="">
                    <img class="shape one left-right" src="{{ asset('user-assets/images/banner/banner__blog__image-sm1.svg') }}" alt="">
                    <img class="shape two show-hide" src="{{ asset('user-assets/images/banner/banner__blog__image-sm2.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shared hosting banner end-->

<!-- BLOG -->
<section class="rts-blog pt-120">
    <div class="container">
        <div class="row justify-content-sm-center justify-content-md-start g-30">
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.php">
                        <img class="blog__thumb" src="{{ asset('user-assets/images/blog/blog-1.png') }}" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.php" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{ asset('user-assets/images/author/author__one.png') }}" alt="">
                            </div>
                            <div class="author__content">
                                <a href="#">Mack jon</a>
                                <span>Developer & Web serenity </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.php">
                        <img class="blog__thumb" src="{{ asset('user-assets/images/blog/blog-2.png') }}" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.php" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{ asset('user-assets/images/author/author__two.png') }}" alt="">
                            </div>
                            <div class="author__content">
                                <a href="#">Zent jon</a>
                                <span>Developer </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.php">
                        <img class="blog__thumb" src="{{ asset('user-assets/images/blog/blog-3.png') }}" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.php" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{ asset('user-assets/images/author/author__three.png') }}" alt="">
                            </div>
                            <div class="author__content">
                                <a href="#">Ahmad Yeamin</a>
                                <span>Developer </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.php">
                        <img class="blog__thumb" src="{{ asset('user-assets/images/blog/blog-6.png') }}" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.php" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{ asset('user-assets/images/author/author__four.png') }}" alt="">
                            </div>
                            <div class="author__content">
                                <a href="#">Samira </a>
                                <span>Marketer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.php">
                        <img class="blog__thumb" src="{{ asset('user-assets/images/blog/blog-7.png') }}" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.php" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{ asset('user-assets/images/author/author__one.png') }}" alt="">
                            </div>
                            <div class="author__content">
                                <a href="#">Mack jon</a>
                                <span>Developer & Web serenity </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.php">
                        <img class="blog__thumb" src="{{ asset('user-assets/images/blog/blog-8.png') }}" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.php" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{ asset('user-assets/images/author/author__two.png') }}" alt="">
                            </div>
                            <div class="author__content">
                                <a href="#">Ashique Mahmud</a>
                                <span>Frontend Developer </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.php">
                        <img class="blog__thumb" src="{{ asset('user-assets/images/blog/blog-9.png') }}" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.php" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{ asset('user-assets/images/author/author__three.png') }}" alt="">
                            </div>
                            <div class="author__content">
                                <a href="#">Jhone Doe</a>
                                <span>Developer & Web serenity </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.php">
                        <img class="blog__thumb" src="{{ asset('user-assets/images/blog/blog-10.png') }}" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.php" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{ asset('user-assets/images/author/author__four.png') }}" alt="">
                            </div>
                            <div class="author__content">
                                <a href="#">Eliza Stella</a>
                                <span>Marketer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10">
                <div class="rts-blog__single">
                    <a href="blog-details.php">
                        <img class="blog__thumb" src="{{ asset('user-assets/images/blog/blog-11.png') }}" alt="blog post thumb">
                    </a>
                    <div class="rts-blog__single--meta">
                        <div class="cat__date">
                            <a href="#" class="cat">Web Hosting</a>
                            <span class="date">19 Sep, 2023</span>
                        </div>
                        <a href="blog-details.php" class="title">Attentive was born in 2015 help
                            sales teams VPS hosting</a>
                        <div class="rts-blog__single--author">
                            <div class="author">
                                <img src="{{ asset('user-assets/images/author/author__one.png') }}" alt="">
                            </div>
                            <div class="author__content">
                                <a href="#">Mack jon</a>
                                <span>Developer & Web serenity </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="blog-pagination-area mb-5">
            <ul>
                <li><a href="#"><i class="fa-regular fa-chevron-left"></i></a></li>
                <li><a class="active" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li>...</li>
                <li><a href="#">8</a></li>
                <li><a href="#">9</a></li>
                <li><a href="#"><i class="fa-regular fa-chevron-right"></i></a></li>
            </ul>
        </div>
    </div>
</section>
<!-- BLOG END -->
@endsection