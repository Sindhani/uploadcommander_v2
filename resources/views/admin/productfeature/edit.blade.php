@extends('admin.layouts.admin')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Add Product Features</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/productfeature') }}">{{ __('Product Features') }}</a></li>
                                <li class="breadcrumb-item active">Add Product Features</li>
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

                                        {!! Form::model($productFeatures, ['method' => 'PATCH','route' => ['admin.productfeature.update', $productFeatures->id],'class'=>'form form-horizontal']) !!}
                                        <div class="form-body">

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Name</label>
                                                <div class="col-md-9">
                                                    {!! Form::text('name', $productFeatures->name, array('placeholder' => 'Name','class' => 'form-control','required')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Description</label>
                                                <div class="col-md-9">
                                                    {!! Form::textarea('description', $productFeatures->description, array('placeholder' => 'Description','class' => 'form-control','rows'=>4)) !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Product Type</label>
                                                <div class="col-md-9">
                                                    {!! Form::select('product_type', $arrOfProductType,$productFeatures->product_type, array('class' => 'form-control','required')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Version</label>
                                                <div class="col-md-9">
                                                    {!! Form::text('version', $productFeatures->version, array('placeholder' => 'Version','class' => 'form-control','required')) !!}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="projectinput6">Is Active</label>
                                                <div class="col-md-9">
                                                    <label>{{ Form::checkbox('is_active', 'Yes', ($productFeatures->is_active=='Yes')?true:false, array('class' => '')) }}</label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-actions right">
                                            <button type="button" class="btn btn-danger mr-1" onclick="location.href='{{ url('admin/productfeature') }}'">
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
