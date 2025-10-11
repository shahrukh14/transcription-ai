@extends('user.layouts.layout')
@section('title', 'Checkout')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-12">
                   <!-- Plan Details -->
                   <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Plan Details</h4>
                        </div>
                        <div class="card-body my-2 py-25">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2 pb-50">
                                        <h5>Plan :  <strong>{{$package->name}}</strong></h5>
                                        <span>A simple start for everyone</span>
                                    </div>
                                    <div class="mb-2 pb-50">
                                        @php
                                            if($package->type == "monthly"){
                                                $expiry_date = \Carbon\Carbon::now()->addMonths(1)->toDateString();
                                            }else{
                                                $expiry_date = \Carbon\Carbon::now()->addYears(1)->toDateString();
                                            }
                                        @endphp
                                        <h5>Will expire on {{date('d M, Y', strtotime($expiry_date))}}</h5>
                                        <span>This plan will be active only after purchase</span>
                                    </div>
                                    <div class="mb-1">
                                        <h5>₹ {{$package->amount}} Per {{($package->type == "monthly" ? "Month": "Year")}} <span class="badge badge-light-primary ms-50">Popular</span></h5>
                                        <span>Standard plan for small to medium businesses</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @foreach (json_decode($package->description) as $description)
                                        <div class="mb-1">
                                            <img src="{{asset('admin/packages/descriptions/'.$description->image)}}" alt="" width="40" class="me-75">
                                            <span>{{$description->title}}</span>
                                        </div>
                                    @endforeach 
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary me-1 mt-1" id="payBtn">Purchase</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- / Plan Details -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

 

@push('style')
 
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).ready(function() {
        $('#payBtn').on('click', function(){
            payWithRazorpay();
        });

        function payWithRazorpay(){
            var options = {
                "key": "{{ $key }}",
                "amount": "{{ $amount * 100 }}",
                "currency": "INR",
                "name": "Your Company",
                "description": "Payment",
                "order_id": "{{ $order->id }}",
                "handler": function (response){
                    // After payment success
                    fetch('{{ route('user.payment.success') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            package_id: "{{ $package->id }}",
                            payment_id: response.razorpay_payment_id,
                            order_id: response.razorpay_order_id,
                            signature: response.razorpay_signature,
                        })
                    }).then(res => {
                        window.location.href = "{{ route('user.dashboard') }}";
                    });
                },
                "modal": {
                    "ondismiss": function(){
                        Swal.fire({
                            title: "Payment cancelled",
                            text: "You closed the payment window",
                            icon: "error"
                        });
                    }
                },
                "theme": {
                    "color": "#528FF0"
                }
            };
             
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    }); 
</script>
@endpush
    