@extends('admin.layouts.layout')
@section('title', 'Add Packages')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">@lang('Packages')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.package.list') }}">List</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Session::has('error'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">
            {{ Session::get('error') }}
        </p>
        @endif
        <div class="content-body">
            <div class="card w-100">
                <form action="{{route('admin.package.insert')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-1">
                            <label for="name" class="form-label">@lang('Package Name')<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Package Name')" name="name" id="name" required>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="amount" class="form-label">@lang('Amount')<span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control" placeholder="@lang('Enter Package Amount')" name="amount" id="amount" required>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="type" class="form-label">@lang('Package Type')<span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="audio_time_limit" class="form-label">@lang('Audio Time Limit')<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="@lang('Enter Audio time limit')" name="audio_time_limit" id="audio_time_limit" required>
                            <span class="text-warning">Time must be entered in minutes</span>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="transcription_limit" class="form-label">@lang('Daily Transcription Limit')<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="@lang('Enter Daily Transcription Limit')" name="transcription_limit" id="transcription_limit" required>
                            <span class="text-warning">Enter 0 (Zero) for unlimited transcription.</span>
                        </div>
                    </div>
                    
                    <div class="row mb-1">
                        <h4 class="mt-1">Description</h4>
                        <div class="col-md-4 mb-1">
                            <label for="description[1][image]" class="form-label">@lang('Image')</label>
                            <input type="file" class="form-control" name="description[1][image]" id="description[1][image]">
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="description[1][title]" class="form-label">@lang('Title')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Description Title')" name="description[1][title]" id="description[1][title]">
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="description[1][content]" class="form-label">@lang('Content')</label>
                            <input type="text" class="form-control" placeholder="@lang('Enter Description Content')" name="description[1][content]" id="description[1][content]">
                        </div>
                    </div>
                    <div class="descriptionAddMoreDiv mb-1"></div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary" id="descriptionaddMore">Add more</button>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">@lang('Add')</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@push('script')
<script>
    $(document).ready(function() {
        //Description Add More Section
        let descriptionaddMoreCounter  = 2;
        $("#descriptionaddMore").click(function (e) {
            e.preventDefault();
            let newRow = `
                <div class="row add-more-div">
                     <div class="col-md-4 mb-1">
                        <label for="description[${descriptionaddMoreCounter}][image]" class="form-label">@lang('Image')</label>
                        <input type="file" class="form-control"  name="description[${descriptionaddMoreCounter}][image]" id="description[${descriptionaddMoreCounter}][image]">
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="description[${descriptionaddMoreCounter}][title]" class="form-label">@lang('Title')</label>
                        <input type="text" class="form-control" placeholder="@lang('Enter Description Title')" name="description[${descriptionaddMoreCounter}][title]" id="description[${descriptionaddMoreCounter}][title]">
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="description[${descriptionaddMoreCounter}][content]" class="form-label">@lang('Content')</label>
                        <input type="text" class="form-control" placeholder="@lang('Enter Description Content')" name="description[${descriptionaddMoreCounter}][content]" id="description[${descriptionaddMoreCounter}][content]">
                    </div>
                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn-danger btn-sm removeDescriptionaddMore" type="button">Remove</button>
                    </div>
                </div>`;
            $(".descriptionAddMoreDiv").append(newRow);
            descriptionaddMoreCounter++;
        });

        //Remove add more 
        $(document).on("click", ".removeDescriptionaddMore", function () {
            $(this).closest(".add-more-div").remove();
        });
       
    });
</script>
@endpush