@extends('user.layouts.layout')
@section('title', 'Home')
@section('content')
<!-- BEGIN: Content-->
 <!-- HERO BANNER four -->
 <section class="rts-hero-four rts-hero__four mern__hosting" style="background-image: url({{ asset('user-assets/images/banner/banner__ten.jpg') }});">
        <div class="container">
            <div class="row g-5 justify-content-between align-items-center">
                <div class="col-lg-8 col-xl-6 col-md-10">
                    <div class="rts-hero-four__content" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">
                        <p class="offer">Up to <span class="off">78%</span> off MERN Hosting</p>
                        <h1 class="banner__title" data-sal="slide-down" data-sal-delay="500" data-sal-duration="800">
                            MERN Stack Hosting
                        </h1>
                        <p class="description" data-sal="slide-down" data-sal-delay="600" data-sal-duration="800">Find hosting tailored for MERN Stack applications, offering full support for MongoDB, Express.js, React, and Node.js.
                        </p>
                        <div class="feature" data-sal="slide-down" data-sal-delay="700" data-sal-duration="800">
                            <ul class="feature__list">
                                <li class="feature__item">Node.js Supported </li>
                                <li class="feature__item"> MongoDB Supported </li>
                                <li class="feature__item"> Litespeed Web Server </li>
                                <li class="feature__item"> 99.99% Uptime </li>
                                <li class="feature__item"> 24/7/365 Day Support </li>
                            </ul>
                        </div>
                        <div class="banner-buttons" data-sal="slide-down" data-sal-delay="800" data-sal-duration="800">
                            <a href="pricing.php" class="rts-btn btn__long secondary__bg secondary__color">get started <i class="fa-solid fa-chevron-right"></i></a>
                            <a href="contact.php" class="rts-btn btn__long border__white white__color">contact us <i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- HERO BANNER four END -->
    <!-- WHY CHOOSE US -->
    <section class="rts-whychoose section__padding">
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
    <div class="rts-pricing-plan alice__blue section__padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="rts-section w-500 text-center">
                    <h2 class="rts-section__title" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">MERN Hosting Plan</h2>
                    <p class="rts-section__description" data-sal="slide-down" data-sal-delay="200" data-sal-duration="800">Globally incubate next-generation e-services via state of the art technology.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-5">
                        <div class="rts-pricing-plan__tab plan__tab">
                            <div class="tab__button">
                                <div class="tab__button__item">
                                    <button class="active tab__price text-white" data-tab="monthly">monthly</button>
                                    <button class="tab__price text-white" data-tab="yearly">yearly</button>
                                </div>
                            </div>
                            <div class="discount">
                                <span class="line"><img src="{{ asset('user-assets/images/pricing/offer__vactor.svg') }}" height="20" width="85" alt=""></span>
                                <p>20% save</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRICING PLAN -->
                <div class="price__content open" id="monthly">
                    <div class="row g-30 monthly">
                        <!-- single card -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card-plan">
                                <div class="card-plan__package">
                                    <div class="icon">
                                        <img src="{{ asset('user-assets/images/pricing/basic.svg') }}" height="30" width="30" alt="">
                                    </div>
                                    <h4 class="package__name">Basic</h4>
                                </div>
                                <p class="card-plan__desc">Everything need to your website</p>
                                <div class="card-plan__offer">
                                    <span class="past-price">$6.63</span>
                                    <span class="offer-given">Save 60%</span>
                                </div>
                                <h5 class="card-plan__price">
                                    <sup>$</sup> 3.63 <sub>/ month</sub>
                                </h5>
                                <div class="card-plan__cartbtn">
                                    <a href="#">add to cart</a>
                                </div>
                                <p class="card-plan__renew-price">
                                    $ 6.99 /mo when you renew
                                </p>
                                <div class="card-plan__feature">
                                    <ul class="card-plan__feature--list">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Explore, discover, and learn on our innovative and informative website."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Standard Performance</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 24/7/365 Support</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Free Email</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Unlimited Bandwidth</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> 100 GB SSD Storage</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i class="fa-light fa-circle-question"></i></span>
                                        </li>


                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free SSL</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime Guarantee</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Web Application Firewall</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">More Features <i class="fa-sharp fa-regular fa-chevron-down"></i>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="card-plan__feature--list more__feature">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> LiteSpeed with LSCache </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Terminal Access </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  MongoDB Databases </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Node.js Available </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Python Available  </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">See less Features <i class="fa-sharp fa-regular fa-chevron-up"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single card end -->
                        <!-- single card -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card-plan">
                                <div class="card-plan__package">
                                    <div class="icon">
                                        <img src="{{ asset('user-assets/images/pricing/premium.svg') }}" height="30" width="30" alt="">
                                    </div>
                                    <h4 class="package__name">Premium</h4>
                                </div>
                                <p class="card-plan__desc">Level-up more power features</p>
                                <div class="card-plan__offer">
                                    <span class="past-price">$12.63</span>
                                    <span class="offer-given">Save 60%</span>
                                </div>
                                <h5 class="card-plan__price">
                                    <sup>$</sup> 6.63 <sub>/ month</sub>
                                </h5>
                                <div class="card-plan__cartbtn">
                                    <a href="#">add to cart</a>
                                </div>
                                <p class="card-plan__renew-price">
                                    $ 6.99 /mo when you renew
                                </p>
                                <div class="card-plan__feature">
                                    <ul class="card-plan__feature--list">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Explore, discover, and learn on our innovative and informative website."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Standard Performance</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 24/7/365 Support</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Free Email</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Unlimited Bandwidth</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> 100 GB SSD Storage</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i class="fa-light fa-circle-question"></i></span>
                                        </li>


                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free SSL</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime Guarantee</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Web Application Firewall</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">More Features <i class="fa-sharp fa-regular fa-chevron-down"></i>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="card-plan__feature--list more__feature">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> LiteSpeed with LSCache </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Terminal Access </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  MongoDB Databases </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Node.js Available </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Python Available  </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">See less Features <i class="fa-sharp fa-regular fa-chevron-up"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single card end -->
                        <!-- single card -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card-plan active">
                                <div class="popular-tag">most popular</div>
                                <div class="card-plan__package">
                                    <div class="icon">
                                        <img src="{{ asset('user-assets/images/pricing/business.svg') }}" height="30" width="30" alt="">
                                    </div>
                                    <h4 class="package__name">Business</h4>
                                </div>
                                <p class="card-plan__desc">Everything need to your website</p>
                                <div class="card-plan__offer">
                                    <span class="past-price">$19.63</span>
                                    <span class="offer-given">Save 60%</span>
                                </div>
                                <h5 class="card-plan__price">
                                    <sup>$</sup> 8.63 <sub>/ month</sub>
                                </h5>
                                <div class="card-plan__cartbtn">
                                    <a href="#">add to cart</a>
                                </div>
                                <p class="card-plan__renew-price">
                                    $ 6.99 /mo when you renew
                                </p>
                                <div class="card-plan__feature">
                                    <ul class="card-plan__feature--list">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Explore, discover, and learn on our innovative and informative website."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Standard Performance</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 24/7/365 Support</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Free Email</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Unlimited Bandwidth</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 100 GB SSD Storage</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i class="fa-light fa-circle-question"></i></span>
                                        </li>


                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free SSL</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime Guarantee</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Web Application Firewall</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">More Features <i class="fa-sharp fa-regular fa-chevron-down"></i>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="card-plan__feature--list more__feature">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> LiteSpeed with LSCache </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Terminal Access </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  MongoDB Databases </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Node.js Available </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Python Available  </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">See less Features <i class="fa-sharp fa-regular fa-chevron-up"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single card end -->
                        <!-- single card -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card-plan ">

                                <div class="card-plan__package">
                                    <div class="icon">
                                        <img src="{{ asset('user-assets/images/pricing/cloud.svg') }}" height="30" width="30" alt="">
                                    </div>
                                    <h4 class="package__name">Cloud Startup</h4>
                                </div>
                                <p class="card-plan__desc">Everything need to your website</p>
                                <div class="card-plan__offer">
                                    <span class="past-price">$29.63</span>
                                    <span class="offer-given">Save 60%</span>
                                </div>
                                <h5 class="card-plan__price">
                                    <sup>$</sup> 11.63 <sub>/ month</sub>
                                </h5>
                                <div class="card-plan__cartbtn">
                                    <a href="#">add to cart</a>
                                </div>
                                <p class="card-plan__renew-price">
                                    $ 6.99 /mo when you renew
                                </p>
                                <div class="card-plan__feature">
                                    <ul class="card-plan__feature--list">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Explore, discover, and learn on our innovative and informative website."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Standard Performance</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 24/7/365 Support</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Free Email</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Unlimited Bandwidth</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 100 GB SSD Storage</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i class="fa-light fa-circle-question"></i></span>
                                        </li>


                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free SSL</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime Guarantee</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Web Application Firewall</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">More Features <i class="fa-sharp fa-regular fa-chevron-down"></i>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="card-plan__feature--list more__feature">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> LiteSpeed with LSCache </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Terminal Access </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  MongoDB Databases </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Node.js Available </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Python Available  </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">See less Features <i class="fa-sharp fa-regular fa-chevron-up"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single card end -->
                    </div>
                </div>

                <!-- PRICING PLAN -->
                <div class="price__content" id="yearly">
                    <div class="row g-30 yearly">
                        <!-- single card -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card-plan">
                                <div class="card-plan__package">
                                    <div class="icon">
                                        <img src="{{ asset('user-assets/images/pricing/basic.svg') }}" height="30" width="30" alt="">
                                    </div>
                                    <h4 class="package__name">Basic</h4>
                                </div>
                                <p class="card-plan__desc">Everything need to your website</p>
                                <div class="card-plan__offer">
                                    <span class="past-price">$79.63</span>
                                    <span class="offer-given">Save 60%</span>
                                </div>
                                <h5 class="card-plan__price">
                                    <sup>$</sup> 36.63 <sub>/ month</sub>
                                </h5>
                                <div class="card-plan__cartbtn">
                                    <a href="#">add to cart</a>
                                </div>
                                <p class="card-plan__renew-price">
                                    $ 79.99 /year when you renew
                                </p>
                                <div class="card-plan__feature">
                                    <ul class="card-plan__feature--list">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Explore, discover, and learn on our innovative and informative website."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Standard Performance</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 24/7/365 Support</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Free Email</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Unlimited Bandwidth</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> 100 GB SSD Storage</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i class="fa-light fa-circle-question"></i></span>
                                        </li>


                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free SSL</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime Guarantee</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Web Application Firewall</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">More Features <i class="fa-sharp fa-regular fa-chevron-down"></i>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="card-plan__feature--list more__feature">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> LiteSpeed with LSCache </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Terminal Access </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  MongoDB Databases </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Node.js Available </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Python Available  </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">See less Features <i class="fa-sharp fa-regular fa-chevron-up"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single card end -->
                        <!-- single card -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card-plan">
                                <div class="card-plan__package">
                                    <div class="icon">
                                        <img src="{{ asset('user-assets/images/pricing/premium.svg') }}" height="30" width="30" alt="">
                                    </div>
                                    <h4 class="package__name">Premium</h4>
                                </div>
                                <p class="card-plan__desc">Level-up more power features</p>
                                <div class="card-plan__offer">
                                    <span class="past-price">$151.63</span>
                                    <span class="offer-given">Save 60%</span>
                                </div>
                                <h5 class="card-plan__price">
                                    <sup>$</sup> 79.56 <sub>/ month</sub>
                                </h5>
                                <div class="card-plan__cartbtn">
                                    <a href="#">add to cart</a>
                                </div>
                                <p class="card-plan__renew-price">
                                    $ 151.99 /year when you renew
                                </p>
                                <div class="card-plan__feature">
                                    <ul class="card-plan__feature--list">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Explore, discover, and learn on our innovative and informative website."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Standard Performance</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 24/7/365 Support</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Free Email</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Unlimited Bandwidth</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> 100 GB SSD Storage</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i class="fa-light fa-circle-question"></i></span>
                                        </li>


                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free SSL</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime Guarantee</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Web Application Firewall</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">More Features <i class="fa-sharp fa-regular fa-chevron-down"></i>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="card-plan__feature--list more__feature">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> LiteSpeed with LSCache </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Terminal Access </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  MongoDB Databases </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Node.js Available </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Python Available  </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">See less Features <i class="fa-sharp fa-regular fa-chevron-up"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single card end -->
                        <!-- single card -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card-plan active">
                                <div class="popular-tag">most popular</div>
                                <div class="card-plan__package">
                                    <div class="icon">
                                        <img src="{{ asset('user-assets/images/pricing/business.svg') }}" height="30" width="30" alt="">
                                    </div>
                                    <h4 class="package__name">Business</h4>
                                </div>
                                <p class="card-plan__desc">Everything need to your website</p>
                                <div class="card-plan__offer">
                                    <span class="past-price">$235.63</span>
                                    <span class="offer-given">Save 60%</span>
                                </div>
                                <h5 class="card-plan__price">
                                    <sup>$</sup> 103.63 <sub>/ month</sub>
                                </h5>
                                <div class="card-plan__cartbtn">
                                    <a href="#">add to cart</a>
                                </div>
                                <p class="card-plan__renew-price">
                                    $ 235.99 /mo when you renew
                                </p>
                                <div class="card-plan__feature">
                                    <ul class="card-plan__feature--list">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Explore, discover, and learn on our innovative and informative website."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Standard Performance</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 24/7/365 Support</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Free Email</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-xmark"></i> Unlimited Bandwidth</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 100 GB SSD Storage</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i class="fa-light fa-circle-question"></i></span>
                                        </li>


                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free SSL</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime Guarantee</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Web Application Firewall</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">More Features <i class="fa-sharp fa-regular fa-chevron-down"></i>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="card-plan__feature--list more__feature">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> LiteSpeed with LSCache </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Terminal Access </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  MongoDB Databases </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Node.js Available </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Python Available  </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">See less Features <i class="fa-sharp fa-regular fa-chevron-up"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single card end -->
                        <!-- single card -->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card-plan ">
                                <div class="card-plan__package">
                                    <div class="icon">
                                        <img src="{{ asset('user-assets/images/pricing/cloud.svg') }}" height="30" width="30" alt="">
                                    </div>
                                    <h4 class="package__name">Cloud Startup</h4>
                                </div>
                                <p class="card-plan__desc">Everything need to your website</p>
                                <div class="card-plan__offer">
                                    <span class="past-price">$353.63</span>
                                    <span class="offer-given">Save 60%</span>
                                </div>
                                <h5 class="card-plan__price">
                                    <sup>$</sup> 139.63 <sub>/ month</sub>
                                </h5>
                                <div class="card-plan__cartbtn">
                                    <a href="#">add to cart</a>
                                </div>
                                <p class="card-plan__renew-price">
                                    $ 353.99 /mo when you renew
                                </p>
                                <div class="card-plan__feature">
                                    <ul class="card-plan__feature--list">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 1 Website</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Explore, discover, and learn on our innovative and informative website."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Standard Performance</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Unlock superior online experiences with our standard performance solutions, ensuring reliability, speed, and seamless functionality for your website needs."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 24/7/365 Support</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides reliable 24/7 support for your hosting needs, ensuring assistance whenever you require help."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Free Email</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers complimentary email services, empowering your online communication with reliable and secure free email solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Unlimited Bandwidth</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie provides unlimited bandwidth, ensuring seamless data transfer for your website's optimal performance and user experience."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 100 GB SSD Storage</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Elevate your online presence with Hostie, offering unlimited bandwidth for your domain, ensuring optimal performance and seamless data flow."><i class="fa-light fa-circle-question"></i></span>
                                        </li>


                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Unlimited Free SSL</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> 99.9% Uptime Guarantee</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Web Application Firewall</span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">More Features <i class="fa-sharp fa-regular fa-chevron-down"></i>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="card-plan__feature--list more__feature">
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> LiteSpeed with LSCache </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie offers generous hosting with 100GB SSD storage, providing ample space for your data and ensuring high-performance storage solutions."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Terminal Access </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Secure your website with Hostie's unlimited free SSL certificates, ensuring encrypted and safe online transactions for your users."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  MongoDB Databases </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hostie guarantees 99% uptime, ensuring your website is consistently available and reliable for visitors around the clock."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i> Node.js Available </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-item">
                                            <span class="text"><i class="fa-regular fa-check"></i>  Python Available  </span>
                                            <span class="tolltip" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enhance your website's security with Hostie's Web Application Firewall, protecting against online threats and ensuring a safe online environment."><i class="fa-light fa-circle-question"></i></span>
                                        </li>
                                        <li class="card-plan__feature--list-trigered">
                                            <span class="text">See less Features <i class="fa-sharp fa-regular fa-chevron-up"></i>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- single card end -->
                    </div>
                </div>
            </div>
            <div class="view-plan-btn">
                <a href="pricing.php" class="btn long-btn">view all plan</a>
            </div>
        </div>
    </div>
    <!-- PRICING PLAN START END -->

    <!-- HOSTING FEATURE -->
    <div class="rts-hosting-feature-four section__padding">
        <div class="container">
            <div class="row">
                <div class="rts-section section-style-two">
                    <div class="rts-section__two">
                        <h2 class="title mb-0 sal-animate" data-sal="slide-down" data-sal-delay="200" data-sal-duration="800">Explore Our MERN
                            Hosting Features</h2>
                    </div>
                    <div class="rts-section-description w-550">
                        <p class="description sal-animate" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">
                            Hosting a MERN (MongoDB, Express.js, React.js, Node.js) stack involves specialized features to ensure optimal performance, scalability, and ease of deployment. Below are some key features typically offered by hosting providers tailored for MERN applications:
                        </p>
                        <a href="pricing.php">View all feature <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- feature lsit -->
            <div class="row g-30">
                <div class="col-lg-3 col-sm-6 sal-animate" data-sal="slide-down" data-sal-delay="400" data-sal-duration="800">
                    <div class="feature__single">
                        <div class="feature__single--icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.25 35H18.75C19.0815 35 19.3995 34.8683 19.6339 34.6339C19.8683 34.3995 20 34.0815 20 33.75C20 33.4185 19.8683 33.1005 19.6339 32.8661C19.3995 32.6317 19.0815 32.5 18.75 32.5H6.25C5.91848 32.5 5.60054 32.3683 5.36612 32.1339C5.1317 31.8995 5 31.5815 5 31.25V25H18.75C19.0815 25 19.3995 24.8683 19.6339 24.6339C19.8683 24.3995 20 24.0815 20 23.75C20 23.4185 19.8683 23.1005 19.6339 22.8661C19.3995 22.6317 19.0815 22.5 18.75 22.5H5V15H33.75C34.0815 15 34.3995 14.8683 34.6339 14.6339C34.8683 14.3995 35 14.0815 35 13.75V6.25C35 5.25544 34.6049 4.30161 33.9017 3.59835C33.1984 2.89509 32.2446 2.5 31.25 2.5H6.25C5.25544 2.5 4.30161 2.89509 3.59835 3.59835C2.89509 4.30161 2.5 5.25544 2.5 6.25V31.25C2.5 32.2446 2.89509 33.1984 3.59835 33.9017C4.30161 34.6049 5.25544 35 6.25 35ZM5 6.25C5 5.91848 5.1317 5.60054 5.36612 5.36612C5.60054 5.1317 5.91848 5 6.25 5H31.25C31.5815 5 31.8995 5.1317 32.1339 5.36612C32.3683 5.60054 32.5 5.91848 32.5 6.25V12.5H5V6.25Z" fill="#2D3C58"></path>
                                <path d="M6.61252 9.10004C6.38117 9.34273 6.25146 9.66475 6.25002 10C6.24907 10.1646 6.2806 10.3276 6.34281 10.4799C6.40501 10.6322 6.49667 10.7707 6.61252 10.8875C6.72872 11.0047 6.86698 11.0977 7.0193 11.1612C7.17162 11.2246 7.33501 11.2573 7.50002 11.2573C7.66504 11.2573 7.82842 11.2246 7.98074 11.1612C8.13307 11.0977 8.27132 11.0047 8.38752 10.8875C8.62456 10.6522 8.75838 10.3323 8.75955 9.99821C8.76073 9.66416 8.62915 9.34333 8.39377 9.10629C8.15839 8.86926 7.83849 8.73543 7.50444 8.73426C7.17039 8.73309 6.84956 8.86467 6.61252 9.10004Z" fill="#2D3C58"></path>
                                <path d="M10.3625 9.09997C10.1312 9.34266 10.0015 9.66468 10 9.99997C9.99907 10.1645 10.0306 10.3276 10.0928 10.4799C10.155 10.6322 10.2467 10.7707 10.3625 10.8875C10.5996 11.1229 10.9204 11.2544 11.2544 11.2533C11.5885 11.2521 11.9084 11.1183 12.1438 10.8812C12.3792 10.6442 12.5107 10.3234 12.5096 9.9893C12.5084 9.65525 12.3746 9.33535 12.1375 9.09997C12.0213 8.98281 11.8831 8.88982 11.7307 8.82636C11.5784 8.7629 11.415 8.73022 11.25 8.73022C11.085 8.73022 10.9216 8.7629 10.7693 8.82636C10.617 8.88982 10.4787 8.98281 10.3625 9.09997Z" fill="#2D3C58"></path>
                                <path d="M6.61252 19.1125C6.3841 19.352 6.25463 19.669 6.25002 20C6.24907 20.1645 6.2806 20.3276 6.34281 20.4799C6.40501 20.6322 6.49667 20.7707 6.61252 20.8875C6.72872 21.0046 6.86698 21.0976 7.0193 21.1611C7.17162 21.2246 7.33501 21.2572 7.50002 21.2572C7.66504 21.2572 7.82842 21.2246 7.98074 21.1611C8.13307 21.0976 8.27132 21.0046 8.38752 20.8875C8.6229 20.6521 8.75514 20.3329 8.75514 20C8.75514 19.6671 8.6229 19.3479 8.38752 19.1125C8.15214 18.8771 7.8329 18.7449 7.50002 18.7449C7.16714 18.7449 6.8479 18.8771 6.61252 19.1125Z" fill="#2D3C58"></path>
                                <path d="M10.3625 19.1125C10.1341 19.352 10.0046 19.669 10 20C9.99907 20.1645 10.0306 20.3276 10.0928 20.4799C10.155 20.6322 10.2467 20.7707 10.3625 20.8875C10.5377 21.0613 10.7605 21.1793 11.0027 21.2267C11.2449 21.2741 11.4957 21.2488 11.7235 21.1539C11.9513 21.059 12.1459 20.8987 12.2828 20.6934C12.4197 20.4881 12.4928 20.2468 12.4928 20C12.4928 19.7532 12.4197 19.5119 12.2828 19.3066C12.1459 19.1013 11.9513 18.941 11.7235 18.8461C11.4957 18.7512 11.2449 18.7259 11.0027 18.7733C10.7605 18.8207 10.5377 18.9387 10.3625 19.1125Z" fill="#2D3C58"></path>
                                <path d="M6.61252 29.1C6.38117 29.3427 6.25146 29.6647 6.25002 30C6.24907 30.1645 6.2806 30.3276 6.34281 30.4799C6.40501 30.6322 6.49667 30.7707 6.61252 30.8875C6.72872 31.0046 6.86698 31.0976 7.0193 31.1611C7.17162 31.2246 7.33501 31.2572 7.50002 31.2572C7.66504 31.2572 7.82842 31.2246 7.98074 31.1611C8.13307 31.0976 8.27132 31.0046 8.38752 30.8875C8.6229 30.6521 8.75514 30.3329 8.75514 30C8.75514 29.6671 8.6229 29.3479 8.38752 29.1125C8.15214 28.8771 7.8329 28.7449 7.50002 28.7449C7.16714 28.7449 6.8479 28.8771 6.61252 29.1125V29.1Z" fill="#2D3C58"></path>
                                <path d="M10.3625 29.1C10.1312 29.3427 10.0015 29.6647 10 30C9.99907 30.1645 10.0306 30.3276 10.0928 30.4799C10.155 30.6322 10.2467 30.7707 10.3625 30.8875C10.5377 31.0613 10.7605 31.1793 11.0027 31.2267C11.2449 31.2741 11.4957 31.2488 11.7235 31.1539C11.9513 31.059 12.1459 30.8987 12.2828 30.6934C12.4197 30.4881 12.4928 30.2468 12.4928 30C12.4928 29.7532 12.4197 29.5119 12.2828 29.3066C12.1459 29.1013 11.9513 28.941 11.7235 28.8461C11.4957 28.7512 11.2449 28.7259 11.0027 28.7733C10.7605 28.8207 10.5377 28.9387 10.3625 29.1125V29.1Z" fill="#2D3C58"></path>
                                <path d="M35.25 22.3V21.25C35.2467 19.726 34.6398 18.2654 33.5622 17.1878C32.4846 16.1102 31.024 15.5033 29.5 15.5C27.975 15.5 26.5125 16.1058 25.4341 17.1841C24.3558 18.2625 23.75 19.725 23.75 21.25V22.3C23.1188 22.4167 22.5483 22.7505 22.1374 23.2437C21.7265 23.7368 21.501 24.3581 21.5 25V34.75C21.5033 35.4783 21.7941 36.1759 22.3091 36.6909C22.8241 37.2059 23.5217 37.4967 24.25 37.5H34.75C35.4783 37.4967 36.1759 37.2059 36.6909 36.6909C37.2059 36.1759 37.4967 35.4783 37.5 34.75V25C37.499 24.3581 37.2735 23.7368 36.8626 23.2437C36.4517 22.7505 35.8812 22.4167 35.25 22.3ZM29.5 18C30.3609 18.0033 31.1857 18.3468 31.7945 18.9555C32.4032 19.5643 32.7467 20.3891 32.75 21.25V22.25H26.25V21.25C26.2533 20.3891 26.5968 19.5643 27.2055 18.9555C27.8143 18.3468 28.6391 18.0033 29.5 18ZM35 34.75C35 34.8163 34.9737 34.8799 34.9268 34.9268C34.8799 34.9737 34.8163 35 34.75 35H24.25C24.1837 35 24.1201 34.9737 24.0732 34.9268C24.0263 34.8799 24 34.8163 24 34.75V25C24 24.9337 24.0263 24.8701 24.0732 24.8232C24.1201 24.7763 24.1837 24.75 24.25 24.75H34.75C34.8163 24.75 34.8799 24.7763 34.9268 24.8232C34.9737 24.8701 35 24.9337 35 25V34.75Z" fill="#2D3C58"></path>
                            </svg>
                        </div>
                        <a href="faq.php" class="feature__single--title">Passion for Privacy</a>
                        <p class="feature__single--description">We believe in everyone's right to
                            privacy &amp; we back policy
                        </p>
                        <div class="feature__single--btn">
                            <a href="faq.php" class="round__btn"><i class="fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 sal-animate" data-sal="slide-down" data-sal-delay="500" data-sal-duration="800">
                    <div class="feature__single">
                        <div class="feature__single--icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_332_2437)">
                                    <path d="M37.6562 19.1595V14.4436C37.6562 12.1268 35.8127 10.2334 33.5156 10.1507V7.25614C33.5156 5.7484 32.289 4.52176 30.7812 4.52176H23.2533L22.2812 1.81965C22.0333 1.13059 21.5316 0.579965 20.8684 0.269261C20.2053 -0.0415198 19.4611 -0.0746448 18.773 0.175824L5.1125 5.14778C4.42516 5.39793 3.8768 5.90098 3.56836 6.56426C3.25992 7.22754 3.22859 7.97106 3.48023 8.65793L4.02906 10.156C1.78414 10.2948 0 12.1643 0 14.4436V35.6936C0 38.0629 1.92758 39.9905 4.29688 39.9905H33.3594C35.7287 39.9905 37.6562 38.0629 37.6562 35.6936V30.8215C38.9795 30.6314 40 29.4906 40 28.1155V21.8655C40 20.4904 38.9795 19.3497 37.6562 19.1595ZM37.6562 28.1155C37.6562 28.3309 37.481 28.5061 37.2656 28.5061H31.0156C29.0771 28.5061 27.5 26.929 27.5 24.9905C27.5 23.052 29.0771 21.4749 31.0156 21.4749H37.2656C37.481 21.4749 37.6562 21.6501 37.6562 21.8655V28.1155ZM5.68094 7.85168C5.63242 7.71926 5.66797 7.60746 5.69352 7.55254C5.71906 7.4977 5.78164 7.3984 5.91414 7.3502L19.5746 2.37825C19.7073 2.33004 19.8191 2.3659 19.874 2.39161C19.9289 2.41731 20.028 2.48028 20.0758 2.61309L20.7625 4.52184H20.2344C18.7266 4.52184 17.5 5.74848 17.5 7.25621V10.1468H6.5218L5.68094 7.85168ZM31.1719 7.25614V10.1468H19.8438V7.25614C19.8438 7.04075 20.019 6.86551 20.2344 6.86551H30.7812C30.9966 6.86551 31.1719 7.04075 31.1719 7.25614ZM33.3594 37.6468H4.29688C3.21992 37.6468 2.34375 36.7706 2.34375 35.6936V14.4436C2.34375 13.3667 3.21992 12.4905 4.29688 12.4905H33.3594C34.4363 12.4905 35.3125 13.3667 35.3125 14.4436V19.1311H31.0156C27.7848 19.1311 25.1562 21.7597 25.1562 24.9905C25.1562 28.2214 27.7848 30.8499 31.0156 30.8499H35.3125V35.6936C35.3125 36.7706 34.4363 37.6468 33.3594 37.6468Z" fill="#2D3C58"></path>
                                    <path d="M31.0156 26.1625C31.6628 26.1625 32.1875 25.6378 32.1875 24.9906C32.1875 24.3434 31.6628 23.8187 31.0156 23.8187C30.3684 23.8187 29.8438 24.3434 29.8438 24.9906C29.8438 25.6378 30.3684 26.1625 31.0156 26.1625Z" fill="#2D3C58"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_332_2437">
                                        <rect width="40" height="40" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <a href="faq.php" class="feature__single--title">Money-Back Guaranteed</a>
                        <p class="feature__single--description">We believe in everyone's right to
                            privacy &amp; we back policy
                        </p>
                        <div class="feature__single--btn">
                            <a href="faq.php" class="round__btn"><i class="fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 sal-animate" data-sal="slide-down" data-sal-delay="600" data-sal-duration="800">
                    <div class="feature__single">
                        <div class="feature__single--icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.77599 0.159466C3.77701 0.159822 3.77805 0.16018 3.77907 0.160536L38.0902 12.0366C38.0909 12.0369 38.0917 12.0373 38.0925 12.0374C40.7087 12.9357 40.5929 16.6231 37.9963 17.4302L22.4859 22.2151C22.4698 22.2201 22.4538 22.2246 22.4377 22.2288C22.3866 22.2425 22.3399 22.2689 22.3023 22.3059C22.2647 22.3428 22.2373 22.3889 22.2228 22.4397L22.2152 22.4651L17.4302 37.9963C16.6231 40.5929 12.9357 40.7087 12.0374 38.0925C12.0373 38.0917 12.0369 38.0909 12.0366 38.0902L0.160536 3.77907C0.16018 3.77805 0.159822 3.77701 0.159466 3.77599C-0.0169322 3.27222 -0.0476967 2.72892 0.0707236 2.20842C0.189387 1.68686 0.453019 1.20947 0.831244 0.831244C1.20947 0.453019 1.68686 0.189387 2.20842 0.0707236C2.72892 -0.0476967 3.27222 -0.0169322 3.77599 0.159466ZM1.30805 3.37579L2.45745 2.97794L14.3367 37.2983L14.338 37.302C14.3766 37.4147 14.4324 37.4709 14.4834 37.5043C14.5424 37.5429 14.6246 37.569 14.7195 37.567C14.8144 37.5653 14.8984 37.5359 14.9598 37.4924C15.0137 37.4543 15.0703 37.3924 15.1069 37.2751C15.1069 37.2753 15.1071 37.2748 15.1069 37.2751L19.8872 21.7597C20.0182 21.3085 20.2631 20.8985 20.5987 20.5695C20.931 20.2435 21.3408 20.0077 21.7892 19.8843L37.2743 15.1072C37.274 15.1072 37.2745 15.1071 37.2743 15.1072C37.3917 15.0706 37.4543 15.0137 37.4924 14.9598C37.5359 14.8984 37.5653 14.8144 37.567 14.7195C37.569 14.6246 37.5429 14.5424 37.5043 14.4834C37.4709 14.4324 37.4147 14.3766 37.302 14.338L37.2983 14.3367L2.97249 2.45557C2.9004 2.43024 2.82262 2.42578 2.7481 2.44273C2.6736 2.45968 2.60541 2.49735 2.55137 2.55137C2.49735 2.60541 2.45968 2.6736 2.44273 2.7481C2.42578 2.82262 2.43022 2.9004 2.45556 2.97249L1.30805 3.37579Z" fill="#2D3C58"></path>
                            </svg>
                        </div>
                        <a href="faq.php" class="feature__single--title">super easy to use</a>
                        <p class="feature__single--description">We guarantee it you don't have
                            to worry about it.
                        </p>
                        <div class="feature__single--btn">
                            <a href="faq.php" class="round__btn"><i class="fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 sal-animate" data-sal="slide-down" data-sal-delay="700" data-sal-duration="800">
                    <div class="feature__single">
                        <div class="feature__single--icon">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.8333 0C30.787 0 39.6667 8.87969 39.6667 19.8333C39.6667 30.787 30.787 39.6667 19.8333 39.6667C8.87969 39.6667 0 30.787 0 19.8333C0 8.87969 8.87969 0 19.8333 0ZM19.8333 2.08772C10.0327 2.08772 2.08772 10.0327 2.08772 19.8333C2.08772 29.634 10.0327 37.579 19.8333 37.579C29.634 37.579 37.579 29.634 37.579 19.8333C37.579 10.0327 29.634 2.08772 19.8333 2.08772ZM31.0101 8.65662C31.3864 9.03291 31.4542 9.71168 31.0101 10.1329L23.4307 17.7122C23.798 18.3339 24.0088 19.059 24.0088 19.8333C24.0088 22.1394 22.1394 24.0088 19.8333 24.0088C17.5273 24.0088 15.6579 22.1394 15.6579 19.8333C15.6579 17.5273 17.5273 15.6579 19.8333 15.6579C20.6077 15.6579 21.3328 15.8687 21.9545 16.236L29.5338 8.65662C29.9415 8.24897 30.6024 8.24897 31.0101 8.65662ZM19.8333 17.7456C18.6803 17.7456 17.7456 18.6803 17.7456 19.8333C17.7456 20.9864 18.6803 21.9211 19.8333 21.9211C20.9864 21.9211 21.9211 20.9864 21.9211 19.8333C21.9211 18.6803 20.9864 17.7456 19.8333 17.7456ZM32.1693 14.1715C32.9788 15.9325 33.4035 17.8539 33.4035 19.8333C33.4035 20.4098 32.9362 20.8772 32.3597 20.8772C31.7831 20.8772 31.3158 20.4098 31.3158 19.8333C31.3158 18.1565 30.9568 16.5323 30.2724 15.0435C30.0316 14.5197 30.2611 13.8998 30.7849 13.659C31.3087 13.4183 31.9285 13.6477 32.1693 14.1715ZM19.8333 6.26316C21.831 6.26316 23.7696 6.6958 25.5435 7.51973C26.0664 7.76258 26.2934 8.38331 26.0506 8.90617C25.8077 9.42904 25.187 9.65604 24.6641 9.41319C23.1642 8.71657 21.5257 8.35088 19.8333 8.35088C13.4918 8.35088 8.35088 13.4918 8.35088 19.8333C8.35088 20.4098 7.88353 20.8772 7.30702 20.8772C6.73051 20.8772 6.26316 20.4098 6.26316 19.8333C6.26316 12.3387 12.3387 6.26316 19.8333 6.26316Z" fill="#2D3C58"></path>
                            </svg>
                        </div>
                        <a href="faq.php" class="feature__single--title">First &amp; Reliable</a>
                        <p class="feature__single--description">We believe in everyone's right to
                            privacy &amp; we back policy
                        </p>
                        <div class="feature__single--btn">
                            <a href="faq.php" class="round__btn"><i class="fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- HOSTING FEATURE END -->

    <!-- TESTIMONIAL -->
    <section class="rts-testimonial">
        <div class="container">
            <div class="row ">
                <div class="col-12 d-flex justify-content-center">
                    <div class="rts-section w-460 text-center">
                        <h3 class="rts-section__title" data-sal="slide-down" data-sal-delay="300" data-sal-duration="800">Our Customers Love Us</h3>
                        <p class="rts-section__description" data-sal="slide-down" data-sal-delay="400" data-sal-duration="800">From 24/7 support that acts as your extended team to incredibly fast
                            website performance</p>
                    </div>
                </div>
            </div>
            <!-- testimonial -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="rts-testimonial__slider testimonial__slider--first">
                        <div class="swiper-wrapper">
                            <!-- single testimonial -->
                            <div class="swiper-slide">
                                <div class="rts-testimonial__single">
                                    <div class="rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="content">
                                        <p>Excellent option for those looking for High-End WordPress Hosting. I have
                                            been using Cloud ways.</p>
                                    </div>
                                    <div class="author__meta">
                                        <div class="author__meta--image">
                                            <img src="{{ asset('user-assets/images/testimonials/author.png') }}" alt="">
                                        </div>
                                        <div class="author__meta--details">
                                            <a href="#">Jamie Knop</a>
                                            <span>Business Owner</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonial end -->
                            <!-- single testimonial -->
                            <div class="swiper-slide">
                                <div class="rts-testimonial__single">
                                    <div class="rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="content">
                                        <p>Excellent option for those looking for High-End WordPress Hosting. I have
                                            been using Cloud ways.</p>
                                    </div>
                                    <div class="author__meta">
                                        <div class="author__meta--image">
                                            <img src="{{ asset('user-assets/images/testimonials/author-2.png') }}" alt="">
                                        </div>
                                        <div class="author__meta--details">
                                            <a href="#">Jahed Khan</a>
                                            <span>Business Owner</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonial end -->
                            <!-- single testimonial -->
                            <div class="swiper-slide">
                                <div class="rts-testimonial__single">
                                    <div class="rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="content">
                                        <p>Excellent option for those looking for High-End WordPress Hosting. I have
                                            been using Cloud ways.</p>
                                    </div>
                                    <div class="author__meta">
                                        <div class="author__meta--image">
                                            <img src="{{ asset('user-assets/images/testimonials/author-3.png') }}" alt="">
                                        </div>
                                        <div class="author__meta--details">
                                            <a href="#">Samira Khan</a>
                                            <span>Digital Marketer</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonial end -->
                            <!-- single testimonial -->
                            <div class="swiper-slide">
                                <div class="rts-testimonial__single">
                                    <div class="rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="content">
                                        <p>Excellent option for those looking for High-End WordPress Hosting. I have
                                            been using Cloud ways.</p>
                                    </div>
                                    <div class="author__meta">
                                        <div class="author__meta--image">
                                            <img src="{{ asset('user-assets/images/testimonials/author.png') }}" alt="">
                                        </div>
                                        <div class="author__meta--details">
                                            <a href="#">Jamie Knop</a>
                                            <span>Business Owner</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonial end -->
                        </div>
                        <!-- pagination dot -->
                        <div class="rts-dot__button slider-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- TESTIMONIAL END -->

    <!-- SUPPORT AREA -->
    <div class="rts-support pt--120">
        <div class="container">
            <div class="row">
                <div class="rts-support__wrapper">
                    <div class="rts-support__wrapper--content">
                        <h3 class="title" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">24/7 World-Class Support</h3>
                        <p data-sal="slide-down" data-sal-delay="200" data-sal-duration="800">Run into trouble? Contact our Customer Success team any
                            time via live chat or email.
                        </p>
                        <div class="feature" data-sal="slide-down" data-sal-delay="300" data-sal-duration="800">
                            <ul class="feature__list">
                                <li class="feature__item">Receive professional MERN Hosting support</li>
                                <li class="feature__item">Our MERN specialists are available round</li>
                            </ul>
                        </div>
                        <a href="support.php" class="rts-btn rts-btn-primary support-btn">Get Support <i class="fa-regular fa-chevron-right"></i></a>
                    </div>
                    <div class="rts-support__wrapper--image" data-sal="slide-left" data-sal-delay="400" data-sal-duration="800">
                        <img src="{{ asset('user-assets/images/support/support__image.svg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SUPPORT AREA END -->

    <!-- SHARED HOSTING FAQ -->
    <div class="rts-hosting-faq section__padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="rts-section text-center">
                        <h2 class="rts-section__title mb-0" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">MERN Hosting FAQ</h2>
                    </div>
                    <div class="rts-faq__accordion" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">
                        <div class="accordion accordion-flush" id="rts-accordion">
                            <div class="accordion-item active">
                                <div class="accordion-header" id="first">
                                    <h4 class="accordion-button collapse show" data-bs-toggle="collapse" data-bs-target="#item__one" aria-expanded="false" aria-controls="item__one">
                                        What is MERN hosting?
                                    </h4>
                                </div>
                                <div id="item__one" class="accordion-collapse collapse collapse show" aria-labelledby="first" data-bs-parent="#rts-accordion">
                                    <div class="accordion-body">
                                        MERN hosting refers to hosting services specifically optimized for deploying and managing web applications built using the MERN stack. This includes support for MongoDB, Express.js, React.js, and Node.js, along with features tailored to the requirements of these technologies.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header" id="two">
                                    <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__two" aria-expanded="false" aria-controls="item__two">
                                        What are the key components of MERN hosting?
                                    </h4>
                                </div>
                                <div id="item__two" class="accordion-collapse collapse" aria-labelledby="two" data-bs-parent="#rts-accordion">
                                    <div class="accordion-body">
                                        The key components of MERN hosting typically include:
                                        <ul>
                                            <li>
                                                Server infrastructure capable of running Node.js applications.
                                            </li>
                                            <li>
                                                Support for MongoDB databases.
                                            </li>
                                            <li>
                                                Integration with deployment tools for React.js applications.
                                            </li>
                                            <li>
                                                Features like load balancing, auto-scaling, and containerization for optimal performance and scalability.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header" id="three">
                                    <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__three" aria-expanded="false" aria-controls="item__three">
                                        Do I need specialized hosting for MERN applications?
                                    </h4>
                                </div>
                                <div id="item__three" class="accordion-collapse collapse" aria-labelledby="three" data-bs-parent="#rts-accordion">
                                    <div class="accordion-body">
                                        While it's possible to host MERN applications on generic hosting platforms, specialized MERN hosting offers advantages such as pre-configured environments, streamlined deployment processes, and support for specific requirements of MERN technologies.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header" id="four">
                                    <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__four" aria-expanded="false" aria-controls="item__four">
                                        What are the advantages of MERN hosting?
                                    </h4>
                                </div>
                                <div id="item__four" class="accordion-collapse collapse" aria-labelledby="four" data-bs-parent="#rts-accordion">
                                    <div class="accordion-body">
                                        Advantages of MERN hosting include:
                                        <ul>
                                            <li>Simplified deployment processes tailored to MERN applications.</li>
                                            <li>Optimized performance and scalability for Node.js and MongoDB.</li>
                                            <li>Integrated development tools and workflows.</li>
                                            <li>Dedicated support for troubleshooting MERN-specific issues.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header" id="five">
                                    <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__five" aria-expanded="false" aria-controls="item__four">
                                        What deployment options are available for MERN hosting?
                                    </h4>
                                </div>
                                <div id="item__five" class="accordion-collapse collapse" aria-labelledby="five" data-bs-parent="#rts-accordion">
                                    <div class="accordion-body">
                                        MERN hosting providers typically offer various deployment options, including:
                                        <ul>
                                            <li> Manual deployment via SSH or FTP.</li>
                                            <li> Integration with version control systems like Git for continuous integration and deployment (CI/CD).</li>
                                            <li>Docker and Kubernetes support for containerized deployments.</li>
                                            <li>One-click deployment through platform-specific tools and interfaces.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- SHARED HOSTING FAQ END -->

    <!-- BRAND AREA -->
    <div class="rts-brand pb--100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rts-brand__wrapper">
                        <div class="rts-brand__slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="rts-brand__slider--single">
                                        <a href="#"><img src="{{ asset('user-assets/images/brand/01.svg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="rts-brand__slider--single">
                                        <a href="#"><img src="{{ asset('user-assets/images/brand/02.svg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="rts-brand__slider--single">
                                        <a href="#"><img src="{{ asset('user-assets/images/brand/03.svg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="rts-brand__slider--single">
                                        <a href="#"><img src="{{ asset('user-assets/images/brand/04.svg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="rts-brand__slider--single">
                                        <a href="#"><img src="{{ asset('user-assets/images/brand/05.svg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="rts-brand__slider--single">
                                        <a href="#"><img src="{{ asset('user-assets/images/brand/06.svg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="rts-brand__slider--single">
                                        <a href="#"> <img src="{{ asset('user-assets/images/brand/07.svg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="rts-brand__slider--single">
                                        <a href="#"><img src="{{ asset('user-assets/images/brand/08.svg') }}" alt=""></a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="rts-brand__slider--single">
                                        <a href="#"><img src="{{ asset('user-assets/images/brand/01.svg') }}" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- END: Content-->
@endsection