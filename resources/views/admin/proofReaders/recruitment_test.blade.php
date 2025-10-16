@extends('admin.layouts.layout')
@section('title', 'Assesment Test View')
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
                        <h2 class="content-header-title float-start mb-0">@lang('Assesment Test View')</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-xl-9 col-md-9 col-6">
                    <div class="card w-100 mb-4">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title">{{ $test->assessment->name }}</h4>
                        </div><hr>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="form-floating col-md-12">
                                    @php 
                                        $transcription_segments = $test->transcription_segments;
                                    @endphp
                                    @foreach (json_decode($transcription_segments)??[] as $segment)
                                        @php
                                            $timeInSeconds  = $segment->start;
                                            $minutes        = floor($timeInSeconds / 60);
                                            $seconds        = $timeInSeconds - ($minutes * 60);
                                            $roundedSeconds = round($seconds);
                                            $formattedTime  = sprintf("%02d:%02d", $minutes, $roundedSeconds);
                                        @endphp
                                        <div class="pt-1">
                                            <div class="d-flex justify-content-start gap-1">
                                                <span>{{ $allSpeakers[$segment->speaker] }}</span>
                                                <span class="playAudio" data-start="{{ $segment->start }}" data-end="{{ $segment->end }}">
                                                    <i class="fa-solid fa-volume-high"></i>
                                                </span>
                                            </div>
                                            <p class="@if($test->status != 'Completed') segment @endif segment-style" data-start="{{ $segment->start }}" data-end="{{ $segment->end }}" data-id="{{ $segment->id }}" data-speaker="{{ $segment->speaker }}">
                                                <span style="color: #717272" class="time-stamp">({{ $formattedTime }})</span>
                                                <span class="editable-text">{{ $segment->text }}</span>
                                                <input type="text" class="form-control edit-input d-none" value="{{$segment->text}}">
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-3 col-3">
                    <div class="card">
                        <div class="card-body">
                            @if($test->auto_submit)
                                <h4> Auto Submitted By Timer</h4>
                            @else
                                <h4> Submitted By Proof reader</h4>
                            @endif
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('admin.proof-reader.recruitment.test.approve', $test->id)}}" class="btn btn-outline-success w-100 mb-1">Approve</a>
                            <a href="{{route('admin.proof-reader.recruitment.test.re.do', $test->id)}}" class="btn btn-outline-warning w-100 mb-1">Re-Do</a>
                            <a href="{{route('admin.proof-reader.recruitment.test.reject', $test->id)}}" class="btn btn-outline-danger w-100">Reject</a>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
 <!-- AUDIO Player-->
<div class="col-12" id="sticky-audio-wrapper">
    <div class="card" id="sticky-audio-player">
        <div class="card-body d-flex justify-content-center align-items-center">
            <div style="width: 53%; margin-left:8%;">
                <h6 class="card-title text-center mb-0">{{ $test->assessment->audio_file }}</h6>
                <audio id="plyr-audio-player" class="audio-player w-100" controls>
                    <source src="{{ asset('admin/assessments/audios/' . $test->assessment->audio_file) }}" type="audio/mp3" />
                </audio>
            </div>
        </div>
    </div>
</div>
<!--/ AUDIO Player -->
<!-- END: Content-->
@endsection
