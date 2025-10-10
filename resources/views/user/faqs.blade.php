@extends('user.layouts.layout')
@section('title', 'FAQs')

@section('content')
<!-- shared hosting banner -->
<div class="rts-hosting-banner rts-hosting-banner-bg banner-default-height">
    <div class="container">
        <div class="row">
            <div class="banner-area">
                <div class="rts-hosting-banner rts-hosting-banner__content contact__banner">
                    <span class="starting__price" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">FAQ's </span>
                    <h1 class="banner-title" data-sal="slide-down" data-sal-delay="200" data-sal-duration="800">
                        Frequently asked questions
                    </h1>
                    <p class="slogan" data-sal="slide-down" data-sal-delay="300" data-sal-duration="800">You can also do this by logging into a server directly, but the process requires some technical knowledge since a single mistake can break your entire site...</p>
                    <div class="hosting-action">
                        <a href="#" class="btn__two secondary__bg secondary__color">Ask a Question <i class="fa-regular fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="rts-hosting-banner__image faq">
                    <img src="{{ asset('user-assets/images/banner/faq/banner__faq__image.svg') }}" alt="">
                    <img class="shape one rotate-one" src="{{ asset('user-assets/images/banner/faq/banner__faq__image-sm1.svg') }}" alt="">
                    <img class="shape two rotate-two" src="{{ asset('user-assets/images/banner/faq/banner__faq__image-sm2.svg') }}" alt="">
                    <img class="shape three" src="{{ asset('user-assets/images/banner/faq/banner__faq__image-sm3.svg') }}" alt="">
                    <img class="shape four" src="{{ asset('user-assets/images/banner/faq/banner__faq__image-sm4.svg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- shared hosting banner end-->

<!-- SHARED HOSTING FAQ -->
<div class="rts-hosting-faq section__padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="rts-section text-center">
                    <h2 class="rts-section__title mb-0" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">Frequently asked questions</h2>
                </div>
                <div class="rts-faq__accordion" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">
                    <div class="accordion accordion-flush" id="rts-accordion">
                        <div class="accordion-item active">
                            <div class="accordion-header" id="first">
                                <h4 class="accordion-button collapse show" data-bs-toggle="collapse" data-bs-target="#item__one" aria-expanded="false" aria-controls="item__one">
                                    Why buy a domain name from hostie?
                                </h4>
                            </div>
                            <div id="item__one" class="accordion-collapse collapse collapse show" aria-labelledby="first" data-bs-parent="#rts-accordion">
                                <div class="accordion-body">
                                    Above all else, we strive to deliver outstanding customer experiences. When you buy a domain name from hostie, we guarantee it will be handed over.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="two">
                                <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__two" aria-expanded="false" aria-controls="item__two">
                                    How does domain registration work?
                                </h4>
                            </div>
                            <div id="item__two" class="accordion-collapse collapse" aria-labelledby="two" data-bs-parent="#rts-accordion">
                                <div class="accordion-body">
                                    Above all else, we strive to deliver outstanding customer experiences. When you buy a domain name from hostie, we guarantee it will be handed over.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="three">
                                <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__three" aria-expanded="false" aria-controls="item__three">
                                    Why is domain name registration required?
                                </h4>
                            </div>
                            <div id="item__three" class="accordion-collapse collapse" aria-labelledby="three" data-bs-parent="#rts-accordion">
                                <div class="accordion-body">
                                    Above all else, we strive to deliver outstanding customer experiences. When you buy a domain name from hostie, we guarantee it will be handed over.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <div class="accordion-header" id="four">
                                <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__four" aria-expanded="false" aria-controls="item__four">
                                    Why is domain name registration required?
                                </h4>
                            </div>
                            <div id="item__four" class="accordion-collapse collapse" aria-labelledby="four" data-bs-parent="#rts-accordion">
                                <div class="accordion-body">
                                    Above all else, we strive to deliver outstanding customer experiences. When you buy a domain name from hostie, we guarantee it will be handed over.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header" id="five">
                                <h4 class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#item__five" aria-expanded="false" aria-controls="item__four">
                                    Why is domain name registration required?
                                </h4>
                            </div>
                            <div id="item__five" class="accordion-collapse collapse" aria-labelledby="five" data-bs-parent="#rts-accordion">
                                <div class="accordion-body">
                                    Above all else, we strive to deliver outstanding customer experiences. When you buy a domain name from hostie, we guarantee it will be handed over.
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

<!-- CONTACT START -->
<section class="rts-contact-form bg-white no-bg border-bottom-light pb--120">
    <div class="container">
        <div class="row gy-30 justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-10">
                <div class="contact-form">
                    <div class="contact-form__content" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">
                        <div class="contact-form__content--image">
                            <img src="{{ asset('user-assets/images/contact/contact-form.png') }}" width="260" height="188" alt="">
                        </div>
                        <h1 class="contact-form__content--title">
                            Ask a
                            Question
                        </h1>
                        <p class="contact-form__content--description">
                            Schedule a call today and one of our experts to help you decide which service is ideal for your business and budget.
                        </p>
                        <div class="contact__shape support-page">
                            <img src="{{ asset('user-assets/images/contact/contact__animated__arrow.svg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 offset-xl-1 col-md-10">
                <div class="form">
                    <h5>Send a message</h5>
                    <form class="form__content" method="post" action="mailer.php">
                        <div class="form__control">
                            <input type="text" class="input-form" name="name" id="name" placeholder="what is your name?" required>
                            <input type="email" class="input-form" name="email" id="email" placeholder="Email Address" required>
                        </div>
                        <div class="form__control">
                            <input type="text" class="input-form" name="phone" id="phone" placeholder="Phone Number" required>
                            <select name="select" id="select" class="input-form">
                                <option value="1">Select a state</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="India">India</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Maldives">Maldives</option>
                            </select>
                        </div>

                        <textarea name="message" id="message" cols="30" rows="10" placeholder="A brief description about your consultation" required></textarea>
                        <input type="checkbox" name="checkbox" id="checkbox">
                        <label for="checkbox">
                            By submitting your information you provide written consent
                            to hostie and its family of brands contacting you.
                        </label>
                        <button type="submit" class="submit__btn">Submit Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CONTACT END -->
@endsection