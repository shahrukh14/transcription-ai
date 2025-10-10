@extends('user.layouts.layout')
@section('title', 'Dashboard')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <div class="card">
                            <div class="bg-dark text-center">
                                <div class="p-4">
                                    <p class="text-white">1 of 3 daily transcriptions used</p>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <a href="{{ route('pricing') }}" class="rts-btn btn__long border__white white__color">GO UNLIMITED</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Shortcuts</h5>
                                <p class="card-text p-2 bg-gray rounded text-start">
                                    <i class="fa-solid fa-bars"></i>
                                    Recent Files
                                </p>
                                <h5 class="card-title">Folders</h5>
                                <p class="card-text p-2 bg-gray rounded text-start">
                                    <i class="fa-solid fa-folder-plus"></i>
                                    Folders
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-4">
                        <div class="card w-100 mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <h6 class="card-title">
                                    <i class="fa-regular fa-file-audio" style="font-size:25px;"></i>{{$transcription->audio_file_original_name}}
                                </h6>
                                <h6 class="card-title">
                                    @if($transcription->status == 0)
                                        <span class="badge rounded-pill bg-warning">Untranscribed</span>
                                    @else
                                        <span class="badge rounded-pill bg-success">Transcribed</span>
                                    @endif
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-floating col-md-12">
                                        <p>{{date('d M Y, h:i A', strtotime($transcription->created_at))}}</p>
                                        @php $speakerMap = []; $speakerCounter = 1; @endphp
                                        @foreach (json_decode($transcription->transcription_segments)??[] as $segment)
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
                                            <span class="fw-bolder speaker">{{ $speakerMap[$segment->speaker] }}</span>
                                            <p class="segment px-1" data-start="{{$segment->start}}"><span style="color: #717272" class="time-stamp">({{ $formattedTime}})</span>{{$segment->text}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-foorter mt-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <audio id="audioPlayer" controls preload="auto" class="w-100">
                                            <source src="{{ asset('user/audios/' . $transcription->audio_file_name) }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Export</h5>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('user.transcription.pdf.download',$transcription->id) }}" title="PDF Download" class="card-text p-1 segment text-start" id="pdfDownloadUrl" data-base-url="{{ route('user.transcription.pdf.download', $transcription->id) }}">
                                    <i class="fa-solid fa-file-pdf"></i> Download PDF
                                </a><br>
                                <a href="{{ route('user.transcription.docx.download',$transcription->id) }}" title="PDF Download" class="card-text p-1 segment text-start" id="docxDownloadUrl" data-base-url="{{ route('user.transcription.docx.download', $transcription->id) }}">
                                    <i class="fa-solid fa-file-word"></i> Download DOCX
                                </a>
                            </div>
                            
                            <p class="fw-bolder m-1">More</p>
                            <div class="card-body">
                                <div class="check-box-area">
                                    <input type="checkbox" id="timestamp_visible" name="timestamp_visible" checked/>
                                    <label for="timestamp_visible">Show Timestamps</label>
                                </div>
                                <div class="check-box-area">
                                    <input type="checkbox" id="speaker_visible" name="speaker_visible" checked/>
                                    <label for="speaker_visible">Show Speaker</label>
                                </div>
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
    .content-body{
        margin: 40px 0 40px 0;
    }

    .bg-gray {
        background-color: #e0e3e7 !important;
    }
    .segment{
        cursor: pointer;
        border-radius: 3px;
    }

    input[type=checkbox] ~ label, input[type=radio] ~ label {
        line-height: 24px !important;
    }
</style>
@endpush

@push('script')
<script> 
$(document).ready(function () {
    const audio = document.getElementById('audioPlayer');

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

    // Segment hover background dark
    $('.segment').on('mouseover', function () {
        $(this).css('background-color', '#c0c0c0');
    }).on('mouseout', function () {
        $(this).css('background-color', 'transparent');
    });

    //Audio Play on segment click
    $('.segment').on('click', function () {debugger
        let startTime = parseFloat($(this).data('start'));
        let audioUrl = "{{ asset('user/audios/' . $transcription->audio_file_name) }}";

        // Only update src if not already set
        if (audio.currentSrc !== audioUrl) {
            audio.src = audioUrl;
            audio.load();
            audio.addEventListener('loadedmetadata', function onMeta() {
                audio.currentTime = startTime;
                console.log("Set to:", audio.currentTime);
                audio.play();
                audio.removeEventListener('loadedmetadata', onMeta);
            });
        } else {
            audio.currentTime = startTime;
            console.log("Set to:", audio.currentTime);
            audio.play();
        }
    });

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