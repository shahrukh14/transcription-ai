@extends('admin.layouts.layout')
@section('title', ' Dynamic')
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
                            <h2 class="content-header-title float-start mb-0">@lang('Dynamic Content')</h2>
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
                                        {{ Session::get('message') }}</p>
                                @endif

                                @if (Session::has('error'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">
                                        {{ Session::get('error') }}</p>
                                @endif
                                <div class="card-header border-bottom d-flex justify-content-between">
                                    <a href="{{ route('admin.dynamic.add.form') }}" class="btn btn-primary" tabindex="0"
                                        aria-controls="DataTables_Table_0">
                                        <span>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Add Dynamic Content
                                        </span>
                                    </a>
                                    <div class="ms-auto">
                                        <form action="" method="GET" class="d-flex">
                                            <input type="text" name="search" id="search" class="form-control"
                                                placeholder="Search Title" value="{{ $search }}">
                                            <button type="submit" class="btn btn-primary mx-1"><i
                                                    class="fa fa-search"></i></button>
                                            <a href="{{ route('admin.dynamic.list') }}" class="btn btn-primary">
                                                <i class="fa-solid fa-arrow-rotate-right"></i>
                                            </a>
                                        </form>

                                    </div>
                                </div>
                                <div class="card-datatable table-responsive">
                                    <table class="datatables-ajax table table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('Sl.NO')</th>
                                                <th>@lang('Title')</th>
                                                <th>@lang('slug')</th>
                                                <th>@lang('action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($dynamics) > 0)
                                                @foreach ($dynamics as $index => $dynamic)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $dynamic->title }}</td>
                                                        <td>{{ url('/') . '/' . $dynamic->slug }}</td>
                                                        <td>
                                                            <a class="btn btn-outline-success"
                                                                href="{{ route('admin.dynamic.edit', $dynamic->id) }}"
                                                                id="editblog"><i class="fa fa-edit"></i></a>
                                                            <a href="{{ route('admin.dynamic.delete', $dynamic->id) }}"
                                                                class="btn btn-outline-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="text-center">
                                                    <td colspan="6">No data found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                            @if (count($dynamics) > 0)
                                {{ $dynamics->links('pagination::bootstrap-5') }}
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
