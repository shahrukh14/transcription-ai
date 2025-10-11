@extends('user.layouts.layout')
@section('title', 'View Transcription')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <div class="row">
                    {{-- <div class="col-xl-3 col-md-3 col-3">
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
                    </div> --}}
                    <div class="col-xl-9 col-md-9 col-6">
                        <div class="card w-100 mb-4">
                            <div class="card-header d-flex justify-content-between pb-0">
                                <h4 class="card-title">
                                    <i class="fa-regular fa-file-audio" style="font-size:25px;"></i> 
                                    {{ $transcription->audio_file_original_name }}
                                </h4>
                                <h6 class="card-title">
                                    @if($transcription->status == 0)
                                        <span class="badge rounded-pill badge-light-warning me-1">Untranscribed</span>
                                    @else
                                        <span class="badge rounded-pill badge-light-success me-1">Transcribed</span>
                                    @endif
                                </h6>
                            </div><hr>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <p class="fw-bolder">{{date('d M Y, h:i A', strtotime($transcription->created_at))}}</p>
                                    <div class="form-floating col-md-12">
                                        @php 
                                            $transcription_segments = $transcription->transcription_segments;
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
                                                <p class="@if($transcription->status != 'Completed') segment @endif segment-style" data-start="{{ $segment->start }}" data-end="{{ $segment->end }}" data-id="{{ $segment->id }}" data-speaker="{{ $segment->speaker }}">
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
                    <div class="col-xl-3 col-md-3 col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h4>Export</h4>
                                <ul class="list-group mb-1">
                                    <li class="list-group-item">
                                        <a href="{{ route('user.transcription.pdf.download',$transcription->id) }}" title="PDF Download" id="pdfDownloadUrl" data-base-url="{{ route('user.transcription.pdf.download', $transcription->id) }}">
                                            <i class="fa-solid fa-file-pdf"></i> Download PDF
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('user.transcription.docx.download',$transcription->id) }}" title="PDF Download" id="docxDownloadUrl" data-base-url="{{ route('user.transcription.docx.download', $transcription->id) }}">
                                            <i class="fa-solid fa-file-word"></i> Download DOCX
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ asset('user/audios/' . $transcription->audio_file_name) }}" title="Download Audio File"  download="{{$transcription->audio_file_original_name}}">
                                            <i class="fa-solid fa-cloud-arrow-down"></i> Download Audio
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" title="Rename File" class="renameFileButton" data-name="{{$transcription->audio_file_original_name}}" data-id="{{$transcription->id}}">
                                            <i class="fa-solid fa-edit"></i> Rename File
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#" title="Rename Speaker" class="renameSpeakerButton" data-id="{{$transcription->id}}">
                                            <i class="fa-solid fa-user-pen"></i> Rename Speaker
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('user.transcription.delete',$transcription->id) }}" title="Delete File">
                                            <i class="fa-solid fa-trash"></i> Delete File
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
                            <button type="button" class="btn btn-primary w-100" id="addToProofReadingBtn"> Add to Proof Reading </button>
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
<!-- Proof Reading Modal Start-->
<div class="modal fade" id="proofReadingModal" tabindex="-1" aria-labelledby="proofReadingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('user.transcription.add.to.proof.reading', ['id' => $transcription->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="proofReadingModalLabel"> <i class="fa-solid fa-file-lines"></i> Add to proof reading</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php
                        $settings       = App\Models\Generalsettings::first();
                        $timeInSeconds  = $transcription->audio_file_duration;
                        $hours          = floor($timeInSeconds / 3600);
                        $minutes        = floor(($timeInSeconds % 3600) / 60);
                        $seconds        = $timeInSeconds % 60;

                        $formattedTime  = '';
                        if ($hours > 0) {
                            $formattedTime .= "{$hours}hr ";
                        }
                        if ($minutes > 0 || $hours > 0) {
                            $formattedTime .= "{$minutes}min ";
                        }
                        $formattedTime .= "{$seconds}sec";

                        //rate calculation 
                        $ratePerMinute = $settings->proof_reading_per_minute;
                        // Round up to the next full minute
                        $totalMinutes =  ($timeInSeconds / 60);

                        // Calculate the total charge
                        $charge = $totalMinutes * $ratePerMinute;

                        //get the final amount by adding user's amount on hold
                        $finalAmount = (int)auth()->user()->amountOnHold() + (int)$charge;

                        //Available language for proof reading
                        $availableLanguage = json_decode($settings->proofreading_language) ?? [];

                        $speakerMarkingChargesPerminute = (int)$settings->speaker_marking_per_minute;
                        $speakerMarkingCharges = $totalMinutes * $speakerMarkingChargesPerminute;
                    @endphp
                    
                    {{-- Check is proof reading is available for this language or not --}}
                    @if(in_array($transcription->language, $availableLanguage))

                        @if(auth()->user()->balance > $finalAmount) {{-- Check availbale balance --}}
                            <div class="row">
                                <input type="hidden" name="price" id="price" value="{{ $charge }}">
                                <div class="col-md-12 mb-1">
                                    <label for="instruction" class="form-label">Instructions</label>
                                    <textarea class="form-control" name="instruction" id="instruction" rows="5" placeholder="if you have specific instructions for your proof reading enter here"></textarea>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label for="attachment2" class="form-label">Attachment 1</label>
                                    <input type="file" class="form-control" name="attachments[]" id="attachment1">
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label for="attachment2" class="form-label">Attachment 2</label>
                                    <input type="file" class="form-control" name="attachments[]" id="attachment1">
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label for="attachment2" class="form-label">Attachment 3</label>
                                    <input type="file" class="form-control" name="attachments[]" id="attachment1">
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label for="attachment2" class="form-label">Attachment 4</label>
                                    <input type="file" class="form-control" name="attachments[]" id="attachment1">
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="speaker_marking" name="speaker_marking" value="1" data-charges="{{$speakerMarkingCharges}}"/>
                                        <label class="form-check-label fw-bolder" for="speaker_marking">Speaker Marking</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-1 d-flex justify-content-between">
                                    <span class="h4">File Name:</span> <span class="h4"> {{$transcription->audio_file_original_name}}</span>
                                </div>
                                <div class="mb-1 d-flex justify-content-between">
                                    <span class="h4">Duration :</span> <span class="h4"> {{$formattedTime}}</span>
                                </div>
                                <div class="mb-1 d-flex justify-content-between">
                                    <span class="h4">Cost :</span> <span class="h4"> ₹{{$ratePerMinute}}/minute</span>
                                </div>
                                <div class="mb-1 d-flex justify-content-between speakerMarkingDiv d-none">
                                    <span class="h4">Speaker Marking Charges:</span> <span class="h4"> ₹{{$speakerMarkingChargesPerminute}}/minute</span>
                                </div>
                                <hr>
                                <div class="mb-1 d-flex justify-content-between">
                                    <span class="h4">Total Charges :</span> <span class="h4 totalCharges"> ₹{{number_format($charge, 2)}}</span>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                @if($proofreadingOnprogress->count() > 0)
                                    @php 
                                        $needToAdd =  (int)$finalAmount - (int)auth()->user()->balance;
                                    @endphp
                                    <div class="col-md-12 mb-1 mt-2 text-center">
                                        <p class="fw-bolder h4 text-danger">You do not have sufficient balance in your wallet</p>
                                        <p class="fw-bolder">Your {{$proofreadingOnprogress->count()}} proof reading has already in progress and ₹ {{number_format(auth()->user()->amountOnHold(), 2)}} is on hold for it. If you want to add this transcription in proof reading you need to add <span class="text-warning">₹ {{number_format($needToAdd, 2)}} </span> to you walle.</p>
                                    </div>
                                @else
                                    <div class="col-md-12 mb-1 mt-2 text-center">
                                        <p class="fw-bolder">You do not have sufficient balance in your wallet. Proof reading for this transcription will cost you around <span class="text-warning">₹ {{number_format($charge, 2)}}</span> approximately. But you have <span class="text-danger">₹ {{number_format(auth()->user()->balance, 2)}}</span> only in your wallet.</p>
                                        <p class="fw-bolder">Add money in your wallet to proof reading of your transcription</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="col-md-12 text-center mt-2">
                                <p class="h3 text-warning">Proof reading is not available for this language</p>
                            </div>
                        </div>
                    @endif
                    
                </div>
                <div class="modal-footer">
                    @if(in_array($transcription->language, $availableLanguage))
                        @if(auth()->user()->balance > $charge)
                            <button type="submit" class="btn btn-primary">Add</button>
                        @else
                            <a href="{{route('user.wallet')}}" class="btn btn-primary">Go to wallet</a>
                        @endif
                    @else
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Proof Reading Modal End-->
 
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


