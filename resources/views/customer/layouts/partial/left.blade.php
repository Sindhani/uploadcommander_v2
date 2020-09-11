<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true"
        data-img="{{ asset('app-assets/images/backgrounds/02.jpg') }}">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ url('/') }}"><img class="brand-logo"
                            alt="Chameleon admin logo" src="{{ asset('app-assets/images/logo/logo.png') }}"/> </a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="navigation-background"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{ url('/') }}"><i class="ft-home"></i><span class="menu-title"
                            data-i18n="">Dashboard</span></a>
            </li>
            <li class=" nav-item"><a href="{{ url('customer/social_account') }}"><i class="ft-user-plus"></i><span
                            class="menu-title" data-i18n="">Social Accounts</span></a></li>
            <li class=" nav-item"><a href="{{ url('/customer/media') }}"><i class="ft-image"></i><span
                            class="menu-title" data-i18n="">Media Center</span></a></li>
            <li class=" nav-item"><a href="#"><i class="ft-plus-circle"></i><span class="menu-title"
                            data-i18n="">Content Library</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="ft-calendar"></i><span class="menu-title"
                            data-i18n="">Task Management</span></a>
            </li>
            <li class=" nav-item"><a href="{{route('customer.captions.index')}}"><i class="ft-grid"></i><span
                            class="menu-title" data-i18n="">Caption Templates</span></a></li>
            <li class=" nav-item"><a href="{{route('customer.social-collection.index')}}"><i class="ft-inbox"></i><span
                            class="menu-title" data-i18n="">Social Collection</span></a></li>
            <li class=" nav-item"><a href="#"><i class="ft-bar-chart-2"></i><span class="menu-title"
                            data-i18n="">Statistics</span></a></li>
            <li class=" nav-item"><a href="#"><i class="ft-cpu"></i><span class="menu-title"
                            data-i18n="">Features</span></a></li>
        </ul>
    </div>
</div><!-- END: Main Menu-->