@extends('admin.layouts.layout')
@section('title', 'subscription')
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
                            <h2 class="content-header-title float-start mb-0">@lang('subscription')</h2>
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
                                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                    <form action="" method="GET" class="d-flex align-items-center m-bottom-4 w-auto">
                                        <div class="formData d-flex">
                                            <input type="text" class="form-control flatpickr-input from" placeholder="From Date" name="from" 
                                                value="{{ request('from') }}" />
                                            <input type="text" class="form-control flatpickr-input to ms-2" placeholder="To Date" name="to" 
                                                value="{{ request('to') }}" />
                                        </div>
                                        <select name="status" class="form-control ms-2 w-auto">
                                            <option value="">All</option>
                                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary ms-2">Search</button>
                                        <a href="{{ url()->current() }}" class="btn btn-primary ms-2">
                                            <i class="fa-solid fa-rotate-right"></i>
                                        </a>
                                    </form>
                                    <form action="" method="GET" class="d-flex">
                                        <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Search Name">
                                        <button type="submit" class="btn btn-primary ms-1"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                                
                                <div class="card-datatable table-responsive">
                                    <table class="datatables-ajax table table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('ID')</th>
                                                <th>@lang('Name')</th>
                                                <th>@lang('Package')</th>
                                                <th>@lang('Amount')</th>
                                                <th>@lang('Start Date')</th>
                                                <th>@lang('Expiry Date')</th>
                                                <th>@lang('Status')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($subscriptions) > 0)
                                                @foreach ($subscriptions as $index => $subscription)
                                                @php
                                                    $expiryDate = \Carbon\Carbon::parse($subscription->expiry_date);
                                                    $isActive = $expiryDate->isFuture() || $expiryDate->isToday();
                                                @endphp
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ optional($subscription->getUser)->first_name }} {{ optional($subscription->getUser)->last_name }}</td>
                                                        <td>{{ optional($subscription->getPackage)->name }}</td>
                                                        <td>₹{{ $subscription->amount }}</td>
                                                        <td>{{ !empty($subscription->created_at) ? \Carbon\Carbon::parse($subscription->created_at)->format('d-m-Y') : 'N/A' }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($subscription->expiry_date)->format('d-m-Y') }}</td>
                                                        <td>   @if($isActive)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-danger">Expired</span>
                                                        @endif</td>
                                                        <td>
                                                            <a class="btn btn-outline-success" href="{{route('admin.subscription.detail',$subscription->id)}}" id="editblog"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="text-center">
                                                    <td colspan="6">No data found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if (count($subscriptions) > 0)
                                {{ $subscriptions->links('pagination::bootstrap-5') }}
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
