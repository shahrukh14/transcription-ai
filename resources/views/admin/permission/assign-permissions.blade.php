@extends('admin.layouts.layout')
@section('title', 'Assign Permissions')
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
                            <h2 class="content-header-title float-start mb-0">All Permissions</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="ajax-datatable">
                    <form action="{{route('admin.assign-permissions')}}" method="POST">
                    @csrf
                        <div class="row">
                            @foreach ($permissions as $group=>$permission)
                                @if(in_array($group, ['_ignition', 'sanctum', 'api', null]))
                                    @continue
                                @endif
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="card business-card">
                                    <div class="card-header pb-0">
                                        <div>
                                            <input class="form-check-input selectAll {{ formatString($group) }}" id="{{ formatString($group) }}" type="checkbox" value="{{ formatString($group) }}">
                                            <label class="form-check-label h4" for="{{ formatString($group) }}">{{ formatString($group) }}</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        @foreach($permission as $per)
                                        <div class="form-check form-check-inline col-md-12 mb-1">
                                            <input class="form-check-input checkbox{{ formatString($group) }}" name="permissions[]" type="checkbox"   value="{{$per->name}}" {{in_array($per->id,$assignedPermissions) ? 'checked' : ''}} >
                                            <label class="form-check-label" for="inlineCheckbox1">{{ formatString($per->name) }}</label>
                                            <input type="hidden" name="role_name" value="{{$roleName}}">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btn-primary">save</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@push('script')
    <script>
        $(document).ready(function(){
            $('.selectAll').on('click', function(){
                let className = $(this).val();
                let selector = '.checkbox' + className;
                if ($(this).prop('checked')==true){ 
                    $(selector).prop('checked', true);
                }else{
                    $(selector).prop('checked', false);
                }
            })
        })
    </script>
@endpush
