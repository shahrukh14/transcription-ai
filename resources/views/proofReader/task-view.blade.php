@extends('proofReader.layouts.layout')
@section('title', 'Transcription View')
@section('content')
    <!-- BEGIN: Content-->
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
                                    @if($task->transcription->status == 0)
                                        <span class="rounded-pill badge-light-warning me-1">Untranscribed</span>
                                    @else
                                        <span class="badge rounded-pill badge-light-success me-1">Transcribed</span>
                                    @endif
                                </h6>
                            </div><hr>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <p class="fw-bolder">{{date('d M Y, h:i A', strtotime($task->transcription->created_at))}}</p>
                                    <div class="form-floating col-md-12">
                                        @php 
                                            $speakerMap = []; 
                                            $speakerCounter = 1;
                                            $transcription_segments = $task->transcription_segments == null ? $task->transcription->transcription_segments : $task->transcription_segments;
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
                                                <span class="playAudio" data-start="{{ $segment->start }}"><i class="fa-solid fa-music"></i></span>
                                                <p class="@if($task->status != 'Complete') segment @endif segment-style" data-start="{{ $segment->start }}" data-id="{{ $segment->id }}" data-speaker="{{ $segment->speaker }}">
                                                    <span style="color: #717272" class="time-stamp">({{ $formattedTime }})</span>
                                                    <span class="editable" contenteditable="false">{{ $segment->text }}</span>
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="w-100">
                                    <h6 class="card-title text-center mb-0">{{ $task->transcription->audio_file_original_name }}</h6>
                                    <audio id="plyr-audio-player" class="audio-player w-100" controls>
                                        <source src="{{ asset('user/audios/' . $task->transcription->audio_file_name) }}" type="audio/mp3" />
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
                                        <a href="{{ route('proof-reader.pdf.download',$task->transcription->id) }}" title="PDF Download" id="pdfDownloadUrl" data-base-url="{{ route('user.transcription.pdf.download', $task->transcription->id) }}">
                                            <i class="fa-solid fa-file-pdf"></i>Download PDF
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('proof-reader.docx.download',$task->transcription->id) }}" title="PDF Download" id="docxDownloadUrl" data-base-url="{{ route('user.transcription.docx.download', $task->transcription->id) }}">
                                            <i class="fa-solid fa-file-word"></i>Download DOCX
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ asset('user/audios/' . $task->transcription->audio_file_name) }}" title="Download Audio File"  download="{{$task->transcription->audio_file_original_name}}">
                                            <i class="fa-solid fa-cloud-arrow-down"></i>Download Audio
                                        </a>
                                    </li>
                                </ul>
                                <h4 class="mb-1">More</h4>
                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="timestamp_visible" name="timestamp_visible" checked />
                                            <label class="form-check-label fw-bolder" for="timestamp_visible">Show Timestamps</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="speaker_visible" name="speaker_visible" checked />
                                            <label class="form-check-label fw-bolder" for="speaker_visible">Show Speaker</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($task->status == "Complete")
                            <button type="button" class="btn btn-success w-100" disabled> Completed </button>
                        @else
                            <a href="{{ route('proof-reader.tasks.mark-as-complete', ['id' => $task->id]) }}"  class="btn btn-success w-100"> Mark as complete </a>
                        @endif
                    </div>
                </div>   
            </div>
        </div>
    </div> 
    <!-- END: Content-->
@endsection

@push('modal')
<!-- Edit Modal Start-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('proof-reader.tasks.update',$task->id) }}" method="POST">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel"> <i class="fa-solid fa-pen-to-square"></i> Edit Transcription</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="segment_id" id="segment_id">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="speaker_select" class="form-label"><i class="fa-solid fa-user"></i> Speaker</label>
                            <select class="form-select select2" id="speaker_select" name="speaker" aria-label="Speaker count selection" >
                                <option selected disabled>Speaker</option>
                                @foreach ($speakerMap as $key => $name)
                                    <option value="{{$key}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="text" class="form-label"><i class="fa-solid fa-file-lines"></i> Text</label>
                            <textarea class="form-control" name="text" id="text"></textarea>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal End-->
@endpush

