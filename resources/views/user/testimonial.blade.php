@extends('user.layouts.layout')
@section('title', 'Testimonial')
@section('content')
<div class="rts-hosting-banner rts-hosting-banner-bg banner-default-height p-2">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center text-center">
            <div class="col-12">
                <div class="rts-hosting-banner__content blog__banner">
                    <h4 class="banner-title">
                       Testimonial
                    </h4>
                    <span class="starting__price">Testimonial</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rts-client-feedback section__padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="rts-section w-500 text-center">
                <h2 class="rts-section__title" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">testimonials </h2>
                </p>
            </div>
        </div>
        <!-- client feedback -->
        <div class="row">
            <div class="feedback-slider">
                <div class="wrapper">
                    @foreach ($testimonials as $testimonial)
                        <div class="slide">
                            <div class="feedback-card">
                                <div class="feedback-card__border"></div>
                                <div class="feedback-card__single">
                                    <div class="quote-icon">
                                        <svg width="33" height="27" viewBox="0 0 33 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.12927 12.9165H11.1667C11.8905 12.9165 12.5847 13.204 13.0965 13.7159C13.6083 14.2277 13.8958 14.9219 13.8958 15.6457V23.8332C13.8958 24.557 13.6083 25.2512 13.0965 25.763C12.5847 26.2748 11.8905 26.5623 11.1667 26.5623H2.97917C2.25535 26.5623 1.56117 26.2748 1.04935 25.763C0.537536 25.2512 0.25 24.557 0.25 23.8332V14.7587C0.250828 12.2879 0.861546 9.85559 2.02796 7.67749C3.19437 5.49939 4.88041 3.6429 6.93646 2.27275L9.37906 0.635254L10.8801 2.90046L8.4375 4.53796C7.01878 5.48869 5.81394 6.72487 4.89994 8.16753C3.98594 9.61019 3.38288 11.2276 3.12927 12.9165ZM22.2328 12.9165H30.2702C30.994 12.9165 31.6882 13.204 32.2 13.7159C32.7118 14.2277 32.9993 14.9219 32.9993 15.6457V23.8332C32.9993 24.557 32.7118 25.2512 32.2 25.763C31.6882 26.2748 30.994 26.5623 30.2702 26.5623H22.0827C21.3589 26.5623 20.6647 26.2748 20.1529 25.763C19.6411 25.2512 19.3535 24.557 19.3535 23.8332V14.7587C19.3543 12.2879 19.9651 9.85559 21.1315 7.67749C22.2979 5.49939 23.9839 3.6429 26.04 2.27275L28.4962 0.635254L29.9836 2.90046L27.541 4.53796C26.1223 5.48869 24.9175 6.72487 24.0035 8.16753C23.0895 9.61019 22.4864 11.2276 22.2328 12.9165Z" fill="#4C5671" />
                                        </svg>
                                    </div>
                                    <p class="feedback-card__single--text">{{ $testimonial->text }}</p>
                                    <div class="feedback-card__single--author">
                                        <div class="author">
                                            <img src="{{ asset('storage/' . $testimonial->author_image) }}" height="50" width="50" alt="{{ $testimonial->author_name }}">
                                        </div>
                                        <div class="author__meta">
                                            <h6>{{ $testimonial->author_name }}</h6>
                                            <span>{{ $testimonial->author_position }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
</div>

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
</style>  
@endpush