@extends('proofReader.layouts.layout')
@section('title', 'Application Form')
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
                        <h2 class="content-header-title float-start mb-0">Application Form</h2>
                    </div>
                </div>
            </div>
        </div>
         <div class="content-body">
            <form action="{{ route('proof-reader.application.submit') }}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <!-- form -->
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label class="form-label" for="select2-basic">Languages known</label><span class="text-danger">*</span>
                                <select class="select2 form-select languageSelect" id="select2-basic" name="language_known[]" required multiple>
                                    <option disabled>Select Language</option>
                                    @foreach ($languages as $language)
                                        <option value="{{$language}}">{{Illuminate\Support\Str::ucfirst($language)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="whatsapp_number" class="form-label">WhatsApp Number</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" id="whatsapp_number" name="whatsapp_number" required />
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="typing_speed" class="form-label">Typing Speed</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" id="typing_speed" name="typing_speed" required/>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="work_hours" class="form-label">How Much Time You Can Devote To Work</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" id="work_hours" name="work_hours" required/>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="city" class="form-label">City</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" id="city" name="city" required />
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="state" class="form-label">State</label><span class="text-danger">*</span>
                                <input class="form-control" type="text" id="state" name="state" required />
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="work_experience" class="form-label">Are you an experienced transcriber? Please share your work experience in details</label><span class="text-danger">*</span>
                                <textarea class="form-control" name="work_experience" id="work_experience" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="paragraph" class="form-label">Why do you want to join us and why home based work is an ideal option for you.(in 100 words)</label><span class="text-danger">*</span>
                                <textarea class="form-control" name="paragraph" id="paragraph" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection