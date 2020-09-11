@extends('admin.layouts.admin')
@section('page_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/checkboxes-radios.css') }}">
@endsection
@section('content')
<style>
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
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Add User</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/role') }}">{{ __('User') }}</a></li>
                                <li class="breadcrumb-item active">Add User</li>
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

                                        {!! Form::open(array('route' => 'admin.user.store','method'=>'POST','class'=>'form form-horizontal')) !!}
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
                                                <div class="col-md-9">
                                                    
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">First Name</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control','required')) !!}
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Surname</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('surname', null, array('placeholder' => 'Surname','class' => 'form-control','required')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Email</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','required')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Password</label>
                                                    <div class="col-md-9">
                                                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control','required','required')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Roles</label>
                                                    <div class="col-md-9">
                                                        {!! Form::select('roles', $roles,[], array('class' => 'form-control','required')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Timezone</label>
                                                    <div class="col-md-9">
                                                        {!! Form::select('timezone', $timezones,[], array('class' => 'form-control','required')) !!}
                                                    </div>
                                                </div>
                                                
                                                <div class="form-actions right">
                                                    <button type="button" class="btn btn-danger mr-1" onclick="location.href='{{ url('admin/user') }}'">
                                                        <i class="ft-x"></i> Cancel
                                                    </button>
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