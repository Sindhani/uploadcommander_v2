@extends('admin.layouts.admin')

@section('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/checkboxes-radios.css') }}">
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Add Coupon</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/coupon') }}">{{ __('Coupon') }}</a></li>
                                <li class="breadcrumb-item active">Add Coupon</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Base style table -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        {!! Form::open(array('route' => 'admin.coupon.store','method'=>'POST','class'=>'form form-horizontal')) !!}
                                            <div class="form-body">

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Coupon Code Type</label>
                                                    <div class="col-md-9">
                                                        <div class="row skin skin-square ml-1">
                                                        @foreach($couponCodeType as $key=>$value)
                                                            <fieldset class="mr-2">
                                                                <input type="radio" name="coupon_code_type" class="coupon_code_type" id="{{ $key }}" value="{{ $key }}" {{ ($key=='automatic')?'checked':'' }} required>
                                                                <label for="{{ $key }}">{{ $value }}</label>
                                                            </fieldset>
                                                        @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row" id="automatic_block">
                                                    <label class="col-md-3 label-control">No. Of Coupon Code</label>
                                                    <div class="col-md-9">
                                                        <input type="number" id="no_of_coupon" name="no_of_coupon" min="1" class="form-control" placeholder="No. Of Coupon Code" />
                                                    </div>
                                                </div>

                                                <div class="form-group row" id="isbn_block" style="display: none;">
                                                    <label class="col-md-3 label-control">ISBN</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('coupon_code', '', array('placeholder' => 'ISBN','class' => 'form-control position-inside-maxlength','maxlength'=>13)) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Coupon Type</label>
                                                    <div class="col-md-9">
                                                        {!! Form::select('coupon_type', $couponType,'', array('class' => 'form-control coupontype','required')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row" id="percentage_block">
                                                    <label class="col-md-3 label-control">Percentage</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('percentage', '', array('placeholder' => 'Percentage','class' => 'form-control percentage-inputmask')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row" id="absolute_block" style="display: none;">
                                                    <label class="col-md-3 label-control">Absolute</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="amount" id="amount" placeholder="Absolute" class="form-control" min="1" step="0.01">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">From Datetime</label>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="date" class="form-control" name="coupon_from_date" id="coupon_from_date" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="time" class="form-control" name="coupon_from_time" id="coupon_from_time" value="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">To Datetime</label>
                                                    <div class="col-md-4">
                                                        <input type="date" class="form-control" name="coupon_to_date" id="coupon_to_date" value="">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="time" class="form-control" name="coupon_to_time" id="coupon_to_time" value="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Packages</label>
                                                    <div class="col-md-9">
                                                        {!! Form::select('package_id', $packages,'', array('class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Coupon Code Used</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('coupon_code_used', '', array('placeholder' => 'Coupon Code Used','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row pb-1">
                                                    <label class="col-md-3 label-control">Stauts</label>
                                                    <div class="col-md-9">
                                                        <div class="row skin skin-square ml-1">
                                                            <input type="checkbox" name="status" id="status" class="switchery" checked="" value="active">
                                                            <label for="switchery" class="font-medium-2 text-bold-600 ml-1"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions right">
                                                <button type="button" class="btn btn-danger mr-1" onclick="location.href='{{ url('admin/coupon') }}'">
                                                    <i class="ft-x"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_scripts')
    <script src="{{ asset('app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.percentage-inputmask').inputmask("99%");

            $('input.coupon_code_type').on('ifChecked', function(event){
                //alert(event.type + ' callback');
                //alert('checked = ' + event.target.checked);
                //alert('value = ' + event.target.value);

                if(event.target.value=='automatic') {
                    $("#isbn_block").hide();
                    $("#automatic_block").show();
                }

                if(event.target.value=='manual') {
                    $("#isbn_block").show();
                    $("#automatic_block").hide();
                }
            });

            $(".coupontype").change(function () {
                if($(this).val()=='percentage') {
                    $("#percentage_block").show();
                    $("#absolute_block").hide();
                }
                if($(this).val()=='absolute') {
                    $("#percentage_block").hide();
                    $("#absolute_block").show();
                }
            });

        });

    </script>
@endsection