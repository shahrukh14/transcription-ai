@extends('admin.layouts.layout')
@section('title', 'Transcription')
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
                            <h2 class="content-header-title float-start mb-0">@lang('Transaction')</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
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
                
                                <div class="card-header border-bottom d-flex justify-content-end">
                                    <form action="" method="GET" class="d-flex align-items-center m-bottom-4 w-auto">
                                        <div class="formData d-flex">
                                            <input type="text" class="form-control flatpickr-input from" placeholder="From Date" name="from" 
                                                value="{{ request('from') }}" />
                                            <input type="text" class="form-control flatpickr-input to ms-.5" placeholder="To Date" name="to" 
                                                value="{{ request('to') }}" />
                                        </div>
                                        <button type="submit" class="btn btn-primary ms-.5">Search</button>
                                    </form>
                                    <form action="" method="GET" class="d-flex">
                                        <input type="text" name="search" id="search" class="form-control ms-2" value="{{ request('search') }}" placeholder="Search Payment Id">
                                        <button type="submit" class="btn btn-primary ms-.5"><i class="fa fa-search"></i></button>
                                    </form>
                
                                    <a href="{{ url()->current() }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                                </div>
                
                                <div class="card-datatable table-responsive">
                                    <table class="datatables-ajax table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-nowrap">@lang('ID')</th>
                                                <th class="text-nowrap">@lang('User')</th>
                                                <th class="text-nowrap">@lang('Package')</th>
                                                <th class="text-nowrap">@lang('Start Date')</th>
                                                <th class="text-nowrap">@lang('Payment Id')</th>
                                                <th class="text-nowrap">@lang('Order Id')</th>
                                                <th class="text-nowrap">@lang('Amount')</th>
                                                <th class="text-nowrap">@lang('Currency')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($transactions) > 0)
                                                @foreach ($transactions as $transaction)
                                                    <tr>
                                                        <td class="text-nowrap">{{ $transaction->id }}</td>
                                                        <td class="text-nowrap">{{ $transaction->user->fullname() }}</td>
                                                        <td class="text-nowrap">{{ $transaction->package->name }}</td>
                                                        <td class="text-nowrap">{{ date('d-m-Y , h:i A', strtotime($transaction->created_at)) }}</td>
                                                        <td class="text-nowrap">{{ $transaction->payment_id }}</td>
                                                        <td class="text-nowrap">{{ $transaction->order_id }}</td>
                                                        <td class="text-nowrap">{{ $transaction->amount }}</td>
                                                        <td class="text-nowrap">{{ $transaction->currency }}</td>
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
                            @if (count($transactions) > 0)
                            {{ $transactions->links('pagination::bootstrap-5') }}
                           @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
