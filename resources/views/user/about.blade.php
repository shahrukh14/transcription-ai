@extends('user.layouts.layout')
@section('title', $dynamic->title ?? 'About') 
@section('content')
<div class="rts-hosting-banner rts-hosting-banner-bg banner-default-height p-2">
    <div class="container-fluid"> 
        <div class="row h-100 justify-content-center align-items-center text-center">
            <div class="col-12">
                <div class="rts-hosting-banner__content blog__banner">
                    <h4 class="banner-title">
                       {{ $dynamic->title ?? 'About Us' }} 
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rts-about-reseller section_padding coustem_padding">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-12"> 
                <div class="hosting-info">
                    <div>{!! $dynamic->content ?? 'Content not available' !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
  <style>
    .section__padding {
        padding: 40px 0;
    }
    .rts-hosting-banner.rts-hosting-banner-bg:before {
        height: 220px !important;
    }
    .rts-hosting-banner {
        display: flex;
        flex-direction: column; 
        justify-content: flex-start; 
        height: 250px;
        position: relative;
    }
    .rts-hosting-banner.rts-hosting-banner-bg::after {
        height: 220px !important;
    }
    .rts-hosting-banner.banner-default-height {
        max-height: auto;
        min-height: auto;
    }
    .rts-hosting-banner-bg {
        display: flex;
        justify-content: center; 
        align-items: center; 
        text-align: center;
        height: 200px; 
    }
    .rts-hosting-banner__content.blog__banner {
        display: flex;
        flex-direction: column;
        align-items: center; 
        justify-content: center; 
        max-width: 100%;
    }
    .rts-about-reseller {
        width: 100%;
    }

    .container-fluid {
        padding-left: 0;
        padding-right: 0;
    }
    .coustem_padding{
        padding: 50px !important;
    }
  </style>  
@endpush
