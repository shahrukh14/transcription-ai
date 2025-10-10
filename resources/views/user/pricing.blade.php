@extends('user.layouts.layout')
@section('title', 'Pricing')
@section('content')
<!-- shared hosting banner -->
<div class="rts-hosting-banner rts-hosting-banner-bg banner-default-height">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-area">
                    <div class="rts-hosting-banner rts-hosting-banner__content pricing__banner">
                        <span class="starting__price" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">Comparison Pricing</span>
                        <h1 class="banner-title" data-sal="slide-down" data-sal-delay="200" data-sal-duration="800">
                            Compare Hostie Dedicated Hosting Plans
                        </h1>
                        <div class="feature mb-0" data-sal="slide-down" data-sal-delay="300" data-sal-duration="800">
                            <ul class="feature__list">
                                <li class="feature__item">24/7 Customer Support</li>
                                <li class="feature__item">Free Domain</li>
                                <li class="feature__item">Free Website Migration</li>
                            </ul>
                        </div>
                    </div>
                    <div class="rts-hosting-banner__image pricing-compare">
                        <img src="{{ asset('user-assets/images/banner/pricing/banner__pricing__image.svg') }}" alt="">
                        <div class="shape__image">
                            <img src="{{ asset('user-assets/images/banner/pricing/shape__star.svg') }}" alt="" class="shape__image--one show-hide">
                            <img src="{{ asset('user-assets/images/banner/pricing/shape__dollar.svg') }}" alt="" class="shape__image--two top-bottom">
                            <img src="{{ asset('user-assets/images/banner/pricing/shape__dollar-2.svg') }}" alt="" class="shape__image--three">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shared hosting banner end-->

<!-- PRICING PLAN -->
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
                <!-- single pricing end -->
            </div>
        </div>

    </div>
</div>
<!-- PRICING PLAN END -->


<!-- HOSTIE CTA -->
<div class="rts-cta-two shared-page-bg mt-5">
    <div class="">
        <div class="row">
            <div class="rts-cta-two__wrapper">
                <div class="cta__shape"></div>
                <div class="cta-content">
                    <span data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">Need help choosing a plan?</span>
                    <h4 data-sal="slide-down" data-sal-delay="200" data-sal-duration="800">Need help?
                        We're always here for you.</h4>
                </div>
                <div class="cta-btn">
                    <a href="#" class="contact__us primary__btn btn__two secondary__bg secondary__color">Go to Live chat Page</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- HOSTIE CTA END -->
@endsection