@extends('admin.layouts.layout')
@section('title', 'View Segments')

@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        @if (Session::has('success'))
            <p class="alert alert-success text-center fs-3 py-1">{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('error'))
            <p class="alert alert-danger text-center fs-3 py-1"> {{ Session::get('error') }}</p>
        @endif
        <div class="content-body">
            <div class="row">
                 <div class="col-xl-9 col-md-9 col-6">
                    <div class="card w-100 mb-4">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4 class="card-title">
                                <i class="fa-regular fa-file-audio" style="font-size:25px;"></i> 
                                {{ $task->transcription->audio_file_original_name }}
                            </h4>
                            <h6 class="card-title">
                                @if ($task->status == "Completed")
                                    <span class="badge rounded-pill badge-light-success me-1">Completed</span>
                                @elseif($task->status == "Claimed")
                                    <span class="badge rounded-pill badge-light-warning me-1">Claimed</span>
                                @elseif($task->status == "Unclaimed")
                                    <span class="badge rounded-pill badge-light-danger me-1">Unclaimed</span>
                                @elseif($task->status == "Cancelled")
                                    <span class="badge rounded-pill badge-light-danger me-1">Cancelled</span>
                                @else
                                    <span class="badge rounded-pill badge-light-secondary me-1">Not Claimed</span>
                                @endif
                            </h6>
                        </div><hr>
                        <div class="card-body pt-0">
                            <div class="row">
                                <p class="fw-bolder">{{date('d M Y, h:i A', strtotime($task->created_at))}}</p>
                                <div class="form-floating col-md-12">
                                    @php 
                                        $transcription_segments = $task->transcription_segments;
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
                                                <span class="fw-bolder">{{ $allSpeakers[$segment->speaker] }}</span>
                                                <span class="playAudio" data-start="{{ $segment->start }}" data-end="{{ $segment->end }}">
                                                    <i class="fa-solid fa-volume-high"></i>
                                                </span>
                                            </div>
                                            <p class="@if($task->status != 'Completed') segment @endif segment-style" data-start="{{ $segment->start }}" data-end="{{ $segment->end }}" data-id="{{ $segment->id }}" data-speaker="{{ $segment->speaker }}">
                                                <span style="color: #717272" class="time-stamp">({{ $formattedTime }})</span>
                                                <span class="editable-text">{{ $segment->text }}</span>
                                                <input type="text" class="form-control edit-input d-none" value="{{ $segment->text }}">
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
                            <h4>Export</h4>
                            <ul class="list-group mb-1">
                                <li class="list-group-item">
                                    <a href="{{ route('admin.proof-reading.pdf.download',$task->transcription->id) }}" title="PDF Download" id="pdfDownloadUrl" data-base-url="{{ route('admin.proof-reading.pdf.download', $task->transcription->id) }}">
                                        <i class="fa-solid fa-file-pdf"></i> Download PDF
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('admin.proof-reading.docx.download',$task->transcription->id) }}" title="PDF Download" id="docxDownloadUrl" data-base-url="{{ route('admin.proof-reading.docx.download', $task->transcription->id) }}">
                                        <i class="fa-solid fa-file-word"></i> Download DOCX
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ asset('user/audios/' . $task->transcription->audio_file_name) }}" title="Download Audio File"  download="{{$task->transcription->audio_file_original_name}}">
                                        <i class="fa-solid fa-cloud-arrow-down"></i> Download Audio
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div>
                                <span class="fw-bolder h4">Proof Reading Cost : ₹ {{number_format($task->price,2)}}</span>
                            </div>
                            <!-- Price Update Form Start-->
                            @if($task->status == "Completed" && $task->admin_approved == 0)
                            <form action="{{ route('admin.proof-reading.price.update', ['id' => $task->id]) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-7 mt-1" style="padding-right:0px; ">
                                        <label for="price" class="form-label">Update Price</label>
                                        <input type="number" step="any" class="form-control" name="price" value="{{$task->price}}" id="price" required>
                                    </div>
                                    <div class="col-md-5" style="margin-top:37px; padding-left:10px;">
                                        <button class="btn btn-outline-primary w-100">Update</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                            <!-- Price Update Form End-->

                            <!-- Proof reading assign Form Start-->
                            @if($task->claimed_by == null)
                            <form action="{{ route('admin.proof-reading.assign', $task->id) }}" method="GET">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mt-1">
                                        <label for="price" class="form-label">Asign Proof reader</label>
                                        <select name="claimed_by" id="claimed_by" onchange="this.form.submit()" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach ($proofReaders as $reader)
                                            <option value="{{$reader->id}}">{{$reader->fullname()}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            @endif
                            <!-- Proof reading assign Form End-->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4>Approval</h4>
                            @if($task->admin_approved == 0)
                            <form action="{{ route('admin.proof-reading.approve', ['id' => $task->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mt-1">
                                        <label for="document" class="form-label">Document</label>
                                        <input type="file"  class="form-control" name="document" id="document" accept=".pdf, .docx">
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <button type="submit" class="btn btn-outline-success w-100">Approve</button>
                                    </div>
                                </div>
                            </form>
                            @else
                                <button class="btn btn-success w-100" disabled>Approved</button>
                            @endif
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
                <h6 class="card-title text-center mb-0">{{ $task->transcription->audio_file_original_name }}</h6>
                <audio id="plyr-audio-player" class="audio-player w-100" controls>
                    <source src="{{ asset('user/audios/' . $task->transcription->audio_file_name) }}" type="audio/mp3" />
                </audio>
            </div>
        </div>
    </div>
</div>
<!--/ AUDIO Player -->
<!-- END: Content-->
@endsection
@push('style')
<style>
    .segment{
        font-size: 16px;
        cursor: pointer;
        border-radius: 3px;
        margin-top: 6px;
        padding: 3px 1px 3px 1px; 
    }
     #sticky-audio-wrapper {
        position: sticky;
        bottom: 0;
        width: 100%;
        z-index: 1050; /* High z-index so it stays above other content */
    }

    #sticky-audio-player {
        border-radius: 0;
        margin: 0;
        box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.15); /* Shadow only on top to give floating feel */
        background-color: #fff;
    }

    #sticky-audio-player .card-body {
        padding: 0.5rem 1rem;
    }

    .audio-player {
        width: 100%;
        display: block;
    }

    .playAudio{
        cursor: pointer;
    }

    .highlight {
        background-color: yellow;
        border-radius: 4px;
    }
