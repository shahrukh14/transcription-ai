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
                    <div class="col-xl-3 col-md-3 col-3">
                        <div class="card">
                            <div class="card-header bg-black">
                                @php
                                    if(auth()->user()->audioTrascriptionWithCurrentPackage() && auth()->user()->currentSubscription->transcription_limit){
                                        $percentage = (auth()->user()->audioTrascriptionWithCurrentPackage() / auth()->user()->currentSubscription->transcription_limit) * 100;
                                        $text = auth()->user()->audioTrascriptionWithCurrentPackage() ." of " .auth()->user()->currentSubscription->transcription_limit." transcriptions used";
                                    }else{
                                        $percentage = 0;
                                        $text = "No Subscription plan found";
                                    }
                                @endphp
                                <div class="w-100 text-center">
                                    <p class="text-white fw-bolder mb-2">{{$text}}</p>
                                    <div class="progress progress-bar-primary mb-2">
                                        <div class="progress-bar" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <a href="{{ route('pricing') }}" class="btn btn-outline-primary">GO UNLIMITED</a>
                                </div>
                            </div>
                            <div class="card-body pt-2">
                                <h4>Shortcuts</h4>
                                <ul class="list-group mb-1">
                                    <li class="list-group-item">
                                        <i class="fa-solid fa-bars"></i> Recent Files
                                    </li>
                                </ul>
                                <h4>Folders</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <i class="fa-solid fa-folder-plus"></i> Folders
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-md-7 col-6">
                        <div class="card w-100 mb-4">
                            <div class="card-header d-flex justify-content-between pb-0">
                                <h4 class="card-title">
                                    <i class="fa-regular fa-file-audio" style="font-size:25px;"></i> {{$transcription->audio_file_original_name}}
                                </h4>
                                <h6 class="card-title">
                                    @if($transcription->status == 0)
                                        <span class="rounded-pill badge-light-warning me-1">Untranscribed</span>
                                    @else
                                        <span class="badge rounded-pill badge-light-success me-1">Transcribed</span>
                                    @endif
                                </h6>
                            </div><hr>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <p class="fw-bolder">{{date('d M Y, h:i A', strtotime($transcription->created_at))}}</p>
                                    <div class="form-floating col-md-12">
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
                                            <div class="pt-1">
                                                <span class="fw-bolder speaker">{{ $speakerMap[$segment->speaker] }}</span>
                                                <p class="segment" data-start="{{$segment->start}}"  data-id="{{$segment->id}}"  data-text="{{$segment->text}}" data-speaker="{{$segment->speaker}}" ><span style="color: #717272" class="time-stamp">({{ $formattedTime}})</span>{{$segment->text}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-2 col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4>Export</h4>
                                <ul class="list-group mb-1">
                                    <li class="list-group-item">
                                        <a href="{{ route('user.transcription.pdf.download',$transcription->id) }}" title="PDF Download" id="pdfDownloadUrl" data-base-url="{{ route('user.transcription.pdf.download', $transcription->id) }}">
                                            <i class="fa-solid fa-file-pdf"></i>Download PDF
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('user.transcription.docx.download',$transcription->id) }}" title="PDF Download" id="docxDownloadUrl" data-base-url="{{ route('user.transcription.docx.download', $transcription->id) }}">
                                            <i class="fa-solid fa-file-word"></i>Download DOCX
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ asset('user/audios/' . $transcription->audio_file_name) }}" title="Download Audio File"  download="{{$transcription->audio_file_original_name}}">
                                            <i class="fa-solid fa-cloud-arrow-down"></i>Download Audio
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" title="Rename File" class="renameFileButton" data-name="{{$transcription->audio_file_original_name}}" data-id="{{$transcription->id}}">
                                            <i class="fa-solid fa-edit"></i> Rename File
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('user.transcription.delete',$transcription->id) }}" title="Delete File">
                                            <i class="fa-solid fa-trash"></i>Delete File
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

                        @if($transcription->add_to_proofreading == 1)
                            <button type="button" class="btn btn-secondary w-100" disabled> Added to Proof Reading </button>
                        @else
                            <a href="{{ route('user.transcription.app.to.proof.reading', ['id' => $transcription->id]) }}"  class="btn btn-primary w-100"> Add to Proof Reading </a>
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
                    <h6 class="card-title text-center mb-0">{{ $transcription->audio_file_original_name }}</h6>
                    <audio id="plyr-audio-player" class="audio-player w-100" controls>
                        <source src="{{ asset('user/audios/' . $transcription->audio_file_name) }}" type="audio/mp3" />
                    </audio>
                </div>
            </div>
        </div>
    </div>
    <!--/ AUDIO Player -->
    <!-- END: Content-->
@endsection

@push('modal')
<!-- Edit Modal Start-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('user.transcription.segment.update',$transcription->id) }}" method="POST">
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
 
<!-- File Rename Modal Start-->
<div class="modal fade" id="fileRenameModal" tabindex="-1" aria-labelledby="fileRenameModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('user.transcription.file.rename') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="fileRenameModalLabel"><i class="fa-solid fa-pen-to-square"></i> Rename File</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="renameFile" class="form-label">Name</label>
                            <input type="text" class="form-control mb-1" name="name" id="renameFile" placeholder="Enter new file name">
                            <input type="hidden" id="transcription_id" name="transcription_id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Rename</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- File Rename Modal End-->
@endpush


@push('style')
<style>
    .content-body{
        margin: 40px 0 40px 0;
    }

    .bg-gray {
        background-color: #e0e3e7 !important;
    }
    .segment{
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
                console.log("Audio seeked and played at:", startTime);
                audio.removeEventListener('seeked', onSeeked); // remove listener after it fires
            });
        } else {
            audio.addEventListener('loadedmetadata', function onLoadedMeta() {
                audio.currentTime = startTime;
                audio.addEventListener('seeked', function onSeeked() {
                    audio.play();
                    console.log("Audio seeked and played at:", startTime);
                    audio.removeEventListener('seeked', onSeeked);
                });
                audio.removeEventListener('loadedmetadata', onLoadedMeta);
            });
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

    //Rename File
    $(document).on('click', '.renameFileButton', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let name = $(this).data('name');
        let modal = $('#fileRenameModal');
        modal.find('#renameFile').val(name);
        modal.find('#transcription_id').val(id);
        modal.modal('show');
    });

});
</script>
@endpush