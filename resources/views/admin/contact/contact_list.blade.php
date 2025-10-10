@extends('admin.layouts.layout')
@section('title', 'Contact List')
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
                            <h2 class="content-header-title float-start mb-0">Contact Us</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                @if (Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }} text-center fs-3">
                                        {{ Session::get('message') }}
                                    </p>
                                @endif

                                @if (Session::has('error'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }} text-center fs-3">
                                        {{ Session::get('error') }}
                                    </p>
                                @endif
                                <div class="card-header border-bottom d-flex justify-content-between">
                                    <form action="" class="d-flex justify-content-end m-bottom-4">
                                        <div class="formData d-flex">
                                            <input type="text" class="form-control flatpickr-input from"
                                                placeholder="From Date" name="from"
                                                value="{{ request()->query('from') }}" />
                                            <input type="text" class="form-control flatpickr-input to"
                                                placeholder="To Date" name="to" value="{{ request()->query('to') }}" />
                                        </div>
                                        <button type="submit" class="btn btn-primary m-left-2">Search</button>
                                    </form>
                                    <form action="" method="GET" class="d-flex">
                                        <input type="text" name="search" id="search" class="form-control"
                                            placeholder="Search Ref_id/Name">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </form>
                                    <div>
                                        <a href="{{ route('admin.contact.export') }}"
                                            class="btn btn-primary ms-1">Export</a>
                                        <a href="{{ route('admin.contact.list') }}" class="btn btn-primary"><i
                                                class="fa-solid fa-rotate-right"></i></a>
                                    </div>
                                </div>

                                <div class="card-datatable table-responsive">
                                    <table class="datatables-ajax table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>first Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Ref. id</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($contacts) > 0)
                                                @foreach ($contacts as $index => $contact)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $contact->fname }}</td>
                                                        <td>{{ $contact->lname }}</td>
                                                        <td>{{ $contact->email }}</td>
                                                        <td>{{ $contact->phone }}</td>
                                                        <td>{{ $contact->refId }}</td>
                                                        <td>{{ $contact->created_at->format('d-m-Y') }}</td>
                                                        <td><button class="btn btn-primary view-message"
                                                                data-message="{{ $contact->message }}"><i
                                                                    class="fas fa-eye"></i></button>
                                                            <a href="{{ route('admin.contact.list.delete', $contact->id) }}"
                                                                class="btn btn-outline-danger"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr class="text-center">
                                                    <td colspan="7">No data found</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @if (count($contacts) > 0)
                                        {{ $contacts->links('pagination::bootstrap-5') }}
                                    @endif
                                </div>

                            </div>
                        </div>
                </section>
            </div>
        </div>
    </div>
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="messageContent"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Content-->


@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.view-message').click(function(e) {
                e.preventDefault();
                var message = $(this).data('message');
                $('#messageContent').text(message);
                $('#messageModal').modal('show');
            });
        });
    </script>
@endpush
