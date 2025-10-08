@extends('admin.layouts.layout')
@section('title', 'Dynamic Edit')
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
                            <h2 class="content-header-title float-start mb-0">@lang('Edit Dynamic')</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dynamic.list') }}">Back</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('admin.dynamic.update', $dynamics->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="title" class="form-label ">@lang('Title')</label>
                                    <input type="text" class="form-control" placeholder="@lang('Enter Title')"
                                        name="title" id="title"value="{{ old('title', $dynamics->title) }}" required>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="meta" class="form-label ">@lang('Meta')</label>
                                    <input type="text" class="form-control" placeholder="@lang('Enter Meta')"
                                        name="meta" id="meta" value="{{ old('meta', $dynamics->meta) }}" required>
                                    @error('meta')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="content" class="form-label mt-2">@lang('Content')</label>
                                <textarea name="content" class="editor4">{{ old('content', $dynamics->content) }}</textarea>
                                @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-5 px-4">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection

@push('style')
    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 200px;
        }
    </style>
@endpush
@push('script')
    <script>
        ClassicEditor
            .create(document.querySelector('.editor4'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
