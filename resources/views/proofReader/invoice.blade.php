@extends('proofReader.layouts.layout')
@section('title', 'Invoice')
@section('content')
@php
    $currency = '<i class="fas fa-indian-rupee-sign"></i>';
@endphp

<div class="app-content content">
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
            <section id="invoice-table">
                <div class="row">
                    <div class="col-12">

                        {{-- Flash messages --}}
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
                            {{-- Year Filter --}}
                            <div class="card-header border-bottom d-flex justify-content-end">
                                <form action="" method="GET" class="d-flex gap-1 w-25">
                                    <select class="form-select" name="year">
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}" @selected($year == $filterYear)>{{ $year }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary ms-1">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary ms-1">
                                        <i class="fa-solid fa-rotate-right"></i>
                                    </a>
                                </form>
                            </div>

                            {{-- Table --}}
                            <div class="card-body px-0">
                                <div class="table-responsive">
                                    <table class="table table-hover text-center align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>@lang('Month')</th>
                                                <th>@lang('Amount') {!! $currency !!}</th>
                                                <th>@lang('CF Amount') {!! $currency !!}</th>
                                                <th>@lang('Total Amount') {!! $currency !!}</th>
                                                <th>@lang('Status')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($months as $month)
                                                @php
                                                    $invoice = $invoiceByMonth->get($month);
                                                @endphp
                                                <tr>
                                                    <td>{{ $month }}</td>
                                                    @if ($invoice)
                                                        <td>{{ $invoice->amount ?? '-'}}</td>
                                                        <td>{{ $invoice->cf_amount ?? '-' }}</td>
                                                        <td>{{ number_format((float)($invoice->amount ?? 0) + (float)($invoice->cf_amount ?? 0), 2) }}</td>
                                                        <td>
                                                            @if ($invoice->status == 1)
                                                                <span class="badge rounded-pill badge-light-success">Completed</span>
                                                            @elseif ($invoice->status == 2)
                                                                <span class="badge rounded-pill badge-light-warning">Carry Forwarded</span>
                                                            @else
                                                                <span class="badge rounded-pill badge-light-secondary">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('proof-reader.tasks.invoice.detail', $invoice->id) }}" class="btn btn-sm btn-outline-primary">
                                                                View
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td class=""> - </td>
                                                        <td class=""> - </td>
                                                        <td class=""> - </td>
                                                        <td class=""> - </td>
                                                        <td class=""> - </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
