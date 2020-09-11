<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true"
     data-img="app-assets/images/backgrounds/04.jpg">
	<div class="navbar-header">
		<ul class="nav navbar-nav flex-row position-relative">
			<li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo"
			                                                                            alt="Chameleon admin logo"
			                                                                            src="{{ asset('app-assets/images/logo/logo.png') }}"/>
					<h3 class="brand-text">UC</h3>
				</a></li>
			<li class="nav-item d-none d-md-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0"
			                                                     data-toggle="collapse"><i
							class="toggle-icon ft-disc font-medium-3" data-ticon="ft-disc"></i></a></li>
			<li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
		</ul>
	</div>
	<div class="navigation-background"></div>
	<div class="main-menu-content">
		<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
			<li class=" nav-item"><a href="{{ url('/') }}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
			</li>

			<li class=" nav-item"><a href="{{ url('admin/role') }}"><i class="ft-home"></i><span class="menu-title"
			                                                                                     data-i18n="">Roles & Rights</span></a>
			</li>

			<li class=" nav-item"><a href="#"><i class="ft-layers"></i><span class="menu-title" data-i18n="">User administration</span></a>
				<ul class="menu-content">
					<li><a class="menu-item" href="{{ url('admin/customer') }}">Customers</a>
					</li>
					<li><a class="menu-item" href="{{ url('admin/user') }}">Administrators</a>
					</li>
				</ul>
			</li>

			<li class=" nav-item"><a href="#"><i class="ft-layers"></i><span class="menu-title"
			                                                                 data-i18n="">Accounting</span></a>
				<ul class="menu-content">
					<li><a class="menu-item" href="#">Dashboard</a>
					</li>
					<li><a class="menu-item" href="#">Invoices</a>
					</li>
					<li><a class="menu-item" href="#">Affiliate cashouts</a>
					</li>
				</ul>
			</li>

			<li class=" nav-item"><a href="#"><i class="ft-layers"></i><span class="menu-title" data-i18n="">Affiliate marketing</span></a>
				<ul class="menu-content">
					<li><a class="menu-item" href="{{ url('admin/customer_affiliate') }}">Customer Affiliate</a>
					</li>
					<li><a class="menu-item" href="{{ url('admin/affiliate_registration_cashout') }}">Registration/Cashout</a>
					</li>
				</ul>
			</li>


			<li class=" nav-item"><a href="{{ url('admin/coupon') }}"><i class="ft-home"></i><span class="menu-title"
			                                                                                       data-i18n="">Coupons</span></a>
			</li>
            <li class=" nav-item"><a href="#"><i class="ft-layers"></i><span class="menu-title" data-i18n="">Support</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.tickets')}}">Ticket system</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.tickets_archive')}}">Ticket Archive</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.helpdesk.index')}}">HelpDesk</a>
            		<li><a class="menu-item" href="{{route('admin.faq.index')}}">FAQ</a>
                    </li>
                    <li><a class="menu-item" href="#">Chat system</a>
                    </li>
                </ul>
            </li>


			<li class=" nav-item"><a href="#"><i class="ft-layers"></i><span class="menu-title"
			                                                                 data-i18n="">Product</span></a>
				<ul class="menu-content">
					<li><a class="menu-item" href="{{ url('admin/package') }}">Packages</a>
					</li>
					<li><a class="menu-item" href="{{ url('admin/productfeature') }}">Features</a>
					</li>
					<li><a class="menu-item" href="{{ url('admin/productaddon') }}">Addons</a>
					</li>
				</ul>
			</li>

			<li class=" nav-item"><a href="#"><i class="ft-home"></i><span class="menu-title"
			                                                               data-i18n="">Modules</span></a></li>


			<li class=" nav-item"><a href="#"><i class="ft-layers"></i><span class="menu-title"
			                                                                 data-i18n="">Settings</span></a>
				<ul class="menu-content">
					<li><a class="menu-item" href="{{ url('admin/system_settings/1/edit') }}">System</a>
					</li>
					<li><a class="menu-item" href="{{ url('admin/email_settings/1/edit') }}">Email Settings</a>
					</li>
					<li><a class="menu-item" href="{{ url('admin/email_template') }}">Email templates</a>
					</li>
					<li><a class="menu-item" href="{{ url('admin/api_setting/1/edit') }}">API</a>
					</li>
					<li><a class="menu-item" href="#">Proxy</a>
					</li>
					<li><a class="menu-item" href="{{ url('admin/language') }}">Language</a>
					</li>
					<li><a class="menu-item" href="{{ url('admin/settings/1/edit') }}">Affiliate</a>
					</li>
					<li><a class="menu-item" href="{{ url('admin/document_template') }}">Document templates</a>
					</li>
				</ul>
			</li>

		</ul>
	</div>
</div>
<!-- END: Main Menu-->