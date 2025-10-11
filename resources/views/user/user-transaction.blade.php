@extends('user.layouts.layout')
@section('title', 'Transactions')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        @if (Session::has('success'))
            <p class="alert alert-success text-center fs-3 py-1">{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('error'))
            <p class="alert alert-danger text-center fs-3 py-1"> {{ Session::get('error') }}</p>
        @endif
        <div class="content-body">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="card">
                        <div class="card-header border-bottom d-flex justify-content-between">
                            <h4 class="card-title">All Transacrtios</h4>
                            <form action="" method="GET" class="d-flex align-items-center m-bottom-4 w-auto gap-1">
                                <div class="formData d-flex gap-1">
                                    <input type="text" class="form-control flatpickr-input from" placeholder="From Date" name="from" value="{{ request('from') }}" />
                                    <input type="text" class="form-control flatpickr-input to" placeholder="To Date" name="to" value="{{ request('to') }}" />
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                            <form action="" method="GET" class="d-flex gap-1">
                                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Search Payment Id">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                <a href="{{ url()->current() }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                            </form>
                        </div>
                        <div class="card-body px-0">
                            <div class="card-datatable table-responsive">
                                <table class="datatables-ajax table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">@lang('ID')</th>
                                            <th class="text-nowrap">@lang('Payment Id')</th>
                                            <th class="text-nowrap">@lang('Order Id')</th>
                                            <th class="text-nowrap">@lang('Amount')</th>
                                            <th class="text-nowrap">@lang('Currency')</th>
                                            <th class="text-nowrap">@lang('Date')</th>
                                            <th class="text-nowrap">@lang('Remark')</th>
                                            <th class="text-nowrap">@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($transactions) > 0)
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td class="text-nowrap">{{ $transaction->id }}</td>
                                                    <td class="text-nowrap">{{ $transaction->payment_id }}</td>
                                                    <td class="text-nowrap">{{ $transaction->order_id }}</td>
                                                    <td class="text-nowrap">{{ number_format($transaction->amount, 2) }}</td>
                                                    <td class="text-nowrap">{{ $transaction->currency }}</td>
                                                    <td class="text-nowrap">{{ date('d-m-Y , h:i A', strtotime($transaction->created_at)) }}</td>
                                                    <td class="text-nowrap">{{ $transaction->remark }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-outline-primary" href="{{ route('user.transaction.invoice', $transaction->id) }}" title="Invoice Download">
                                                            <i class="fa-solid fa-file-pdf"></i><span>Invoice</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr class="text-center">
                                            <th colspan="6">No data found</th>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
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

 

@push('style')
<!-- Dropzone CSS -->
<style>

    body {
        overflow-x: hidden;
    }
    .content-body{
        margin: 40px 0 40px 0;
    }
</style>
@endpush

@push('script')
<script> 
$(document).ready(function () {

   
});
</script>
@endpush
    