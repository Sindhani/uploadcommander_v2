<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                                class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                    class="ft-menu font-large-1"> </i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                    class="ficon ft-maximize"></i></a></li>
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
                                href="#" data-toggle="dropdown"> <span class="avatar avatar-online">
                                <img src="{{ (Auth::user()->photo) ? asset('user_photo/'.Auth::user()->photo): asset('images/user.jpg') }}"
                                        alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <a class="dropdown-item" href="#">
                                    <span class="avatar avatar-online">
                                        <img src="{{ asset('app-assets/images/portrait/small/avatar-s-19.png') }}"
                                                alt="avatar">
                                        <span class="user-name text-bold-700 ml-1">{{ Auth::user()->first_name }}</span>
                                    </span>
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('admin/user/'.Auth::user()->id.'/edit') }}"> <i
                                            class="ft-user"></i> Edit Profile</a>
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