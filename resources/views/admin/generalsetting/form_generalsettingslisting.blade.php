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
           
                       
                        {{-- <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="meta_title" class="form-label">@lang('Meta Title')</label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="@lang('Enter Meta Title')" value="{{ $existingSettings ? $existingSettings->meta_title : '' }}">
                                <span class="text-danger" id="meta_title-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="meta_description" class="form-label">@lang('Meta Description')</label>
                                <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="@lang('Enter Meta Description')" value="{{ $existingSettings ? $existingSettings->meta_description : '' }}">
                                <span class="text-danger" id="meta_description-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="keyword" class="form-label">@lang('Keyword')</label>
                                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="@lang('Enter Keyword')" value="{{ $existingSettings ? $existingSettings->keyword : '' }}">
                                <span class="text-danger" id="keyword-error"></span>
                            </div>
                        </div> --}}
                        <!-- <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="email_type" class="form-label">@lang('Mail Type')</label>
                                <input type="text" class="form-control" name="email_type" id="email_type" placeholder="@lang('Enter Email Type')" value="{{ $existingSettings ? $existingSettings->email_type : '' }}">
                                <span class="text-danger" id="email_type-error"></span>

                            </div>
                            <div class="col-md-4">
                                <label for="email_setting" class="form-label">@lang('Mail userName')</label>
                                <input type="text" class="form-control" name="email_setting" id="email_setting" placeholder="@lang('Enter Email Setting')" value="{{ $existingSettings ? $existingSettings->email_setting : '' }}">
                                <span class="text-danger" id="email_setting-error"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="mail_password" class="form-label">@lang('Mail Password')</label>
                                <input type="password" class="form-control" name="mail_password" id="mail_password" placeholder="@lang('Enter Mail Password')" value="{{ $existingSettings ? $existingSettings->mail_password : '' }}">
                                <span class="text-danger" id="mail_password-error"></span>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="smtp_mailhost" class="form-label">@lang('SMTP Mail Host')</label>
                                <input type="text" class="form-control" name="smtp_mailhost" id="smtp_mailhost" placeholder="@lang('Enter SMTP Mail Host')" value="{{ $existingSettings ? $existingSettings->smtp_mailhost : '' }}">
                                <span class="text-danger" id="smtp_mailhost-error"></span>
                            </div>
                        </div> -->
                        <button type="submit" class="btn btn-primary">@lang('Save Settings')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection