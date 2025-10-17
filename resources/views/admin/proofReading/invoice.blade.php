@extends('admin.layouts.layout')
@section('title', 'Invoice')
@section('content')
@php
    $currency = '<i class="fas fa-indian-rupee-sign"></i>';
@endphp
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">@lang('Invoice')</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="ajax-datatable">
                <div class="row">
                    <div class="col-12">
                        @if (Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center fs-3 py-1 mb-1">
                                {{ Session::get('message') }}
                            </p>
                        @endif
                        
                        @if (Session::has('error'))
                            <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3 py-1 mb-1">
                                {{ Session::get('error') }}
                            </p>
                        @endif

                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-end">
                                <form action="" method="GET" class="d-flex gap-1 w-25">
                                    <select class="form-select" name="month">
                                        @foreach ($months as $month)
                                            <option value="{{$month}}" @selected($month == $filterMonth)>{{$month}}</option>
                                        @endforeach
                                    </select>
                                    <select class="form-select" name="year">
                                        @foreach ($years as $year)
                                            <option value="{{$year}}" @selected($year == $filterYear)>{{$year}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary ms-.5"><i class="fa fa-search"></i></button>
                                </form>
                                <a href="{{ url()->current() }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                            </div>
                            <div class="card-body px-0">
                                <div class="card-datatable table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-nowrap">@lang('Proof Reader')</th>
                                                <th class="text-nowrap">@lang('Amount') {!! $currency !!}</th>
                                                <th class="text-nowrap">@lang('CF Amountzz') {!! $currency !!}</th>
                                                <th class="text-nowrap">@lang('Total Amount') {!! $currency !!}</th>
                                                <th class="text-nowrap">@lang('Status')</th>
                                                <th class="text-nowrap">@lang('Action')</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            @forelse($invoices as $invoice)
                                                <tr>
                                                    <td>
                                                        {{$invoice->proofReader->fullName()}}
                                                    </td>
                                                    <td>{{$invoice->amount}}</td>
                                                    <td>{{$invoice->cf_amount}}</td>
                                                    <td>
                                                        {{ number_format((float)($invoice->amount ?? 0) + (float)($invoice->cf_amount ?? 0), 2) }}
                                                    </td>
                                                    <td>
                                                        @if ($invoice->status == 1)
                                                            <span class="badge rounded-pill badge-light-success me-1">Completed</span>
                                                        @elseif($invoice->status == 2)
                                                            <span class="badge rounded-pill badge-light-warning me-1">Carry Forwarded</span>
                                                        @else
                                                            <span class="badge rounded-pill badge-light-secondary me-1">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.proof-reading.invoice.details', $invoice->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                                    </td>
                                                </tr>
                                            @empty
                                            <tr class="text-center mt-4">
                                                <th colspan="6">No data found</th>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @if(count($invoices) > 0)
                                        {{ $invoices->links('pagination::bootstrap-5') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
