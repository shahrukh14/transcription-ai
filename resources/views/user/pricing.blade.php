@extends('user.layouts.layout')
@section('title', 'Pricing')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <section id="pricing-plan">
                <!-- title text and switch button -->
                <div class="text-center">
                    <h1 class="mt-5">Pricing Plans</h1>
                    {{-- <p class="mb-2 pb-75"> </p> --}}
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
    </div>
</div>
<!-- END: Content-->
@endsection

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