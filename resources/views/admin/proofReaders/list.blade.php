@extends('admin.layouts.layout')
@section('title', 'Proof Readers')
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
                        <h2 class="content-header-title float-start mb-0">@lang('Proof Readers')</h2>
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
                                {{-- <a href="{{route('admin.proof-reader.add')}}" class="btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0">
                                    <span>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add New Proof Reader
                                    </span>
                                </a> --}}
                                <form action="" method="GET" class="d-flex ms-auto">
                                    <input type="text" name="search" id="search" class="form-control" value="{{$search}}" placeholder="Search Title">
                                    <button type="submit" class="btn btn-primary ms-1"><i class="fa fa-search"></i></button>
                                    <a href="{{route('admin.proof-reader.list')}}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                                </form>
                            </div>
                            <div class="card-datatable table-responsive">
                                <table class="datatables-ajax table table-hover">
                                    <thead>
                                        <tr>
                                            <th>@lang('Name')</th>
                                            <th>@lang('Email')</th>
                                            <th>@lang('Mobile')</th>
                                            <th>@lang('Wallet')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($proofReaders) > 0)
                                            @foreach ($proofReaders as $index => $reader)
                                                <tr>
                                                    <td>
                                                        <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar pull-up my-0" title data-bs-original-title="{{$reader->fullName()}}">
                                                            <img src="{{asset("admin/proofreaders/".$reader->image)}}" alt="" height="35" width="35">
                                                        </div>
                                                        {{ $reader->fullName() }}</td>
                                                    <td>{{ $reader->email }}</td>
                                                    <td>{{ $reader->mobile }}</td>
                                                    <td>{{ $reader->wallet }}</td>
                                                    <td>
                                                        <a href="{{route('admin.proof-reader.edit',$reader->id)}}" class="btn btn-outline-success"><i class="fa fa-edit"></i></a>
                                                        <a href="{{route('admin.proof-reader.delete',$reader->id)}}" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
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
                                @if (count($proofReaders) > 0)
                                    {{ $proofReaders->links('pagination::bootstrap-5') }}
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
