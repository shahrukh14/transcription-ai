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
                        @if(auth()->guard('reader')->user()->assessment_1_complete == 0)
                            <h2 class="content-header-title float-start mb-0">Assessment 1</h2>
                        @else
                            <h2 class="content-header-title float-start mb-0">Assessment 2</h2>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
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
            <section id="ajax-datatable">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <span class="fw-bolder"> To begin this</span>
                                <ul class="mt-1">
                                    <li class="pb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s standard dummy text ever.</li>
                                    <li class="pb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s standard dummy text ever.</li>
                                    <li class="pb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s standard dummy text ever.</li>
                                    <li class="pb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s standard dummy text ever.</li>
                                </ul>
                                @if(auth()->guard('reader')->user()->re_do_assessment == 1)
                                <div class="demo-spacing-0 mt-2">
                                    <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                                        <div class="alert-body d-flex align-items-center">
                                            <i data-feather="info" class="me-50"></i>
                                            <span>Your last assessment test was rejected. You need to re attempt this assessment again </span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom"></div>
                            <div class="card-datatable table-responsive">
                                @if(auth()->guard('reader')->user()->assessment_1_complete == 1 && auth()->guard('reader')->user()->assessment_1_status == 0)
                                <div class="demo-spacing-0 p-1">
                                    <div class="alert alert-warning mt-1 alert-validation-msg" role="alert">
                                        <div class="alert-body d-flex align-items-center">
                                            <i data-feather="info" class="me-50"></i>
                                            <span>Your assessment 1 test is under review, you can attempt assessment 2 after the approval</span>
                                        </div>
                                    </div>
                                </div>
                                @else
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
                                                            {{-- For First Assessment --}}
                                                            @if(auth()->guard('reader')->user()->assessment_1_complete == 0) 
                                                                @if(auth()->guard('reader')->user()->assessment_1_complete == 1)
                                                                    <button class="btn btn-outline-secondary btn-sm" disabled><i class="fa-solid fa-ban"></i></button>
                                                                @else
                                                                    <a href="{{ route('proof-reader.assessment.test', $test->id) }}" class="btn btn-outline-primary btn-sm">Start</a>
                                                                @endif
                                                            @endif

                                                            {{-- For Second Assessment --}}
                                                            @if(auth()->guard('reader')->user()->assessment_1_complete == 1 && auth()->guard('reader')->user()->assessment_2_complete == 0)
                                                                @if(auth()->guard('reader')->user()->assessment_2_complete == 1)
                                                                    <button class="btn btn-outline-secondary btn-sm" disabled><i class="fa-solid fa-ban"></i></button>
                                                                @else
                                                                    <a href="{{ route('proof-reader.assessment.test', $test->id) }}" class="btn btn-outline-primary btn-sm">Start</a>
                                                                @endif
                                                            @endif
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
                                @endif

                                @if(auth()->guard('reader')->user()->assessment_2_complete == 1 && auth()->guard('reader')->user()->assessment_2_status == 0)
                                <div class="demo-spacing-0 p-1">
                                    <div class="alert alert-warning mt-1 alert-validation-msg" role="alert">
                                        <div class="alert-body d-flex align-items-center">
                                            <i data-feather="info" class="me-50"></i>
                                            <span>Your assessment 2 test is under review, please wait for the approval approval</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
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