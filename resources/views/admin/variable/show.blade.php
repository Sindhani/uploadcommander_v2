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
                    <h3 class="content-header-title mb-0 d-inline-block">Variables</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ url('/admin/language') }}">{{ __('Language') }}</a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('Variables') }}
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

                                            {!! Form::model($variables, ['method' => 'PATCH','route' => ['admin.variable.update', $id],'class'=>'form form-horizontal']) !!}
                                                <table class="table table-striped table-bordered base-style">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Text</th>
                                                            <th>Edit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(!empty($variables) && count($variables)>0)
                                                            @foreach($variables as $var)
                                                                <tr>
                                                                    <td>{{ $var->name }}</td>
                                                                    <td>{{ $var->text }}</td>
                                                                    <td><input type="text" class="form-control" name="var[{{ $var->id }}]" value="{{ $var->text }}" /></td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                    <tfoot>
                                                        @if(!empty($variables) && count($variables)>0)
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="la la-check-square-o"></i> Update
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tfoot>
                                                </table>
                                            {!! Form::close() !!}
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
                serverSide: false
            });
        });
    </script>
@endsection