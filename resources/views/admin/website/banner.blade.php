@extends('admin.layouts.layout')
@section('title', 'Banner Image')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9  mb-2">
                <div class="row breadcrumbs-top">
                    <div class="">
                        <h2 class="content-header-title float-start mb-0 uppercase">Update Banner Image</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="card w-100">
                <div class="card-body">
                    <form method="POST" enctype='multipart/form-data' action="{{ route('admin.update.banner', ['id' => 1]) }}" class="p-2">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 mar-t-b  mb-1">
                                <label class="form-label mb-1">Banner 1</label>
                                <div class="form_input">
                                    <input name="banner_img1" type="file" tabindex="1" class="form-control" />
                                    @if($banner && $banner->banner_img1 != null)
                                    <a href="{{ asset('landing-assets/images/banner_img/'.$banner->banner_img1) }}" target="_blank">Image Link</a> 
                                    &nbsp; 
                                    <a href="{{ route('admin.delete.banner', [ 'image' => $banner->banner_img1]) }}"><i class="fa-solid fa-xmark"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mar-t-b  mb-1">
                                <label class="form-label mb-1">Banner 2</label>
                                <div class="form_input">
                                    <input name="banner_img2" type="file" tabindex="1" class="form-control" />
                                    @if($banner && $banner->banner_img2 != null)
                                    <a href="{{ asset('landing-assets/images/banner_img/'.$banner->banner_img2) }}" target="_blank">Image Link</a>
                                    &nbsp;
                                    <a href="{{ route('admin.delete.banner', [ 'image' => $banner->banner_img2]) }}"><i class="fa-solid fa-xmark"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 mar-t-b  mb-1">
                                <label class="form-label mb-1">Banner 3</label>
                                <div class="form_input">
                                    <input name="banner_img3" type="file" tabindex="1" class="form-control" />
                                    @if($banner && $banner->banner_img3 != null)
                                    <a href="{{ asset('landing-assets/images/banner_img/'.$banner->banner_img3) }}" target="_blank">Image Link</a>
                                    &nbsp;
                                    <a href="{{ route('admin.delete.banner', [ 'image' => $banner->banner_img3]) }}"><i class="fa-solid fa-xmark"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mar-t-b  mb-1">
                                <label class="form-label mb-1">Banner 4</label>
                                <div class="form_input">
                                    <input name="banner_img4" type="file" tabindex="1" class="form-control" />
                                    @if($banner && $banner->banner_img4 != null)
                                    <a href="{{ asset('landing-assets/images/banner_img/'.$banner->banner_img4) }}" target="_blank">Image Link</a>
                                    &nbsp;
                                    <a href="{{ route('admin.delete.banner', [ 'image' => $banner->banner_img4]) }}"><i class="fa-solid fa-xmark"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 mar-t-b  mb-1">
                                <label class="form-label mb-1">Banner 5</label>
                                <div class="form_input">
                                    <input name="banner_img5" type="file" tabindex="1" class="form-control" />
                                    @if($banner && $banner->banner_img5 != null)
                                    <a href="{{ asset('landing-assets/images/banner_img/'.$banner->banner_img5) }}" target="_blank">Image Link</a>
                                    &nbsp;
                                    <a href="{{ route('admin.delete.banner', [ 'image' => $banner->banner_img5]) }}"><i class="fa-solid fa-xmark"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary ">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </section>
    </div>
    <!--CARD END-->

</div>

@endsection