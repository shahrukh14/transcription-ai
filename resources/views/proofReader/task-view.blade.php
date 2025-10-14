@extends('proofReader.layouts.layout')
@section('title', 'Task View')
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
                                                    <div class="dropdown speaker">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow p-0 fw-bolder speakerNameText" data-bs-toggle="dropdown">
                                                            {{ $allSpeakers[$segment->speaker] }}
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            @foreach ($allSpeakers as $speakrValue => $speakerName)
                                                                <a class="dropdown-item speakerDropdown" href="#" data-speaker="{{ $speakrValue }}" data-id="{{ $segment->id }}">
                                                                    <span>{{ $speakerName }}</span>
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <span class="playAudio" data-start="{{ $segment->start }}" data-end="{{ $segment->end }}">
                                                        <i class="fa-solid fa-volume-high"></i>
                                                    </span>
                                                    <span class="addSegment" data-id="{{ $segment->id }}" data-language="{{ $segment->language }}">
                                                        <i class="fa-solid fa-square-plus" style="cursor: pointer;"></i>
                                                    </span>
                                                </div>
                                                <p class="@if($task->status != 'Completed') segment @endif segment-style" data-start="{{ $segment->start }}" data-end="{{ $segment->end }}" data-id="{{ $segment->id }}" data-speaker="{{ $segment->speaker }}">
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
                                <div>
                                    <span class="fw-bolder h4 timerRunning">Timer Running</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <span class="fw-bolder h4">Proof Reading Cost : ₹ {{number_format($task->price,2)}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4>Export</h4>
                                <ul class="list-group mb-1">
                                    <li class="list-group-item">
                                        <a href="{{ route('proof-reader.pdf.download',$task->id) }}" title="PDF Download" id="pdfDownloadUrl" data-base-url="{{ route('proof-reader.pdf.download',$task->id) }}">
                                            <i class="fa-solid fa-file-pdf"></i> Download PDF
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('proof-reader.docx.download',$task->id) }}" title="PDF Download" id="docxDownloadUrl" data-base-url="{{ route('proof-reader.docx.download',$task->id) }}">
                                            <i class="fa-solid fa-file-word"></i> Download DOCX
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ asset('user/audios/' . $task->transcription->audio_file_name) }}" title="Download Audio File"  download="{{$task->transcription->audio_file_original_name}}">
                                            <i class="fa-solid fa-cloud-arrow-down"></i> Download Audio
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" title="Rename Speaker" class="renameSpeakerButton" data-id="{{$task->id}}">
                                            <i class="fa-solid fa-user-pen"></i> Rename Speaker
                                        </a>
                                    </li>
                                </ul>

                                @if($task->attachment != null)
                                <h4 class="mb-1">Attachments</h4>
                                <div class="row">
                                    @foreach (json_decode($task->attachment) as $attachment)
                                        <div class="col-md-12 mb-1">
                                            <a href="{{ asset('proofreading/attachments/' . $attachment) }}" title="Download Attachment" download="{{$attachment}}">
                                                <i class="fa-solid fa-file-arrow-down"></i> {{$attachment}}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                @endif

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
                        @if($task->status == "Completed")
                            <button type="button" class="btn btn-success w-100" disabled> Completed </button>
                        @else
                            <a href="{{ route('proof-reader.tasks.mark-as-complete', ['id' => $task->id]) }}"  class="btn btn-success w-100"> Mark as complete </a>
                        @endif
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

