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
                    <div class="col-lg-9 col-md-9 col-sm-6">
                        <div class="card w-100 mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <h6 class="card-title">
                                    <i class="fa-regular fa-file-audio" style="font-size:25px;"></i>
                                    {{$transcription->audio_file_name}}
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
                                <form action="{{ route('user.transcription.update',$transcription->id) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="form-floating col-md-12">
                                            <textarea class="form-control" name="transcription_from_api" style="min-height: 223px; font-size:16px;">{{$transcription->transcription_from_api}}</textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg mt-3">Submit</button>
                                </form>
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
</style>
@endpush

@push('script')
<script> 
$(document).ready(function () {
    
});
</script>
@endpush