@extends('user.layouts.layout')
@section('title', 'FAQs')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
        <div class="content-body">
            <section id="accordion-with-margin">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">FAQs</h3>
                            </div>
                            <div class="card-body">
                                <div class="accordion accordion-margin" id="accordionMargin" data-toggle-hover="true">
                                    @foreach ($faqs as $index => $faq)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingMargin{{ $faq->id}}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMargin{{ $faq->id}}" aria-expanded="false" aria-controls="accordionMargin{{ $faq->id}}">
                                                {{ $faq->title }}
                                            </button>
                                        </h2>
                                        <div id="accordionMargin{{ $faq->id}}" class="accordion-collapse collapse" aria-labelledby="headingMargin{{ $faq->id}}" data-bs-parent="#accordionMargin">
                                            <div class="accordion-body">
                                                {!! $faq->description !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
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
 

@push('style')
<!-- Dropzone CSS -->
<style> 
</style>
@endpush

 
    