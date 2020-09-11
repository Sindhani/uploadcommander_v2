@extends('customer.layouts.address')

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
                    <h3 class="content-header-title mb-0 d-inline-block border-right-0">Address & Change Password</h3>
                </div>
            </div>
            <div class="content-body">
                <!-- Base style table -->
                {!! Form::open(array('url' => 'customer/user/addresspassword','method'=>'POST','class'=>'form form-horizontal','enctype'=>'multipart/form-data')) !!}
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

                                        @if (Session::has('error'))
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                <ul>
                                                    <li>{{ Session::get('error') }}</li>
                                                </ul>
                                            </div>
                                        @endif


                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-3 text-center">
                                                    <div class="circle">
                                                        <img class="profile-pic" src="{{ asset('images/user.jpg') }}">
                                                    </div>
                                                    <div class="p-image">
                                                        <i class="la la-camera upload-button"></i>
                                                        <input class="file-upload" type="file" name="photo" id="photo" accept="image/*"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4 class="card-title">Address</h4>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                {{--<label class="col-md-3 label-control">Street Number</label>--}}
                                                                <div class="col-md-12">
                                                                    {!! Form::text('street', null, array('placeholder' => 'Street','class' => 'form-control','required')) !!}
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                {{--<label class="col-md-3 label-control">City</label>--}}
                                                                <div class="col-md-12">
                                                                    {!! Form::text('city', null, array('placeholder' => 'City','class' => 'form-control','required')) !!}
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                {{--<label class="col-md-3 label-control">Zipcode</label>--}}
                                                                <div class="col-md-12">
                                                                    {!! Form::text('zipcode', null, array('placeholder' => 'Zipcode','class' => 'form-control','required')) !!}
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                {{--<label class="col-md-3 label-control">Country</label>--}}
                                                                <div class="col-md-12">
                                                                    {!! Form::select('country', $countryList,[], array('class' => 'form-control','required')) !!}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <div class="clearfix"></div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="card-title">Change Password</h4>

                                                            <div class="form-body">

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            {{--<label class="col-md-3 label-control">New Passowrd</label>--}}
                                                                            <div class="col-md-12">
                                                                                {!! Form::password('password', array('placeholder' => 'New Password','class' => 'form-control','required')) !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group row">
                                                                            {{--<label class="col-md-3 label-control">Confirm Passowrd</label>--}}
                                                                            <div class="col-md-12">
                                                                                {!! Form::password('password_confirmation', array('placeholder' => 'Confirm Password','class' => 'form-control','required')) !!}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <h4 class="card-title">&nbsp;</h4>
                                                    <div class="form-group row">
                                                        {{--<label class="col-md-3 label-control">Language</label>--}}
                                                        <div class="col-md-12">
                                                            {!! Form::select('language', $language,[], array('class' => 'form-control','required')) !!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        {{--<label class="col-md-3 label-control">Timezone</label>--}}
                                                        <div class="col-md-12">
                                                            {!! Form::select('timezone', $timezones,[], array('class' => 'form-control','required')) !!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        {{--<label class="col-md-3 label-control">Date Format</label>--}}
                                                        <div class="col-md-12">
                                                            {!! Form::select('dateformat', $dateFormat,[], array('class' => 'form-control','required')) !!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        {{--<label class="col-md-3 label-control">Time Format</label>--}}
                                                        <div class="col-md-12">
                                                            {!! Form::select('timeformat', $timeFormat,[], array('class' => 'form-control','required')) !!}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>







                                        <div class="clearfix"></div>

                                        <div class="form-body">
                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Save
                                                </button>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            {!! Form::close() !!}
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_scripts')
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
@endsection