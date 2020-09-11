@extends('customer.layouts.app')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block border-right-0">Social Accounts</h3>
                </div>
            </div>
            <div class="content-body content-body-top">
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

                    <div class="row">
                        <div class="col-4">
                            <div class="card change-color">
                                <div class="card-header pb-0 change-color">
                                        <h4 class="card-title" id="hidden-label-basic-form">Instagram</h4>
                                    </div>

                                <div class="card-content collapse show change-height-insta-card">
                                    <img class="card-img-top center change-height-insta" src={{asset('app-assets/images/icons/insta.png')}}>

                                @if(!empty($instragramAccounts) && count($instragramAccounts)>0)
                                        <div id="recent-buyers" class="media-list">
                                            <img class="card-img-top center relative-pos" src={{asset('app-assets/images/icons/insta.png')}}>
                                        @foreach($instragramAccounts as $tws)
                                                <a href="#" class="media border-0">
                                                    <div class="media-body w-100">
                                            <span class="list-group-item-heading font-color">{{ $tws->option('instagram_username') }}

                                            </span>
                                                        <ul class="list-unstyled users-list m-0 float-right">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Delete Account" class="" onclick="deleteAccount({{ $tws->id }})">
                                                                <i class="la la-remove mr-0"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="card-body card-dashboard">
                                        <div class="form-actions text-center border-top-0">
                                            <a class="btn btn-glow btn-bg-gradient-x-purple-blue round text-white" href="{{ url('customer/instagram') }}">
                                                <i class="la la-check-square-o"></i> Add Account
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card change-color">
                                <div class="card-header pb-0 change-color">
                                    <h4 class="card-title" id="hidden-label-basic-form">Facebook</h4>
                                </div>

                                <div class="card-content change-height-fb-card">
                                        <img class="card-img-top center change-height-fb" src={{asset('app-assets/images/icons/fb.png')}}>

                                    @if(!empty($fbAccounts) && count($fbAccounts)>0)
                                    <div id="recent-buyers" class="media-list">
                                        @foreach($fbAccounts as $fbs)
                                        <a href="#" class="media border-0">
                                            <div class="media-left pr-1">
                                            <span class="avatar avatar-md">
                                                <img class="media-object rounded-circle" src="{{ $fbs->option('facebook_avatar') }}" alt="">
                                                <i></i>
                                            </span>
                                            </div>
                                            <div class="media-body w-100">
                                            <span class="list-group-item-heading font-color">{{ $fbs->option('facebook_name') }}

                                            </span>
                                                <ul class="list-unstyled users-list m-0 float-right">
                                                    <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Delete Account" class="" onclick="deleteAccount({{ $fbs->id }})">
                                                        <i class="la la-remove mr-0"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    @endif

                                    @include('customer.social_account.social_login.facebook')
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card change-color">
                                <div class="card-header pb-0 change-color">
                                    <h4 class="card-title" id="hidden-label-basic-form">Twitter</h4>
                                </div>
                                <div class="card-content collapse show">
                                    @if(empty($twitterAccounts) && count($twitterAccounts)>0)
                                        <img class="card-img-top center relative-pos" src={{asset('app-assets/images/icons/twitter.png')}}>
                                    @endif
                                @if(!empty($twitterAccounts) && count($twitterAccounts)>0)
                                        <div id="recent-buyers" class="media-list">
                                            <img class="card-img-top center relative-pos" src={{asset('app-assets/images/icons/twitter.png')}}>
                                        @foreach($twitterAccounts as $tws)
                                                <a href="#" class="media border-0">
                                                    <div class="media-left pr-1">
                                            <span class="avatar avatar-md">
                                                <img class="media-object rounded-circle" src="{{ $tws->option('twitter_avatar') }}" alt="">
                                                <i></i>
                                            </span>
                                                    </div>
                                                    <div class="media-body w-100">
                                            <span class="list-group-item-heading font-color">{{ $tws->option('twitter_name') }}

                                            </span>
                                                        <ul class="list-unstyled users-list m-0 float-right">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Delete Account" class="" onclick="deleteAccount({{ $tws->id }})">
                                                                <i class="la la-remove mr-0"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="card-body card-dashboard">
                                        <div class="form-actions text-center border-top-0">
                                            <a class="btn btn-glow btn-bg-gradient-x-purple-blue round text-white" href="{{ url('customer/twitter') }}">
                                                <i class="la la-check-square-o"></i> Add Account
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-4">
                            <div class="card change-color">
                                <div class="card-header pb-0 change-color">
                                    <h4 class="card-title" id="hidden-label-basic-form">Linkedin</h4>
                                </div>

                                <div class="card-content collapse show change-height-insta-card">
                                    <img class="card-img-top center change-height-insta" src={{asset('app-assets/images/icons/linkedin.png')}}>

                                    @if(!empty($instragramAccounts) && count($instragramAccounts)>0)
                                        <div id="recent-buyers" class="media-list">
                                            <img class="card-img-top center relative-pos" src={{asset('app-assets/images/icons/linkedin.png')}}>
                                            @foreach($instragramAccounts as $tws)
                                                <a href="#" class="media border-0">
                                                    <div class="media-body w-100">
                                            <span class="list-group-item-heading font-color">{{ $tws->option('linkedin_username') }}

                                            </span>
                                                        <ul class="list-unstyled users-list m-0 float-right">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Delete Account" class="" onclick="deleteAccount({{ $tws->id }})">
                                                                <i class="la la-remove mr-0"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="card-body card-dashboard">
                                        <div class="form-actions text-center border-top-0">
                                            <a class="btn btn-glow btn-bg-gradient-x-purple-blue round text-white" href="{{ url('customer/linkedin') }}">
                                                <i class="la la-check-square-o"></i> Add Account
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card change-color">
                                <div class="card-header pb-0 change-color">
                                    <h4 class="card-title" id="hidden-label-basic-form">Xing</h4>
                                </div>

                                <div class="card-content change-height-fb-card">
                                    <img class="card-img-top center change-height-fb" src={{asset('app-assets/images/icons/xing.png')}}>

                                    @if(!empty($fbAccounts) && count($fbAccounts)>0)
                                        <div id="recent-buyers" class="media-list">
                                            @foreach($fbAccounts as $fbs)
                                                <a href="#" class="media border-0">
                                                    <div class="media-left pr-1">
                                            <span class="avatar avatar-md">
                                                <img class="media-object rounded-circle" src="{{ $fbs->option('xing_avatar') }}" alt="">
                                                <i></i>
                                            </span>
                                                    </div>
                                                    <div class="media-body w-100">
                                            <span class="list-group-item-heading font-color">{{ $fbs->option('xing_name') }}

                                            </span>
                                                        <ul class="list-unstyled users-list m-0 float-right">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Delete Account" class="" onclick="deleteAccount({{ $fbs->id }})">
                                                                <i class="la la-remove mr-0"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif

                                    @include('customer.social_account.social_login.facebook')
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card change-color">
                                <div class="card-header pb-0 change-color">
                                    <h4 class="card-title" id="hidden-label-basic-form">Pinterest</h4>
                                </div>
                                <div class="card-content collapse show">
                                    @if(empty($twitterAccounts) && count($twitterAccounts)>0)
                                        <img class="card-img-top center relative-pos" src={{asset('app-assets/images/icons/pinterest.png')}}>
                                    @endif
                                    @if(!empty($twitterAccounts) && count($twitterAccounts)>0)
                                        <div id="recent-buyers" class="media-list">
                                            <img class="card-img-top center relative-pos" src={{asset('app-assets/images/icons/pinterest.png')}}>
                                            @foreach($twitterAccounts as $tws)
                                                <a href="#" class="media border-0">
                                                    <div class="media-left pr-1">
                                            <span class="avatar avatar-md">
                                                <img class="media-object rounded-circle" src="{{ $tws->option('twitter_avatar') }}" alt="">
                                                <i></i>
                                            </span>
                                                    </div>
                                                    <div class="media-body w-100">
                                            <span class="list-group-item-heading font-color">{{ $tws->option('twitter_name') }}

                                            </span>
                                                        <ul class="list-unstyled users-list m-0 float-right">
                                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Delete Account" class="" onclick="deleteAccount({{ $tws->id }})">
                                                                <i class="la la-remove mr-0"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="card-body card-dashboard">
                                        <div class="form-actions text-center border-top-0">
                                            <a class="btn btn-glow btn-bg-gradient-x-purple-blue round text-white" href="{{ url('customer/twitter') }}">
                                                <i class="la la-check-square-o"></i> Add Account
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('scripts')
    <script type="text/javascript">
        function deleteAccount(id)
        {
            if(confirm('Are you sure to delete?'))
            {
                window.location.href='{{ url('customer/social_account/destroy') }}'+'/'+id;
            }
            else
            {
                return false;
            }
        }
    </script>
    @stack('scripts')
@endsection
