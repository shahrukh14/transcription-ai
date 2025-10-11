@extends('proofReader.layouts.layout')
@section('title', 'Tasks')
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
                        <h2 class="content-header-title float-start mb-0">List of Assessment Tests</h2>
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
                            <div class="card-header border-bottom"></div>
                            <div class="card-datatable table-responsive">
                                <table class="datatables-ajax table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">@lang('Name')</th>
                                            <th class="text-nowrap">@lang('Audio')</th>
                                            <th class="text-nowrap">@lang('Language')</th>
                                            <th class="text-nowrap">@lang('Audio Duration')</th>
                                            <th class="text-nowrap">@lang('Test Duration')</th>
                                            <th class="text-nowrap">@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($tests))
                                            @foreach($tests as $test)
                                                @php
                                                    $timeInSeconds  = $test->audio_duration;
                                                    $hours          = floor($timeInSeconds / 3600);
                                                    $minutes        = floor(($timeInSeconds % 3600) / 60);
                                                    $seconds        = $timeInSeconds % 60;

                                                    $audioDuration  = '';
                                                    if ($hours > 0) {
                                                        $audioDuration .= "{$hours}hr ";
                                                    }
                                                    if ($minutes > 0 || $hours > 0) {
                                                        $audioDuration .= "{$minutes}min ";
                                                    }
                                                    $audioDuration .= "{$seconds}sec";

                                                    $testDurationInSeconds = ((int)$test->test_duration * 60);
                                                    $test_hours          = floor($testDurationInSeconds / 3600);
                                                    $test_minutes        = floor(($testDurationInSeconds % 3600) / 60);
                                                    $test_seconds        = $testDurationInSeconds % 60;

                                                    $testDuration  = '';
                                                    if ($test_hours > 0) {
                                                        $testDuration .= "{$test_hours}hr ";
                                                    }
                                                    if ($test_minutes > 0 || $test_hours > 0) {
                                                        $testDuration .= "{$test_minutes}min ";
                                                    }
                                                    if ($test_seconds > 0) {
                                                        $testDuration .= "{$test_seconds}sec";
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{$test->name}}</td>
                                                    <td>{{ Str::limit($test->audio_file_original_name, 50, '...') }}</td>
                                                    <td>{{ ucfirst($test->audio_language) }}</td>
                                                    <td>{{ $audioDuration }}</td>
                                                    <td>{{ $testDuration }}</td>
                                                    <td>
                                                        <a href="{{ route('proof-reader.assessment.test',$test->id) }}" class="btn btn-outline-primary btn-sm">Start</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr class="text-center mt-4">
                                            <th colspan="6">No data found</th>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
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