</style>
@endpush



@push('script')
<script> 
$(document).ready(function () {
    let originalText = '';
    let segmentEndTime = null;
    const audio = document.getElementById('plyr-audio-player');
    $('.playAudio').on('click', function () {
        let start = parseFloat($(this).data('start'));
        let end = parseFloat($(this).data('end'));
        segmentEndTime = end; // Set segment end time

        // Play audio from the start time
        playAudio(start);

        // Highlight current segment (manually, once)
        $('.editable-text').removeClass('highlight');
        let $segment = $(this).closest('.pt-1').find('.segment-style');
        $segment.find('.editable-text').addClass('highlight');
    });

    function playAudio(startTime) {
        if (audio.readyState >= 1) {
            audio.pause();
            audio.currentTime = startTime;
            audio.addEventListener('seeked', function onSeeked() {
                audio.play();
                audio.removeEventListener('seeked', onSeeked);
            });
        } else {
            audio.addEventListener('loadedmetadata', function onLoadedMeta() {
                audio.currentTime = startTime;
                audio.addEventListener('seeked', function onSeeked() {
                    audio.play();
                    audio.removeEventListener('seeked', onSeeked);
                });
                audio.removeEventListener('loadedmetadata', onLoadedMeta);
            });
        }
    }

    // Auto highlight the sentence based on audio time
    function highlightSegmentByTime(currentTime) {
        // Only highlight the next sentence after the current one finishes
        if (segmentEndTime && currentTime > segmentEndTime) {
            $('.editable-text.highlight').removeClass('highlight');
            
            // Find the next segment to highlight
            let $nextSegment = $('.segment-style').filter(function () {
                return parseFloat($(this).data('start')) > segmentEndTime;
            }).first();

            if ($nextSegment.length) {
                segmentEndTime = parseFloat($nextSegment.data('end')); // Update the end time
                $nextSegment.find('.editable-text').addClass('highlight'); // Highlight next sentence
            } else {
                segmentEndTime = null; // No more segments
            }
        }
    }

    audio.addEventListener('timeupdate', function () {
        let currentTime = audio.currentTime;
        highlightSegmentByTime(currentTime);
    });

});
</script>
@endpush
