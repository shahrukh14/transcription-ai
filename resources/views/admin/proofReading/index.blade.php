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
                            <div class="card-header border-bottom">
                                <div class="col-md-12 text-end">
                                <div class="d-flex justify-content-end">
                                    <form action="" method="GET" class="d-flex">
                                        <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Search ID">
                                        <button type="submit" class="btn btn-primary ms-1"><i class="fa fa-search"></i></button>
                                        <a href="{{ route('admin.proof-reading.list') }}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                                    </form>
                                </div>
                                </div>
                            </div>
                            
                            
                            <div class="card-datatable table-responsive">
                                @if($tasks->count())
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('ID')</th>
                                                <th>@lang('Uploaded Date')</th>
                                                <th>@lang('Claimed Date')</th>
                                                <th>@lang('Claimed By')</th>
                                                <th>@lang('Status')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tasks as $task)
                                                <tr>
                                                    <td>{{ $task->id }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($task->uploaded_dt)->format('d/m/Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($task->claimed_dt)->format('d/m/Y') }}</td>
                                                    <td>{{ $task->getProofreader->first_name ?? '—' }}</td>
                                                    <td>
                                                        <span class="badge 
                                                            @if($task->status === 'pending') bg-warning 
                                                            @elseif($task->status === 'in-progress') bg-info 
                                                            @elseif($task->status === 'completed') bg-success 
                                                            @else bg-primary 
                                                            @endif">
                                                            {{ ucfirst($task->status) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.proof-reading.view', $task->id) }}" class="btn btn-outline-primary btn-sm">
                                                            <i class="fa fa-eye"></i> 
                                                        </a>
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
