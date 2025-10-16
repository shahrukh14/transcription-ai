@extends('admin.layouts.layout')
@section('title', 'Proof Reading Assessments')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">@lang('Assessments')</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="ajax-datatable">
                <div class="row">
                    <div class="col-12">
                        @if (Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center fs-3 py-1 mb-1">
                                {{ Session::get('message') }}
                            </p>
                        @endif
                        
                        @if (Session::has('error'))
                            <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3 py-1 mb-1">
                                {{ Session::get('error') }}
                            </p>
                        @endif
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-between">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestModal">
                                    Add Test
                                </button>
                                <form action="" method="GET" class="d-flex gap-1">
                                    <input type="text" name="search" id="search" class="form-control ms-2" value="{{ request('search') }}" placeholder="Search Name">
                                    <button type="submit" class="btn btn-primary ms-.5"><i class="fa fa-search"></i></button>
                                    <a href="{{ url()->current() }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                                </form>
                            </div>
                            <div class="card-body px-0">
                                <div class="card-datatable table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-nowrap">@lang('Name')</th>
                                                <th class="text-nowrap">@lang('Audio')</th>
                                                <th class="text-nowrap">@lang('Type')</th>
                                                <th class="text-nowrap">@lang('Language')</th>
                                                <th class="text-nowrap">@lang('Audio Duration')</th>
                                                <th class="text-nowrap">@lang('Test Duration')</th>
                                                <th class="text-nowrap">@lang('Created At')</th>
                                                <th class="text-nowrap">@lang('Status')</th>
                                                <th class="text-nowrap">@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@push('modal')
<!-- Add test Modal Start-->
<div class="modal fade" id="addTestModal" tabindex="-1" aria-labelledby="addTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.proof-reader.assessments.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="addTestModalLabel">Add Assessment Test</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label for="speaker" class="form-label">Name</label><span class="text-danger">*</span>
                            <input class="form-control" type="text" id="name" name="name" required />
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="speaker" class="form-label">Audio</label>
                            <input class="form-control" type="file" id="audio" name="audio"  accept=".mp3, .wav, .flac, .aac, .opus, .ogg, .m4a, .mp4, .mpeg, .mov, .webm"  required />
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="speaker" class="form-label">Test Duration (in minute)</label><span class="text-danger">*</span>
                            <input class="form-control" type="number" id="test_duration" name="test_duration" required />
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="select2-basic">Audio Language</label><span class="text-danger">*</span>
                            <select class="select2 form-select languageSelect" id="select2-basic" name="audio_language" required>
                                <option selected disabled>Select Language</option>
                                @foreach ($languages as $language)
                                    <option value="{{$language}}">{{Illuminate\Support\Str::ucfirst($language)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="assessment_type">Audio for which assessment</label><span class="text-danger">*</span>
                            <select class="form-select languageSelect" id="assessment_type" name="assessment_type" required>
                                <option value="1">Assessment 1</option>
                                <option value="2">Assessment 2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add test Modal End-->

<!-- Edit test Modal Start-->
<div class="modal fade" id="editTestModal" tabindex="-1" aria-labelledby="editTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.proof-reader.assessments.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="editTestModalLabel">Edit Assessment Test</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label for="edit_name" class="form-label">Name</label><span class="text-danger">*</span>
                            <input class="form-control" type="text" id="edit_name" name="name" required />
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="edit_audio" class="form-label">Audio</label>
                            <input class="form-control" type="file" id="edit_audio" name="audio" accept=".mp3, .wav, .flac, .aac, .opus, .ogg, .m4a, .mp4, .mpeg, .mov, .webm"/>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="edit_test_duration" class="form-label">Test Duration (in minute)</label><span class="text-danger">*</span>
                            <input class="form-control" type="number" id="edit_test_duration" name="test_duration" required />
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="edit_audio_language">Audio Language</label><span class="text-danger">*</span>
                            <select class="form-select" id="edit_audio_language" name="audio_language" required>
                                <option selected disabled>Select Language</option>
                                @foreach ($languages as $language)
                                    <option value="{{ $language }}">{{ ucfirst($language) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="edit_assessment_type">Audio for which assessment</label><span class="text-danger">*</span>
                            <select class="form-select" id="edit_assessment_type" name="assessment_type" required>
                                <option value="1">Assessment 1</option>
                                <option value="2">Assessment 2</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label" for="edit_status">Status</label>
                            <select class="form-select" id="edit_status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
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
<!-- Edit test Modal End-->
@endpush

@push('script')
<script>
    $(document).ready(function(){
        renderTable();
        getAudioTranscription();

        function renderTable(){
            $.ajax({
                url: "{{ route('admin.proof-reader.assessments.get') }}",
                type: "GET",
                success: function (response) {
                    $('#tableBody').html(response);
                }
            });
        }

        // Ajax Request for Transcription
        function getAudioTranscription(){
            $.ajax({
                url: "{{ route('admin.proof-reader.assessments.get.audio.transcription') }}",
                type: "GET",
                success: function (response) {
                    renderTable()
                }
            });
        }
    });

    // EDIT FUNCTION
    $(document).on('click', '.editBtn', function () {
        let button = $(this);
        $('#edit_id').val(button.data('id'));
        $('#edit_name').val(button.data('name'));
        $('#edit_audio_language').val(button.data('audio_language'));
        $('#edit_test_duration').val(button.data('test_duration'));
        $('#edit_assessment_type').val(button.data('assessment_type'));
        $('#edit_status').val(button.data('status'));
    });
</script>
@endpush