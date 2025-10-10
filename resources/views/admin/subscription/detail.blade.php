@extends('admin.layouts.layout')
@section('title', 'Subscription Detail')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">@lang('Subscription Details')</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.subscription.list') }}">Home</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <!-- User Details Card -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">User Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- User Avatar -->
                                    <div class="d-flex align-items-center">
                                        <span class="avatar">
                                            @if (!empty($detail->getUser->image)) 
                                                <img class="round"
                                                    src="{{ asset('admin/profileImage/' . $detail->getUser->username . '/' . $detail->getUser->image) }}"
                                                    alt="avatar" height="40" width="40">
                                            @else
                                                <img class="round"
                                                    src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}"
                                                    alt="default avatar" height="40" width="40">
                                            @endif
                                        </span>
                                        <div class="user-nav ms-2">
                                            <span class="fw-bolder">{{ $detail->getUser->first_name ?? 'N/A' }}</span>
                                            <span class="fw-bolder">{{ $detail->getUser->last_name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                            
                                    <div class="col-md-8 mt-2">
                                        <label class="form-label">Email</label>
                                        <p class="mt-1">{{ $detail->getUser->email ?? 'N/A' }}</p>
                                    </div>
                            
                                    <div class="col-md-4 mt-2">
                                        <label class="form-label">Phone</label>
                                        <p class="mt-1">{{ $detail->getUser->mobile ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Package Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="fw-bold">{{ $detail->getPackage->name ?? 'N/A' }}<h4>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-success">
                                            ₹{{ isset($detail->getPackage->amount) ? number_format($detail->getPackage->amount, 2) : '0.00' }}
                                        </h6>
                                    </div>
                                    @php
                                        $descriptions = json_decode($detail->getPackage->description ?? '[]', true);
                                    @endphp
                                    
                                    @if (!empty($descriptions) && is_array($descriptions))
                                        <div class="col-12 mt-2">
                                            <div class="border p-2 rounded bg-light">
                                                @foreach ($descriptions as $description)
                                                    <div class="d-flex align-items-center mb-2">
                                                        @php 
                                                            $imagePath = asset('admin/packages/descriptions/' . ($description['image'] ?? 'default.png'));
                                                        @endphp
                                                        <img src="{{ $imagePath }}" 
                                                             alt="Feature Image" 
                                                             width="40" height="50" 
                                                             class="rounded me-2 border">
                                                        <span class="fw-semibold">{{ $description['title'] ?? 'No Title' }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-12 mt-2">
                                            <p class="text-muted">No features available.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- New Card -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Subscription Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Start Date</label>
                                        <p class="mt-1">{{ !empty($detail->created_at) ? \Carbon\Carbon::parse($detail->created_at)->format('d-m-Y') : 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Expiry Date</label>
                                        <p class="mt-1">{{ !empty($detail->expiry_date) ? \Carbon\Carbon::parse($detail->expiry_date)->format('d-m-Y') : 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Row -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
