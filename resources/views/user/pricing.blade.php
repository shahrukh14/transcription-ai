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
                            Compare Hostie Dedicated
                            Hosting Plans
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
                            <h4 class="plan-title">Basic Plan</h4>
                            <p class="description">Added privacy and security features</p>
                            <div class="border-separator"></div>
                            <div class="plan-feature">
                                <ul class="plan-feature__list">
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span>
                                        Free Domain ($9.99 value)
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Staging Environment
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> 24/7/365 Support
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-xmark"></i> </span> Free Domain ($9.99 value)
                                    </li>
                                </ul>
                            </div>
                            <button class="buy__plan btn__two">
                                Price: $12.36
                            </button>
                        </div>
                    </div>
                </div>
                <!-- single pricing end -->
                <!-- single pricing plan -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-plan has-box-shadow active">
                        <div class="single-plan__content">
                            <div class="plan-icon">
                                <svg width="43" height="39" viewBox="0 0 43 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M29.6658 15.2435L25.4688 7.55024H29.18L37.8846 15.2435H29.6658ZM12.822 7.55024H9.11078L0.41414 15.2435H8.63296L12.822 7.55024ZM27.85 15.2435L23.653 7.55024H14.6378L10.4487 15.2435H27.85ZM10.2735 16.8363L19.0897 39L28.0093 16.8363H10.2735ZM0 16.8363L16.5332 36.8656L8.56127 16.8363H0ZM29.7295 16.8363L21.7655 36.6108L38.2828 16.8363H29.7295ZM2.64439 3.78909H4.04469V5.18939C4.04469 5.40061 4.1286 5.60317 4.27795 5.75253C4.4273 5.90188 4.62987 5.98579 4.84109 5.98579C5.05231 5.98579 5.25487 5.90188 5.40423 5.75253C5.55358 5.60317 5.63749 5.40061 5.63749 5.18939V3.78909H7.0374C7.24862 3.78909 7.45118 3.70518 7.60054 3.55583C7.74989 3.40647 7.8338 3.20391 7.8338 2.99269C7.8338 2.78147 7.74989 2.5789 7.60054 2.42955C7.45118 2.2802 7.24862 2.19629 7.0374 2.19629H5.63749V0.796399C5.63749 0.585181 5.55358 0.382614 5.40423 0.23326C5.25487 0.0839063 5.05231 0 4.84109 0C4.62987 0 4.4273 0.0839063 4.27795 0.23326C4.1286 0.382614 4.04469 0.585181 4.04469 0.796399V2.19631H2.64439C2.43595 2.20051 2.23747 2.28626 2.09154 2.43516C1.94562 2.58405 1.86388 2.78422 1.86388 2.9927C1.86388 3.20118 1.94562 3.40135 2.09154 3.55024C2.23747 3.69914 2.43595 3.78489 2.64439 3.78909ZM41.3171 24.7136H39.9172V23.3133C39.9165 23.1025 39.8323 22.9005 39.683 22.7517C39.5338 22.6029 39.3316 22.5193 39.1208 22.5193C38.91 22.5193 38.7078 22.6029 38.5585 22.7517C38.4092 22.9005 38.325 23.1025 38.3244 23.3133V24.7136H36.9237C36.8189 24.7132 36.7151 24.7336 36.6182 24.7735C36.5212 24.8134 36.4332 24.872 36.359 24.946C36.2847 25.0199 36.2259 25.1078 36.1857 25.2046C36.1455 25.3014 36.1248 25.4052 36.1248 25.51C36.1248 25.6147 36.1455 25.7185 36.1857 25.8153C36.2259 25.9121 36.2847 26 36.359 26.074C36.4332 26.1479 36.5212 26.2066 36.6182 26.2464C36.7151 26.2863 36.8189 26.3067 36.9237 26.3064H38.3244V27.7063C38.324 27.8111 38.3444 27.9149 38.3843 28.0118C38.4242 28.1087 38.4828 28.1968 38.5568 28.271C38.6307 28.3452 38.7187 28.4041 38.8154 28.4443C38.9122 28.4844 39.016 28.5051 39.1208 28.5051C39.2256 28.5051 39.3293 28.4844 39.4261 28.4443C39.5229 28.4041 39.6108 28.3452 39.6848 28.271C39.7588 28.1968 39.8174 28.1087 39.8572 28.0118C39.8971 27.9149 39.9175 27.8111 39.9172 27.7063V26.3064H41.3171C41.5256 26.3023 41.7242 26.2165 41.8702 26.0676C42.0162 25.9187 42.098 25.7185 42.098 25.51C42.098 25.3014 42.0162 25.1012 41.8702 24.9523C41.7242 24.8034 41.5256 24.7177 41.3171 24.7136Z" fill="url(#paint0_linear_195_837)" />
                                    <defs>
                                        <linearGradient id="paint0_linear_195_837" x1="0" y1="19.5" x2="42.0981" y2="19.5" gradientUnits="userSpaceOnUse">
                                            <stop offset="10%" stop-color="#F0B400" />
                                            <stop offset="1" stop-color="#FFE1B1" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <h4 class="plan-title">Premium Plan</h4>
                            <p class="description">Added privacy and security features</p>
                            <div class="border-separator"></div>
                            <div class="plan-feature">
                                <ul class="plan-feature__list">
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span>
                                        24/7 Real-time Monitoring
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Regular Security Patching
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Unlimited Application Installation
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Free Object Cache Pro
                                    </li>
                                </ul>
                            </div>
                            <button class="buy__plan btn__two">
                                Price: $99.36
                            </button>
                        </div>
                    </div>
                </div>
                <!-- single pricing end -->
                <!-- single pricing plan -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-plan has-box-shadow">
                        <div class="single-plan__content">
                            <div class="plan-icon">
                                <svg width="31" height="39" viewBox="0 0 31 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3567 7.52352C16.5762 6.55271 14.4246 6.55271 12.6443 7.52352L3.10995 12.7224C1.19287 13.7677 0 15.7768 0 17.9605V27.78C0 29.9636 1.19287 31.9728 3.10995 33.018L12.6443 38.2169C14.4246 39.1876 16.5762 39.1876 18.3567 38.2169L27.891 33.018C29.8081 31.9728 31.001 29.9636 31.001 27.78V17.9605C31.001 15.7768 29.8081 13.7677 27.891 12.7224L18.3567 7.52352ZM15.5009 16.9041C14.9359 16.9041 14.5581 17.5818 13.8023 18.9375L13.6069 19.2883C13.3923 19.6736 13.2849 19.8661 13.1174 19.9931C12.95 20.1202 12.7416 20.1676 12.3245 20.2618L11.9449 20.3477C10.4773 20.6798 9.74359 20.8457 9.56902 21.4071C9.39445 21.9685 9.89466 22.5534 10.8951 23.7234L11.1539 24.0261C11.4382 24.3584 11.5803 24.5246 11.6444 24.7303C11.7082 24.9359 11.6867 25.1576 11.6438 25.6013L11.6046 26.005C11.4534 27.566 11.3778 28.3463 11.8347 28.6934C12.2919 29.0402 12.9788 28.724 14.3528 28.0914L14.7082 27.9277C15.0988 27.7479 15.2939 27.6581 15.5009 27.6581C15.7079 27.6581 15.903 27.7479 16.2936 27.9277L16.649 28.0914C18.023 28.724 18.7099 29.0402 19.1671 28.6934C19.6241 28.3463 19.5483 27.566 19.3972 26.005L19.358 25.6013C19.3151 25.1576 19.2936 24.9359 19.3574 24.7303C19.4215 24.5246 19.5637 24.3584 19.8478 24.0261L20.1068 23.7234C21.1071 22.5534 21.6075 21.9685 21.4328 21.4071C21.2582 20.8457 20.5244 20.6798 19.0569 20.3477L18.6773 20.2618C18.2603 20.1676 18.0518 20.1202 17.8844 19.9931C17.7169 19.8661 17.6095 19.6736 17.395 19.2883L17.1995 18.9375C16.4438 17.5818 16.0659 16.9041 15.5009 16.9041Z" fill="url(#paint0_linear_197_962)" />
                                    <path d="M13.5122 0H17.4897C21.2396 0 23.1146 -1.18537e-07 24.2795 1.16497C25.4445 2.32992 25.4445 4.2049 25.4445 7.95486V7.9906L19.7848 4.90449C17.1142 3.44831 13.8869 3.44829 11.2163 4.90449L5.55737 7.99016V7.95486C5.55737 4.2049 5.55737 2.32992 6.72234 1.16497C7.88729 -1.18537e-07 9.76227 0 13.5122 0Z" fill="url(#paint1_linear_197_962)" />
                                    <defs>
                                        <linearGradient id="paint0_linear_197_962" x1="15.5009" y1="-1.1999e-05" x2="15.5009" y2="38.945" gradientUnits="userSpaceOnUse">
                                            <stop offset="10%" stop-color="#9999FF" />
                                            <stop offset="1" stop-color="#2B2BFF" />
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_197_962" x1="15.501" y1="0" x2="15.501" y2="38.945" gradientUnits="userSpaceOnUse">
                                            <stop offset="10%" stop-color="#9999FF" />
                                            <stop offset="1" stop-color="#2B2BFF" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <h4 class="plan-title">Cloud Startup</h4>
                            <p class="description">Added privacy and security features</p>
                            <div class="border-separator"></div>
                            <div class="plan-feature">
                                <ul class="plan-feature__list">
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span>
                                        Free Object Cache Pro
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> HTTP/2 Enabled Servers
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> 24/7/365 Support
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Optimized With Advanced Caches
                                    </li>
                                </ul>
                            </div>
                            <button class="buy__plan btn__two">
                                Price: $55.36
                            </button>
                        </div>
                    </div>
                </div>
                <!-- single pricing end -->
            </div>
        </div>
        <div class="tab__content" id="yearly">
            <div class="row yearly g-30">
                <!-- single pricing plan -->
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
                            <h5 class="plan-title">Basic Plan</h5>
                            <p class="description">Added privacy and security features</p>
                            <div class="border-separator"></div>
                            <div class="plan-feature">
                                <ul class="plan-feature__list">
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span>
                                        Free Domain ($9.99 value)
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Staging Environment
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> 24/7/365 Support
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Free Domain ($9.99 value)
                                    </li>
                                </ul>
                            </div>
                            <button class="buy__plan btn__two">
                                Price: $144.36
                            </button>
                        </div>
                    </div>
                </div>
                <!-- single pricing end -->
                <!-- single pricing plan -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-plan has-box-shadow active">
                        <div class="single-plan__content">
                            <div class="plan-icon">
                                <svg width="43" height="39" viewBox="0 0 43 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M29.6658 15.2435L25.4688 7.55024H29.18L37.8846 15.2435H29.6658ZM12.822 7.55024H9.11078L0.41414 15.2435H8.63296L12.822 7.55024ZM27.85 15.2435L23.653 7.55024H14.6378L10.4487 15.2435H27.85ZM10.2735 16.8363L19.0897 39L28.0093 16.8363H10.2735ZM0 16.8363L16.5332 36.8656L8.56127 16.8363H0ZM29.7295 16.8363L21.7655 36.6108L38.2828 16.8363H29.7295ZM2.64439 3.78909H4.04469V5.18939C4.04469 5.40061 4.1286 5.60317 4.27795 5.75253C4.4273 5.90188 4.62987 5.98579 4.84109 5.98579C5.05231 5.98579 5.25487 5.90188 5.40423 5.75253C5.55358 5.60317 5.63749 5.40061 5.63749 5.18939V3.78909H7.0374C7.24862 3.78909 7.45118 3.70518 7.60054 3.55583C7.74989 3.40647 7.8338 3.20391 7.8338 2.99269C7.8338 2.78147 7.74989 2.5789 7.60054 2.42955C7.45118 2.2802 7.24862 2.19629 7.0374 2.19629H5.63749V0.796399C5.63749 0.585181 5.55358 0.382614 5.40423 0.23326C5.25487 0.0839063 5.05231 0 4.84109 0C4.62987 0 4.4273 0.0839063 4.27795 0.23326C4.1286 0.382614 4.04469 0.585181 4.04469 0.796399V2.19631H2.64439C2.43595 2.20051 2.23747 2.28626 2.09154 2.43516C1.94562 2.58405 1.86388 2.78422 1.86388 2.9927C1.86388 3.20118 1.94562 3.40135 2.09154 3.55024C2.23747 3.69914 2.43595 3.78489 2.64439 3.78909ZM41.3171 24.7136H39.9172V23.3133C39.9165 23.1025 39.8323 22.9005 39.683 22.7517C39.5338 22.6029 39.3316 22.5193 39.1208 22.5193C38.91 22.5193 38.7078 22.6029 38.5585 22.7517C38.4092 22.9005 38.325 23.1025 38.3244 23.3133V24.7136H36.9237C36.8189 24.7132 36.7151 24.7336 36.6182 24.7735C36.5212 24.8134 36.4332 24.872 36.359 24.946C36.2847 25.0199 36.2259 25.1078 36.1857 25.2046C36.1455 25.3014 36.1248 25.4052 36.1248 25.51C36.1248 25.6147 36.1455 25.7185 36.1857 25.8153C36.2259 25.9121 36.2847 26 36.359 26.074C36.4332 26.1479 36.5212 26.2066 36.6182 26.2464C36.7151 26.2863 36.8189 26.3067 36.9237 26.3064H38.3244V27.7063C38.324 27.8111 38.3444 27.9149 38.3843 28.0118C38.4242 28.1087 38.4828 28.1968 38.5568 28.271C38.6307 28.3452 38.7187 28.4041 38.8154 28.4443C38.9122 28.4844 39.016 28.5051 39.1208 28.5051C39.2256 28.5051 39.3293 28.4844 39.4261 28.4443C39.5229 28.4041 39.6108 28.3452 39.6848 28.271C39.7588 28.1968 39.8174 28.1087 39.8572 28.0118C39.8971 27.9149 39.9175 27.8111 39.9172 27.7063V26.3064H41.3171C41.5256 26.3023 41.7242 26.2165 41.8702 26.0676C42.0162 25.9187 42.098 25.7185 42.098 25.51C42.098 25.3014 42.0162 25.1012 41.8702 24.9523C41.7242 24.8034 41.5256 24.7177 41.3171 24.7136Z" fill="url(#paint0_linear_195_838)" />
                                    <defs>
                                        <linearGradient id="paint0_linear_195_838" x1="0" y1="19.5" x2="42.0981" y2="19.5" gradientUnits="userSpaceOnUse">
                                            <stop offset="10%" stop-color="#F0B400" />
                                            <stop offset="1" stop-color="#FFE1B1" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <h5 class="plan-title">Premium Plan</h5>
                            <p class="description">Added privacy and security features</p>
                            <div class="border-separator"></div>
                            <div class="plan-feature">
                                <ul class="plan-feature__list">
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span>
                                        24/7 Real-time Monitoring
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Regular Security Patching
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Unlimited Application Installation
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Free Object Cache Pro
                                    </li>
                                </ul>
                            </div>
                            <button class="buy__plan btn__two">
                                Price: $1000.36
                            </button>
                        </div>
                    </div>
                </div>
                <!-- single pricing end -->
                <!-- single pricing plan -->
                <div class="col-lg-4 col-md-6">
                    <div class="single-plan has-box-shadow">
                        <div class="single-plan__content">
                            <div class="plan-icon">
                                <svg width="31" height="39" viewBox="0 0 31 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3567 7.52352C16.5762 6.55271 14.4246 6.55271 12.6443 7.52352L3.10995 12.7224C1.19287 13.7677 0 15.7768 0 17.9605V27.78C0 29.9636 1.19287 31.9728 3.10995 33.018L12.6443 38.2169C14.4246 39.1876 16.5762 39.1876 18.3567 38.2169L27.891 33.018C29.8081 31.9728 31.001 29.9636 31.001 27.78V17.9605C31.001 15.7768 29.8081 13.7677 27.891 12.7224L18.3567 7.52352ZM15.5009 16.9041C14.9359 16.9041 14.5581 17.5818 13.8023 18.9375L13.6069 19.2883C13.3923 19.6736 13.2849 19.8661 13.1174 19.9931C12.95 20.1202 12.7416 20.1676 12.3245 20.2618L11.9449 20.3477C10.4773 20.6798 9.74359 20.8457 9.56902 21.4071C9.39445 21.9685 9.89466 22.5534 10.8951 23.7234L11.1539 24.0261C11.4382 24.3584 11.5803 24.5246 11.6444 24.7303C11.7082 24.9359 11.6867 25.1576 11.6438 25.6013L11.6046 26.005C11.4534 27.566 11.3778 28.3463 11.8347 28.6934C12.2919 29.0402 12.9788 28.724 14.3528 28.0914L14.7082 27.9277C15.0988 27.7479 15.2939 27.6581 15.5009 27.6581C15.7079 27.6581 15.903 27.7479 16.2936 27.9277L16.649 28.0914C18.023 28.724 18.7099 29.0402 19.1671 28.6934C19.6241 28.3463 19.5483 27.566 19.3972 26.005L19.358 25.6013C19.3151 25.1576 19.2936 24.9359 19.3574 24.7303C19.4215 24.5246 19.5637 24.3584 19.8478 24.0261L20.1068 23.7234C21.1071 22.5534 21.6075 21.9685 21.4328 21.4071C21.2582 20.8457 20.5244 20.6798 19.0569 20.3477L18.6773 20.2618C18.2603 20.1676 18.0518 20.1202 17.8844 19.9931C17.7169 19.8661 17.6095 19.6736 17.395 19.2883L17.1995 18.9375C16.4438 17.5818 16.0659 16.9041 15.5009 16.9041Z" fill="url(#paint0_linear_197_963)" />
                                    <path d="M13.5122 0H17.4897C21.2396 0 23.1146 -1.18537e-07 24.2795 1.16497C25.4445 2.32992 25.4445 4.2049 25.4445 7.95486V7.9906L19.7848 4.90449C17.1142 3.44831 13.8869 3.44829 11.2163 4.90449L5.55737 7.99016V7.95486C5.55737 4.2049 5.55737 2.32992 6.72234 1.16497C7.88729 -1.18537e-07 9.76227 0 13.5122 0Z" fill="url(#paint1_linear_197_963)" />
                                    <defs>
                                        <linearGradient id="paint0_linear_197_963" x1="15.5009" y1="-1.1999e-05" x2="15.5009" y2="38.945" gradientUnits="userSpaceOnUse">
                                            <stop offset="10%" stop-color="#9999FF" />
                                            <stop offset="1" stop-color="#2B2BFF" />
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_197_963" x1="15.501" y1="0" x2="15.501" y2="38.945" gradientUnits="userSpaceOnUse">
                                            <stop offset="10%" stop-color="#9999FF" />
                                            <stop offset="1" stop-color="#2B2BFF" />
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            <h5 class="plan-title">Cloud Startup</h5>
                            <p class="description">Added privacy and security features</p>
                            <div class="border-separator"></div>
                            <div class="plan-feature">
                                <ul class="plan-feature__list">
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span>
                                        Free Object Cache Pro
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> HTTP/2 Enabled Servers
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> 24/7/365 Support
                                    </li>
                                    <li>
                                        <span><i class="fa-solid fa-check"></i> </span> Optimized With Advanced Caches
                                    </li>
                                </ul>
                            </div>
                            <button class="buy__plan btn__two">
                                Price: $448.36
                            </button>
                        </div>
                    </div>
                </div>
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