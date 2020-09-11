<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.8/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
</head>

<style>

    .megamenu-li {
        position: static;
    }

    .megamenu {
        position: absolute;
        width: 100%;
        left: 0;
        right: 0;
        padding: 15px;
    }

    .hr-line{
        color: #E5E5E5;
        border:         none;
        border-left:    1px solid ;
        height:         40vh;
        width:          1px;
        margin: 0px;
    }

    .robot-size {
        width: 125px;
        height: 170px;
    }
    .robot-margin {
        margin-left: 45px;
        margin-bottom: 20px;
        margin-top: 13px;
    }

    .top-space {
        margin-top: 50px;
    }

    .image-alignment  {
        float: left;
        margin: 0 15px 0 0;
    }

    .btn-min-width-robot {
        min-width: 9.5rem;
        margin-left: 65px;
    }

    .robot-tour-p {
        min-width: 20rem;
        font-size: 11px;
        color: #57AAD8;
        font-weight: 600;
    }

    .center-helpdesk {
        align-items: center;
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 30%;
    }

    .cross {
        font-size: 20px;
    }


    .navbar-semi-dark .navbar-nav .active.nav-link {
        background-color: rgb(30 154 213);
        padding: 13px;
        border-radius: 4px;
        margin-bottom: 5px;
    }
    .arrow_box a{
        color: #0973ba !important;
    }
    .arrow_box .active{
        color: white !important;
    }
    @media (min-width: 992px){
        .navbar .nav-center {
            margin-left : 1em;
            margin-right : 30em;
        }
    }