<!-- Speaker Rename Modal Start-->
<div class="modal fade" id="speakerRenameModal" tabindex="-1" aria-labelledby="speakerRenameModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('user.transcription.speaker.rename') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="speakerRenameModalLabel"><i class="fa-solid fa-user-pen"></i> Rename Speaker</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="transcription_id" name="transcription_id">
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

<!-- add segment Modal Start-->
<div class="modal fade" id="addSegmentModal" tabindex="-1" aria-labelledby="addSegmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('user.transcription.segment.add', $transcription->id) }}" method="POST">
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


    //select2 initialization
    $('.select2').select2({
        placeholder: "Select Speaker",
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
                url: "{{ route('user.transcription.segment.update', $transcription->id) }}",
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
            url: "{{ route('user.transcription.speaker.update', $transcription->id) }}",
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

    //speaker marking on proof reader
    $('#speaker_marking').on('click', function (){
        let totalCharges;
        let proofReadingCharges = $('#price').val();
        let speakerMarkingCharges = $(this).data('charges');
        if ($(this).is(':checked')){
            totalCharges = parseFloat(proofReadingCharges) + parseFloat(speakerMarkingCharges);
            $('.speakerMarkingDiv').removeClass('d-none');
        }else{
            totalCharges = parseFloat(proofReadingCharges) - parseFloat(speakerMarkingCharges);
            $('.speakerMarkingDiv').addClass('d-none');
        }
        $('#price').val(totalCharges.toFixed(2));
        $('.totalCharges').text('₹'+totalCharges.toFixed(2));
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

    //Rename Speaker
    $(document).on('click', '.renameSpeakerButton', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let modal = $('#speakerRenameModal');
        modal.find('#transcription_id').val(id);
        modal.modal('show');
    });

    //add to proof reading
    $('#addToProofReadingBtn').on('click', function (){
        let modal = $('#proofReadingModal');
        modal.modal('show');
    });

});
</script>
@endpush