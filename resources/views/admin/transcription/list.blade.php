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
                            <h2 class="content-header-title float-start mb-0">@lang('Transcriptions')</h2>
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
                                    <form action="" method="GET" class="d-flex align-items-center m-bottom-4 w-auto gap-1">
                                        <div class="formData d-flex gap-1">
                                            <input type="text" class="form-control flatpickr-input from" placeholder="From Date" name="from" value="{{ request('from') }}" />
                                            <input type="text" class="form-control flatpickr-input to ms-.5" placeholder="To Date" name="to" value="{{ request('to') }}" />
                                        </div>
                                        <button type="submit" class="btn btn-primary ms-.5">Search</button>
                                    </form>
                                    <form action="" method="GET" class="d-flex gap-1">
                                        <input type="text" name="search" id="search" class="form-control ms-2" value="{{ request('search') }}" placeholder="Search Name">
                                        <button type="submit" class="btn btn-primary ms-.5"><i class="fa fa-search"></i></button>
                                    </form>
                                    <a href="{{ url()->current() }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                                </div>
                
                                <div class="card-datatable table-responsive">
                                    <table class="datatables-ajax table table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('Audio')</th>
                                                <th>@lang('Uploaded at')</th>
                                                <th>@lang('Duration')</th>
                                                <th>@lang('Language')</th>
                                                <th>@lang('Status')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($transcriptions) > 0)
                                                @foreach ($transcriptions as $index => $transcription)
                                                @php
                                                    $timeInSeconds  = $transcription->audio_file_duration;
                                                    $minutes        = floor($timeInSeconds / 60);
                                                    $seconds        = $timeInSeconds - ($minutes * 60);
                                                    $roundedSeconds = round($seconds);
                                                    $duration  = "{$minutes}m {$roundedSeconds}s";
                                                @endphp
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('admin.transcription.detail',$transcription->id)}}" title="{{ $transcription->audio_file_original_name }}">
                                                                {{ Str::limit($transcription->audio_file_original_name, 50, '...') }}
                                                            </a>
                                                        </td>
                                                        <td>{{date('d M Y, h:i A', strtotime($transcription->created_at))}} </td>
                                                        <td>{{ $duration }} </td>
                                                        <td>{{ ucfirst($transcription->language) }}</td>
                                                        <td>
                                                            @if($transcription->status == 0)
                                                                <span class="badge rounded-pill badge-light-secondary me-1">Untranscribed</span>
                                                            @else
                                                                <span class="badge rounded-pill badge-light-success me-1">Transcribed</span>
                                                            @endif
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
