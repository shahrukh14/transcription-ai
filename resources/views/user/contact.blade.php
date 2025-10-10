@extends('user.layouts.layout')
@section('title', 'Contact')

@section('content')
<div class="rts-hosting-banner rts-hosting-banner-bg banner-default-height p-2">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center text-center">
            <div class="col-12">
                <div class="rts-hosting-banner__content blog__banner">
                    <h4 class="banner-title">
                      Contact Us
                    </h4>
                    <span class="starting__price">Contact</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="rts-contact-form no-bg pt--120 pb--120">
    <div class="container">
        <div class="row gy-30 justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-10">
                <div class="contact-form">
                    <div class="contact-form__content" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">
                        <div class="contact-form__content--image">
                            <img src="{{ asset('user-assets/images/contact/contact-form.png') }}" width="260" height="188" alt="">
                        </div>
                        <h1 class="contact-form__content--title customcontact-form">
                            Ask a Question
                        </h1>
                        <p class="contact-form__content--description">
                            Schedule a call today and one of our experts to help you decide which service is ideal for your business and budget.
                        </p>
                        <div class="contact__shape support-page">
                            <img src="assets/images/contact/contact__animated__arrow.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-10">
                @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center fs-3">
                    {{ Session::get('message') }}
                </p>
                 @endif
                <div class="form">
                    <h5>Send a message</h5>
                    <form class="form__content" method="post" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="form__control">
                            <input type="text" class="input-form  padding-input" name="fname" id="fname" placeholder="First Name" required>
                            <input type="text" class="input-form  padding-input" name="lname" id="lname" placeholder="Last Name" required>
                        </div>
                        <div class="form__control">
                            <input type="email" class="input-form  padding-input" name="email" id="email" placeholder="Email Address" required>
                            <input type="text" class="input-form  padding-input" name="phone" id="phone" placeholder="Phone Number" required>
                        </div>
                        <textarea name="message  padding-input" id="message" cols="30" rows="10" placeholder="A brief description about your consultation"></textarea>
                        <button type="submit" class="submit__btn">Submit Now</button>
                    </form>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- CONTACT END -->

<!-- CONTACT MAP -->
<section class="rts-contact-map-area">
    <div class="section-inner">
        <div class="contact-map-area-fluid">
            <iframe class="contact-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.9149746596686!2d90.4226635760237!3d23.786041887405727!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c781b4c7f3f5%3A0xc93971c0e57c8be6!2sReacThemes!5e0!3m2!1sen!2sbd!4v1722157445545!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

@endsection
@push('style')
  <style>
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
.customcontact-form{
    font-size: 45px !important;
}
.padding-input {
    padding: 10px; 
}
</style>  
@endpush