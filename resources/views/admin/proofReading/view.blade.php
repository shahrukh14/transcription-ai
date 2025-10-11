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
                                {{ $tasks->transcription->audio_file_original_name }}
                            </h4>
                            <h6 class="card-title">
                                @if($tasks->transcription->status == 0)
                                    <span class="rounded-pill badge-light-warning me-1">Untranscribed</span>
                                @else
                                    <span class="badge rounded-pill badge-light-success me-1">Transcribed</span>
                                @endif
                            </h6>
                        </div><hr>
                        <div class="card-body pt-0">
                            <div class="row">
                                <p class="fw-bolder">{{date('d M Y, h:i A', strtotime($tasks->transcription->created_at))}}</p>
                                <div class="form-floating col-md-12">
                                    @php 
                                        $speakerMap = []; 
                                        $speakerCounter = 1;
                                        $transcription_segments = $tasks->transcription_segments == null ? $tasks->transcription->transcription_segments : $tasks->transcription_segments;
                                    @endphp
                                    @foreach (json_decode($transcription_segments)??[] as $segment)
                                        @php
                                            if (!isset($speakerMap[$segment->speaker])) {
                                                $speakerMap[$segment->speaker] = 'Speaker ' . $speakerCounter++;
                                            }
                                            $timeInSeconds  = $segment->start;
                                            $minutes        = floor($timeInSeconds / 60);
                                            $seconds        = $timeInSeconds - ($minutes * 60);
                                            $roundedSeconds = round($seconds);
                                            $formattedTime  = sprintf("%02d:%02d", $minutes, $roundedSeconds);
                                        @endphp
                                        <div class="pt-1">
                                            <span class="fw-bolder speaker">{{ $speakerMap[$segment->speaker] }}</span>
                                            <p @if($tasks->status != "Complete") class="segment" @endif data-start="{{$segment->start}}"  data-id="{{$segment->id}}"  data-text="{{$segment->text}}" data-speaker="{{$segment->speaker}}" >
                                            <span style="color: #717272" class="time-stamp">({{ $formattedTime}})</span>{{$segment->text}} </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="w-100">
                                <h6 class="card-title text-center mb-0">{{ $tasks->transcription->audio_file_original_name }}</h6>
                                <audio id="plyr-audio-player" class="audio-player w-100" controls>
                                    <source src="{{ asset('user/audios/' . $tasks->transcription->audio_file_name) }}" type="audio/mp3" />
                                </audio>
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
                                    <a href="{{ route('user.transcription.pdf.download',$tasks->transcription->id) }}" title="PDF Download" id="pdfDownloadUrl" data-base-url="{{ route('user.transcription.pdf.download', $tasks->transcription->id) }}">
                                        <i class="fa-solid fa-file-pdf"></i>Download PDF
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('user.transcription.docx.download',$tasks->transcription->id) }}" title="PDF Download" id="docxDownloadUrl" data-base-url="{{ route('user.transcription.docx.download', $tasks->transcription->id) }}">
                                        <i class="fa-solid fa-file-word"></i>Download DOCX
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ asset('user/audios/' . $tasks->transcription->audio_file_name) }}" title="Download Audio File"  download="{{$tasks->transcription->audio_file_original_name}}">
                                        <i class="fa-solid fa-cloud-arrow-down"></i>Download Audio
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div> 
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
</style>
@endpush



@push('script')
<script> 
$(document).ready(function () {

//select2 initialization
$('.select2').select2({
    placeholder: "Select",
    allowClear: true,
    dropdownParent: $('#speaker_select').parent()
});

const audio = document.getElementById('plyr-audio-player');

// Segment hover background dark
$('.segment').on('mouseover', function () {
    $(this).css('background-color', '#c0c0c073');
}).on('mouseout', function () {
    $(this).css('background-color', 'transparent');
});


//Segment edit modal open
$('.segment').on('click', function () {

    //Open edit Modal
    let data = $(this).data();
    let modal = $('#editModal');
    modal.find('#segment_id').val(data.id)
    modal.find('#text').text(data.text)
    modal.find('#speaker_select').val(data.speaker)
    modal.modal('show');

 
    // Play Audio from start time
    let startTime = parseFloat(data.start);

    if (audio.readyState >= 1) { // Audio is loaded
        audio.pause(); // Pause first to avoid overlapping play
        audio.currentTime = startTime;

        // Wait for seek to complete
        audio.addEventListener('seeked', function onSeeked() {
            audio.play();
            audio.removeEventListener('seeked', onSeeked); // remove listener after it fires
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
});

});
</script>
@endpush
