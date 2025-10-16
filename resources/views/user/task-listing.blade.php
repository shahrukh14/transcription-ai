@extends('user.layouts.layout')
@section('title', 'Proof Reading')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        @if (Session::has('success'))
            <p class="alert alert-success text-center fs-3 py-1">{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('error'))
            <p class="alert alert-danger text-center fs-3 py-1"> {{ Session::get('error') }}</p>
        @endif
        <div class="content-body">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-12">
                    <div class="card-header p-0">
                        <h4 class="card-title">Proof Readings</h4>
                    </div>
                    <div class="card">
                        <div class="card-header border-bottom d-flex justify-content-end">
                            <form action="" method="GET" class="d-flex gap-1">
                                <input type="text" name="search" id="search" class="form-control ms-2" value="{{ request('search') }}" placeholder="Search Payment Id">
                                <button type="submit" class="btn btn-primary ms-.5"><i class="fa fa-search"></i></button>
                            </form>
                            <a href="{{ url()->current() }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                        </div>
                        <div class="card-body px-0">
                            <div class="card-datatable table-responsive">
                                <table class="datatables-ajax table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">@lang('Audio')</th>
                                            <th class="text-nowrap">@lang('Uploaded At')</th>
                                            <th class="text-nowrap">@lang('Status')</th>
                                            <th class="text-nowrap">@lang('Claimed At')</th>
                                            <th class="text-nowrap">@lang('Complete At')</th>
                                            <th class="text-nowrap">@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($transcriptions) > 0)
                                            @foreach ($transcriptions as $transcription)
                                                @php
                                                    $task = $transcription->tasks->first();
                                                @endphp
                                            <tr>
                                                <td>
                                                    @if($task->payment == "Paid")
                                                    <a href="{{ route('user.proof.reading.view', $transcription->id) }}" title="{{$transcription->audio_file_original_name}}">
                                                        {{ Str::limit($transcription->audio_file_original_name, 50, '...') }}
                                                    </a>
                                                    @else
                                                        <span>{{ Str::limit($transcription->audio_file_original_name, 50, '...') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{date('d M Y, h:i A', strtotime($task->uploaded_dt))}}</td>
                                                <td>
                                                    @if ($transcription->tasksStatus == "Completed")
                                                        <span class="badge rounded-pill badge-light-success me-1">Completed</span>
                                                    @elseif($transcription->tasksStatus == "Claimed")
                                                        <span class="badge rounded-pill badge-light-warning me-1">In Progress</span>
                                                    @elseif($transcription->tasksStatus == "Unclaimed")
                                                        <span class="badge rounded-pill badge-light-danger me-1">Unclaimed</span>
                                                    @elseif($transcription->tasksStatus == "Cancelled")
                                                        <span class="badge rounded-pill badge-light-danger me-1">Cancelled</span>
                                                    @else
                                                        <span class="badge rounded-pill badge-light-secondary me-1">Not Claimed</span>
                                                    @endif
                                                </td>
                                                <td>{!! ($transcription->tasksStatus && $task->claimed_dt != null) ? date('d M Y, h:i A', strtotime($task->claimed_dt)) : '<span class="badge rounded-pill badge-light-secondary me-1">Not Claimed</span>' !!}</td>
                                                <td>{!! ($transcription->tasksStatus && $task->task_complete_time != null) ? date('d M Y, h:i A', strtotime($task->task_complete_time)) : '<span class="badge rounded-pill badge-light-warning me-1">Not Completed</span>' !!}</td>
                                                <td>
                                                    @if ($transcription->tasksStatus == "Claimed" || $transcription->tasksStatus == "Completed" || $transcription->tasksStatus == "Cancelled")
                                                        <button type="button" class="btn btn-outline-secondary" disabled>Cancel</button>
                                                    @else
                                                        <a href="{{ route('user.proof.reading.cancel',$transcription->id) }}" class="btn btn-outline-danger">Cancel</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                        <tr class="text-center">
                                            <th colspan="7"><h4>No data found</h4></th>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection