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
                            <h2 class="content-header-title float-start mb-0">@lang('Transcription')</h2>
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
                                        <input type="text" name="search" id="search" class="form-control ms-2" value="{{ request('search') }}" placeholder="Search Name">
                                        <button type="submit" class="btn btn-primary ms-.5"><i class="fa fa-search"></i></button>
                                    </form>
                
                                    <a href="{{ url()->current() }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                                </div>
                
                                <div class="card-datatable table-responsive">
                                    <table class="datatables-ajax table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-nowrap">@lang('ID')</th>
                                                <th class="text-nowrap">@lang('Start date')</th>
                                                <th class="text-nowrap">@lang('Name')</th>
                                                <th class="text-nowrap">@lang('File Name')</th>
                                                <th class="text-nowrap">@lang('Transcription')</th>
                                                <th class="text-nowrap">@lang('Duration')</th>
                                                <th class="text-nowrap">@lang('Package')</th>
                                                <th class="text-nowrap">@lang('Status')</th>
                                                <th class="text-nowrap">@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($transcriptions) > 0)
                                                @foreach ($transcriptions as $index => $transcription)
                                                    <tr>
                                                        <td class="text-nowrap">{{ $index + 1 }}</td>
                                                        <td>{{ !empty($transcription->created_at) ? \Carbon\Carbon::parse($transcription->created_at)->format('d-m-Y') : 'N/A' }}</td>
                                                        <td class="text-nowrap">{{ optional($transcription->getUserName)->first_name }} {{ optional($transcription->getUserName)->last_name }}</td>
                                                        <td class="text-nowrap">{{ $transcription->audio_file_original_name }}</td>
                                                        <td class="text-nowrap">{{ \Illuminate\Support\Str::words($transcription->transcription_from_api, 6, '...') }}</td>
                                                        <td class="text-nowrap">{{ gmdate('i:s', $transcription->audio_file_duration) }}</td>
                                                        <td class="text-nowrap">{{ optional($transcription->getPackage)->name }} </td>
                                                        <td class="text-nowrap"> @if($transcription->status == 0)
                                                                <div class="spinner-border text-primary" role="status">
                                                                    <span class="visually-hidden">Loading...</span>
                                                                </div>
                                                            @else
                                                                <span class="badge rounded-pill bg-success">Transcribed</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-nowrap">
                                                            <a class="btn btn-outline-success" href="{{route('admin.transcription.detail',$transcription->id)}}" id="editblog"><i class="fa fa-eye"></i></a>
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
                            @if (count($transcriptions) > 0)
                            {{ $transcriptions->links('pagination::bootstrap-5') }}
                           @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
