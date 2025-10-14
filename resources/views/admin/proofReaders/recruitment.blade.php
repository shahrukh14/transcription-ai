@extends('admin.layouts.layout')
@section('title', 'Recruitment')
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
                        <h2 class="content-header-title float-start mb-0">@lang('Recruitment')</h2>
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
                                <form action="" method="GET" class="d-flex ms-3">
                                    <input type="text" name="search" id="search" class="form-control" value="{{$search}}" placeholder="Search Title">
                                    <button type="submit" class="btn btn-primary ms-1"><i class="fa fa-search"></i></button>
                                    <a href="{{route('admin.proof-reader.recruitment.list')}}" class="btn btn-primary ms-1"><i class="fa-solid fa-rotate-right"></i></a>
                                </form>
                            </div>
                            <div class="card-datatable table-responsive">
                                <table class="datatables-ajax table table-hover">
                                    <thead>
                                        <tr>
                                            <th>@lang('Name')</th>
                                            <th>@lang('Mobile')</th>
                                            <th>@lang('Tests')</th>
                                            {{-- <th>@lang('Action')</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($proofReaders) > 0)
                                            @foreach ($proofReaders as $index => $reader)
                                                <tr>
                                                    <td>{{ $reader->fullName() }}</td>
                                                    <td>{{ $reader->mobile }}</td>
                                                    <td>
                                                        @foreach ($reader->tests as $test)
                                                            <a href="{{route('admin.proof-reader.recruitment.test', $test->id)}}" class="btn btn-outline-primary btn-sm">View</a>
                                                        @endforeach
                                                    </td>
                                                    {{-- <td>
                                                        <a href="{{route('admin.proof-reader.edit',$reader->id)}}" class="btn btn-outline-success btn-sm"><i class="fa-solid fa-check"></i> Approve</a>
                                                    </td> --}}
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
