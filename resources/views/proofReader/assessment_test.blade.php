@extends('proofReader.layouts.layout')
@section('title', 'Assessment Test')
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
                                <h4 class="card-title">{{ $test->name }}</h4>
                                <h4 class="card-title text-success timerRunning"></h4>
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
                            <div class="card-header"></div><hr>
                            <div class="card-body pt-0">
                                <form action="{{ route('proof-reader.assessment.test.final.submit', $test->id) }}" method="POST" id="finalSubmitForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mt-1">
                                            <input type="hidden" name="auto_submit" id="auto_submit" value="0">
                                            <button type="submit" class="btn btn-outline-success w-100">Final Sumbit</button>
                                        </div>
                                    </div>
                                </form>
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
const examStartTime = "{{ \Carbon\Carbon::parse($test->start_time)->format('Y-m-d H:i:s') }}";
const examDurationMinutes = "{{ $assessmentTest->test_duration }}";
$(document).ready(function () {
    let originalText = '';
    let segmentEndTime = null;
    const audio = document.getElementById('plyr-audio-player');

    const startTime = new Date(examStartTime);
    const duration = examDurationMinutes * 60; // convert mins to seconds
    const endTime = new Date(startTime.getTime() + duration * 1000); // Calculate end time

    console.log(startTime);
    console.log(duration);
    console.log(endTime);

    // Update timer every second
    const timerInterval = setInterval(function () {
        const now = new Date(); // this is client's time

        // Calculate difference in seconds
        let diff = Math.floor((endTime - now) / 1000);

        if (diff <= 0) {
            clearInterval(timerInterval);
            $('.timerRunning').text('00:00:00');
            $('#auto_submit').val(1);
            $('#finalSubmitForm').submit();
            return;
        }

        const hours = String(Math.floor(diff / 3600)).padStart(2, '0');
        const minutes = String(Math.floor((diff % 3600) / 60)).padStart(2, '0');
        const seconds = String(diff % 60).padStart(2, '0');

        $('.timerRunning').text(`${hours}:${minutes}:${seconds}`);
    }, 1000);

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
                url: "{{ route('proof-reader.assessment.test.segment.update', $test->id) }}",
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