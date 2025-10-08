@extends('admin.layouts.layout')
@section('title', 'Add Permission')
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
                            <h2 class="content-header-title float-start mb-0">@lang('Add Permission')</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                      <!-- Button trigger modal -->

              <div class="card w-100">
                <div class="card-body">
                 <div class="row">
                  <div class="col-md-6">
                    <form action="{{route('admin.add-permission')}}" method="POST">
                      @csrf
                      <div class="mb-3">
                        <label for="permission" class="form-label">@lang('Permission')</label>
                        <input type="text" class="form-control" name="permission" id="permission" required>
                      </div>
                      <button type="submit" class="btn btn-primary">@lang('Submit')</button>
                    </form>
                  </div>
                 </div>
                  
                </div>
              </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
@push('modal')
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button>
@endpush


