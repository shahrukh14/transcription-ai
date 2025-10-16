@extends('admin.layouts.layout')
@section('title', 'Invoice Details')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-12 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12 d-flex justify-content-between">
                        <h2 class="content-header-title float-start mb-0">@lang('Invoice Details')</h2>
                        <a href="{{ route('admin.proof-reading.invoice.download', $invoice->id) }}" class="btn btn-outline-primary">Download Invoice</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="ajax-datatable">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-between">
                                <h5 class="">Invoice Deatils</h5>
                                <button class="btn btn-sm btn-outline-primary" id="updateBtn">Status</button>
                            </div>
                            <div class="card-body px-2 pt-1">
                                <h4> Proof Reader : {{$invoice->proofReader->fullName()}}</h4>
                                <h4> Month : {{$invoice->month}}</h4>
                                <h4> Amount : {{$invoice->amount}}</h4>
                                <h4> CF Amount : {{$invoice->cf_amount}}</h4>
                                <h4> Total Amount : {{((int)$invoice->amount + (int)$invoice->cf_amount)}}</h4>
                                <h4> 
                                    Payment Status :
                                    @if ($invoice->status == 1)
                                        <span class="badge rounded-pill badge-light-success me-1">Completed</span>
                                    @elseif($invoice->status == 2)
                                        <span class="badge rounded-pill badge-light-warning me-1">Carry Forwarded</span>
                                    @else
                                        <span class="badge rounded-pill badge-light-secondary me-1">Pening</span>
                                    @endif
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header border-bottom d-flex justify-content-start">
                                <h5 class="">Completed task in the month of {{$invoice->month}}, {{$invoice->year}} by {{$invoice->proofReader->fullName()}}</h5>
                            </div>
                            <div class="card-body px-0">
                                <div class="card-datatable table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-nowrap">@lang('Audio')</th>
                                                <th class="text-nowrap">@lang('Price')</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            @forelse($tasks as $task)
                                                <tr>
                                                    <td>{{$task->audio_name}}</td>
                                                    <td>{{$task->price}}</td>
                                                </tr>
                                            @empty
                                            <tr class="text-center mt-4">
                                                <th colspan="6">No data found</th>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @if(count($tasks) > 0)
                                        {{ $tasks->links('pagination::bootstrap-5') }}
                                    @endif
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

<!-- Update Modal-->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.proof-reading.invoice.update.status', $invoice->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="updateModalLabel"><i class="fa-solid fa-pen-to-square"></i> Payment Status</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <select name="status" id="status" class="form-select">
                                <option value="2">Carry Forword</option>
                                <option value="1">Paid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Update Modal Modal End-->

@push('script')
<script> 
$(document).ready(function () {
    $('#updateBtn').on('click', function (){
        let modal = $('#updateModal');
        modal.modal('show');
    });
});
</script>
@endpush
