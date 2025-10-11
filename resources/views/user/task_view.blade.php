@extends('user.layouts.layout')
@section('title', 'View Proof Reading')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
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
                            @if($task->document != null)
                            <div class="card-body pt-0">
                                <div class="row">
                                    @php
                                        $filePath = 'proofreading/documents/'.$task->document;
                                        $fileUrl = asset($filePath);
                                        $extension = pathinfo($task->document, PATHINFO_EXTENSION);
                                    @endphp
                                    <div class="col-md-12">
                                        @if(in_array(strtolower($extension), ['doc', 'docx']))
                                            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($fileUrl) }}" width="100%" height="600px"></iframe>
                                        @elseif(strtolower($extension) === 'pdf')
                                            <iframe src="{{ $fileUrl }}" width="100%" height="600px"></iframe>
                                        @else
                                            <p>This file format is not supported for preview.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @else
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
                                                <span class="fw-bolder">{{ $allSpeakers[$segment->speaker] }}</span>
                                                <p class="@if($task->status != 'Completed') segment @endif segment-style">
                                                    <span style="color: #717272" class="time-stamp">({{ $formattedTime }})</span>
                                                    <span class="editable-text">{{ $segment->text }}</span>
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-3 col-sm-3">
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
                                    @if($task->document != null)
                                     <li class="list-group-item">
                                        <a href="{{$fileUrl}}" title="Download Document"  download="{{$task->document}}">
                                            <i class="fa-solid fa-file"></i> Download Document
                                        </a>
                                    </li>
                                    @else
                                    <li class="list-group-item">
                                        <a href="{{ route('user.proof.reading.pdf.download',$task->id) }}" title="PDF Download" id="pdfDownloadUrl" data-base-url="{{ route('user.proof.reading.pdf.download', $task->id) }}">
                                            <i class="fa-solid fa-file-pdf"></i> Download PDF
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('user.proof.reading.docx.download',$task->id) }}" title="PDF Download" id="docxDownloadUrl" data-base-url="{{ route('user.proof.reading.docx.download', $task->id) }}">
                                            <i class="fa-solid fa-file-word"></i> Download DOCX
                                        </a>
                                    </li>
                                    @endif
                                </ul>

                                @if($task->document == null)
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
                                @endif
                            </div>
                        </div>

                        @if($task->status== "Cancelled")
                            <button type="button" class="btn btn-primary w-100" id="addToProofReadingBtn"> Add to Proof Reading </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('modal')
<!-- Proof Reading Modal Start-->
<div class="modal fade" id="proofReadingModal" tabindex="-1" aria-labelledby="proofReadingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('user.transcription.add.to.proof.reading', ['id' => $task->transcription->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="proofReadingModalLabel"> <i class="fa-solid fa-file-lines"></i> Add to proof reading</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php
                        $settings = App\Models\Generalsettings::first();
                        $timeInSeconds  = $task->transcription->audio_file_duration;
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
                    @endphp
                    @if(auth()->user()->balance > $charge)
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <h4>File Name: {{$task->transcription->audio_file_original_name}}</h4>
                                <h4>Duration : {{$formattedTime}}</h4>
                            </div>
                            <div class="col-md-12 mb-1">
                                <h4>Proof reading for this transcription will cost you around <span class="fw-bolder text-primary">₹{{number_format($charge, 2)}}</span><small> (₹{{$ratePerMinute}}/minute)</small> approximately.</h4> 
                            </div>
                            <div class="col-md-12 mb-1">
                                <h4>
                                    Click<a href="{{ route('user.transcription.docx.download',$task->transcription->id) }}"> here </a>to download the transcripted file.
                                </h4> 
                            </div>
                            <input type="hidden" name="price" id="price" value="{{ $charge }}">
                            <div class="col-md-12 mb-1">
                                <label for="instruction" class="form-label">Instructions</label>
                                <textarea class="form-control" name="instruction" id="instruction" rows="6" placeholder="if you have specific instructions for your proof reading enter here"></textarea>
                            </div>
                            <div class="col-md-12 mb-1">
                                <label for="attachment" class="form-label">Attachment</label>
                                <input type="file" class="form-control" name="attachment" id="attachment">
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12 mb-1">
                                <p class="fw-bolder">You do not have sufficient balance in your wallet. Proof reading for this transcription will cost you around <span class="text-warning">₹ {{number_format($charge, 2)}}</span> approximately. But you have <span class="text-danger">₹ {{number_format(auth()->user()->balance, 2)}}</span> only in your wallet.</p>
                                <p class="fw-bolder">Add money in your wallet to proof reading of your transcription</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    @if(auth()->user()->balance > $charge)
                        <button type="submit" class="btn btn-primary">Add</button>
                    @else
                        <a href="{{route('user.wallet')}}" class="btn btn-primary">Go to wallet</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Proof Reading Modal End-->
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

    //add to proof reading
    $('#addToProofReadingBtn').on('click', function (){
        let modal = $('#proofReadingModal');
        modal.modal('show');
    });

});
</script>
@endpush