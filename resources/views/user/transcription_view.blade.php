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
                                            <p class="segment px-1" data-start="{{$segment->start}}"  data-id="{{$segment->id}}"  data-text="{{$segment->text}}" data-speaker="{{$segment->speaker}}" ><span style="color: #717272" class="time-stamp">({{ $formattedTime}})</span>{{$segment->text}}</p>
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
                                <a href="{{ route('user.transcription.pdf.download',$transcription->id) }}" title="PDF Download" class="card-text p-1 text-start" id="pdfDownloadUrl" data-base-url="{{ route('user.transcription.pdf.download', $transcription->id) }}">
                                    <i class="fa-solid fa-file-pdf"></i> Download PDF
                                </a><br>
                                <a href="{{ route('user.transcription.docx.download',$transcription->id) }}" title="PDF Download" class="card-text p-1 text-start" id="docxDownloadUrl" data-base-url="{{ route('user.transcription.docx.download', $transcription->id) }}">
                                    <i class="fa-solid fa-file-word"></i> Download DOCX
                                </a><br>
                                <a href="{{ asset('user/audios/' . $transcription->audio_file_name) }}" title="Download Audio File" class="card-text p-1 text-start" download="{{$transcription->audio_file_original_name}}">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>Download Audio
                                </a><br>
                                <a href="#" title="Rename File" class="card-text p-1 text-start renameFileButton" data-name="{{$transcription->audio_file_original_name}}" data-id="{{$transcription->id}}">
                                    <i class="fa-solid fa-edit"></i> Rename File
                                </a><br>
                                <a href="{{ route('user.transcription.delete',$transcription->id) }}" title="Delete File" class="card-text p-1 text-start">
                                    <i class="fa-solid fa-trash"></i>Delete File
                                </a><br>
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

                        @if($transcription->add_to_proofreading == 1)
                            <button type="button" class="btn w-100 p-2 my-3 btn-secondary" disabled> Added to Proof Reading </button>
                        @else
                            <a href="{{ route('user.transcription.app.to.proof.reading', ['id' => $transcription->id]) }}"  class="btn w-100 p-2 my-3 btn-primary"> Added to Proof Reading </a>
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
            <form action="{{ route('user.transcription.segment.update',$transcription->id) }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Transcription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <input type="hidden" name="segment_id" id="segment_id">
                <div class="mb-4">
                    <label for="speaker_select" class="form-label fw-semibold mb-2"><i class="fa-solid fa-user"></i> Speaker</label>
                    <select class="form-control" id="speaker_select" name="speaker" aria-label="Speaker count selection" >
                        <option selected disabled>Speaker</option>
                        @foreach ($speakerMap as $key => $name)
                            <option value="{{$key}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="text" class="form-label fw-semibold mb-2"><i class="fa-solid fa-file-lines"></i> Text</label>
                    <textarea class="form-control" name="text" id="text" style="font-size:16px;">Some Text Here </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary py-2">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Modal End-->
@endpush

@push('modal')
<!-- File Rename Modal Start-->
<div class="modal fade" id="fileRenameModal" tabindex="-1" aria-labelledby="fileRenameModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('user.transcription.file.rename') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title text-center" id="fileRenameModalLabel">Rename File</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="otherElements">
                        <div class="mb-4">
                            <label for="languageSelect" class="form-label fw-semibold mb-2">Name</label>
                            <input type="text" class="form-control mb-1" name="name" id="renameFile" placeholder="Enter new file name">
                            <input type="hidden" id="transcription_id" name="transcription_id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary py-2">Rename</button>
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
    // Destroy any existing instances first
    if ($('#speaker_select').hasClass('select2-hidden-accessible')) {
        $('#speaker_select').select2('destroy');
    }
    if ($('#speaker_select').next('.nice-select').length) {
        $('#speaker_select').next('.nice-select').remove();
    }
    $('#speaker_select').select2({
        dropdownParent: $('#editModal'),
        width: '100%',
        placeholder: "Select language",
    });

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


    //Segment edit modal open
    $('.segment').on('click', function () {
        let data = $(this).data();
        let modal = $('#editModal');
        modal.find('#segment_id').val(data.id)
        modal.find('#text').text(data.text)
        modal.find('#speaker_select').val(data.speaker)
        modal.modal('show');
    });

    //Audio Play on segment click
    // $('.segment').on('click', function () {
    //     let startTime = parseFloat($(this).data('start'));
    //     let audioUrl = "{{ asset('user/audios/' . $transcription->audio_file_name) }}";

    //     // Only update src if not already set
    //     if (audio.currentSrc !== audioUrl) {
    //         audio.src = audioUrl;
    //         audio.load();
    //         audio.addEventListener('loadedmetadata', function onMeta() {
    //             audio.currentTime = startTime;
    //             console.log("Set to:", audio.currentTime);
    //             audio.play();
    //             audio.removeEventListener('loadedmetadata', onMeta);
    //         });
    //     } else {
    //         audio.currentTime = startTime;
    //         console.log("Set to:", audio.currentTime);
    //         audio.play();
    //     }
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