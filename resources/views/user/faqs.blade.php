@extends('user.layouts.layout')
@section('title', 'FAQs')

@section('content')
<!-- shared hosting banner -->
<div class="rts-hosting-banner rts-hosting-banner-bg banner-default-height p-2">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center text-center">
            <div class="col-12">
                <div class="rts-hosting-banner__content blog__banner">
                    <h4 class="banner-title">
                        Frequently asked questions
                    </h4>
                    <span class="starting__price">FAQ's </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SHARED HOSTING FAQ -->
<div class="rts-hosting-faq section__padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="rts-faq__accordion" data-sal="slide-down" data-sal-delay="100" data-sal-duration="800">
                    <div class="accordion accordion-flush" id="rts-accordion">
                        @foreach ($faqs as $index => $faq)
                            <div class="accordion-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="accordion-header" id="heading{{ $index }}">
                                    <h4 class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#item_{{ $index }}" 
                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" 
                                        aria-controls="item_{{ $index }}">
                                        {{ $faq->title }}
                                    </h4>
                                </div>
                                <div id="item_{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" 
                                     aria-labelledby="heading{{ $index }}" data-bs-parent="#rts-accordion">
                                    <div class="accordion-body">
                                        {!! $faq->description !!}

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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