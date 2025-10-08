@extends('admin.layouts.layout')
@section('title', 'Faq')
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
                            <h2 class="content-header-title float-start mb-0">@lang('FAQ')</h2>
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
                                <div class="card-header border-bottom">
                                    <a href="{{route('admin.faq.form')}}" class="btn btn-primary" tabindex="0"
                                        aria-controls="DataTables_Table_0">
                                        <span>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-plus me-50 font-small-4">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                            Add New Faq
                                        </span>
                                    </a>
                                    <form action="" method="GET" class="d-flex ms-3">
                                        <input type="text" name="search" id="search" class="form-control"
                                           value="{{$search}}" placeholder="Search Title">
                                        <button type="submit" class="btn btn-primary ms-1"><i class="fa fa-search"></i></button>
                                        <a href="{{route('admin.faq.list')}}" class="btn btn-primary ms-1"><i
                                                class="fa-solid fa-rotate-right"></i></a>
                                    </form>
                                </div>
                                <div class="card-datatable table-responsive">
                                    <table class="datatables-ajax table table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('ID')</th>
                                                <th>@lang('Title')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($faqs) > 0)
                                                @foreach ($faqs as $index => $faq)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $faq->title }}</td>
                                                        <td>
                                                            <a class="btn btn-outline-success"
                                                                href="{{route('admin.faq.edit',$faq->id)}}"
                                                                id="editblog"><i class="fa fa-edit"></i></a>
                                                            <a href="{{route('admin.faq.delete',$faq->id)}}"
                                                                class="btn btn-outline-danger"><i
                                                                    class="fa fa-trash"></i></a>

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
                                    @if (count($faqs) > 0)
                                        {{ $faqs->links('pagination::bootstrap-5') }}
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
