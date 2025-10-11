@extends('user.layouts.layout')
@section('title', 'Dashboard')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        @if (Session::has('success'))
            <p class="alert alert-success text-center fs-3 py-1">{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('error'))
            <p class="alert alert-danger text-center fs-3 py-1"> {{ Session::get('error') }}</p>
        @endif
        <div class="content-body">
            <div class="row">
                <div class="col-xl-3 col-md-3 col-12">
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

                <div class="col-xl-9 col-md-9 col-12">
                      
                    <div class="card-header p-0">
                        <h4 class="card-title">
                            User Transacrtion Details
                        </h4>
                    </div>
                    <div class="card">
                      
                        <div class="card-header border-bottom d-flex justify-content-end">
                            <form action="" method="GET" class="d-flex align-items-center m-bottom-4 w-auto">
                                <div class="formData d-flex">
                                    <input type="text" class="form-control flatpickr-input from" placeholder="From Date" name="from" 
                                        value="{{ request('from') }}" />
                                    <input type="text" class="form-control flatpickr-input to ms-.5" placeholder="To Date" name="to" 
                                        value="{{ request('to') }}" />
                                </div>
                                <button type="submit" class="btn btn-primary ms-.5">Search</button>
                            </form>
                            <form action="" method="GET" class="d-flex">
                                <input type="text" name="search" id="search" class="form-control ms-2" value="{{ request('search') }}" placeholder="Search Payment Id">
                                <button type="submit" class="btn btn-primary ms-.5"><i class="fa fa-search"></i></button>
                            </form>
        
                            <a href="{{ url()->current() }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="card-datatable table-responsive">
                                <table class="datatables-ajax table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">@lang('ID')</th>
                                            <th class="text-nowrap">@lang('User')</th>
                                            <th class="text-nowrap">@lang('Package')</th>
                                            <th class="text-nowrap">@lang('Start Date')</th>
                                            <th class="text-nowrap">@lang('Payment Id')</th>
                                            <th class="text-nowrap">@lang('Order Id')</th>
                                            <th class="text-nowrap">@lang('Amount')</th>
                                            <th class="text-nowrap">@lang('Currency')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($transactions) > 0)
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td class="text-nowrap">{{ $transaction->id }}</td>
                                                    <td class="text-nowrap">{{ $transaction->user->fullname() }}</td>
                                                    <td class="text-nowrap">{{ $transaction->package->name }}</td>
                                                    <td class="text-nowrap">{{ date('d-m-Y , h:i A', strtotime($transaction->created_at)) }}</td>
                                                    <td class="text-nowrap">{{ $transaction->payment_id }}</td>
                                                    <td class="text-nowrap">{{ $transaction->order_id }}</td>
                                                    <td class="text-nowrap">{{ $transaction->amount }}</td>
                                                    <td class="text-nowrap">{{ $transaction->currency }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <tr class="text-center">
                                            <th colspan="6">No data found</th>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
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

@push('modal')
<!-- Drop Zone Modal Start-->
<div class="modal fade" id="dropZoneModal" tabindex="-1" aria-labelledby="dropZoneModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dropZoneModalLabel">Audio Upload</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Dropzone Div -->
                <div id="audioDropzone" data-upload-url="{{ route('user.audio.upload') }}">
                    <div class="dz-message" data-dz-message>
                        <h4 style="margin-bottom: 5px;">Drag and Drop</h4>
                        <span style="font-size: 10px">MP3, WAV, FLAC, AAC, OPUS, OGG, M4A, MP4, MPEG, MOV, WEBM</span>
                        <h6>---OR---</h6>
                        <button type="button" class="btn btn-outline-secondary">Browse Files</button>
                    </div>
                    <div class="progress mt-1">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-12 mb-1">
                        <label class="form-label" for="select2-basic">Select Audio Language</label>
                        <select class="select2 form-select languageSelect" id="select2-basic">
                            <option selected disabled>Select Language</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-1">
                        <label for="speakers" class="form-label">How many speakers?</label>
                        <select class="select2 form-select" id="speakers" aria-label="Speaker count selection">
                            <option selected disabled>Select number of speakers</option>
                            <option value="2">2 speakers</option>
                            <option value="3">3 speakers</option>
                            <option value="4">4 speakers</option>
                            <option value="5">5 speakers</option>
                            <option value="6">6 speakers</option>
                            <option value="7">7 speakers</option>
                            <option value="8">8 speakers</option>
                            <option value="-1">Detect Automatically</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="transcribe_to_english" name="transcribe_to_english" value="1" />
                            <label class="form-check-label fw-bolder" for="transcribe_to_english">Transcribe to English</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="uploadBtn" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>
<!-- Drop Zone Modal End-->

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
<!-- Dropzone CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
<style>

    body {
        overflow-x: hidden;
    }
    .content-body{
        margin: 40px 0 40px 0;
    }

    .bg-gray {
        background-color: #e0e3e7 !important;
    }
    #audioDropzone {
        border: 2px dashed #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
        padding: 15px;
        text-align: center;
        color: #555;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    #audioDropzone:hover {
        border-color: #007bff;
    }

    .dz-message {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 18px;
        font-weight: 500;
    }

    .dz-preview {
        padding: 10px;
        margin-top: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
        width: 100%;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .dz-success-mark, .dz-error-mark {
        width: 40px !important;
        height: 40px !important;
        display: inline-block !important;
    }

    .dz-success-mark svg, .dz-error-mark svg {
        width: 90%;
        height: 90%;
    }

    .dz-filename {
        font-weight: 500;
        margin-top: 5px;
        color: #333;
        text-align: center;
    }

    .dz-size {
        font-size: 14px;
        color: #6c757d;
        text-align: center;
    }

    .dz-remove {
        color: #dc3545;
        margin-top: 8px;
        cursor: pointer;
        font-size: 14px;
        display: block;
    }

    .dz-remove:hover {
        text-decoration: underline;
    }
    .tableRow{
        border-bottom: #333;
    }
</style>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script> 
$(document).ready(function () {

    //select2 initialization
    $('.select2').select2({
        placeholder: "Select",
        allowClear: true,
        dropdownParent: $('#select2-basic').parent()
    });

    // Get Transcription function call on page load
    renderTranscriptionTable();

    // Disable Dropzone auto discovery globally
    Dropzone.autoDiscover = false;

    // Remove existing Dropzone instance if already attached
    if (Dropzone.instances.length) {
        Dropzone.instances.forEach(function (dz) {
            dz.destroy();
        });
    }

    let uploadUrl = $('#audioDropzone').data('upload-url');
    let audioDropzone;

    if (uploadUrl) {
        audioDropzone = new Dropzone("#audioDropzone", {
            url: uploadUrl, // Use the dynamic URL
            paramName: "audio", // Name of the file in request
            maxFiles: 1,
            maxFilesize: 1024, // Max file size = 1 GB
            acceptedFiles: ".mp3,.wav,.flac,.aac,.opus,.ogg,.m4a,.mp4,.mpeg,.mov,.webm",
            addRemoveLinks: true,
            autoProcessQueue: false, // Prevent automatic upload
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            init: function () {
                let dz = this;

                // When file is added
                this.on("addedfile", function (file) {
                    console.log("File added:", file.name);
                });

                // Handle successful upload
                this.on("success", function (file, response) {
                    if (response.success) {
                        dz.removeAllFiles(); // Clear after successful upload
                        $('#dropZoneModal').modal('hide');
                        $('.modal-backdrop').removeClass('show');
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success"
                        });
                        renderTranscriptionTable();
                        getTranscription();
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: response.message,
                            icon: "error"
                        });
                    }
                });

                // Handle errors
                this.on("error", function (file, errorMessage) {
                    Swal.fire({
                        title: "Error!",
                        text: errorMessage,
                        icon: "error"
                    });
                });

                // Upload button click event
                $('#uploadBtn').on('click', function () {
                    if (dz.getQueuedFiles().length === 0) {
                        Swal.fire({
                            title: "Error!",
                            text: "Please select an audio file first!",
                            icon: "error"
                        });
                        return;
                    }

                    // Validate language and speakers
                    let language = $('.languageSelect').val();
                    let speakers = $('#speakers').val();
                    let transcribeToEnglish = 0;
                    if ($('#transcribe_to_english').is(':checked')){
                        transcribeToEnglish = 1;
                    }

                    if (!language || !speakers) {
                        Swal.fire({
                            title: "Error!",
                            text: "Please select language and number of speakers!",
                            icon: "error"
                        });
                        return;
                    }

                    // Append additional data
                    dz.on("sending", function (file, xhr, formData) {
                        formData.append("language", language);
                        formData.append("speakers", speakers);
                        formData.append("transcribe_to_english", transcribeToEnglish);

                        // Handle real-time progress
                        xhr.upload.onprogress = function (e) {
                            if (e.lengthComputable) {
                                let progress = Math.round((e.loaded / e.total) * 100);
                                $('.progress-bar').css('width', progress + '%');
                                $('.progress-bar').text(progress + '%');
                            }
                        };
                    });

                    // Start uploading
                    dz.processQueue();
                });
            }
        });
    } else {
        Swal.fire({
            title: "Error!",
            text: "Dropzone URL is undefined",
            icon: "error"
        });
    }

    function renderTranscriptionTable(){
        $.ajax({
            url: "{{ route('user.transcription.render.table') }}",
            type: "GET",
            success: function (response) {
                $('#tableBody').html(response);
            }
        });
    }

    // Ajax Request for Transcription
    function getTranscription(){
        $.ajax({
            url: "{{ route('user.transcription.get') }}",
            type: "GET",
            success: function (response) {
                console.log(response);
                renderTranscriptionTable()
            }
        });
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
    