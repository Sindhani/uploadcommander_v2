@extends('customer.layouts.app')

@section('vendor_style')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/js/gallery/photo-swipe/photoswipe.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/js/gallery/photo-swipe/default-skin/default-skin.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/file-uploaders/dropzone.min.css') }}">
@endsection

@section('page_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/file-uploaders/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/gallery.css') }}">
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block border-right-0">Media Center</h3>
                </div>
            </div>
            <div class="content-body">
                @include('customer.media.partian.gallery')
                <!-- Base style table -->
                <section id="base-style">

                    <div class="row">
                        <div class="col-12">
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
                        </div>
                    </div>
                    @include('customer.media.partian.dropzone')
                </section>
                <!--/ Base style table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('page_scripts')
<script src="{{ asset('app-assets/vendors/js/gallery/masonry/masonry.pkgd.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/dropzone.min.js') }}" type="text/javascript"></script>
@endsection

@section('scripts')
@stack('scripts')
@endsection