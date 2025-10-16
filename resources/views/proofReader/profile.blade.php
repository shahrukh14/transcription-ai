@extends('proofReader.layouts.layout')
@section('title', 'Dashboard')
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
                            <h2 class="content-header-title float-start mb-0">Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center fs-3">
                    {{ Session::get('message') }}
                </p>
            @endif
            @if (Session::has('error'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">
                    {{ Session::get('error') }}
                </p>
            @endif
            <div class="content-body">
                <section id="input-file-browser">
                    <div class="card">
                        <div class="card-body pt-1">
                            <!-- form -->
                            <form action="{{ route('proof-reader.profile.update') }}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">First Name<sup><span class="text-danger fs-5">*</span></sup></label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text" id="first_name" name="first_name" value="{{ $reader->first_name }}" required />
                                            @error('first_name')
                                                <small class="-mt-3 text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Last Name<sup><span class="text-danger fs-5">*</span></sup> </label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text" id="last_name" value="{{ $reader->last_name }}" name="last_name" required />
                                            @error('last_name')
                                                <small class="-mt-3 text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Email</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="email" id="email"  value="{{ $reader->email }}" name="email" disabled />
                                        </div>
                                        @error('email')  <small class="-mt-3 text-red-500">{{ $message }}</small> @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Mobile Number</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="mobile" id="mobile"  value="{{ $reader->mobile }}" />
                                        </div>
                                        @error('mobile')  <small class="-mt-3 text-red-500">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="password">Password</label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="" aria-describedby="login-password" tabindex="2"/><span class="input-group-text cursor-pointer"><i data-feather="eye" ></i></span>
                                        </div>
                                        @error('password')
                                            <small class="-mt-3 text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <div class="mb-1">
                                            <label for="image" class="form-label">Profile pic</label>
                                            <input class="form-control" type="file" name="image" id="image" >
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="select2-basic">Languages known</label><span class="text-danger">*</span>
                                        <select class="select2 form-select languageSelect" id="select2-basic" name="language_known[]" required multiple>
                                            <option disabled>Select Language</option>
                                            @php
                                                $selectedLanguages = json_decode($reader->language_known, true) ?? [];
                                            @endphp
                                            @foreach ($languages as $language)
                                                <option value="{{ $language }}" {{ in_array($language, $selectedLanguages) ? 'selected' : '' }}>
                                                    {{ Illuminate\Support\Str::ucfirst($language) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label for="typing_speed" class="form-label">Typing Speed</label><span class="text-danger">*</span>
                                            <input class="form-control" type="text" id="typing_speed" name="typing_speed" value="{{ $reader->typing_speed }}"/>
                                            @error('typing_speed')
                                                <small class="-mt-3 text-red-500">{{ $message }}</small>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label for="work_hours" class="form-label">How Much Time You Can Devote To Work</label><span class="text-danger">*</span>
                                        <input class="form-control" type="text" id="work_hours" name="work_hours" value="{{ $reader->work_hours }}" required/>
                                        @error('work_hours')
                                            <small class="-mt-3 text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label for="city" class="form-label">City</label><span class="text-danger">*</span>
                                        <input class="form-control" type="text" id="city" name="city" value="{{ $reader->city }}" required/>
                                        @error('city')
                                            <small class="-mt-3 text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label for="state" class="form-label">State</label><span class="text-danger">*</span>
                                        <input class="form-control" type="text" id="state" name="state" value="{{ $reader->state }}" required />
                                        @error('state')
                                            <small class="-mt-3 text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        {{-- bank details insert --}}
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Bank Details</h2>
                        </div>
                    </div>
                </div>
            </div>
            @if (Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center fs-3">
                    {{ Session::get('success') }}
                </p>
            @endif
            {{-- @if (Session::has('error'))
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">
                    {{ Session::get('error') }}
                </p>
            @endif --}}
            <div class="content-body">
                <section id="input-file-browser">
                    <div class="card">
                        <div class="card-body pt-1">
                            <!-- form -->
                            <form action="{{ route('proof-reader.bankDetails', $reader->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Bank Name<sup><span class="text-danger fs-5">*</span></sup></label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text" id="bank_name" name="bank_name" value="{{ $reader->bank_details['bank_name'] ?? '' }}" required />
                                            @error('bank_name')
                                                <small class="-mt-3 text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Branch Name<sup><span class="text-danger fs-5">*</span></sup> </label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text" id="branch" value="{{ $reader->bank_details['branch'] ?? '' }}" name="branch" required />
                                            @error('branch')
                                                <small class="-mt-3 text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">Account No.<sup><span class="text-danger fs-5">*</span></sup> </label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text" id="account_no" value="{{ $reader->bank_details['account_no'] ?? '' }}" name="account_no" required />
                                            @error('account_no')
                                                <small class="-mt-3 text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-6 mb-1">
                                        <label class="form-label" for="">IFSC<sup><span class="text-danger fs-5">*</span></sup> </label>
                                        <div class="input-group form-password-toggle ">
                                            <input class="form-control" type="text" id="ifsc"  value="{{ $reader->bank_details['ifsc'] ?? '' }}" name="ifsc" required />
                                        </div>
                                        @error('ifsc')  <small class="-mt-3 text-red-500">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection


