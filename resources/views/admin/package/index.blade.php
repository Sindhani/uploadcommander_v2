@extends('admin.layouts.admin')

@section('vendor_style')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Packages</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('Packages') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Base style table -->
                <section id="base-style">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="heading-elements">
                                        <button type="button" class="btn btn-primary btn-min-width mr-1 mb-1 text-right" onclick="location.href='{{ url('admin/package/create') }}'"> <i class="la la-plus"></i> Add Package</button>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            @if (Session::has('success'))
                                                <div class="alert alert-success mt-2" role="alert">{{ Session::get('success') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if (Session::has('danger'))
                                                <div class="alert alert-danger mt-2" role="alert">{{ Session::get('danger') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <table class="table table-striped table-bordered base-style">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Social Acc. Limit</th>
                                                    <th>Monthly Pricing</th>
                                                    <th>Yearly Pricing</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Base style table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('scripts')
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    var table = $('.base-style').DataTable({
        "pageLength": 50,
        processing: true,
        serverSide: true,
        ajax: "{{ url('admin/package') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'subscription_name', name: 'subscription_name'},
            {data: 'social_account_limit', name: 'social_account_limit'},
            {data: 'monthly_pricing', name: 'monthly_pricing'},
            {data: 'yearly_pricing', name: 'yearly_pricing'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

});
</script>
@endsection