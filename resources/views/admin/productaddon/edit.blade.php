@extends('admin.layouts.admin')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Product Addons</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/productaddon') }}">{{ __('Product Addons') }}</a></li>
                                <li class="breadcrumb-item active">Edit Product Addons</li>
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

                                        {!! Form::model($productAddons, ['method' => 'PATCH','route' => ['admin.productaddon.update', $productAddons->id],'class'=>'form form-horizontal']) !!}
                                            <div class="form-body">

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Addon Name</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('addon_name', $productAddons->subscription_name, array('placeholder' => 'Addon Name','class' => 'form-control','required')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Social Account Limit</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('social_account_limit', $productAddons->social_account_limit, array('placeholder' => 'Social Account Limit','class' => 'form-control')) !!}
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">File Storage Size (MB)</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('file_storage_size', $productAddons->file_storage_size, array('placeholder' => 'File Storage Size (MB)','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Monthly Pricing</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('monthly_pricing', $productAddons->monthly_pricing, array('placeholder' => 'Monthly Pricing','class' => 'form-control','required')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Yearly Pricing</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('yearly_pricing', $productAddons->yearly_pricing, array('placeholder' => 'Yearly Pricing','class' => 'form-control','required')) !!}
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions right">
                                                <button type="button" class="btn btn-danger mr-1" onclick="location.href='{{ url('admin/productaddon') }}'">
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
