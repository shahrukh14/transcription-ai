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
                                {{-- dropdown --}}
                                <form method="GET" action="">
                                    <select class="form-select" name="status" onchange="this.form.submit()">
                                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                                        <option value="claimed" {{ request('status') == 'claimed' ? 'selected' : '' }}>Claimed</option>
                                        <option value="unclaimed" {{ request('status') == 'unclaimed' ? 'selected' : '' }}>Unclaimed</option>
                                    </select>
                                </form>
                                {{-- date filter --}}
                                <form action="" method="GET" class="d-flex gap-1 align-items-center m-bottom-4 w-auto">
                                    <div class="formData d-flex gap-1">
                                        <input type="text" class="form-control flatpickr-input from" placeholder="From Date" name="from" value="{{ request('from') }}" />
                                        <input type="text" class="form-control flatpickr-input to" placeholder="To Date" name="to" value="{{ request('to') }}" />
                                    </div>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </form>
                                {{-- search filter --}}
                                <form action="" method="GET" class="d-flex">
                                    <input type="text" name="search" id="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Search Audio name">
                                    <button type="submit" class="btn btn-primary mx-1"><i class="fa fa-search"></i></button>
                                    @if((request()->is('proof-reader/tasks/my-task')))
                                        <a href="{{ route('proof-reader.tasks.my.task') }}" class="btn btn-primary"><i class="fa-solid fa-rotate-right"></i></a>
                                    @else
                                        <a href="{{ route('proof-reader.tasks.list') }}" class="btn btn-primary"><i class="fa-solid fa-rotate-right"></i></a>
                                    @endif
                                </form>
                            </div>
                            <div class="card-datatable table-responsive">
                                <table class="datatables-ajax table table-hover">
                                    <thead>
                                        <tr>
                                            <th>@lang('Audio')</th>
                                            <th>@lang('Uploaded At')</th>
                                            <th>@lang('Claimed At')</th>
                                            <th>@lang('Completed At')</th>
                                            <th>@lang('Claim Tasks')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($tasks) > 0)
                                        @foreach ($tasks as $index => $task)
                                        <tr>
                                            <td>
                                                <a href="{{ route('proof-reader.tasks.view',$task->id) }}" title="{{$task->transcription->audio_file_original_name}}">
                                                    {{ Str::limit($task->audio_name, 30, '...') }}
                                                </a>
                                            </td>
                                            <td>{{date('d M Y, h:i A', strtotime($task->uploaded_dt))}}</td>
                                            <td>{!! ($task->claimed_dt != null) ? date('d M Y, h:i A', strtotime($task->claimed_dt)) : '<span class="badge rounded-pill badge-light-warning me-1">Not Claimed</span>' !!}</td>
                                            <td>{!! ($task->task_complete_time != null) ? date('d M Y, h:i A', strtotime($task->task_complete_time)) : '<span class="badge rounded-pill badge-light-warning me-1">Not Completed</span>' !!}</td>
                                            <td>
                                                @if ($task->status == "Completed")
                                                    <span class="badge rounded-pill badge-light-success me-1">Completed</span>
                                                @else
                                                    <form action="{{ route('proof-reader.tasks.claimed.by.proof.reader', ['id' => $task->id]) }}">
                                                        @if ($task->status == "Claimed")
                                                            <select name="status" id="" onchange="this.form.submit()" class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="Unclaimed" {{ $task->status == 'Unclaimed' ? 'selected' : '' }}>Unclaimed</option>
                                                            </select>
                                                        @else
                                                            <select name="status" id="" onchange="this.form.submit()" class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="Claimed" {{ $task->status == 'Claimed' ? 'selected' : '' }}>Claimed</option>
                                                            </select>
                                                        @endif
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr class="text-center">
                                            <td colspan="5"><h4>No data found</h4></td>
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