</style>
<body class="vertical-layout vertical-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse show" id="navbar-mobile">

                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>

                    <li class="helpdesk-center nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                    <li class="dropdown d-none d-md-block mr-1 megamenu-li">
                        <a class="dropdown-toggle nav-link" id="apps-navbar-links" href="#" data-toggle="dropdown">
                            <i class="ficon ft-help-circle"></i></a>

                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                            <button type="button" class="close" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="center-helpdesk">Upload Commander HelpDesk</h4>

                            <div class="row">
                                <div class="col-sm-6 col-lg-2">
                                    <div class="arrow_box">
                                        @php $count = 1; $menu = $menu; $child = $child; @endphp
                                        @foreach($menu as $key => $value)
                                        @if($value->is_menu)
                                        <a class="dropdown-item" href="#">{{$value->description}}</a>
                                        @foreach($child as $key => $childd)
                                        @if (Request::path() == $childd->linked_page) 
                                        @if($childd->assignment == $value->description)
                                        <ul>
                                            <li><a class="nav-link @if(Request::path() == $childd->linked_page) active @endif" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home-{{$count++}}" role="tab" aria-controls="v-pills-home-{{$count++}}" aria-selected="true" style="font-size: 10px;padding: 8px;">{{$childd->description}}</a></li>
                                        </ul>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                        @endforeach

                                    </div>
                                </div>
                                <span class="hr-line"></span>

                                <div class="col-sm-6 col-lg-7">

                                    <div class="tab-content" id="v-pills-tabContent">
                                        @php $count = 1; @endphp
                                        @foreach($menu1 as $key => $values)
                                            @if($values->is_menu)
                                                @foreach($child1 as $key => $children)
                                                    @if($children->assignment == $values->description)
                                                        <div class="tab-pane fade @if(Request::path() == $children->linked_page) show active @endif" id="v-pills-home-{{$count++}}" role="tabpanel" aria-labelledby="v-pills-home-tab-{{$count++}}">{!! $children->content !!}</div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>

                                </div>

                                <span class="hr-line"></span>
                                <div class="col-sm-6 col-lg-1">

                                    <img class="robot-size robot-margin" src="{{asset('app-assets/images/social/robot-tour.png')}}">
                                    <button type="button" class="btn btn-info btn-min-width-robot mr-1 mb-1">Start Tour</button>
                                    <p class="robot-tour-p">Click this button to start a demo user tour</p>
                                </div>

                            </div>
                        </div>
                    </li>

                    <li id="id01" class="history-center dropdown d-none d-md-block mr-1 megamenu-li">
                        <a class="dropdown-toggle nav-link" id="apps-navbar-links" href="#" data-toggle="dropdown">
                            <i class="ficon ft-clock"></i></a>

                        <div class="dropdown-menu megamenu" aria-labelledby="dropdown01">
                            <button type="button" class="close" aria-label="Close">
                                <span onclick="document.getElementById('id02').style.display='none'"  aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="center-helpdesk">Upload Commander History</h4>



                            <hr>
                            <div class="row">
                                <div class="col-sm-6 col-lg-2">
                                    <img class="robot-history-size robot-margin-history" src={{asset('app-assets/images/social/robot-history.png')}}>
                                </div>
                                <hr class="hr-line2">

                                <div class="col-sm-6 col-lg-7">
                                    <div class="search-helpdesk">
                                        <form id="search-form" class="form-inline" role="form" method="post" action="//www.google.com/search" target="_blank">
                                            <div class="input-group search-width">
                                                <input type="text" class="form-control search-form" placeholder="Search">
                                                <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary search-btn" data-target="#search-form" name="q"><i class="margin-right fa ft-search"></i>
                                        </button>
                                    </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="">
                                        <div class="">

                                            <div class="col-12 timeline-left" id="activity">
                                                <div class="timeline">



                                                    <ul class="base-timeline activity-timeline">
                                                        <li>
                                                            <div class="timeline-icon-edit bg-primary">
                                                                <i class="margin-right margin-right font-medium-1">Today</i>
                                                            </div>

                                                            <ul class="base-timeline-sub list-unstyled users-list m-0">
                                                                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                                </li>
                                                            </ul>
                                                        </li>

                                                        <li>
                                                            <div class="timeline-icon bg-warning">
                                                                <div data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Linda Olson" class="avatar avatar-sm pull-up">
                                                                    <img class="list-group-item-heading media-object rounded-circle" src={{asset("app-assets/images/portrait/small/avatar-s-14.png")}} alt="Avatar" style="margin-bottom: 5px;">
                                                                </div>
                                                            </div>
                                                            <ul class="row base-timeline-sub list-unstyled users-list m-0">
                                                                <div class="card-body timeline-card-body card-body-padding col-lg-4">
                                                                    <div class="list-group-item-heading act-time mr-1">08/27/2020 | <span>02:46 PM</span></div>
                                                                    <span>Linda Olson</span>
                                                                </div>
                                                                <div class=" base-timeline-info col-lg-9 second-card-margin-left">
                                                                    <div class="card-body timeline-card-body card-body-padding" style="padding-bottom: 43px;">
                                                                        <a href="#" class="text-warning">Have added a Subuser demo to the system.</a>
                                                                    </div>
                                                                </div>
                                                            </ul>
                                                        </li>


                                                        <li>
                                                            <div class="timeline-icon bg-warning">
                                                                <div data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kristopher Candy" class="avatar avatar-sm pull-up">
                                                                    <img class="list-group-item-heading media-object rounded-circle" src={{asset("app-assets/images/social/robo-avatar.png")}} alt="Avatar">
                                                                </div>
                                                            </div>
                                                            <ul class="row base-timeline-sub list-unstyled users-list m-0">
                                                                <div class="card-body timeline-card-body card-body-padding col-lg-4">
                                                                    <div class="list-group-item-heading act-time mr-1">08/27/2020 | <span>02:46 PM</span></div>
                                                                    <span>Kristopher Candy</span>
                                                                </div>
                                                                <div class=" base-timeline-info col-lg-9 second-card-margin-left">
                                                                    <div class="card-body timeline-card-body card-body-padding" style="padding-bottom: 16px;">
                                                                        <span style="color: #27aae1;">UploadCommander has posted the planned task <a href="#" style="color: #5654c8;">test post</a> on your Facebook Account <a href="#" style="color: #5654c8;">Test</a> and Instagram Account <a href="#" style="color: #5654c8;">Demo</a></span>
                                                                    </div>
                                                                </div>
                                                            </ul>
                                                        </li>


                                                        <li>
                                                            <div class="timeline-icon">
                                                                <div data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Lawrance Fawler" class="avatar avatar-sm pull-up">
                                                                    <img class="list-group-item-heading media-object rounded-circle" src={{asset("app-assets/images/portrait/small/avatar-s-12.png")}} alt="Avatar" style="margin-bottom: 5px;">
                                                                </div>
                                                            </div>
                                                            <ul class="row base-timeline-sub list-unstyled users-list m-0">
                                                                <div class="card-body timeline-card-body card-body-padding col-lg-4">
                                                                    <div class="list-group-item-heading act-time mr-1">08/27/2020 | <span>02:46 PM</span></div>
                                                                    <span>Lawrance Fawler</span>
                                                                </div>
                                                                <div class=" base-timeline-info col-lg-9 second-card-margin-left">
                                                                    <div class="card-body timeline-card-body card-body-padding" style="padding-bottom: 43px;">
                                                                        <a href="#" class="text-warning">Have added a Subuser demo to the system.</a>
                                                                    </div>
                                                                </div>
                                                            </ul>

                                                        </li>

                                                        <li>

                                                            <div class="timeline-icon bg-warning">
                                                                <div data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Robo Jackson" class="avatar avatar-sm pull-up">
                                                                    <img class="list-group-item-heading media-object rounded-circle" src={{asset("app-assets/images/social/robo-avatar.png")}} alt="Avatar">
                                                                </div>
                                                            </div>
                                                            <ul class="row base-timeline-sub list-unstyled users-list m-0">
                                                                <div class="card-body timeline-card-body card-body-padding col-lg-4">
                                                                    <div class="list-group-item-heading act-time mr-1">08/27/2020 | <span>02:46 PM</span></div>
                                                                    <span>Robo Jackson</span>
                                                                </div>
                                                                <div class=" base-timeline-info col-lg-9 second-card-margin-left">
                                                                    <div class="card-body timeline-card-body card-body-padding" style="padding-bottom: 16px;">
                                                                        <span style="color: #27aae1;">UploadCommander has posted the planned task <a href="#" style="color: #5654c8;">test post</a> on your Facebook Account <a href="#" style="color: #5654c8;">Test</a> and Instagram Account <a href="#" style="color: #5654c8;">Demo</a></span>
                                                                    </div>
                                                                </div>
                                                            </ul>

                                                        </li>

                                                        {{--                                                            <div class="list-inline mt-n2 align-right">--}}
                                                        {{--                                                                <li><button type="button" class="btn btn-glow btn-round btn-bg-gradient-x-blue-cyan">Older Posts</button></li>--}}
                                                        {{--                                                            </div>--}}
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="hr-line2">
                                <div class="col-sm-1 col-lg-2">
                                    <div class="card filter-card">
                                        <div class="card-header">
                                            <h4 class="card-title" style="color: #464855;">Filter by User</h4>
                                            <a class="heading-elements-toggle">
                                                <i class="fa fa-ellipsis-v font-medium-3"></i>
                                            </a>
                                        </div>
                                        <a href="" class="custom-card">
                                            <div class="card-content">
                                                <div id="recent-buyers" class="media-list">
                                                    <a href="#" class="media border-0">
                                                        <div class="media-left pr-1">
                                                <span class="avatar avatar-md avatar-online">
                                                    <img href="#" class="media-object rounded-circle" src={{asset("app-assets/images/portrait/small/avatar-s-7.png")}}>
                                                    <i></i>
                                                </span>
                                                        </div>
                                                        <div class="media-body w-100">
                                                <span class="list-group-item-heading">Kristopher Candy
                                                </span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </a>

                                        <div class="card-content">
                                            <div id="recent-buyers" class="media-list">
                                                <a href="#" class="media border-0">
                                                    <div class="media-left pr-1">
                                                <span class="avatar avatar-md avatar-online">
                                                    <img class="media-object rounded-circle" src={{asset("app-assets/images/portrait/small/avatar-s-8.png")}}>
                                                    <i></i>
                                                </span>
                                                    </div>
                                                    <div class="media-body w-100">
                                                <span class="list-group-item-heading">Lawrence Fowler
                                                </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="card-content">
                                            <div id="recent-buyers" class="media-list">
                                                <a href="#" class="media border-0">
                                                    <div class="media-left pr-1">
                                                        <span class="avatar avatar-md avatar-online">
                                                            <img class="media-object rounded-circle" src={{asset("app-assets/images/portrait/small/avatar-s-9.png")}}>
                                                        </span>
                                                    </div>
                                                    <div class="media-body w-100">
                                                        <span class="list-group-item-heading">Linda Olson</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link"
                                                                       id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true"
                                                                       aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span
                                class="selected-language"></span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            <div class="arrow_box"><a class="dropdown-item" href="{{ url('admin/locale/en') }}"><i
                                        class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item"
                                                                                          href="{{ url('admin/locale/gr') }}"><i
                                        class="flag-icon flag-icon-de"></i> German</a></div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown"> <span class="avatar avatar-online"><img
                                    src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                    alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right"><a class="dropdown-item" href="#"><span
                                        class="avatar avatar-online"><img
                                            src="{{ (Auth::guard('customers')->user()->photo)?asset('user_photo/'.Auth::guard('customers')->user()->photo):asset('images/user.jpg') }}"
                                            alt="avatar"><span class="user-name text-bold-700 ml-1">
											{{ Auth::guard('customers')->user()->first_name }}
										</span></span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('customer/profile') }}"><i
                                        class="ft-user"></i> Account Settings</a>
                                @if(Auth::guard('customers')->user()->parent_id === null)
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
                                            class="ft-user"></i> Contract Details</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
                                            class="ft-user"></i> Affilitte Details</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item"
                                                                           href="{{ url('customer/user') }}"><i
                                            class="ft-user"></i> User Management</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="{{route('customer.tickets')}}"><i
                                            class="ft-user"></i> Support Tickets</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i

                                        class="ft-power"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav><!-- END: Header-->

</nav>
<!-- END: Header-->

<script>
    function closeWin() {
        myWindow.close();
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.0.8/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
