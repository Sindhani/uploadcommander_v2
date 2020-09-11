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
                <div class="content-header-left col-md-9 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Affiliate Regsitration/Cashout</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('Affiliate Regsitration/Cashout') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Base style table -->
                <section id="tabs-with-icons">
                    <div class="row match-height">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="baseIcon-tab1" data-toggle="tab" aria-controls="tabIcon1" href="#tabIcon1" aria-expanded="true"><i class="ft-aperture"></i> Affiliate Registration</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="baseIcon-tab2" data-toggle="tab" aria-controls="tabIcon2" href="#tabIcon2" aria-expanded="false"><i class="ft-bell"></i> Cash outs</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content px-1 pt-1">
                                            <div role="tabpanel" class="tab-pane active" id="tabIcon1" aria-expanded="true" aria-labelledby="baseIcon-tab1">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered base-style" id="affiliate_regsitration">
                                                        <thead>
                                                        <tr>
                                                            <th>Registration Date and Time</th>
                                                            <th>Customer Number</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Payment Method</th>
                                                            <th>Buyed Packages</th>
                                                            <th>Payed Price</th>
                                                            <th>Commission Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabIcon2" aria-labelledby="baseIcon-tab2">
                                                <table class="table table-striped table-bordered base-style">
                                                    <thead>
                                                    <tr>
                                                        <th>Request Date and Time</th>
                                                        <th>Payment method</th>
                                                        <th>Payout Amount</th>
                                                        <th>Payout date</th>
                                                        <th>Status</th>
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
    var table = $('#affiliate_regsitration').DataTable({
        "pageLength": 50,
        processing: true,
        serverSide: true,
        ajax: "{{ url('admin/affiliate_registration_cashout') }}",
        columns: [
            {data: 'created_at', name: 'created_at'},
            {data: 'customer_number', name: 'customer_number'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'payment_method', name: 'payment_method'},
            {data: 'packages', name: 'packages'},
            {data: 'payed_price', name: 'payed_price'},
            {data: 'commission_amount', name: 'commission_amount'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

});
</script>
@endsection