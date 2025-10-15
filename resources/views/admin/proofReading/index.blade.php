@extends('admin.layouts.layout')
@section('title', 'Proof Reading')
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
                        <h2 class="content-header-title float-start mb-0">@lang('Proof Reading')</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="ajax-datatable">
                <div class="row">
                    <div class="col-12">
                        @if (Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center fs-3 py-1 mb-1">
                                {{ Session::get('message') }}
                            </p>
                        @endif
                        
                        @if (Session::has('error'))
                            <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3 py-1 mb-1">
                                {{ Session::get('error') }}
                            </p>
                        @endif
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-end">
                                <form action="" method="GET" class="d-flex align-items-center m-bottom-4 w-auto gap-1">
                                    <div class="formData d-flex gap-1">
                                        <input type="text" class="form-control flatpickr-input from" placeholder="From Date" name="from" value="{{ request('from') }}" />
                                        <input type="text" class="form-control flatpickr-input to ms-.5" placeholder="To Date" name="to" value="{{ request('to') }}" />
                                    </div>
                                    <button type="submit" class="btn btn-primary ms-.5">Search</button>
                                </form>
                                <form action="" method="GET" class="d-flex gap-1">
                                    <input type="text" name="search" id="search" class="form-control ms-2" value="{{ request('search') }}" placeholder="Search Name">
                                    <button type="submit" class="btn btn-primary ms-.5"><i class="fa fa-search"></i></button>
                                </form>
                                <a href="{{ url()->current() }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                            </div>
                            <div class="card-body px-0">
                                <div class="card-datatable table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-nowrap">@lang('Audio')</th>
                                                    <th class="text-nowrap">@lang('Uploaded At')</th>
                                                    <th class="text-nowrap">@lang('Status')</th>
                                                    <th class="text-nowrap">@lang('Claimed By')</th>
                                                    <th class="text-nowrap">@lang('Claimed At')</th>
                                                    <th class="text-nowrap">@lang('Complete At')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($tasks->count())
                                                @foreach($tasks as $task)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('admin.proof-reading.view',$task->id) }}" title="{{$task->audio_name}}">
                                                                {{ Str::limit($task->audio_name, 50, '...') }}
                                                            </a>
                                                        </td>
                                                        <td>{{date('d M Y, h:i A', strtotime($task->uploaded_dt))}}</td>
                                                        <td>
                                                            @if ($task->status == "Completed")
                                                                <span class="badge rounded-pill badge-light-success me-1">Completed</span>
                                                            @elseif($task->status == "Claimed")
                                                                <span class="badge rounded-pill badge-light-warning me-1">Claimed</span>
                                                            @elseif($task->status == "Unclaimed")
                                                                <span class="badge rounded-pill badge-light-danger me-1">Unclaimed</span>
                                                            @elseif($task->status == "Cancelled")
                                                                <span class="badge rounded-pill badge-light-danger me-1">Cancelled</span>
                                                            @else
                                                                <span class="badge rounded-pill badge-light-secondary me-1">Not Claimed</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($task->claimed_by != null)
                                                                {{$task->proofReader->fullName()}}
                                                            @else
                                                                <span class="badge rounded-pill badge-light-secondary me-1">Not Claimed</span>
                                                            @endif
                                                        </td>
                                                        <td>{!! ($task->claimed_dt != null) ? date('d M Y, h:i A', strtotime($task->claimed_dt)) : '<span class="badge rounded-pill badge-light-warning me-1">Not Claimed</span>' !!}</td>
                                                        <td>{!! ($task->task_complete_time != null) ? date('d M Y, h:i A', strtotime($task->task_complete_time)) : '<span class="badge rounded-pill badge-light-warning me-1">Not Completed</span>' !!}</td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                <tr class="text-center mt-4">
                                                    <th colspan="6">No data found</th>
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
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
