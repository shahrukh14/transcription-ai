@extends('admin.layouts.layout')
@section('title', 'Transacription')
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
                            <h2 class="content-header-title float-start mb-0">@lang('Transacription Deatils')</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.transaction.list') }}">Home</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <!-- User Details Card -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="mb-2"><strong>Audio File:</strong></label>
                                        <p class="mb-2">{{ $detail->audio_file_original_name }}<a href="{{ asset('user/audios/' . $detail->audio_file_name) }}" class="btn btn-sm btn-primary ms-2" download>
                                            <i class="fa fa-download"></i> Download
                                        </a></p>
                                    
                                        <label class="mb-2"><strong>transaction:</strong></label>
                                        <p>{{ $detail->transaction_from_api }}</p>
                                    </div>
                                    
                                </div>
                            </div>   
                        </div>
                    </div>
                </div> <!-- End Row -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
