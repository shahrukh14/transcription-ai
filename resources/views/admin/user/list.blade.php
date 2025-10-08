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
                            <h2 class="content-header-title float-start mb-0">@lang('Users')</h2>
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
                                        <a href="{{ route('admin.add-user-form') }}" class="btn btn-primary">
                                            @lang('Add New User')
                                        </a>
                                    </div>
                                </div>
                                <div class="card-datatable table-responsive">
                                    <table class="datatables-ajax table  table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('Created Date')</th>
                                                <th>@lang('First Name')</th>
                                                <th>@lang('Last Name')</th>
                                                <th>@lang('Email')</th>
                                                <th>@lang('Role')</th>
                                                <th>@lang('Status')</th>
                                                <th>@lang('Action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($users) > 0)
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ date('d/m/Y h : i A', strtotime($user->created_at)) }}
                                                        </td>
                                                        <td>{{$user->first_name}}</td>
                                                        <td>{{$user->last_name }}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{$user->getRoleNames()->first()}}</td>
                                                        <td>
                                                            <div class="form-check form-switch ">
                                                                <form action="{{ route('admin.change-user-status') }}"
                                                                    method="POST" onchange="this.submit()">
                                                                    @csrf
                                                                    <input class="form-check-input cursor-pointer"
                                                                        type="checkbox" role="switch"
                                                                        value="{{ config('constant.status.active') }}"
                                                                        name="user_status"
                                                                        {{ config('constant.status.active') == $user->status ? 'checked' : '' }}>
                                                                    <input type="hidden" name="user_id"
                                                                        value="{{ $user->id }}">
                                                                </form>
                                                            </div>
                                                        </td>
                                                        <td>
                                                                    <a class="btn btn-outline-success" href="{{route('admin.edit-user',['id' => $user->id])}}" id="editschool" ><i class="fa fa-edit"></i></a>
                                                            <a href="{{route('admin.delete-user',['id' => $user->id])}}" class="btn btn-outline-danger text-danger"><i
                                                                    class="fa fa-trash"></i></a>
                                                   
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
            @if (count($users) > 0)
                {{ $users->links('pagination::bootstrap-5') }}
            @endif
        </div>
    </div>
    <!-- END: Content-->
@endsection
