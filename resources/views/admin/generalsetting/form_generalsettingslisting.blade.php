@extends('admin.layouts.layout')
@section('title', 'General Settings')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">@lang('General Settings')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Session::has('success'))
        <p class="alert alert-success text-center fs-3">{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('error'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">
            {{ Session::get('error') }}
        </p>
        @endif
        <div class="content-body">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ route('admin.general.setting.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="name" class="form-label">@lang('Site Name')</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $existingSettings ? $existingSettings->name : '' }}" placeholder="@lang('Enter Site Name')">
                                <span class="text-danger" id="name-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="logo" class="form-label">@lang('Logo')</label>
                                <input type="file" class="form-control" name="logo" id="logo">
                                @if($existingSettings && $existingSettings->logo != null)
                                <a href="{{ asset('admin/generalSetting/'.$existingSettings->logo) }}" target="_blank">view image</a>
                                @endif
                                <span class="text-danger" id="logo-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">@lang('Email')</label>
                                <input type="eemail" class="form-control" name="email" id="email" placeholder="@lang('Enter Eemail')" value="{{ $existingSettings ? $existingSettings->email : '' }}">
                                <span class="text-danger" id="email-error"></span>
                            </div>
                        </div> 
                        <div class="row mb-2">
                             <div class="col-md-4">
                                <label for="mobile" class="form-label">@lang('Mobile')</label>
                                <input type="text" class="form-control" name="mobile" id="mobile" placeholder="@lang('Enter Mobile')" value="{{ $existingSettings ? $existingSettings->mobile : '' }}">
                                <span class="text-danger" id="mobile-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="address" class="form-label">@lang('Address')</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="@lang('Enter Address')" value="{{ $existingSettings ? $existingSettings->address : '' }}">
                                <span class="text-danger" id="address-error"></span>
                            </div> 
                           <div class="col-md-4">
                                <label for="facebook" class="form-label">@lang('Facebook')</label>
                                <input type="text" class="form-control" name="facebook" id="facebook" placeholder="@lang('Enter Facebook URL')" value="{{ $existingSettings ? $existingSettings->facebook : '' }}">
                                <span class="text-danger" id="facebook-error"></span>
                            </div> 
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="twitter" class="form-label">@lang('Twitter')</label>
                                <input type="text" class="form-control" name="twitter" id="twitter" placeholder="@lang('Enter Twitter URL')" value="{{ $existingSettings ? $existingSettings->twitter : '' }}">
                                <span class="text-danger" id="twitter-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="instagram" class="form-label">@lang('Instagram')</label>
                                <input type="text" class="form-control" name="instagram" id="instagram" placeholder="@lang('Enter instagram URL')" value="{{ $existingSettings ? $existingSettings->instagram : '' }}">
                                <span class="text-danger" id="instagram-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="linkedin" class="form-label">@lang('LinkedIn')</label>
                                <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="@lang('Enter LinkedIn URL')" value="{{ $existingSettings ? $existingSettings->linkedin : '' }}">
                                <span class="text-danger" id="linkedin-error"></span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="linkedin" class="form-label">@lang('pinterest')</label>
                                <input type="text" class="form-control" name="printest" id="printest" placeholder="@lang('Enter printest URL')" value="{{ $existingSettings ? $existingSettings->printest : '' }}">
                                <span class="text-danger" id="printest-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="logo" class="form-label">@lang('Icon')</label>
                                <input type="file" class="form-control" name="icon" id="icon">
                                @if($existingSettings && $existingSettings->icon != null)
                                <a href="{{ asset('admin/icon/'.$existingSettings->icon) }}" target="_blank">view image</a>
                                @endif
                                <span class="text-danger" id="icon-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="meta_title" class="form-label">@lang('Meta')</label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="@lang('Enter Meta URL')" value="{{ $existingSettings ? $existingSettings->meta_title : '' }}">
                                <span class="text-danger" id="meta_title-error"></span>
                            </div>
                        </div>
                       
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="proof_reading_per_minute" class="form-label">@lang('Proof Reading Price Per Minute')</label>
                                <input type="number" class="form-control" name="proof_reading_per_minute" id="proof_reading_per_minute" step="any" placeholder="@lang('How much do you charge for proof reading per minute')" value="{{ $existingSettings ? $existingSettings->proof_reading_per_minute : 0 }}">
                                <span class="text-danger" id="proof_reading_per_minute-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="speaker_marking_per_minute" class="form-label">@lang('Speaker Marking Per Minute')</label>
                                <input type="number" class="form-control" name="speaker_marking_per_minute" id="speaker_marking_per_minute" step="any" placeholder="@lang('How much do you charge for marking speakers in proof reading per minute')" value="{{ $existingSettings ? $existingSettings->speaker_marking_per_minute : 0 }}">
                                <span class="text-danger" id="speaker_marking_per_minute-error"></span>
                            </div>
                            <div class="col-md-4 mb-4">
                                @php
                                    if($existingSettings){
                                        $selectedLanguage = json_decode($existingSettings->proofreading_language);
                                    }else{
                                        $selectedLanguage = [];
                                    }
                                @endphp
                                <label class="form-label" for="select2-basic">Select Proofreading Language</label>
                                <select class="select2 form-select languageSelect" id="select2-basic" name="proofreading_language[]" multiple>
                                    <option value="" disabled>Select Language</option>
                                    @foreach ($languages as $language)
                                        <option value="{{$language}}" @if(in_array($language, $selectedLanguage)) selected @endif>{{Illuminate\Support\Str::ucfirst($language)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('Save Settings')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
$(document).ready(function(){
    
});
</script>
@endpush