@push('style')
<style>
    .segment-style{
        font-size: 16px;
        cursor: pointer;
        border-radius: 3px;
        margin-top: 6px;
        padding: 3px 1px 3px 1px; 
    }
    .segment .editable[contenteditable="true"] {
        border: 1px solid #007bff !important;
        padding: 2px;
        border-radius: 4px;
    }
    .playAudio{
        cursor: pointer;
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

    // Load saved state on page load
    if (localStorage.getItem('speaker_visible') === 'true') {
        $('#speaker_visible').prop('checked', true);
    } else {
        $('#speaker_visible').prop('checked', false);
    }

    if (localStorage.getItem('timestamp_visible') === 'true') {
        $('#timestamp_visible').prop('checked', true);
    } else {
        $('#timestamp_visible').prop('checked', false);
    }

    // Reflect initial state
    showHideSpeakerAndTimeStamp();
    updateDownloadUrl();

    const audio = document.getElementById('plyr-audio-player');

    // Segment hover background dark
    // $('.segment').on('mouseover', function () {
    //     $(this).css('background-color', '#c0c0c073');
    // }).on('mouseout', function () {
    //     $(this).css('background-color', 'transparent');
    // });

    //Time Stamp show/hide
    $('#timestamp_visible').on('click', function (){
        localStorage.setItem('timestamp_visible', $(this).is(':checked'));
        showHideSpeakerAndTimeStamp();
        updateDownloadUrl();
    });

    //Speaker show/hide
    $('#speaker_visible').on('click', function (){
        localStorage.setItem('speaker_visible', $(this).is(':checked'));
        showHideSpeakerAndTimeStamp();
        updateDownloadUrl();
    });


    // Make the span editable on click
    $(document).on('click', '.segment .editable', function (e) {
        e.stopPropagation(); // Avoid triggering document click
        $('.editable').not(this).attr('contenteditable', 'false'); // Close others
        $(this).attr('contenteditable', 'true').focus();
        originalText = $(this).text().trim();
    });

    // Detect blur (click outside or focus out)
    $(document).on('blur', '.editable', function () {
        let $span = $(this);
        let newText = $span.text().trim();
        if (newText !== originalText) {
            let $p = $span.closest('.segment');
            let segmentId = $p.data('id');
            let speaker = $p.data('speaker');

            $.ajax({
                url: "{{ route('proof-reader.tasks.update', $task->id) }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    segment_id: segmentId,
                    speaker: speaker,
                    text: newText
                },
                success: function (response) {
                    toastr.success(response.message);
                },
                error: function (xhr) {
                    toastr.error('SOmething went wrong');
                    $span.text(originalText); // revert
                }
            });
        }
        $span.attr('contenteditable', 'false');
    });

    // Prevent deselecting by clicking inside editable again
    $(document).on('mousedown', '.editable', function (e) {
        e.stopPropagation();
    });

    // Click anywhere else makes all editable false
    $(document).on('click', function () {
        $('.editable').attr('contenteditable', 'false');
    });

    function showHideSpeakerAndTimeStamp(){
        //Speaker show/hide
        if ($('#speaker_visible').is(':checked')){
            $('.speaker').show();
        }else{
            $('.speaker').hide();
        }

        //Time Stamp show/hide
        if ($('#timestamp_visible').is(':checked')){
            $('.time-stamp').show();
        }else{
            $('.time-stamp').hide();
        }
    }

    // Update the URL based on checkboxes
    function updateDownloadUrl() {
        let speaker = $('#speaker_visible').is(':checked');
        let timestamp = $('#timestamp_visible').is(':checked');

        let pdfBaseUrl = $('#pdfDownloadUrl').data('base-url');
        let pdfFullUrl = `${pdfBaseUrl}?speaker=${speaker}&timestamp=${timestamp}`;

        let docxBaseUrl = $('#docxDownloadUrl').data('base-url');
        let docxFullUrl = `${docxBaseUrl}?speaker=${speaker}&timestamp=${timestamp}`;

        $('#pdfDownloadUrl').attr('href', pdfFullUrl);
        $('#docxDownloadUrl').attr('href', docxFullUrl);
    }

    $('.playAudio').on('click', function () {
        let time = $(this).data('start');
        let startTime = parseFloat(time);
        playAudio(startTime)
    });

    function playAudio(startTime){
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
    }

});
</script>
@endpush


