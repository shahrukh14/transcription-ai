@extends('admin.layouts.layout')
@section('title', 'Edit Proof Reader')
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
                        <h2 class="content-header-title float-start mb-0">@lang('Proof Reader')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.proof-reader.list') }}">List</a></li>
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
                <div class="card-body">
                    <form action="{{route('admin.proof-reader.update', $proofReader->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6 mb-1">
                                <label for="first_name" class="form-label">@lang('First Name')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="@lang('Enter First Name')" name="first_name" id="first_name" value="{{$proofReader->first_name}}" required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="last_name" class="form-label">@lang('Last Name')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="@lang('Enter Last Name')" name="last_name" id="last_name" value="{{$proofReader->last_name}}" required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="email" class="form-label">@lang('E-mail')<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" placeholder="@lang('Enter email address')" name="email" id="email" value="{{$proofReader->email}}" required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="mobile" class="form-label">@lang('Mobile')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="@lang('Enter mobile number')" name="mobile" id="mobile"  value="{{$proofReader->mobile}}"  required>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="image" class="form-label">@lang('Password')</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            {{--  --}}
                            <div class="col-md-6 mb-1">
                                <label for="image" class="form-label">@lang('Languages known')</label>
                                <select class="select2 form-select languageSelect" id="select2-basic" name="language_known[]" required multiple>
                                    <option disabled>Select Language</option>
                                    @php
                                        $selectedLanguages = json_decode($proofReader->language_known, true) ?? [];
                                    @endphp
                                    @foreach ($languages as $language)
                                        <option value="{{ $language }}" {{ in_array($language, $selectedLanguages) ? 'selected' : '' }}>
                                            {{ Illuminate\Support\Str::ucfirst($language) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="typing_speed" class="form-label">@lang('Typing Speed')</label>
                                <input class="form-control" type="text" id="typing_speed" name="typing_speed" value="{{ $proofReader->typing_speed }}"/>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="work_hours" class="form-label">@lang('How Much Time You Can Devote To Work')</label>
                                <input class="form-control" type="text" id="work_hours" name="work_hours" value="{{ $proofReader->work_hours }}" required/>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="city" class="form-label">@lang('City')</label>
                                <input class="form-control" type="text" id="city" name="city" value="{{ $proofReader->city }}"/>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="state" class="form-label">@lang('State')</label>
                                <input class="form-control" type="text" id="state" name="state" value="{{$proofReader->state}}"/>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="image" class="form-label">@lang('Profile Picture')</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                            <div class="col-md-6 mb-1">
                                <div>
                                    @if($proofReader->image && file_exists(public_path('admin/proofreaders/' . $proofReader->image)))
                                        <img src="{{ asset('admin/proofreaders/' . $proofReader->image) }}" alt="Profile Image" class="img-fluid" style="max-height: 70px; border-radius: 8px;">
                                    @else
                                        <p>No image uploaded</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('Save')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@push('script')
<script>
    $(document).ready(function() {
       
    });
</script>
@endpush