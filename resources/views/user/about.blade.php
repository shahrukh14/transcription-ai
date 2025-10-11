@extends('user.layouts.layout')
@section('title', $dynamic->title)
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12 mt-1">
                    {!! $dynamic->content ?? 'Content not available' !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

 
    