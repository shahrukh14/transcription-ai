@extends('user.layouts.layout')
@section('title', 'Home')
@section('content')
<!-- BEGIN: Content-->
 <!-- HERO BANNER four -->
 @if($banners->isNotEmpty())
 <section class="rts-hero-four rts-hero__four mern__hosting">
     <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-inner">
             @php $active = true; @endphp
             @foreach($banners as $banner)
                 @foreach(['banner_img1', 'banner_img2', 'banner_img3'] as $imgField)
                     @if(!empty($banner->$imgField))
                         <div class="carousel-item custom-carousel-item  {{ $active ? 'active' : '' }}" style="background-image: url('{{ asset('landing-assets/images/banner_img/'.$banner->$imgField) }}');">
                             <div class="container">
                                 <div class="row g-5 justify-content-between align-items-center carouselContent">
                                     <div class="col-lg-8 col-xl-6 col-md-10">
                                         <div class="rts-hero-four__content" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">
                                             {{-- <p class="offer">Up to <span class="off">78%</span> off MERN Hosting</p> --}}
                                             <h1 class="banner__title" data-sal="slide-down" data-sal-delay="500" data-sal-duration="800">
                                                 {{-- MERN Stack Hosting --}}
                                             </h1>
                                             <p class="description" data-sal="slide-down" data-sal-delay="600" data-sal-duration="800">
                                                 {{-- Find hosting tailored for MERN Stack applications, offering full support for MongoDB, Express.js, React, and Node.js. --}}
                                             </p>
                                             <div class="feature" data-sal="slide-down" data-sal-delay="700" data-sal-duration="800">
                                                 {{-- <ul class="feature__list">
                                                     <li class="feature__item"></li>
                                                     <li class="feature__item"></li>
                                                     <li class="feature__item"></li>
                                                     <li class="feature__item"></li>
                                                     <li class="feature__item"></li>
                                                 </ul> --}}
                                             </div>
                                             <div class="banner-buttons" data-sal="slide-down" data-sal-delay="800" data-sal-duration="800">
                                                 {{-- <a href="pricing.php" class="rts-btn btn__long secondary__bg secondary__color">get started <i class="fa-solid fa-chevron-right"></i></a> --}}
                                                 {{-- <a href="contact.php" class="rts-btn btn__long border__white white__color">contact us <i class="fa-solid fa-chevron-right"></i></a> --}}
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         @php $active = false; @endphp
                     @endif
                 @endforeach
             @endforeach
         </div>
         <!-- Carousel controls -->
         <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
             <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
             <span class="carousel-control-next-icon" aria-hidden="true"></span>
             <span class="visually-hidden">Next</span>
         </button>
     </div>
 </section>
 @endif
 
 
    <!-- HERO BANNER four END -->
    <!-- WHY CHOOSE US -->
    <section class="rts-whychoose section__padding carouselpadding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 order-change">
                    <div class="rts-whychoose__content">
                        <h3 class="rts-whychoose__content--title sal-animate" data-sal="slide-down" data-sal-delay="300" data-sal-duration="800">
                            Why Choose MERN Hosting for Your Hosting Needs
                        </h3>

                        <!-- single content-->
                        <div class="single sal-animate" data-sal="slide-right" data-sal-delay="300" data-sal-duration="800">
                            <div class="single__image">
                                <img src="{{ asset('user-assets/images/icon/speed.svg') }}" alt="">
                            </div>
                            <div class="single__content">
                                <h6>Up To 20xFaster Turbo</h6>
                                <p>That means better SEO rankings, lower bounce
                                    rates &amp; higher conversion rates!</p>
                            </div>
                        </div>
                        <!-- single content-->
                        <div class="single sal-animate" data-sal="slide-right" data-sal-delay="400" data-sal-duration="800">
                            <div class="single__image bg1">
                                <img src="{{ asset('user-assets/images/icon/support.svg') }}" alt="">
                            </div>
                            <div class="single__content">
                                <h6>24/7 Expert Support</h6>
                                <p>Our knowledgeable and friendly support team
                                    is available 24/7/365 to help!</p>
                            </div>
                        </div>
                        <!-- single content-->
                        <div class="single sal-animate" data-sal="slide-right" data-sal-delay="500" data-sal-duration="800">
                            <div class="single__image">
                                <img src="{{ asset('user-assets/images/icon/money-back.svg') }}" alt="">
                            </div>
                            <div class="single__content">
                                <h6>Money-Back Guarantee</h6>
                                <p>Give our high-speed hosting service a try
                                    completely risk-free!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="rts-whychoose__image">
                        <img src="{{ asset('user-assets/images/whychoose.svg') }}" alt="">
                        <img src="{{ asset('user-assets/images/paper-plane.svg') }}" alt="" class="shape one bottom-top">
                        <img src="{{ asset('user-assets/images/wifi.svg') }}" alt="" class="shape two right-left">
                    </div>
                </div>
            </div>
        </div>
        <div class="rts-shape">
            <div class="rts-shape__one"></div>
        </div>
    </section>
    <!-- WHY CHOOSE US END -->

    <!-- PRICING PLAN START -->
    <div class="rts-pricing-plan pt--120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="rts-section w-550 text-center">
                    <h2 class="rts-section__title">Unleash Online Growth
                        Not Budgets.</h2>
                    <p class="rts-section__description">shared hosting is the easiest, most economical</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-4 col-md-5">
                    <div class="rts-pricing-plan__tab plan__tab--shadow">
                        <div class="tab__button">
                            <div class="tab__button__item">
                                <button class="active tab__btn" data-tab="monthly">monthly</button>
                                <button class="tab__btn" data-tab="yearly">yearly</button>
                            </div>
                        </div>
                        <div class="discount">
                            <span class="line">
                                <img src="{{ asset('user-assets/images/pricing/offer__vactor.svg') }}" height="20" width="85" alt="">
                            </span>
                            <p>20% save</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PRICING PLAN -->
            <div class="tab__content open" id="monthly">
                <div class="row monthly g-30">
                    @foreach ($monthlyPackages as $monthly)
                    <!-- single pricing plan -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-plan has-box-shadow">
                            <div class="single-plan__content">
                                <div class="plan-icon">
                                    <svg width="40" height="39" viewBox="0 0 40 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M36.5877 20.7647L37.5973 16.9971C38.7756 12.5992 39.3648 10.4002 38.9211 8.49722C38.5709 6.99464 37.7828 5.6297 36.6567 4.57499C35.2305 3.23924 33.0314 2.65003 28.6336 1.4716C24.2357 0.293177 22.0366 -0.296027 20.1337 0.14769C18.6311 0.498029 17.2661 1.28608 16.2115 2.41218C15.0678 3.63324 14.4714 5.42081 13.5839 8.66997C13.4349 9.21563 13.2775 9.80292 13.1081 10.4352L12.0986 14.2028C10.9201 18.6007 10.3309 20.7996 10.7746 22.7027C11.125 24.2053 11.913 25.5703 13.0391 26.625C14.4653 27.9607 16.6643 28.5498 21.0623 29.7284C25.0263 30.7905 27.2037 31.374 28.9884 31.1538C29.1838 31.1298 29.3743 31.0961 29.5621 31.0522C31.0646 30.7019 32.4296 29.9138 33.4843 28.7878C34.82 27.3616 35.4093 25.1627 36.5877 20.7647Z" fill="url(#paint0_linear_193_834)" />
                                        <path d="M2.34746 24.7972L3.35698 28.5649C4.53541 32.9628 5.12461 35.1617 6.46036 36.5879C7.51507 37.714 8.88002 38.5021 10.3826 38.8523C12.2856 39.296 14.4845 38.7069 18.8825 37.5285C23.2803 36.35 25.4794 35.7608 26.9056 34.4251C27.024 34.3141 27.1385 34.1999 27.2494 34.0825C26.5977 34.0277 25.9402 33.9227 25.2721 33.7899C23.9145 33.52 22.3015 33.0878 20.3938 32.5767L20.1371 32.5078C18.0615 31.9516 16.3272 31.4861 14.9424 30.9859C13.4862 30.4597 12.163 29.8113 11.0395 28.7589C9.49107 27.3087 8.40752 25.4318 7.92577 23.3659C7.57621 21.8666 7.67614 20.3965 7.94868 18.8722C8.20986 17.4117 8.67893 15.6613 9.24091 13.5641L10.3198 9.53784C6.57424 10.5468 4.60277 11.1438 3.28804 12.3752C2.16193 13.4299 1.37388 14.7948 1.02354 16.2973C0.579827 18.2003 1.16903 20.3992 2.34746 24.7972Z" fill="url(#paint1_linear_193_834)" />
                                        <defs>
                                            <linearGradient id="paint0_linear_193_834" x1="19.9725" y1="-1.61164e-06" x2="19.9725" y2="39.0008" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#9999FF" />
                                                <stop offset="1" stop-color="#2B2BFF" />
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_193_834" x1="19.9725" y1="-6.84369e-06" x2="19.9725" y2="39.0008" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#9999FF" />
                                                <stop offset="1" stop-color="#2B2BFF" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                <h4 class="plan-title">{{$monthly->name}}</h4>
                                <p class="description">Added privacy and security features</p>
                                <div class="border-separator"></div>
                                <div class="plan-feature">
                                    <ul class="plan-feature__list">
                                        @foreach (json_decode($monthly->description) as $description)
                                        <li>
                                            <span>
                                                <img src="{{asset('admin/packages/descriptions/'.$description->image)}}" alt="" width="40" height="50">
                                            </span>
                                            {{$description->title}}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if(auth()->user() && $monthly->id == auth()->user()->currentSubscription->id)
                                    <button class="buy__plan btn__two" disabled>CURRENT PALN</button>
                                @else
                                    <button class="buy__plan btn__two">₹{{$monthly->amount}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- single pricing end -->
                    @endforeach
                </div>
            </div>
            <div class="tab__content" id="yearly">
                <div class="row yearly g-30">
                    <!-- single pricing plan -->
                    @foreach ($yearlyPackages as $yearly)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-plan has-box-shadow">
                            <div class="single-plan__content">
                                <div class="plan-icon">
                                    <svg width="40" height="39" viewBox="0 0 40 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M36.5877 20.7647L37.5973 16.9971C38.7756 12.5992 39.3648 10.4002 38.9211 8.49722C38.5709 6.99464 37.7828 5.6297 36.6567 4.57499C35.2305 3.23924 33.0314 2.65003 28.6336 1.4716C24.2357 0.293177 22.0366 -0.296027 20.1337 0.14769C18.6311 0.498029 17.2661 1.28608 16.2115 2.41218C15.0678 3.63324 14.4714 5.42081 13.5839 8.66997C13.4349 9.21563 13.2775 9.80292 13.1081 10.4352L12.0986 14.2028C10.9201 18.6007 10.3309 20.7996 10.7746 22.7027C11.125 24.2053 11.913 25.5703 13.0391 26.625C14.4653 27.9607 16.6643 28.5498 21.0623 29.7284C25.0263 30.7905 27.2037 31.374 28.9884 31.1538C29.1838 31.1298 29.3743 31.0961 29.5621 31.0522C31.0646 30.7019 32.4296 29.9138 33.4843 28.7878C34.82 27.3616 35.4093 25.1627 36.5877 20.7647Z" fill="url(#paint0_linear_193_835)" />
    
                                        <path d="M2.34746 24.7972L3.35698 28.5649C4.53541 32.9628 5.12461 35.1617 6.46036 36.5879C7.51507 37.714 8.88002 38.5021 10.3826 38.8523C12.2856 39.296 14.4845 38.7069 18.8825 37.5285C23.2803 36.35 25.4794 35.7608 26.9056 34.4251C27.024 34.3141 27.1385 34.1999 27.2494 34.0825C26.5977 34.0277 25.9402 33.9227 25.2721 33.7899C23.9145 33.52 22.3015 33.0878 20.3938 32.5767L20.1371 32.5078C18.0615 31.9516 16.3272 31.4861 14.9424 30.9859C13.4862 30.4597 12.163 29.8113 11.0395 28.7589C9.49107 27.3087 8.40752 25.4318 7.92577 23.3659C7.57621 21.8666 7.67614 20.3965 7.94868 18.8722C8.20986 17.4117 8.67893 15.6613 9.24091 13.5641L10.3198 9.53784C6.57424 10.5468 4.60277 11.1438 3.28804 12.3752C2.16193 13.4299 1.37388 14.7948 1.02354 16.2973C0.579827 18.2003 1.16903 20.3992 2.34746 24.7972Z" fill="url(#paint1_linear_193_835)" />
    
                                        <defs>
                                            <linearGradient id="paint0_linear_193_835" x1="19.9725" y1="-1.61164e-06" x2="19.9725" y2="39.0008" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#9999FF" />
                                                <stop offset="1" stop-color="#2B2BFF" />
                                            </linearGradient>
                                            <linearGradient id="paint1_linear_193_835" x1="19.9725" y1="-6.84369e-06" x2="19.9725" y2="39.0008" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#9999FF" />
                                                <stop offset="1" stop-color="#2B2BFF" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </div>
                                <h4 class="plan-title">{{$yearly->name}}</h4>
                                <p class="description">Added privacy and security features</p>
                                <div class="border-separator"></div>
                                <div class="plan-feature">
                                    <ul class="plan-feature__list">
                                        @foreach (json_decode($yearly->description) as $description)
                                        <li>
                                            <span>
                                                <img src="{{asset('admin/packages/descriptions/'.$description->image)}}" alt="" width="40" height="50">
                                            </span>
                                            {{$description->title}}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if(auth()->user() && $yearly->id == auth()->user()->currentSubscription->id)
                                    <button class="buy__plan btn__two" disabled>CURRENT PALN</button>
                                @else
                                    <button class="buy__plan btn__two">₹{{$yearly->amount}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="rts-client-feedback section__padding section_padding" id="testimonial">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="rts-section w-500 text-center mb-2">
                            <h2 class="rts-section__title" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">Testimonials</h2>
                        </div>
                    </div>
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" data-bs-wrap="true">
                        <div class="carousel-inner">
                            @foreach(array_chunk($testimonials->toArray(), 3) as $index => $chunk)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach($chunk as $testimonial)
                                            <div class="col-md-4">
                                                <div class="feedback-card">
                                                    <div class="feedback-card__border"></div>
                                                    <div class="feedback-card__single text-center">
                                                        <p class="feedback-card__single--text mb-3">{{ $testimonial['title'] }}</p>
                                                        <div class="author">
                                                            <img src="{{ asset('admin/testimonials/' . $testimonial['image']) }}" class="round-image" alt="">
                                                        </div>
                                                        <div class="author__meta">
                                                            <span>{!! $testimonial['description'] !!}</span> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
            
                        <!-- Carousel Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<!-- END: Content-->
@endsection
@push('style')
<style>
.rts-hero-four.mern__hosting {
    
    padding: 0px 0px !important;
}
.carouselContent{
    padding: 50px;
}
.carouselpadding{
    padding: 60px 0;
}
.custom-carousel-item {
    height: 100%;
    min-height: 550px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}
.section__padding {
    padding: 50px 0;
}
.round-image {
    width: 50px;          
    height: 50px;        
    border-radius: 50%; 
}
.feedback-card__single {
    display: flex;
    flex-direction: column; 
    justify-content: center; 
    align-items: center; 
    text-align: center; 
}

.round-image {
    width: 80px;
    height: 80px; 
    border-radius: 50%; 
    object-fit: cover; 
}

.feedback-card__single--text {
    margin-bottom: 10px;
}
.rts-client-feedback .feedback-card {
    max-height: 500px;
}
</style>
@endpush

