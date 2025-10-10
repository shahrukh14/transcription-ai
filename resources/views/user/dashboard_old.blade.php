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
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="card">
                            <div class="bg-dark text-center">
                                <div class="p-4">
                                    @php
                                        if(auth()->user()->audioTrascriptionWithCurrentPackage() && auth()->user()->currentSubscription->transcription_limit){
                                            $percentage = (auth()->user()->audioTrascriptionWithCurrentPackage() / auth()->user()->currentSubscription->transcription_limit) * 100;
                                            $text = auth()->user()->audioTrascriptionWithCurrentPackage() ." of " .auth()->user()->currentSubscription->transcription_limit." transcriptions used";
                                        }else{
                                            $percentage = 0;
                                            $text = "No Subscription plan found";
                                        }
                                    @endphp
                                    <p class="text-white">{{$text}}</p>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="{{$percentage}}" aria-valuemin="0" aria-valuemax="100"></div>
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
                    <div class="col-lg-9 col-md-9 col-sm-6">
                        <div class="card w-100 mb-4">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fa-solid fa-bars"></i>
                                    Recent Files
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="text-center p-4">
                                    <h4 class="card-title">Welcome to TranScribe</h4>
                                    <button type="button" class="rts-btn btn__long primary__bg white__color mt-2" data-bs-toggle="modal" data-bs-target="#dropZoneModal" style="width: 35%;">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>Transcribe Your First File
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card w-100 mb-4">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fa-solid fa-bars"></i>
                                    Uploaded Files
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Uploaded</th>
                                            <th scope="col">Duration</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        {{-- Transcriptions Table Will be render here by AJAX--}}
                                    </tbody>
                                  </table>
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
            <div class="modal-body p-4">
                <!-- Dropzone Div -->
                <div id="audioDropzone" data-upload-url="{{ route('user.audio.upload') }}">
                    <div class="dz-message" data-dz-message>
                        <h4 style="margin-bottom: 5px;">Drag and Drop</h4>
                        <span style="font-size: 12px">MP3, WAV, FLAC, AAC, OPUS, OGG, M4A, MP4, MPEG, MOV, WEBM</span>
                        <h6>---OR---</h6>
                        <button type="button" class="btn btn-outline-secondary w-25">Browse Files</button>
                    </div>
                    <div class="progress mt-4" style="height: 18px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                    </div>
                </div>
                <div class="otherElements">
                    <div class="mb-4">
                        <label for="languageSelect" class="form-label fw-semibold mb-2">Select Audio Language</label>
                        <select class="form-control mb-1 select2" id="languageSelect">
                            <option value="">Select</option>
                            @foreach ($languages as $language)
                                <option value="{{$language}}">{{Illuminate\Support\Str::ucfirst($language)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="speakers" class="form-label fw-semibold mb-2">How many speakers?</label>
                        <select class="form-control" id="speakers" aria-label="Speaker count selection">
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
                    <div class="check-box-area mb-4">
                        <input type="checkbox" id="transcribe_to_english" name="transcribe_to_english" value="1"/>
                        <label for="transcribe_to_english" class="form-label fw-semibold mb-2">Transcribe to English</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="uploadBtn" class="btn btn-primary py-2">Upload</button>
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
<!-- Dropzone CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
<style>
    .content-body{
        margin: 40px 0 40px 0;
    }

    .bg-gray {
        background-color: #e0e3e7 !important;
    }
    #audioDropzone {
        min-height: 200px;
        border: 2px dashed #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
        padding: 30px;
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

    .otherElements{
        margin-top: 10px;
    }
    .form-control {
        display: block;
        width: 100%;
        padding: .775rem 1.75rem;
        font-size: 1.5rem;
        font-weight: 400;
        line-height: 1.8;
    }
</style>
@endpush


@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script> 
$(document).ready(function () {

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
                    let language = $('#languageSelect').val();
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