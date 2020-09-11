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
                    <h3 class="content-header-title mb-0 d-inline-block">System Settings</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">System Settings</li>
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

                                        @if (Session::has('success'))
                                            <div class="alert alert-success mt-2" role="alert">{{ Session::get('success') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endif

                                        {!! Form::model($settings, ['method' => 'PATCH','route' => ['admin.system_settings.update', $settings->id],'class'=>'form form-horizontal','enctype'=>'multipart/form-data']) !!}
                                            <div class="form-body">

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Maintenance mode</label>
                                                    <div class="col-md-9">
                                                        <div class="row skin skin-square ml-1">
                                                            <input type="checkbox" name="maintenance_mode" id="maintenance_mode" class="switchery" {{ ($settings->maintenance_mode)?"checked":"" }} value="1">
                                                            <label for="switchery" class="font-medium-2 text-bold-600 ml-1"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Website Name</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('website_name', $settings->website_name, array('placeholder' => 'Website Name','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Website Description</label>
                                                    <div class="col-md-9">
                                                        {!! Form::textarea('website_description', $settings->website_description, array('placeholder' => 'Website Description','class' => 'form-control', 'rows'=>4)) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Website Keywords</label>
                                                    <div class="col-md-9">
                                                        {!! Form::textarea('website_keywords', $settings->website_keywords, array('placeholder' => 'Website Description','class' => 'form-control', 'rows'=>4)) !!}
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Logo</label>
                                                    <div class="col-md-9">
                                                        <div class="custom-file">
                                                            <input type="file" name="logo" id="logo" class="custom-file-input" >
                                                            <label class="custom-file-label" for="logo">Choose Logo</label>
                                                        </div>
                                                        @if($settings->logo)
                                                            <img src="{{ asset('systemsettings/'.$settings->logo) }}" width="100px" class="mt-1">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Favicon</label>
                                                    <div class="col-md-9">
                                                        <div class="custom-file">
                                                            {!! Form::file('favicon', array('placeholder' => 'Favicon','class' => 'custom-file-input')) !!}
                                                            <label class="custom-file-label" for="favicon">Choose Favicon</label>
                                                        </div>
                                                        @if($settings->favicon)
                                                            <img src="{{ asset('systemsettings/'.$settings->favicon) }}" width="50px" class="mt-1">
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-actions right">
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
    <script src="{{ asset('app-assets/js/scripts/forms/custom-file-input.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
@endsection