@extends('proofReader.layouts.layout')
@section('title', 'Invoice')
@section('content')
@php
    $currency = '<i class="fas fa-indian-rupee-sign"></i>';
@endphp
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12 d-flex justify-content-between">
                        <h2 class="content-header-title float-start mb-0">@lang('Invoice Details')</h2>
                        <a href="{{ route('proof-reader.tasks.invoice.pdf', $invoice->id) }}" class="btn btn-outline-primary">Download Invoice</a>
                    </div>
                    {{-- <a href="{{ asset($invoice->file) }}" target="_blank">View File</a> --}}
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="ajax-datatable">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-between">
                                <h5 class="">Invoice Deatils</h5>
                            </div>
                            <div class="card-body px-2 pt-1">
                                <h4> Proof Reader : {{$invoice->proofReader->fullName()}}</h4>
                                <h4> Month : {{$invoice->month}} - {{$invoice->year}}</h4>
                                <h4> Amount :  {!! $currency !!} {{$invoice->amount}}</h4>
                                <h4> CF Amount : {!! $currency !!} {{$invoice->cf_amount}}</h4>
                                <h4> Total Amount : {!! $currency !!} {{ number_format((float)($invoice->amount ?? 0) + (float)($invoice->cf_amount ?? 0), 2) }}</h4>
                                <h4> 
                                    Payment Status :
                                    @if ($invoice->status == 1)
                                        <span class="badge rounded-pill badge-light-success me-1">Completed</span>
                                    @elseif($invoice->status == 2)
                                        <span class="badge rounded-pill badge-light-warning me-1">Carry Forwarded</span>
                                    @else
                                        <span class="badge rounded-pill badge-light-secondary me-1">Pending</span>
                                    @endif
                                </h4>
                                <h4>Remarks : {{$invoice->remark}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-start">
                                <h5 class="">Completed task in the month of {{$invoice->month}}, {{$invoice->year}} by {{$invoice->proofReader->fullName()}}</h5>
                            </div>
                            <div class="card-body px-0">
                                <div class="card-datatable table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-nowrap">@lang('Audio')</th>
                                                <th class="text-nowrap">@lang('Date')</th>
                                                <th class="text-nowrap">@lang('Price') {!! $currency !!} </th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            @forelse($tasks as $task)
                                                <tr>
                                                    <td>{{$task->audio_name}}</td>
                                                    <td>{{ $task->claimed_dt ? \Carbon\Carbon::parse($task->claimed_dt)->format('d/m/Y') : '' }}</td>
                                                    <td>{{number_format((float)$task->price, 2)}}</td>
                                                </tr>
                                            @empty
                                            <tr class="text-center mt-4">
                                                <th colspan="6">No data found</th>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @if(count($tasks) > 0)
                                        {{ $tasks->links('pagination::bootstrap-5') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  --}}
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-between">
                                <h5 class="">Bank Deatils</h5>
                            </div>
                            <div class="card-body px-2 pt-1">
                                @php
                                    $bank = $invoice->proofReader->bank_details;
                                @endphp
                                @if($bank && is_array($bank))
                                    <h4>Bank Name : {{ $bank['bank_name'] }}</h4>
                                    <h4>Branch : {{ $bank['branch'] }}</h4>
                                    <h4>Account No. : {{ $bank['account_no'] }}</h4>
                                    <h4>IFSC : {{ $bank['ifsc'] }}</h4>
                                @else
                                    <p class="text-danger">Bank Details Not Available!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{--  --}}
            </section>
        </div>
    </div>
</div>
@endsection