@push('modal')
<!-- add segment Modal Start-->
<div class="modal fade" id="addSegmentModal" tabindex="-1" aria-labelledby="addSegmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('proof-reader.tasks.segment.add', $task->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="addSegmentModalLabel"><i class="fa-solid fa-plus-square"></i> Add Segment</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="text" class="form-label">Text<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="text" id="text" placeholder="Enter transcription" required></textarea>
                        </div>
                        <div class="col-md-12 mb-1">
                            <label for="speaker_select" class="form-label">Speakers <span class="text-danger">*</span></label>
                            <select class="select2 form-select" id="speaker_select" name="speaker" required>
                                <option value="">Select speaker</option>
                                @foreach ($allSpeakers as $speakrValue => $speakerName)
                                    <option value="{{$speakrValue}}">{{$speakerName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="start_time" class="form-label">Start Time (in seconds)<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="start_time" id="start_time" step="any" required>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="end_time" class="form-label">End Time (in seconds)<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="end_time" id="end_time" step="any" required>
                        </div>
                        <input type="hidden" name="language" id="segment_language">
                        <input type="hidden" name="previous_segment_id" id="previous_segment_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add segment Modal End-->

<!-- Speaker Rename Modal Start-->
<div class="modal fade" id="speakerRenameModal" tabindex="-1" aria-labelledby="speakerRenameModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('proof-reader.tasks.speaker.rename') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="speakerRenameModalLabel"><i class="fa-solid fa-user-pen"></i> Rename Speaker</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="task_id" name="task_id">
                    @foreach ($allSpeakers as $speakrValue => $speakerName)
                    <div class="row">
                        <div class="col-md-6">
                            <label for="speaker" class="form-label">Default Name</label>
                            <input type="text" class="form-control mb-1" id="speaker" value="{{$speakerName}}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="new_name" class="form-label">New Name</label>
                            <input type="text" class="form-control mb-1" name="{{$speakrValue}}" id="new_name" placeholder="Enter new name" value="{{$speakerName}}">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Rename</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Speaker Rename Modal End-->
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
   
    input[type=checkbox] ~ label, input[type=radio] ~ label {
        line-height: 24px !important;
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


    // On span click → hide span, show input
    $(document).on('click', '.segment .editable-text', function () {
        audio.pause();
        let $span = $(this);
        let $p = $span.closest('.segment');
        let $input = $p.find('.edit-input');
        originalText = $span.text().trim();
        $span.addClass('d-none');
        $input.val(originalText).removeClass('d-none').focus();
    });

    // On blur of input → AJAX save
    $(document).on('blur', '.edit-input', function () {
        let $input = $(this);
        let newText = $input.val().trim();
        let $p = $input.closest('.segment');
        let $span = $p.find('.editable-text');
        let segmentId = $p.data('id');
        let speaker = $p.data('speaker');

        // Only send AJAX if text was changed
        if (newText !== originalText) {
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
                    $span.text(newText);
                },
                error: function () {
                    toastr.error('Something went wrong');
                    $input.val(originalText);
                },
                complete: function () {
                    $input.addClass('d-none');
                    $span.removeClass('d-none');
                }
            });
        } else {
            $input.addClass('d-none');
            $span.removeClass('d-none');
        }
    });
 
    //Update speaker on dropdown click
    $('.speakerDropdown').on('click', function (e){
        let $clicked = $(this); // store reference to clicked element
        let data = $clicked.data();
        let speakerNameText = $clicked.text().trim();
        let segmentId = data.id;
        let speaker = data.speaker;

        $.ajax({
            url: "{{ route('proof-reader.tasks.speaker.update', $task->id) }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                segment_id: segmentId,
                speaker: speaker,
                speaker_name: speakerNameText,
            },
            success: function (response) {
                toastr.success(response.message);
                $clicked.closest('.dropdown').find('.speakerNameText').text(speakerNameText);
            },
            error: function () {
                toastr.error('Something went wrong');
            }
        });
    });

    //Rename Speaker
    $(document).on('click', '.renameSpeakerButton', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let modal = $('#speakerRenameModal');
        modal.find('#task_id').val(id);
        modal.modal('show');
    });
    
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

    //add segment modal open
    $('.addSegment').on('click', function () {
        let $data = $(this).data();
        let modal = $('#addSegmentModal');
        modal.find('#previous_segment_id').val($data.id);
        modal.find('#segment_language').val($data.language);
        modal.modal('show');
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
});
</script>
@endpush

@if($task->status == 'Claimed' && $task->claimed_dt != null && $task->claimed_by == auth()->guard('reader')->user()->id)

@push('script')
<script> 

const claimTime = "{{ \Carbon\Carbon::parse($task->claimed_dt)->format('Y-m-d H:i:s') }}";
const durationMinutes = "{{ $task->proof_reading_time_duration }}"; //In minutes
const markAsCompleteUrl = "{{ route('proof-reader.tasks.mark-as-complete', ['id' => $task->id]) }}";

$(document).ready(function () {
    const startTime = new Date(claimTime);
    const duration = durationMinutes * 60; // convert mins to seconds
    const endTime = new Date(startTime.getTime() + duration * 1000); // Calculate end time

    // Update timer every second
    const timerInterval = setInterval(function () {
        const now = new Date(); // this is client's time

        // Calculate difference in seconds
        let diff = Math.floor((endTime - now) / 1000);

        if (diff <= 0) {
            clearInterval(timerInterval);
            $('.timerRunning').text('00:00:00');
            window.location.href = markAsCompleteUrl;
            return;
        }

        const hours = String(Math.floor(diff / 3600)).padStart(2, '0');
        const minutes = String(Math.floor((diff % 3600) / 60)).padStart(2, '0');
        const seconds = String(diff % 60).padStart(2, '0');

        $('.timerRunning').text(`Remaining Time : ${hours}:${minutes}:${seconds}`);
    }, 1000);
});

</script>
@endpush
@endif

