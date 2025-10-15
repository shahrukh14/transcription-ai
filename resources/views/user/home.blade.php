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
    <section id="introduction-section">
        <div class="text-center">
            <h1 class="mt-5 mb-2">Precision Proofreading: Elevating AI Transcripts to Excellence</h1>
            <p class="mb-1 mx-4">Welcome to Hybrid Intelligence your premier destination for transforming AI-generated transcripts into polished, professional documents. In the era of artificial intelligence, we understand the importance of human touch in refining automated content.</p>
            <p class="mb-2 pb-75">Trust us to refine your transcripts, so they resonate effectively with your audience.</p>
            <div class="d-flex align-items-center justify-content-center mb-5 pb-50">
               <a href="{{ route('login')}}" class="btn btn-outline-primary">Start Your Proofreading Journey</a>
            </div>
        </div>
    </section>

    <section id="knowledge-base-content">
        <div class="text-center">
            <h1 class="mt-5 mb-2">Services</h1>
        </div>
         <div class="row kb-search-content-info match-height mx-4">
            <div class="col-md-4 col-sm-6 col-12 kb-search-content">
                <div class="card">
                    <a href="page-kb-category.html">
                        <img src="{{asset('/app-assets/images/illustration/personalization.svg')}}" class="card-img-top" alt="knowledge-base-image" />
                        <div class="card-body text-center">
                            <h4>AI Transcript</h4>
                            <p class="text-body mt-1 mb-0">
                                Generate your transcript from an AI, we support 80 languages.
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-12 kb-search-content">
                <div class="card">
                    <a href="page-kb-category.html">
                        <img src="{{asset('/app-assets/images/illustration/demand.svg')}}" class="card-img-top" alt="knowledge-base-image" />
                        <div class="card-body text-center">
                            <h4>AI Transcript Proofreading</h4>
                            <p class="text-body mt-1 mb-0"> We meticulously review your AI-generated transcripts for grammar, punctuation, spelling, and clarity, ensuring a final product that communicates your intended message effectively.</p>
                            <p class="text-body mt-1 mb-0"> We provide consistency checks across your transcripts, applying uniform style and voice to maintain a professional tone throughout.</p>
                            <p class="text-body mt-1 mb-0"> Tailoring your transcripts to meet specific formatting guidelines or style preferences, ensuring that your content is not just correct but also visually appealing.</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-12 kb-search-content">
                <div class="card">
                    <a href="page-kb-category.html">
                        <img src="{{asset('/app-assets/images/illustration/email.svg')}}" class="card-img-top" alt="knowledge-base-image" />
                        <div class="card-body text-center">
                            <h4>Manual Transcription</h4>
                            <p class="text-body mt-1 mb-0">Team of transcribers who can do manual transcription directly from an audio</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="knowledge-base-content">
        <div class="text-center">
            <h1 class="mt-5 mb-2">Why Choose Us?</h1>
        </div>
         <div class="row kb-search-content-info match-height mx-4">
            <div class="col-md-3 col-sm-6 col-12 kb-search-content">
                <div class="card">
                    <a href="page-kb-category.html">
                        <img src="{{asset('/app-assets/images/illustration/marketing.svg')}}" class="card-img-top" alt="knowledge-base-image" />
                        <div class="card-body text-center">
                            <h4>Experienced Professionals</h4>
                            <p class="text-body mt-1 mb-0">Our proofreaders have years of experience in linguistics and editing, ensuring your transcripts are handled with expertise.</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 kb-search-content">
                <div class="card">
                    <a href="page-kb-category.html">
                        <img src="{{asset('/app-assets/images/illustration/demand.svg')}}" class="card-img-top" alt="knowledge-base-image" />
                        <div class="card-body text-center">
                            <h4>Quick Turnaround</h4>
                            <p class="text-body mt-1 mb-0">Need it fast? We offer expedited services to meet tight deadlines without sacrificing quality.</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 kb-search-content">
                <div class="card">
                    <a href="page-kb-category.html">
                        <img src="{{asset('/app-assets/images/illustration/api.svg')}}" class="card-img-top" alt="knowledge-base-image" />
                        <div class="card-body text-center">
                            <h4>100% Confidentiality</h4>
                            <p class="text-body mt-1 mb-0">Your content is safe with us. We adhere to strict privacy standards to keep your information secure.</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 kb-search-content">
                <div class="card">
                    <a href="page-kb-category.html">
                        <img src="{{asset('/app-assets/images/illustration/email.svg')}}" class="card-img-top" alt="knowledge-base-image" />
                        <div class="card-body text-center">
                            <h4>Affordable Pricing</h4>
                            <p class="text-body mt-1 mb-0">Quality proofreading shouldn’t be expensive. We offer competitive rates to accommodate all clients</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

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

