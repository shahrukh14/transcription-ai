@extends('user.layouts.layout')
@section('title', 'Wallet Details')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Wallet Details</h2>
                        </div>
                    </div>
                </div>
            </div>
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center fs-3">
                    {{ Session::get('message') }}
                </p>
            @endif
            @if (Session::has('error'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">
                    {{ Session::get('error') }}
                </p>
            @endif
            <div class="content-body">
                <div class="row match-height">
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <h4 class="card-title">Statistics</h4>
                            </div>
                            <div class="card-body statistics-body">
                                <div class="row">
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-primary me-2">
                                                <div class="avatar-content">
                                                    <i class="fa-solid fa-wallet font-large-1"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{number_format(auth()->user()->balance, 2)}}</h4>
                                                <p class="card-text font-small-3 mb-0">Available Balance</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-success me-2">
                                                <div class="avatar-content">
                                                    <i class="fa-solid fa-money-bill-trend-up font-large-1"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{number_format(auth()->user()->credits()->sum('amount'), 2)}}</h4>
                                                <p class="card-text font-small-3 mb-0">Total Crdit</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-danger me-2">
                                                <div class="avatar-content">
                                                    <i class="fa-solid fa-money-bill-wave font-large-1"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{number_format(auth()->user()->debits()->sum('amount'), 2)}}</h4>
                                                <p class="card-text font-small-3 mb-0">Total Debit</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex flex-row">
                                            <div class="avatar bg-light-info me-2">
                                                <div class="avatar-content">
                                                    <i class="fa-solid fa-money-bill-transfer font-large-1"></i>
                                                </div>
                                            </div>
                                            <div class="my-auto">
                                                <h4 class="fw-bolder mb-0">{{number_format(auth()->user()->totalTransfers()->sum('amount'), 2)}}</h4>
                                                <p class="card-text font-small-3 mb-0">Total Transfer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Statistics Card -->
                </div>
                <section id="input-file-browser">
                    <div class="card">
                        <div class="card-header border-bottom d-flex justify-content-between">
                            <button type="button" class="btn btn-primary addToWallletBtn">Add money to wallet</button>
                            <form action="" method="GET" class="d-flex gap-1">
                                <input type="text" name="search" id="search" class="form-control ms-2" value="{{ request('search') }}" placeholder="Search Payment Id">
                                <button type="submit" class="btn btn-primary ms-.5"><i class="fa fa-search"></i></button>
                                <a href="{{ url()->current() }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                            </form>
                        </div>
                        <div class="card-body px-0">
                            <div class="card-datatable table-responsive">
                                <table class="datatables-ajax table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">@lang('Amount')</th>
                                            <th class="text-nowrap">@lang('Date')</th>
                                            <th class="text-nowrap">@lang('Type')</th>
                                            <th class="text-nowrap">@lang('Remark')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($wallets) > 0)
                                            @foreach ($wallets as $wallet)
                                            <tr>
                                                <td>{{number_format($wallet->amount, 2)}}</td>
                                                <td>{{date('d M Y, h:i A', strtotime($wallet->created_at))}}</td>
                                                <td>
                                                    @if ($wallet->type == "credit")
                                                        <span class="badge rounded-pill badge-light-success me-1">Credit</span>
                                                    @else
                                                        <span class="badge rounded-pill badge-light-danger me-1">Debit</span>
                                                    @endif
                                                </td>
                                                <td>{{$wallet->transaction->remark}}</td>
                                            </tr>
                                            @endforeach
                                        @else
                                        <tr class="text-center">
                                            <th colspan="6"><h4>No data found</h4></th>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@push('modal')
<!-- Edit Modal Start-->
<div class="modal fade" id="addTowalletModal" tabindex="-1" aria-labelledby="addTowalletModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="addTowalletModalLabel"> <i class="fa-solid fa-wallet"></i> Add Money To your wallet</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary addBtn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal End-->
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click', '.addToWallletBtn', function(e){
            e.preventDefault();
            let modal = $('#addTowalletModal');
            modal.modal('show');
        });

        $(document).on('click', '.addBtn', function(e){
            payNow();
        });

        function payNow() {
            const amount = $("#amount").val();
            if (!amount || amount <= 0){
                Swal.fire({
                    title: "Error",
                    text: "Please Enter a valid amount!",
                    icon: "error"
                });
                return;
            };

            fetch('{{ route('user.wallet.pay') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ amount: amount })
            })
            .then(res => res.json())
            .then(data => {
                const options = {
                    key: data.key,
                    amount: data.amount,
                    currency: "INR",
                    name: "{{ auth()->user()->fullname()}}",
                    description: "Wallet Recharge",
                    order_id: data.order_id,
                    handler: function (response) {
                        // Send payment success response to backend
                        fetch('{{ route('user.wallet.payment.success') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_signature: response.razorpay_signature,
                                amount: amount
                            })
                        }).then(res => res.json())
                        .then(res => {
                            $('#addTowalletModal').modal('hide');
                            Swal.fire({
                                title: "Payment Successful",
                                text: "Amount added to your wallet",
                                icon: "success"
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        });
                    },
                    theme: { color: "#3399cc" }
                };
                new Razorpay(options).open();
            });
        }
    });
</script>
@endpush


