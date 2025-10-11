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
                @foreach(['banner_img1', 'banner_img2', 'banner_img3', 'banner_img4', 'banner_img5'] as $imgField)
                    @if(!empty($banner->$imgField))
                    <div class="carousel-item custom-carousel-item  {{ $active ? 'active' : '' }}" style="background-image: url('{{ asset('landing-assets/images/banner_img/'.$banner->$imgField) }}');"></div>
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

<div class="content-body">
    <section id="pricing-plan">
        <!-- title text and switch button -->
        <div class="text-center">
            <h1 class="mt-5">Pricing Plans</h1>
            <p class="mb-2 pb-75">Choose the best plan to fit your needs and start now</p>
            <div class="d-flex align-items-center justify-content-center mb-5 pb-50">
                <h6 class="me-1 mb-0">Monthly</h6>
                <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="priceToggle"/>
                    <label class="form-check-label" for="priceToggle"></label>
                </div>
                <h6 class="ms-50 mb-0">Yearly</h6>
            </div>
        </div>
        <!--/ title text and switch button -->

        <!-- pricing plan cards -->
        <div class="row pricing-card">
            <div class="col-12 col-sm-offset-2 col-sm-10 col-md-12 col-lg-offset-2 col-lg-10 mx-auto">
                <!-- monthy plan cards -->
                <div class="row monthly-pricing-div">
                    <!-- Plan  Card -->
                    @foreach ($monthlyPackages as $monthly)
                    <div class="col-12 col-md-4">
                        <div class="card standard-pricing popular text-center">
                            <div class="card-body">
                                {{-- <div class="pricing-badge text-end">
                                    <span class="badge rounded-pill badge-light-primary">Recomended</span>
                                </div> --}}
                                <img src="{{asset('app-assets/images/illustration/Pot2.svg')}}" class="mb-1" alt="svg img" />
                                <h3>{{$monthly->name}}</h3>
                                <p class="card-text">For small to medium businesses</p>
                                <div class="annual-plan">
                                    <div class="plan-price mt-2">
                                        <sup class="font-medium-1 fw-bold text-primary">₹</sup>
                                        <span class="pricing-standard-value fw-bolder text-primary">{{$monthly->amount}}</span>
                                        <sub class="pricing-duration text-body font-medium-1 fw-bold">/month</sub>
                                    </div>
                                </div>
                                <ul class="list-group list-group-circle text-start">
                                    @foreach (json_decode($monthly->description) as $description)
                                    <li class="list-group-item">{{$description->title}}</li>
                                    @endforeach 
                                </ul>
                                @if(auth()->user() && $monthly->id == auth()->user()->currentSubscription->id)
                                    <button type="button" class="btn w-100 btn-outline-secondary mt-2" disabled>Your current plan</button>
                                @else
                                    <a href="{{ route('user.subscription.checkout', $monthly->id) }}" class="btn w-100 btn-primary mt-2">Upgrade</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!--/ Plan Card --> 
                </div>
                <!--/ monthy plan cards -->

                <!-- yearly plan cards -->
                <div class="row yearly-pricing-div d-none">
                    <!-- standard plan -->
                    @foreach ($yearlyPackages as $yearly)
                    <div class="col-12 col-md-4">
                        <div class="card standard-pricing popular text-center">
                            <div class="card-body">
                                {{-- <div class="pricing-badge text-end">
                                    <span class="badge rounded-pill badge-light-primary">Popular</span>
                                </div> --}}
                                <img src="{{asset('app-assets/images/illustration/Pot2.svg')}}" class="mb-1" alt="svg img" />
                                <h3>{{$yearly->name}}</h3>
                                <p class="card-text">For small to medium businesses</p>
                                <div class="annual-plan">
                                    <div class="plan-price mt-2">
                                        <sup class="font-medium-1 fw-bold text-primary">₹</sup>
                                        <span class="pricing-standard-value fw-bolder text-primary">{{$yearly->amount}}</span>
                                        <sub class="pricing-duration text-body font-medium-1 fw-bold">/month</sub>
                                    </div>
                                    <small class="annual-pricing text-muted">₹ {{$yearly->amount * 12}} / year</small>
                                </div>
                                <ul class="list-group list-group-circle text-start">
                                    @foreach (json_decode($yearly->description) as $description)
                                    <li class="list-group-item">{{$description->title}}</li>
                                    @endforeach 
                                </ul>
                                @if(auth()->user() && $yearly->id == auth()->user()->currentSubscription->id)
                                    <button type="button" class="btn w-100 btn-outline-secondary mt-2" disabled>Your current plan</button>
                                @else
                                    <a href="{{ route('user.subscription.checkout', $yearly->id) }}" class="btn w-100 btn-primary mt-2">Upgrade</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!--/ standard plan --> 
                </div>
                <!--/ yearly plan cards -->
            </div>
        </div>
        <!--/ pricing plan cards -->
    </section>
</div>
 
<!-- END: Content-->
@endsection
@push('style')
<style>
    body {
        overflow-x: hidden;
    }

    .rts-hero-four.mern__hosting {
        padding: 0px 0px !important;
    }
    .custom-carousel-item {
        height: 100%;
        min-height: 550px;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            // Toggle between monthly and yearly pricing
            $('#priceToggle').change(function() {
                if ($(this).is(':checked')) {
                    // Yearly pricing
                    $('.yearly-pricing-div').removeClass('d-none');
                    $('.monthly-pricing-div').addClass('d-none');
                }else{
                    // Monthly pricing
                    $('.monthly-pricing-div').removeClass('d-none');
                    $('.yearly-pricing-div').addClass('d-none');
                }
            });
        }); 
    </script>
@endpush

