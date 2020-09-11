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
                    <h3 class="content-header-title mb-0 d-inline-block">Add Language</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/language') }}">{{ __('Language') }}</a></li>
                                <li class="breadcrumb-item active">Add Language</li>
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

                                        {!! Form::open(array('route' => 'admin.language.store','method'=>'POST','class'=>'form form-horizontal')) !!}
                                            <div class="form-body">

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Name</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('language_name', '', array('placeholder' => 'Name','class' => 'form-control','required')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Country Code</label>
                                                    <div class="col-md-9">
                                                        {!! Form::select('country_code', $arrOfCountryCode,'', array('class' => 'form-control','required')) !!}
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
                                                <button type="button" class="btn btn-danger mr-1" onclick="location.href='{{ url('admin/language') }}'">
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
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
@endsection