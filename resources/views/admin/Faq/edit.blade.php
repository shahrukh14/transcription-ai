@extends('admin.layouts.layout')
@section('title', 'Edit Faq')
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
                        <h2 class="content-header-title float-start mb-0">@lang('FAQ')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.faq.list') }}">Home</a></li>
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
                    <form action="{{route('admin.faq.update',$faqs->id)}}" method="POST" id="blogForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="title" class="form-label">@lang('Title')</label>
                                <input type="text" class="form-control" placeholder="@lang('Enter Title')" name="title" id="title" value="{{ old('title', $faqs->title) }}" required>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <label for="description" class="form-label">@lang('Description')</label>
                                <textarea class="form-control" name="description" class="description">{{ old('description', $faqs->description) }}"</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">@lang('Update')</button>
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
        $("#blogForm").validate({
            rules: {
                title: {
                    required: true,

                },

                description: {
                    required: true
                }

            },
            messages: {
                title: {
                    required: "*Title is required",

                },

                description: {
                    required: "*Description is required",
                },

            },

        });


    });
</script>
@endpush