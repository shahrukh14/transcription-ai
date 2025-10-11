@extends('proofReader.layouts.layout')
@section('title', 'Tasks')
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
                        <h2 class="content-header-title float-start mb-0">Tasks</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="ajax-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
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
                            <div class="card-header border-bottom">
                                <form action="{{ route('proof-reader.tasks.list') }}" method="GET" class="d-flex">
                                    <input type="text" name="search" id="search" class="form-control"
                                        value="{{ $search }}" placeholder="Search Task name">
                                    <button type="submit" class="btn btn-primary mx-1"><i class="fa fa-search"></i></button>
                                    <a href="{{ route('proof-reader.tasks.list') }}" class="btn btn-primary"><i
                                            class="fa-solid fa-rotate-right"></i></a>
                                </form>
                            </div>
                            <div class="card-datatable table-responsive">
                                <table class="datatables-ajax table table-hover">
                                    <thead>
                                        <tr>
                                            <th>@lang('Sl no.')</th>
                                            <th>@lang('Task name')</th>
                                            <th>@lang('Claim Tasks')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($tasks) > 0)
                                        @foreach ($tasks as $index => $task)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <a href="{{ route('proof-reader.tasks.view',$task->id) }}">
                                                    {{ $task->transcription->audio_file_name }}
                                                </a>
                                            </td>
                                            <td>
                                               <form action="{{ route('proof-reader.tasks.claimed.by.proof.reader', ['id' => $task->id]) }}">
                                               <select name="status" id="" onchange="this.form.submit()" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="C" {{ $task->status == 'C' ? 'selected' : '' }}>Claimed</option>
                                                    <option value="UC" {{ $task->status == 'UC' ? 'selected' : '' }}>Unclaimed</option>
                                                </select>
                                               </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="text-center">
                                            <td colspan="4">No data found</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                @if (count($tasks) > 0)
                                {{ $tasks->links('pagination::bootstrap-5') }}
                                @endif
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