@extends('admin.layouts.layout')
@section('title', 'Roles')
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
                            <h2 class="content-header-title float-start mb-0">@lang('Roles')</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <div id="tableHeaderDiv">
                                        <a href="{{ route('admin.add-role-form') }}" class="btn btn-primary">
                                            @lang('Add New Role')
                                        </a>
                                    </div>
                                </div>
                                <div class="card-datatable table-responsive">
                                    <table class="datatables-ajax table  table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('Created Date')</th>
                                                <th>@lang('Title')</th>
                                                <th>@lang('Status')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($rolesDetails) > 0)
                                                @foreach ($rolesDetails as $roleDetails)
                                                    <tr>
                                                        <td>{{ date('d/m/Y h : i A', strtotime($roleDetails->created_at)) }}
                                                        </td>
                                                        <td>{{ $roleDetails->name }}</td>
                                                        <td>
                                                            <div class="form-check form-switch ">
                                                                <form action="{{ route('admin.change-role-status') }}"
                                                                    method="POST" onchange="this.submit()">
                                                                    @csrf
                                                                    <input class="form-check-input cursor-pointer"
                                                                        type="checkbox" role="switch"
                                                                        value="{{ config('constant.status.active') }}"
                                                                        name="role_status"
                                                                        {{ config('constant.status.active') == $roleDetails->status ? 'checked' : '' }}>
                                                                    <input type="hidden" name="role_id"
                                                                        value="{{ $roleDetails->id }}">
                                                                </form>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-outline-success"
                                                                href="{{ route('admin.assign-permissions-to-role', ['role_name' => $roleDetails->name]) }}">Assign Permission</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8" class="text-center">@lang('No Data Found')</td>
                                                </tr>
                                            @endif



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @if (count($rolesDetails) > 0)
                {{ $rolesDetails->links('pagination::bootstrap-5') }}
            @endif
        </div>
    </div>
    <!-- END: Content-->
@endsection
