@extends('customer.layouts.app')

@section('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/checkboxes-radios.css') }}">
@endsection

@section('styles')
<style type="text/css">
    .profile-pic {
        max-width: 200px;
        max-height: 200px;
        display: block;
    }

    .file-upload {
        display: none;
    }
    .circle {
        overflow: hidden;
        width: 200px;
        height: 199px;
        position: absolute;
        border-radius: 130px;
        border: 5px solid #e7e7e7;
    }
    img {
        max-width: 100%;
        height: auto;
    }
    .p-image {
        position: absolute;
        top: 157px;
        right: 65px;
        color: #666666;
        transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
    }
    .p-image:hover {
        transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
    }
    .upload-button {
        font-size: 1.2em;
    }

    .upload-button:hover {
        transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        color: #999;
    }
</style>
@endsection


@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block border-right-0">Account Settings</h3>
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

                                        @if (Session::has('success'))
                                            <div class="alert alert-success mt-2" role="alert">{{ Session::get('success') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif

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
                                            {!! Form::open(array('url' => 'customer/user/updateaccount','method'=>'POST','class'=>'form form-horizontal','enctype'=>'multipart/form-data')) !!}
                                                <div class="row">
                                                    <div class="col-md-3 text-center">
                                                        @if ($customer->photo)
                                                            <div class="circle">
                                                                <img class="profile-pic" src="{{ asset('user_photo/'.$customer->photo) }}">
                                                            </div>
                                                        @else
                                                            <div class="circle" style="border: 0px;">
                                                                <img class="profile-pic" src="{{ asset('images/user.jpg') }}">
                                                            </div>
                                                        @endif

                                                        <div class="p-image">
                                                            <i class="la la-camera upload-button"></i>
                                                            <input class="file-upload" type="file" name="photo" id="photo" accept="image/*"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <h4 class="card-title">Personal</h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        {!! Form::text('first_name', $customer->first_name, array('placeholder' => 'First Name','class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        {!! Form::text('company_name', $customer->company_name, array('placeholder' => 'Company Name','class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        {!! Form::text('last_name', $customer->last_name, array('placeholder' => 'Last Name','class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <h4 class="card-title">Address</h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">Street Number</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::text('street', $customer->street, array('placeholder' => 'Street','class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">City</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::text('city', $customer->city, array('placeholder' => 'City','class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">Country</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::select('country', $countryList, $customer->country, array('class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">Street Number</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::text('street_no', $customer->street_no, array('placeholder' => 'Street No.','class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">Zipcode</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::text('zipcode', $customer->zipcode, array('placeholder' => 'Zipcode','class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>



                                                            </div>
                                                        </div>

                                                        <h4 class="card-title">Account Settings</h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        {!! Form::text('email', $customer->email, array('placeholder' => 'Email','class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">New Passowrd</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::password('password', array('placeholder' => 'New Password','class' => 'form-control')) !!}
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="col-md-6">

                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">Confirm Passowrd</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::password('password_confirmation', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <h4 class="card-title">Interface Settings</h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">Language</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::select('language', $language, $customer->language, array('class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">Timezone</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::select('timezone', $timezones, $customer->timezone, array('class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">Date Format</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::select('dateformat', $dateFormat, $customer->dateformat, array('class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    {{--<label class="col-md-3 label-control">Time Format</label>--}}
                                                                    <div class="col-md-12">
                                                                        {!! Form::select('timeformat', $timeFormat, $customer->timeformat, array('class' => 'form-control','required')) !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-body">
                                                            <div class="form-actions center">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="la la-check-square-o"></i> Save
                                                                </button>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            {!! Form::close() !!}

                                        </div>

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
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function(){
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });
    </script>
@endsection