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
                    <h3 class="content-header-title mb-0 d-inline-block">API Settings</h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">API Settings</li>
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

                                        {!! Form::model($settings, ['method' => 'PATCH','route' => ['admin.api_setting.update', $settings->id],'class'=>'form form-horizontal']) !!}
                                            <div class="form-body">

                                                <h4 class="mb-2">Stripe API settings</h4>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Enviroment</label>
                                                    <div class="col-md-9">
                                                        {!! Form::select('stripe_mode', $environment, $settings->stripe_mode, array('class' => 'form-control')) !!}
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Publishable key</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('stripe_key', $settings->stripe_key, array('placeholder' => 'Publishable key','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Secret key</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('stripe_secret_key', $settings->stripe_secret_key, array('placeholder' => 'Secret key','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Webhook Signing Secret Key</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('stripe_webhook_signing_secret_key', $settings->stripe_webhook_signing_secret_key, array('placeholder' => 'Webhook Signing Secret Key','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row pb-1">
                                                    <label class="col-md-3 label-control">Enable Recurring Payments</label>
                                                    <div class="col-md-9">
                                                        <div class="row skin skin-square ml-1">
                                                            <input type="checkbox" name="stripe_enable_recurring_payment" id="stripe_enable_recurring_payment" class="switchery" value="Yes" {{ ($settings->stripe_enable_recurring_payment=='Yes')?"checked='checked'":"" }}>
                                                            <label for="stripe_enable_recurring_payment" class="font-medium-2 text-bold-600 ml-1"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <h4 class="mb-2">PayPal API settings</h4>
                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Enviroment</label>
                                                    <div class="col-md-9">
                                                        {!! Form::select('paypal_mode', $environment, $settings->paypal_mode, array('class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">PayPal Client ID</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('paypal_client_id', $settings->paypal_client_id, array('placeholder' => 'PayPal Client ID','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">PayPal Client Secret</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('paypal_client_secret', $settings->paypal_client_secret, array('placeholder' => 'PayPal Client Secret','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">WebHook ID</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('paypal_webhook', $settings->paypal_webhook, array('placeholder' => 'WebHook ID','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row pb-1">
                                                    <label class="col-md-3 label-control">Enable Subscription</label>
                                                    <div class="col-md-9">
                                                        <div class="row skin skin-square ml-1">
                                                            <input type="checkbox" name="paypal_enable_subscription" id="paypal_enable_subscription" class="switchery" value="Yes" {{ ($settings->paypal_enable_subscription=='Yes')?"checked='checked'":"" }}>
                                                            <label for="paypal_enable_subscription" class="font-medium-2 text-bold-600 ml-1"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <h4 class="mb-2">Google reCaptcha API settings</h4>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Site key</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('recaptcha_site_key', $settings->recaptcha_site_key, array('placeholder' => 'Site key','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Secret key</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('recaptcha_secret_key', $settings->recaptcha_secret_key, array('placeholder' => 'Secret key','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row pb-1">
                                                    <label class="col-md-3 label-control">Enable reCaptcha in signup page</label>
                                                    <div class="col-md-9">
                                                        <div class="row skin skin-square ml-1">
                                                            <input type="checkbox" name="enable_recaptcha" id="enable_recaptcha" class="switchery" value="Yes" {{ ($settings->enable_recaptcha=='Yes')?'checked="checked"':'' }}>
                                                            <label for="enable_recaptcha" class="font-medium-2 text-bold-600 ml-1"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <h4 class="mb-2">Google Drive Picker API settings</h4>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Google API Key</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('google_api_key', $settings->google_api_key, array('placeholder' => 'Google API Key','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Google Client ID</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('google_client_id', $settings->google_client_id, array('placeholder' => 'Google Client ID','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <hr>

                                                <h4 class="mb-2">Dropbox Chooser API settings</h4>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">Dropbox API Key</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('dropbox_api_key', $settings->dropbox_api_key, array('placeholder' => 'Dropbox API Key','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                                <hr>

                                                <h4 class="mb-2">OneDrive File Picker API settings</h4>

                                                <div class="form-group row">
                                                    <label class="col-md-3 label-control">OneDrive Client ID</label>
                                                    <div class="col-md-9">
                                                        {!! Form::text('onedrive_client_id', $settings->onedrive_client_id, array('placeholder' => 'OneDrive Client ID','class' => 'form-control')) !!}
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions right">
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
    <script src="{{ asset('app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
@endsection

@section('scripts')
    <script src="{{ asset('app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
@endsection